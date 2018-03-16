<?php
$from=\yii\bootstrap\ActiveForm::begin();
echo $from->field($brand,'name');
echo $from->field($brand,'status')->inline()->radioList(\backend\models\Brand::$statuss,['value'=>1]);
echo $from->field($brand,'sort')->textInput(['value'=>100]);
echo $from->field($brand,'img')->fileInput();
echo $from->field($brand,'intro')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();