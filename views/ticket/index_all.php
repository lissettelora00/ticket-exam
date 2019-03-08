<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tickets';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index-all">

    <section class="content-header">
        <h1>
            <?= Html::encode($this->title) ?>
            <small>All</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </section>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <section class="content">
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
                        <a href="<?= Url::toRoute('ticket/tickets'); ?>"><span class="info-box-text">All Active Tickets</span></a>
                        <span class="info-box-number"><?= count($allTickets) ?></span>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">Open | Assigned | Pending <?php if(count($allTimeTickets)) {echo " | Overall: ".count($allTimeTickets);}?></span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-sticky-note"></i></span>
                    <div class="info-box-content">
                        <a href="<?= Url::toRoute('ticket/unassigned'); ?>"><span class="info-box-text">Open</span></a>
                        <span class="info-box-number"><?= count($allUnassignedTickets) ?></span>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">Ready to be assigned</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>
                    <div class="info-box-content">
                        <a href="<?= Url::toRoute('ticket/pending'); ?>"><span class="info-box-text">Pending</span></a>
                        <span class="info-box-number"><?= count($allPendingTickets) ?></span>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <span class="progress-description">Your Pending tickets | Update your tickets</span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div><!-- /.col -->   

      </div><!-- /.row -->

    </section>
    </section>
    
</div>
