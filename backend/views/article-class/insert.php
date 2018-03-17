<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticleClass */
/* @var $form ActiveForm */
?>
<div class="article-class-insert">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'order')->textInput(['value'=>100]) ?>
        <?= $form->field($model, 'status')->radioList(\backend\models\ArticleClass::$statuss,['value'=>1])?>
        <?= $form->field($model, 'is_help')->radioList(\backend\models\ArticleClass::$is_helps,['value'=>0]) ?>
        <?= $form->field($model, 'intro')->textarea() ?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-class-insert -->
