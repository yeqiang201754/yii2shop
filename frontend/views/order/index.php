<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>填写核对订单信息</title>
	<link rel="stylesheet" href="/style/base.css" type="text/css">
	<link rel="stylesheet" href="/style/global.css" type="text/css">
	<link rel="stylesheet" href="/style/header.css" type="text/css">
	<link rel="stylesheet" href="/style/fillin.css" type="text/css">
	<link rel="stylesheet" href="/style/footer.css" type="text/css">

	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/js/cart2.js"></script>

</head>
<body>
	<!-- 顶部导航 start -->
    <?php
    include Yii::getAlias("@app")."/views/common/top.php";
    ?>
	<!-- 顶部导航 end -->
	
	<div style="clear:both;"></div>

	<!-- 页面头部 start -->


	<div class="header w990 bc mt15">
		<div class="logo w990">
			<h2 class="fl"><a href="index.html"><img src="/images/logo.png" alt="京西商城"></a></h2>
			<div class="flow fr flow2">
				<ul>
					<li>1.我的购物车</li>
					<li class="cur">2.填写核对订单信息</li>
					<li>3.成功提交订单</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 页面头部 end -->
	
	<div style="clear:both;"></div>

	<!-- 主体部分 start -->
        <form id="form">
            <input name="_csrf-frontend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
	<div class="fillin w990 bc mt15">
		<div class="fillin_hd">
			<h2>填写并核对订单信息</h2>
		</div>

		<div class="fillin_bd">
			<!-- 收货人信息  start-->
			<div class="address">
				<h3>收货人信息 </h3>
				<div class="address_info">
				<p>
                 <?php
                 foreach ($addresss as $k=> $address){


                 ?>
					<input type="radio" value="<?=$address->id?>" name="address_id" <?=$address->status==1?'checked="checked"':""?>/><?=$address->user_name?>  <?=$address->mobile?>  <?=$address->province?> <?=$address->city?> <?=$address->county?> <?=$address->address?> </p>


<?php  }  ?>

				</div>
                <a href="/address/index" class="confirm_btn"><span>添加地址</span></a>

			<!-- 收货人信息  end-->

			<!-- 配送方式 start -->
			<div class="delivery">
				<h3>送货方式 </h3>

				<div class="delivery_select">
					<table>
						<thead>
							<tr>
								<th class="col1">送货方式</th>
								<th class="col2">运费</th>
								<th class="col3">运费标准</th>
							</tr>
						</thead>
						<tbody>

                        <?php
                        foreach ($delivery_ways as $k=> $v) {


                            ?>

                            <tr class="<?=$k==0?"cur":""?> ">
                                <td>
                                    <input type="radio" name="delivery" <?=$k==0?"checked=\"checked\"":""?>  value="<?=$v->id?>"/><?=$v->name?>
                                </td>
                                <td>￥<span class="delivery_price"><?=$v->price?></span></td>
                                <td><?=$v->standard?></td>
                            </tr>

                            <?php
                        }
                        ?>

						</tbody>
					</table>

				</div>
			</div> 
			<!-- 配送方式 end --> 

			<!-- 支付方式  start-->
			<div class="pay">
				<h3>支付方式 </h3>

				<div class="pay_select ">
					<table>
                        <?php
                        foreach ($payment as $k=> $v) {


                            ?>
                            <tr class="<?= $k == 0 ? "cur" : "" ?>">
                                <td class="col1"><input type="radio"
                                                        name="pay" <?= $k == 0 ? "checked=\"checked\"" : "" ?>
                                                        value="<?= $v->id ?>"/><?= $v->name ?></td>
                                <td class="col2"><?= $v->content ?></td>
                            </tr>
                            <?php
                        }


                        ?>
					</table>

				</div>
			</div>
			<!-- 支付方式  end-->

			<!-- 商品清单 start -->
			<div class="goods">
				<h3>商品清单</h3>
				<table>
					<thead>
						<tr>
							<th class="col1">商品</th>
							<th class="col3">价格</th>
							<th class="col4">数量</th>
							<th class="col5">小计</th>
						</tr>	
					</thead>
					<tbody>


<?php
$num=0;
$total=0;
foreach ($goodss as $k=>$v){

?>

						<tr>
							<td class="col1"><a href=""><img src="<?=$v->logo?>" alt="" /></a>  <strong><a href=""><?=$v->title?></a></strong></td>
							<td class="col3">￥<?=$v->goods_price?></td>
							<td class="col4"> <?=$cart[$v->id]?></td>
							<td class="col5"><span>￥<?=$v->goods_price*$cart[$v->id]?></span></td>
						</tr>

<?php
$total+=$v->goods_price*$cart[$v->id];
    $num+=$cart[$v->id];
}?>


					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">
								<ul>
									<li>
										<span><?=$num?>件商品，总商品金额：</span>
										<em>￥<span id="total"><?=$total?></span></em>
									</li>

									<li>
										<span>运费：</span>
										<em>￥<span id="price"><?=$delivery_ways[0]->price?></span></em>
									</li>
									<li>
										<span>应付总额：</span>
										<em>￥<span class="all_price"><?=$total+$delivery_ways[0]->price?></span></em>
                                        <input name="all_price" type="hidden" value="<?=$total+$delivery_ways[0]->price?>"/>
									</li>
								</ul>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<!-- 商品清单 end -->
		
		</div>

		<div class="fillin_ft">
			<a href="javascript:;" id="sub_btn"><span>提交订单</span></a>
			<p>应付总额：<strong>￥<span class="all_price"><?=$total+$delivery_ways[0]->price?></span>元</strong></p>
			
		</div>
	</div>
    </form>
	<!-- 主体部分 end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->

        <?php
        include Yii::getAlias("@app")."/views/common/copyright.php";
        ?>
	<!-- 底部版权 end -->
    <script type="text/javascript" src="/layer/layer.js"></script>
        <script>
      $(function () {


       $("input[name='delivery']").change(function () {
           var price=$(this).parent().next().children().text();
           //console.debug(price);
           $("#price").text(price);
           $(".all_price").text($("#total").text()*1+price*1)

       })





         $("#sub_btn").click(function () {
           //  console.debug("sadasdas");
            // console.debug($("#form"));
             $.post('/order/index',$("#form").serialize(),function (data) {
                  if(data.status){

                      window.location.href = "/order/over";

                  }else {
//页面层-自定义

                      layer.open({
                          content: data.msg,
                          scrollbar: false
                      });

                  }



             },'json')
         })
      });







        </script>


</body>
</html>
