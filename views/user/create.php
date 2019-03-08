<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <section class="content-header">
        <h1>
            <?= Html::encode($this->title) ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="<?= Url::toRoute('user/index'); ?>">Users</a></li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </section>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
