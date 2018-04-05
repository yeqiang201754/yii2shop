<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>购物车页面</title>
	<link rel="stylesheet" href="/style/base.css" type="text/css">
	<link rel="stylesheet" href="/style/global.css" type="text/css">
	<link rel="stylesheet" href="/style/header.css" type="text/css">
	<link rel="stylesheet" href="/style/cart.css" type="text/css">
	<link rel="stylesheet" href="/style/footer.css" type="text/css">

	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/js/cart1.js"></script>
	
</head>
<body>
	<!-- 顶部导航 start -->
    <?php
    include Yii::getAlias("@app")."/views/common/top.php";
    ?>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>
	
	<!-- 页面头部 start -->
    <?php
    include Yii::getAlias("@app")."/views/common/head.php";
    ?>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
	<div class="mycart w990 mt10 bc">
		<h2><span>我的购物车</span></h2>
		<table>
			<thead>
				<tr>
					<th class="col1">商品名称</th>
					<th class="col3">单价</th>
					<th class="col4">数量</th>	
					<th class="col5">小计</th>
					<th class="col6">操作</th>
				</tr>
			</thead>
			<tbody>
<?php

       foreach ($goodss as $goods){

?>

				<tr data_id="<?=$goods->id?>">
					<td class="col1"><a href=""><img src="<?=$goods->logo?>" alt="" />
                        </a>  <strong>
                            <a href="<?=\yii\helpers\Url::to(['list/content','id'=>$goods->id])?>"><?=$goods->title?></a>
                        </strong></td>
					<td class="col3">￥<span><?=$goods->goods_price?></span></td>
					<td class="col4"> 
						<a href="javascript:;" class="reduce_num"></a>
						<input type="text" name="amount" value="<?=$cart[$goods->id]?>" class="amount"/>
						<a href="javascript:;" class="add_num"></a>
					</td>
					<td class="col5">￥<span><?=sprintf('%.2f', $goods->goods_price*$cart[$goods->id])?></span></td>
					<td class="col6"><a href="<?=\yii\helpers\Url::to(['/list/delete-cart','id'=>$goods->id])?>">删除</a></td>
				</tr>


<?php
}
?>

			</tbody>
			<tfoot>
				<tr>
					<td colspan="6">购物金额总计： <strong>￥ <span id="total">1870.00</span></strong></td>
				</tr>
			</tfoot>
		</table>
		<div class="cart_btn w990 bc mt10">
			<a href="/index/index" class="continue">继续购物</a>
			<a href="/order/index" class="checkout">结 算</a>
		</div>
	</div>
	<!-- 主体部分 end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
    <!-- 底部版权 start -->
    <?php
    include Yii::getAlias("@app")."/views/common/copyright.php";
    ?>
	<!-- 底部版权 end -->
</body>
</html>
