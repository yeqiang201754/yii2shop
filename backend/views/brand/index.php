<?php
/* @var $this yii\web\View */
?>
<h1>显示品牌</h1>

<?=\yii\bootstrap\Html::a('添加',['insert'],['class'=>'btn btn-info'])?>
<table class="table">
    <tr>
        <td>id</td>
        <td>名字</td>
        <td>状态</td>
        <td>排序</td>
        <td>图片</td>
        <td>简介</td>
        <td>操作</td>
    </tr>
    <?php foreach ($brands as $brand){

   ?>
    <tr>
      <td><?=$brand->id?></td>
      <td><?=$brand->name?></td>
      <td><?=\backend\models\Brand::$statuss[$brand->status]?></td>
      <td><?=$brand->sort?></td>
      <td><?=\yii\bootstrap\Html::img('/'.$brand->logo,['height'=>30])?></td>
      <td><?=$brand->intro?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['update','id'=>$brand->id],['class'=>'btn btn-success'])?>
          <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$brand->id],['class'=>'btn btn-danger'])?>
        </td>
    </tr>
    <?php   }?>
</table>
<?=\yii\widgets\LinkPager::widget([
'pagination' => $page,
]);?>