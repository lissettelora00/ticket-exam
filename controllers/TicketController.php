<?php

namespace app\controllers;

use Yii;

use app\models\Ticket;
use app\models\TicketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
                        'actions' => ['create', 'update', 'delete', 'index', 'view', 'tickets', 'unassigned'],
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
        $searchModel  = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //Busco todos los Tickets de la base de datos
        $ticketModel  = new Ticket;
        $ticketOpen   = Ticket::TICKET_OPEN;
        $ticketUnassg = Ticket::TICKET_UNASSIGNED;
        $ticketPnd    = Ticket::TICKET_PENDING;
        $allOpen      = "$ticketOpen, $ticketUnassg, $ticketPnd";

        $allTickets           = $ticketModel::find()->andWhere("id_ticket_status IN ($allOpen)")->all();
        $allPendingTickets    = $ticketModel::find()->andWhere("id_ticket_status IN ($ticketPnd)")->all();
        $allUnassignedTickets = $ticketModel::find()->andWhere("id_ticket_status IN ($ticketUnassg)")->all();

        

        /*return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
        return $this->render('index_all', [
            'allTickets' => $allTickets,
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
        $searchModel  = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //Busco todos los Tickets de la base de datos
        $ticketModel  = new Ticket;
        $ticketUnassg = Ticket::TICKET_UNASSIGNED;

        $allUnassignedTickets = $ticketModel::find()->andWhere("id_ticket_status IN ($ticketUnassg)")->all();        

        return $this->render('unassigned', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'allUnassignedTickets' => $allUnassignedTickets,
        ]);
    }

}
