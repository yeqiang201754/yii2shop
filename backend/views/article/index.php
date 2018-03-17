<?php
/* @var $this yii\web\View */
?>
    <h1>文章列表</h1>
<?=\yii\bootstrap\Html::a('添加',['insert'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <td>id</td>
            <td>标题</td>
            <td>简介</td>
            <td>排序</td>
            <td>状态</td>
            <td>分类id</td>
            <td>添加时间</td>
            <td>修改时间</td>
            <td>操作</td>
        </tr>
        <?php
        foreach ($articless as $article){


            ?>
            <tr>
                <td><?=$article->id?></td>
                <td><?=$article->title?></td>
                <td><?=$article->intro?></td>
                <td><?=$article->order?></td>
                <td><?=\backend\models\Article::$statuss[$article->status]?></td>
                <td><?=$article->class->name?></td>
                <td><?=date('Y-m-d H:i:s',$article->add_time)?></td>
                <td><?=date('Y-m-d H:i:s',$article->update_time)?></td>
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