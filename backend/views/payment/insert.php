<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Payment */
/* @var $form ActiveForm */
?>
<div class="payment-insert">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'content') ?>
        <?= $form->field($model, 'immediate')->radioList(\backend\models\Payment::$immediates,['value'=>0]) ?>

        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- payment-insert -->
