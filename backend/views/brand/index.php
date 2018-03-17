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

      <td><?php

          if($brand->status){
           echo \yii\bootstrap\Html::a('上线',['up','id'=>$brand->id],['class'=>'btn btn-success glyphicon glyphicon-ok']);
          }else{
           echo   \yii\bootstrap\Html::a('下线',['down','id'=>$brand->id],['class'=>'btn btn-danger glyphicon glyphicon-remove']);
          }



          ?></td>
      <td><?=$brand->sort?></td>
      <td><?php
          //判断是上传了还是本地的 本地加"/"
          $imgPath=strpos($brand->logo,"http://")!==false?$brand->logo:"/".$brand->logo;
          echo \yii\bootstrap\Html::img($imgPath,['height'=>40]);
          ?></td>
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