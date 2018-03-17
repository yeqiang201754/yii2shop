<?php
/* @var $this yii\web\View */
?>
<h1>文章分类</h1>
<?=\yii\bootstrap\Html::a('添加',['insert'],['class'=>'btn btn-info'])?>
<table class="table">
    <tr>
        <td>id</td>
        <td>名字</td>
        <td>简介</td>
        <td>排序</td>
        <td>状态</td>
        <td>是否帮助类</td>
        <td>操作</td>
    </tr>
    <?php
    foreach ($articles as $article){


        ?>
        <tr>
            <td><?=$article->id?></td>
            <td><?=$article->name?></td>
            <td><?=$article->intro?></td>
            <td><?=$article->order?></td>
            <td><?=$article->status?></td>
            <td><?=$article->is_help?></td>
            <td>
                <?=\yii\bootstrap\Html::a('修改',['update','id'=>$article->id],['class'=>'btn btn-success'])?>
                <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$article->id],['class'=>'btn btn-danger'])?>
            </td>
        </tr>
        <?php
    }
    ?>

</table>


<?=\yii\widgets\LinkPager::widget([
    'pagination' => $page,
]);?>