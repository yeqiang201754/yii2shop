<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($brand,'name');
echo $form->field($brand,'status')->inline()->radioList(\backend\models\Brand::$statuss,['value'=>1]);
echo $form->field($brand,'sort')->textInput(['value'=>100]);
echo $form->field($brand, 'logo')->widget('manks\FileInput',[]);
echo $form->field($brand,'intro')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();