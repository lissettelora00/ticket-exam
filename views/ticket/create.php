<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */

$this->title = 'Create Ticket';
//$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-create">
    <section class="content-header">
        <h1>
            <?= Html::encode($this->title) ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?= Url::toRoute('ticket/index'); ?>">Tickets</a></li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </section>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
