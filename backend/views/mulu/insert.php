<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Mulu */
/* @var $form ActiveForm */
?>
<div class="mulu-insert">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'ico') ?>
        <?= $form->field($model, 'url') ?>
        <?= $form->field($model, 'p_id')->dropDownList($mus) ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- mulu-insert -->
