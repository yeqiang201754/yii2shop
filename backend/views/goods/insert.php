<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form ActiveForm */
?>
<div class="goods-insert">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'intro') ?>
        <?= $form->field($model, 'logo')->widget('manks\FileInput',[]) ?>
        <?= $form->field($model, 'market_price') ?>
        <?= $form->field($model, 'goods_price') ?>
        <?= $form->field($model, 'sn') ?>
        <?= $form->field($model, 'goods_class_id')->dropDownList($class) ?>
        <?= $form->field($model, 'brand_id')->dropDownList($brands) ?>
        <?= $form->field($model, 'num') ?>
        <?= $form->field($model, 'roder')->textInput(['value'=>100]) ?>
        <?= $form->field($model, 'status')->radioList(\backend\models\Goods::$statuss,['value'=>1]) ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goods-insert -->
