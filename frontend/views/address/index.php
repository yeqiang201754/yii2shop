<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>收货地址</title>
	<link rel="stylesheet" href="/style/base.css" type="text/css">
	<link rel="stylesheet" href="/style/global.css" type="text/css">
	<link rel="stylesheet" href="/style/header.css" type="text/css">
	<link rel="stylesheet" href="/style/home.css" type="text/css">
	<link rel="stylesheet" href="/style/address.css" type="text/css">
	<link rel="stylesheet" href="/style/bottomnav.css" type="text/css">
	<link rel="stylesheet" href="/style/footer.css" type="text/css">

	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="/js/header.js"></script>
	<script type="text/javascript" src="/js/home.js"></script>
</head>
<body>
		<!-- 顶部导航 start -->
        <?php
        include Yii::getAlias("@app")."/views/common/top.php";
        ?>
	<!-- 顶部导航 end -->


	<!-- 头部 start -->
        <?php
        include Yii::getAlias("@app")."/views/common/head.php";
        ?>
	<!-- 头部 end-->
	
	<div style="clear:both;"></div>

	<!-- 页面主体 start -->
	<div class="main w1210 bc mt10">
		<div class="crumb w1210">
			<h2><strong>我的XX </strong><span>> 我的订单</span></h2>
		</div>
		
		<!-- 左侧导航菜单 start -->
		<div class="menu fl">
			<h3>我的XX</h3>
			<div class="menu_wrap">
				<dl>
					<dt>订单中心 <b></b></dt>
					<dd><b>.</b><a href="">我的订单</a></dd>
					<dd><b>.</b><a href="">我的关注</a></dd>
					<dd><b>.</b><a href="">浏览历史</a></dd>
					<dd><b>.</b><a href="">我的团购</a></dd>
				</dl>

				<dl>
					<dt>账户中心 <b></b></dt>
					<dd class="cur"><b>.</b><a href="">账户信息</a></dd>
					<dd><b>.</b><a href="">账户余额</a></dd>
					<dd><b>.</b><a href="">消费记录</a></dd>
					<dd><b>.</b><a href="">我的积分</a></dd>
					<dd><b>.</b><a href="">收货地址</a></dd>
				</dl>

				<dl>
					<dt>订单中心 <b></b></dt>
					<dd><b>.</b><a href="">返修/退换货</a></dd>
					<dd><b>.</b><a href="">取消订单记录</a></dd>
					<dd><b>.</b><a href="">我的投诉</a></dd>
				</dl>
			</div>
		</div>
		<!-- 左侧导航菜单 end -->

		<!-- 右侧内容区域 start -->
		<div class="content fl ml10">
			<div class="address_hd">
				<h3>收货地址薄</h3>
			<?php
            foreach ($address as $k=>$v){


            ?>
				<dl <?php
                if($k==$count-1){
                    echo 'class=last';
                }
                ?>> <!-- 最后一个dl 加类last -->
					<dt><?=$k+1?>.<?=$v->user_name?> <?=$v->province?> <?=$v->city?> <?=$v->county?> <?=$v->address?> <?=$v->mobile?> </dt>
					<dd>
						<a href="/address/update?id=<?=$v->id?>">修改</a>
						<a href="/address/delete?id=<?=$v->id?>">删除</a>
						<?=$v->status==1?"<a href=\"/address/statusout?id=$v->id\">取消默认地址</a>":"<a href=\"/address/status?id=$v->id\">设为默认地址</a>"?>
					</dd>
				</dl>
    <?php  } ?>
			</div>

			<div class="address_bd mt10">
				<h4>新增收货地址</h4>
				<form action="" name="address_form" id="address_form">
                    <input name="_csrf-frontend" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
						<ul>
							<li>
								<label for=""><span>*</span>收 货 人：</label>
								<input type="text" name="Address[user_name]" class="txt" id="user_name"/>
							</li>
							<li>
                                <label for=""><span>*</span>所在地区：</label>
                                <select name="Address[province]" id="province">

                                </select><select name="Address[city]" id="city">

                                </select><select name="Address[county]" id="county"></select>
                                <br>
							</li>
							<li>
								<label for=""><span>*</span>详细地址：</label>
								<input type="text" name="Address[address]" class="txt address"  id="address"/>
							</li>
							<li>
								<label for=""><span>*</span>手机号码：</label>
								<input type="text" name="Address[mobile]" class="txt" id="mobile" />
							</li>
							<li>
								<label for="">&nbsp;</label>
								<input type="checkbox" name="Address[status]" class="check" checked="checked"/>设为默认地址
							</li>
							<li>
								<label for="">&nbsp;</label>
								<input type="button" name="" class="btn" value="保存"  />
							</li>
						</ul>
					</form>
			</div>	

		</div>
		<!-- 右侧内容区域 end -->
	</div>
	<!-- 页面主体 end-->

	<div style="clear:both;"></div>

	<!-- 底部导航 start -->
        <?php
        include Yii::getAlias("@app")."/views/common/bottom.php";
        ?>
	<!-- 底部导航 end -->

	<div style="clear:both;"></div>
	<!-- 底部版权 start -->
        <?php
        include Yii::getAlias("@app")."/views/common/copyright.php";
        ?>
	<!-- 底部版权 end -->
        <script type="text/javascript" src="/js/PCASClass.js" ></script>
        <script type="text/javascript" src="/layer/layer.js"></script>
		<script>
            //三级联动
            new PCAS("Address[province]","Address[city]","Address[county]");


            $(function () {



                //地址添加
                $(".btn").click(function () {
                    //console.debug("asdasd");
                    $.post('/address/insert', $("#address_form").serialize(), function (result) {
                        console.debug(result);
                        if (result.status) {

                          window.location.href = "/address/index";
                        } else {
                          //  console.debug(result);
                            $.each(result.data, function (k, v) {
                                //  console.debug(v[0]);
                                layer.tips(v[0], '#' + k, {
                                    tips: [2, '#0FA6D8'],//还可配置颜色
                                    tipsMore: true
                                });
                            })

                        }
                    }, 'json');
                });
               //删除






            });

		</script>
</body>
</html>

