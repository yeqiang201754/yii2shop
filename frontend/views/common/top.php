<div class="topnav">
    <div class="topnav_bd w1210 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>
                <li><?=Yii::$app->user->identity->username?>您好，欢迎来到京西！

                <?php
                $htnlout=<<<html
                [<a href="user/login">登录</a>] [<a href="/user/reg">免费注册</a>]

html;
             $htmllogin=<<<html
[<a href="/user/logout">注销</a>]
html;

               if(Yii::$app->user->id){
                   echo $htmllogin;
               }else{
                   echo $htnlout;
               }




                ?>


                </li>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>