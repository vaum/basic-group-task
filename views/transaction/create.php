<?php

/* @var $this yii\web\View */
/* @var $model \app\models\Transaction */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Transaction Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to send credit to another dude:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'receiver')->dropDownList($availableUsers); ?>
    <?= $form->field($model, 'amount'); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'create-transaction-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    if ($status) {
echo $status;
    }
    ?>
</div>