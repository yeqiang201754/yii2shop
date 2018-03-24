<?php
/* @var $this yii\web\View */
?>
<h1>mulu/index</h1>
<?=\yii\bootstrap\Html::a('添加',['mulu/insert'],['class'=>'btn btn-info'])?>
<table class="table">
    <tr>
        <td>id</td>
        <td>名字</td>
        <td>图标</td>
        <td>地址</td>
        <td>父级</td>
        <td>操作</td>
    </tr>
    <?php
    foreach ($mu as $m){

    ?>
    <tr>
        <td><?=$m->id?></td>
        <td><?=$m->p_id==0?"":"&emsp;&emsp;&emsp;"?><?=$m->name?></td>
        <td><?=$m->ico?></td>
        <td><?=$m->url?></td>
        <td><?=$m->p_id?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['mulu/update','id'=>$m->id],['class'=>'btn btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['mulu/delete','id'=>$m->id],['class'=>'btn btn-danger'])?>
        </td>
    </tr>
    <?php  } ?>
</table>
