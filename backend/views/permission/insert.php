<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */
/* @var $form ActiveForm */
?>
<div class="permission-insert">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput($model->name!=null?['disabled'=>""]:[""]) ?>

        <?= $form->field($model, 'description') ?>

        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- permission-insert -->
