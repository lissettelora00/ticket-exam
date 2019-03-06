<?php
use yii\helpers\Html;
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tickets
        <small>unassigned</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Simple</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Requestor</th>
                            <th>Request Date</th>
                            <th>Ticket Type</th>
                            <th>Assign</th>
                        </tr>
                        <?php foreach ($allUnassignedTickets as $ticket):?>
                        <tr>
                            <td><?= $ticket->title; ?></td>
                            <td><?= $ticket->description; ?></td>
                            <td><?= $ticket->id_user_requestor; ?></td>
                            <td><?= $ticket->request_date; ?></td>
                            <td><?= $ticket->id_ticket_type; ?></td>
                            <td><?= Html::a('<i class="fa fa-plus"></i>',
                                                ['#'], 
                                                [
                                                    'title' => 'Assign Ticket',
                                                    'data-toggle'=>'modal',
                                                    'data-target'=>'#modalassign',
                                                ]
                                            );
                            ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
