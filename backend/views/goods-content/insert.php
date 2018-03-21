<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsContent */
/* @var $form ActiveForm */
?>
<div class="goods-content-insert">

    <?php $form = ActiveForm::begin(); ?>

        <?=  $form->field($model,'content')->widget('kucha\ueditor\UEditor',[]);?>
    <?php
    // ActiveForm
    echo $form->field($model, 'img')->widget('manks\FileInput', [
        'clientOptions' => [
            'pick' => [
                'multiple' => true,
            ],
            // 'server' => Url::to('upload/u2'),
            // 'accept' => [
            // 	'extensions' => 'png',
            // ],
        ],
    ]); ?>
        <?= $form->field($model, 'goods_id') ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div><!-- goods-content-insert -->
