<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Tickets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index-all">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ticket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <section class="content">
        <!-- Info boxes -->
        <div class="row">

            <div class="col-md-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-trello"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">All Tickets</span>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">20% Increase in 30 Days</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-sticky-note"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Open - Pending To Asign</span>
                        <span class="info-box-number">41,410</span>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">20% Increase in 30 Days</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number">41,410</span>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">20% Increase in 30 Days</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->   

      </div><!-- /.row -->

    </section>
    
</div>
