<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsClass */
/* @var $form ActiveForm */
?>
<div class="goods-class-insert">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'intor') ?>
        <?= $form->field($model, 'p_id') ?>
    <?= \liyuze\ztree\ZTree::widget([

        'setting' => '{
       
			data: {
				simpleData: {
					enable: true,
					pIdKey:"p_id",
				}
			},
			callback: {
				onClick: onClick
				
			},
		}',
        'nodes' =>$goods_class,
    ]);
    ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    <?php

 $js=<<<js
//找到ztree
var treeObj = $.fn.zTree.getZTreeObj("w1");
//找到要选中的
var node = treeObj.getNodeByParam("id","$model->p_id", null);
//默认选择
treeObj.selectNode(node);
//默认展开
treeObj.expandAll(true);
js;

$this->registerJs($js);


    ?>

</div><!-- goods-class-insert -->
<script>
    function onClick(e,treeId, treeNode) {
   $(function () {

      $("#goodsclass-p_id").val(treeNode.id);
       treeObj.expandAll(true)
   })
    }
</script>