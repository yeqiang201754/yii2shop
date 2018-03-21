<?php
/* @var $this yii\web\View */
?>
<h1>商品表</h1>


<p>
    <?=\yii\helpers\Html::a('添加',['insert'],['class'=>'btn btn-info pull-left'])?>
    <?=\yii\helpers\Html::a('重置',['goods/index'],['class'=>'btn btn-default pull-right'])?>
    <form class="form-inline pull-right">
    <select class="form-control" name="status">
        <option>请选择状态</option>
        <option value="0"  <?=Yii::$app->request->get('status')==="0"?"selected":""?>>下架</option>
        <option value="1" <?=Yii::$app->request->get('status')==="1"?"selected":""?>>上架</option>
    </select>
        <div class="form-group">

            <input type="text" class="form-control" id="min" placeholder="最低价" size="5" name="min" value="<?=Yii::$app->request->get('min')?>">
        </div>
        <div class="form-group">

            <input type="text" class="form-control" id="max" placeholder="最高价" size="5" name="max"value="<?=Yii::$app->request->get('max')?>">
        </div>
    <div class="form-group">

        <input type="text" class="form-control" id="max" placeholder="编号或名字" size="5" name="kd"
               value="<?=Yii::$app->request->get('kd')?>">
    </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
    </form>
</p>

<table class="table">
    <tr>
        <td>id</td>
        <td>标题</td>
        <td>简介</td>
        <td>图片</td>
        <td>市场价</td>
        <td>商场价</td>
        <td>编号</td>
        <td>分类</td>
        <td>品牌</td>
        <td>库存</td>
        <td>排序</td>
        <td>状态</td>
        <td>添加时间</td>
        <td>操作</td>
    </tr>
    <?php
    foreach ($goodss as $goods){


    ?>
    <tr>
        <td><?=$goods->id?></td>
        <td><?=$goods->title?></td>
        <td><?=$goods->intro?></td>
        <td><?=\yii\bootstrap\Html::img($goods->logo,['height'=>40])?></td>
        <td><?=$goods->market_price?></td>
        <td><?=$goods->goods_price?></td>
        <td><?=$goods->sn?></td>
        <td><?=$goods->goodsClass->name?></td>
        <td><?=$goods->brand->name?></td>
        <td><?=$goods->num?></td>
        <td><?=$goods->roder?></td>
        <td><?=\backend\models\Goods::$statuss[$goods->status]?></td>
        <td><?=date('Ymd H:i:s',$goods->add_time)?></td>
        <td>
            <?=\yii\helpers\Html::a('修改',['update','id'=>$goods->id],['class'=>'btn btn-success'])?>
            <?=\yii\helpers\Html::a('删除',['delete','id'=>$goods->id],['class'=>'btn btn-danger'])?>


        </td>

    </tr>
    <?php }?>
</table>
<?=\yii\widgets\LinkPager::widget([
'pagination' => $pagination,
]);
?>