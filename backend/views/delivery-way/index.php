<?php
/* @var $this yii\web\View */
?>
    <h1>显示送货方式</h1>

<?=\yii\bootstrap\Html::a('添加',['insert'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <td>id</td>
            <td>名字</td>
            <td>价格</td>
            <td>标准</td>
            <td>操作</td>
        </tr>
        <?php foreach ($models as $model){

            ?>
            <tr>
                <td><?=$model->id?></td>
                <td><?=$model->name?></td>
                <td><?=$model->price?></td>
                <td><?=$model->standard?></td>

                <td>
                    <?=\yii\bootstrap\Html::a('修改',['update','id'=>$model->id],['class'=>'btn btn-success'])?>
                    <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$model->id],['class'=>'btn btn-danger'])?>
                </td>
            </tr>
        <?php   }?>
    </table>
