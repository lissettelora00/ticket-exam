<?php
use yii\helpers\Html;

?>
  
  <section class="content-header">
    <h1>
      Tickets
      <small>unassigned</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="#">Tickets</a></li>
      <li class="active">Unassigned</li>
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
                          <td><?= $users[$ticket->id_user_requestor]; ?></td>
                          <td><?= $ticket->request_date; ?></td>
                          <td><?= $ticketType[$ticket->id_ticket_type]; ?></td>
                          <td>
                            <?= Html::activeDropDownList($userModel, 'id_record', $users, 
                              [ 
                                'prompt'   => '-Select User-', 
                                'onchange' => 'showSaveIcon(this, '.$ticket->id_record.')'
                              ]); ?> 
                            &nbsp;&nbsp;
                            <a id="icon-<?= $ticket->id_record;?>" class="btn btn-assign" style="display:none;">
                              <i class="fa fa-save fa-lg text-success"></i>
                            </a>               
                          </td>
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
 
  <div class="modal remote fade" id="modalassign">
    <div class="modal-dialog">
        <div class="modal-content loader-lg"></div>
    </div>
</div>

<div class="col-md-12 text-center" id="loader" style="margin-top: 2.5em; display: none">        
  <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
  <span class="sr-only">Loading...</span>
</div>