<?php

namespace app\controllers;

use Yii;

use app\models\Ticket;
use app\models\TicketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use yii\helpers\ArrayHelper;
use app\models\TicketType;
use app\models\AssignedTicket;
use app\models\TicketDetail;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'create', 
                            'update', 
                            'delete', 
                            'index', 
                            'view', 
                            'tickets', 
                            'unassigned', 
                            'assignticket',
                            'pending',
                            'ticketdetails',
                            'report',
                            'reportdata'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $ticketModel  = new Ticket;

        $ticketOpen   = Ticket::TICKET_OPEN;
        $ticketAssg   = Ticket::TICKET_ASSIGNED;
        $ticketPnd    = Ticket::TICKET_PENDING;
        $allOpen      = "$ticketOpen, $ticketAssg, $ticketPnd";

        $allTickets           = $ticketModel::find()->andWhere("id_ticket_status IN ($allOpen)")->all();
        $allTimeTickets       = $ticketModel::find()->all();
        $allUnassignedTickets = $ticketModel::find()->andWhere("id_ticket_status IN ($ticketOpen)")->all();        
        $allPendingTickets    = $ticketModel->getCurrentUserTickets();
        

        return $this->render('index_all', [
            'allTickets' => $allTickets,
            'allTimeTickets' => $allTimeTickets,
            'allPendingTickets' => $allPendingTickets,
            'allUnassignedTickets' => $allUnassignedTickets,
        ]);
    }

    /**
     * 
     */
    public function actionTickets()
    {
        $searchModel  = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Ticket model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ticket();

        if ($model->load(Yii::$app->request->post())){

            $model->request_date        = date("Y-m-d H:i:s");
            $model->id_user_requestor   = yii::$app->user->identity->id;
            $model->id_ticket_status    = Ticket::TICKET_OPEN;

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id_record]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_record]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Lists all unassigned Ticket models.
     * @return mixed
     */
    public function actionUnassigned()
    {
        //
        $ticketModel = new Ticket;
        $unassigned  = $ticketModel::TICKET_OPEN;

        $ticketTypeModel = new TicketType;
        $ticketsType     = $ticketTypeModel::find()->all();
        $ticketType      = ArrayHelper::map($ticketsType, 'id_record', 'type_name');

        $userModel   = new User;
        $allUsers    = $userModel::find()->all();

        foreach($allUsers as &$usr){
            $usr->first_name = $usr->first_name.' '.$usr->last_name;
        }
        
        $users = ArrayHelper::map($allUsers, 'id_record', 'first_name');

        $allUnassignedTickets = $ticketModel::find()
                                            ->andWhere("id_ticket_status IN ($unassigned)")
                                            ->all();     

        return $this->render('unassigned', [
            'ticketModel'  => $ticketModel,
            'users'        => $users,
            'userModel'    => $userModel,
            'ticketType'   => $ticketType,
            'allUnassignedTickets' => $allUnassignedTickets,
        ]);
    }

    /**
     * assigned a Ticket.
     * @return mixed
     */
    public function actionAssignticket()
    {
        $post  = Yii::$app->request->post();

        $model = new AssignedTicket;

        $model->id_user_assigned        = $post['user'];
        $model->id_ticket               = $post['ticket'];
        $model->id_user_assigns_ticket  = yii::$app->user->identity->id;
        $model->assigned_date           = date("Y-m-d H:i:s");

        if ($model->save()) {

            $modelTicket = $this->findModel($post['ticket']);

            $modelTicket->id_ticket_status = Ticket::TICKET_ASSIGNED;

            if($modelTicket->save()){
                return true;
            }
           
        }

        return false;
    }


    /**
     * Lists all open-pending Tickets.
     * @return mixed
     */
    public function actionPending()
    {
        //Busco todos los Tickets de la base de datos
        $ticketModel  = new Ticket;
        $ticketAssg   = Ticket::TICKET_ASSIGNED;
        $ticketPnd    = Ticket::TICKET_PENDING;
        $allOpen      = "$ticketAssg, $ticketPnd";
        
        //Search All tickets assigned to current user
        $allTickets  = $ticketModel->getCurrentUserTickets();
       
        $userModel   = new User;
        $allUsers    = $userModel::find()->all();

        foreach($allUsers as &$usr){
            $usr->first_name = $usr->first_name.' '.$usr->last_name;
        }
       
        $users = ArrayHelper::map($allUsers, 'id_record', 'first_name');

        $ticketTypeModel = new TicketType;
        $ticketsType     = $ticketTypeModel::find()->all();
        $ticketType      = ArrayHelper::map($ticketsType, 'id_record', 'type_name');

        $ticketDetailModel = new TicketDetail;
        $ticketsDetail     = $ticketDetailModel::find()
                                                ->andWhere("id_ticket_status_user IN ($allOpen)")
                                                ->all();  
        


       return $this->render('all_pending_tickets', [
           'allTickets' => $allTickets,
           'users'      => $users,
           'ticketType' => $ticketType,
           'userModel'  => $userModel,
           'ticketsDetail' => $ticketsDetail,
       ]);

    }

    /**
     * Return data of an especified ticket
     * @return mixed
     */
    public function actionTicketdetails()
    {
        $post       = Yii::$app->request->post();

        $idTicket   = $post['ticket'];

        $details    = Ticket::find(['id_record' => $idTicket])->asArray()->one();

        return json_encode($details);
    }


    /**
     * Show report index
     */
    public function actionReport(){

       return $this->render('report');

    }

    /**
     * Get report by a range of date
     */
    public function actionReportdata(){
        
        $model = new Ticket;

        if(Yii::$app->request->post())
        {
            $post    = Yii::$app->request->post();

            $initial = $post['initDate'];
            $final   = $post['finalDate'];

            $ticketData = $model->getTicketReportByDate($initial, $final);

            return json_encode($ticketData);
        }

        return false;

    }


}
