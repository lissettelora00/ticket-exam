<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Ticket;

$ticketsDetailArray = [];

foreach ($ticketsDetail as $detail):
  $ticketsDetailArray[$detail->id_ticket][] = $detail;
endforeach;

?>
  
  <section class="content-header">
    <h1>
      Tickets
      <small>assigned to you</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li><a href="<?= Url::toRoute('ticket/index'); ?>">Tickets</a></li>
      <li class="active">Your Tickets</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="table-pending-tickets">
                <tbody>
                    <tr>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Requestor</th>
                      <th>Request Date</th>
                      <th>Worked Time</th>                          
                    </tr>
                    <?php foreach ($allTickets as $ticket):?>
                    <tr id="tr-<?= $ticket['id_record'];?>" t-id="<?= $ticket['id_record']; ?>" data-toggle="collapse" data-target="#accordion-<?= $ticket['id_record']; ?>" class="clickable">
                      <td><?= $ticket['title']; ?></td>
                      <td><?= $ticket['description']; ?></td>
                      <td><?= $users[$ticket['id_user_requestor']]; ?></td>
                      <td><?= $ticket['request_date']; ?></td>
                      <td><?= round($ticket['worked'], 2); ?></td>                         
                    </tr>
                    <tr>
                      <td colspan="5">
                      <?php if(isset($ticketsDetailArray[$ticket['id_record']])):?>                          
                        <div id="accordion-<?= $ticket['id_record']; ?>" class="collapse row">
                          <div class="col-md-12">
                            <ul class="timeline">
                              <li class="time-label">
                                <span class="bg-green" id="update-pending-ticket" tid="<?= $ticket['id_record'];?>">Update</span>
                              </li><!-- /.timeline-label -->    
                              <?php foreach ($ticketsDetailArray[$ticket['id_record']] as $detail):?>
                              
                              <li>
                                <i class="fa fa-comments bg-yellow"></i>
                                <div class="timeline-item">
                                  <span class="time"><i class="fa fa-clock-o"></i> <?= date_format(date_create($detail->updated_datetime), 'g:ia \o\n l jS F Y');?></span>
                                  <h3 class="timeline-header"><a href="#"><?= Yii::$app->user->identity->first_name.' '.Yii::$app->user->identity->last_name?></a> commented:</h3>
                                  <div class="timeline-body">
                                    <?= $detail->comment;?>
                                  </div>
                                  <div class="timeline-footer">
                                    <a class="btn btn-warning btn-flat btn-xs">Pending</a>
                                  </div>
                                </div>
                              </li><!-- END timeline item -->
                              <?php endforeach; ?>
                            </ul>
                          </div><!-- /.col -->
                        </div>
                        <?php else:?>
                        <div id="accordion-<?= $ticket['id_record']; ?>" class="collapse row">
                          <div class="col-md-12">
                            <ul class="timeline">
                              <li class="time-label">
                                <span class="bg-green" id="update-pending-ticket" tid="<?= $ticket['id_record'];?>">Update</span>
                              </li><!-- /.timeline-label --> 

                              <li>
                                <i class="fa fa-clock-o bg-aqua"></i>
                                <div class="timeline-item">
                                  <h3 class="timeline-header no-border"><a href="#"><?= Yii::$app->user->identity->first_name.' '.Yii::$app->user->identity->last_name ?>:</a> the ticket has not been updated</h3>
                                </div>
                              </li>   
                              
                            </ul>
                          </div><!-- /.col -->
                        </div>
                        <?php endif;?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
 
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" id="form-update-ticket" action="<?= Url::toRoute('ticketdetail/create'); ?>">                  

                  <input type="hidden" id="r" name="r" value="ticketdetail/create">
                  <input type="hidden" id="id-ticket" name="id-ticket">

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="worked-time" >Worked Time</label>
                    <div class="col-xs-3">
                      <input type="number " class="form-control" name="worked">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="status" >Status</label>
                    <div class="col-sm-6">
                      <select class="form-control" id="status" name="status">
                        <option value="<?= Ticket::TICKET_PENDING ?>">Pending</option>
                        <option value="<?= Ticket::TICKET_FINISHED ?>">Finished</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="comment"> Comment</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="comment" rows="3" id="comment" placeholder="Enter your comment"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                  

                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>

<div class="col-md-12 text-center" id="loader" style="margin-top: 2.5em; display: none">        
  <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
  <span class="sr-only">Loading...</span>
</div>

<style>
  .centered-info{

    position: fixed;
    top: 50%;  
  }
</style>