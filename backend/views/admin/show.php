<?php
/* @var $this yii\web\View */
?>
    <h1>用户列表</h1>
<?=\yii\bootstrap\Html::a('添加',['insert'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <td>id</td>
            <td>用户名</td>
            <td>状态</td>
            <td>创建时间</td>
            <td>修改时间</td>
            <td>最后登陆时间</td>
            <td>最后登陆ip</td>

            <td>操作</td>
        </tr>
        <?php
        foreach ($admins as $admin){


            ?>
            <tr>
                <td><?=$admin->id?></td>
                <td><?=$admin->username?></td>
                <td><?=\backend\models\Admin::$statuss[$admin->status]?></td>
                <td><?=date('Y-m-d H:i:s',$admin->created_at)?></td>
                <td><?=date('Y-m-d H:i:s',$admin->updated_at)?></td>
                <td><?=$admin->login_at!==0?date('Y-m-d H:i:s',$admin->login_at):'此用户没有登录记录'?></td>
                <td><?=$admin->login_ip!==0?long2ip($admin->login_ip):'此用户没有登录记录'?></td>

                <td>
                    <?=\yii\bootstrap\Html::a('修改',['update','id'=>$admin->id],['class'=>'btn btn-success'])?>
                    <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$admin->id],['class'=>'btn btn-danger'])?>
                </td>
            </tr>
            <?php
        }
        ?>

    </table>


