<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Report';
?>

<div class="ticket-index-all">

    <section class="content-header">
        <h1>
            <?= Html::encode($this->title) ?>
            <small>Tickets</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </section>
   


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h1 class="box-title"><i class="fa fa-file"></i></h1>
                </div>                        
                        
                <div class="box-body"> 
                    <div class="row">     

                        <div class="col-md-3 pull-right">  

                            <div class="form-group">
                                <label></label>

                                <div class="input-group">
                                    <button type="button" class="btn btn-primary pull-right" id="generate-report-btn">
                                        <span><i class="fa fa-exchange"></i> Generate</span>
                                    </button>
                                </div>
                            </div>  

                        </div>           
                        
                        <div class="col-md-3 pull-right">  

                            <!-- Date -->
                            <div class="form-group">
                                <label>Final Date:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="final-date">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->       

                        </div>

                        <div class="col-md-3 pull-right">

                            <!-- Date -->
                            <div class="form-group">
                                <label>Initial Date:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="initial-date">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->       

                        </div>

                    </div><!-- row -->

                </div><!-- /.box-body -->
            </div>
        </div>
    </div>

    <div class="row" id="div-report-render">
    </div>
</section>
</div>