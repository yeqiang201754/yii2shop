<?php
/* @var $this yii\web\View */
?>
    <h1>用户列表</h1>
<?=\yii\bootstrap\Html::a('添加',['insert'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <td>id</td>
            <td>用户名</td>
            <td>密码</td>

            <td>操作</td>
        </tr>
        <?php
        foreach ($admins as $admin){


            ?>
            <tr>
                <td><?=$admin->id?></td>
                <td><?=$admin->username?></td>
                <td><?=$admin->userpassword?></td>

                <td>
                    <?=\yii\bootstrap\Html::a('修改',['update','id'=>$admin->id],['class'=>'btn btn-success'])?>
                    <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$admin->id],['class'=>'btn btn-danger'])?>
                </td>
            </tr>
            <?php
        }
        ?>

    </table>

<!---->
<?//=\yii\widgets\LinkPager::widget([
//    'pagination' => $page,
//]);?>