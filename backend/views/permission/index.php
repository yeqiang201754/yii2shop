<?php
/* @var $this yii\web\View */
?>
    <h1>文章列表</h1>
<?=\yii\bootstrap\Html::a('添加',['insert'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <td>名称</td>
            <td>类型</td>
            <td>简介</td>

        </tr>
        <?php
        foreach ($pers as $per){


            ?>
            <tr>
                <td><?=strpos($per->name,"/")!==false?"&emsp;&emsp;&emsp;":""?><?=$per->name?></td>
                <td><?=$per->type?></td>
                <td><?=$per->description?></td>

                <td>
                    <?=\yii\bootstrap\Html::a('修改',['update','name'=>$per->name],['class'=>'btn btn-success'])?>
                    <?=\yii\bootstrap\Html::a('删除',['delete','name'=>$per->name],['class'=>'btn btn-danger'])?>
                </td>
            </tr>
            <?php
        }
        ?>

    </table>

