<?php
/* @var $this yii\web\View */
?>
    <h1>角色列表</h1>
<?=\yii\bootstrap\Html::a('添加',['insert'],['class'=>'btn btn-info'])?>
    <table class="table">
        <tr>
            <td>名称</td>
            <td>类型</td>
            <td>简介</td>
            <td>权限列表</td>
            <td>操作</td>

        </tr>
        <?php
        foreach ($roles as $role){


            ?>
            <tr>
                <td><?=strpos($role->name,"/")!==false?"&emsp;&emsp;&emsp;":""?><?=$role->name?></td>
                <td><?=$role->type?></td>
                <td><?=$role->description?></td>
                <td><?php
                     //得到当前角色的所有权限
                    $auth=Yii::$app->authManager;
                    $pers=$auth->getPermissionsByRole($role->name);

                   if($pers){
                       $perss="";
                       foreach ($pers as $per){
                           $perss.=$per->description.';';
                       }
                       echo trim($perss,';');
                   }


                    ?></td>

                <td>
                    <?=\yii\bootstrap\Html::a('修改',['update','name'=>$role->name],['class'=>'btn btn-success'])?>
                    <?=\yii\bootstrap\Html::a('删除',['delete','name'=>$role->name],['class'=>'btn btn-danger'])?>
                </td>
            </tr>
            <?php
        }
        ?>

    </table>

