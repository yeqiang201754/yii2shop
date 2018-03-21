<?=\yii\bootstrap\Html::a('添加',['insert'],['class'=>'btn btn-info'])?>
<table class="table">
    <tr>
        <td>名字</td>
        <td>id</td>
        <td>树形编号</td>
        <td>左</td>
        <td>右</td>
        <td>深度</td>
        <td>简介</td>
        <td>父级id</td>
        <td>操作</td>
    </tr>
    <?php foreach ($goods_classs as $goods_class){?>
    <tr class="tr" data_tree="<?=$goods_class->tree?>" data_lift="<?=$goods_class->lift?>" data_right="<?=$goods_class->right?>" >
        <td><?=$goods_class->nametext?><span class="lcon glyphicon glyphicon-triangle-bottom
"></span></td>
        <td><?=$goods_class->id?></td>
        <td><?=$goods_class->tree?></td>
        <td><?=$goods_class->lift?></td>
        <td><?=$goods_class->right?></td>
        <td><?=$goods_class->deep?></td>
        <td><?=$goods_class->intor?></td>
        <td><?=$goods_class->p_id?></td>
        <td>
            <?=\yii\bootstrap\Html::a('修改',['update','id'=>$goods_class->id],['class'=>'btn btn-success'])?>
            <?=\yii\bootstrap\Html::a('删除',['delete','id'=>$goods_class->id],['class'=>'btn btn-danger'])?>
        </td>
        <?php }?>
    </tr>
</table>
<?php
$js=<<<js
$(".lcon").click(function() {
var parent=$(this).parent().parent();
//console.debug(parent);
var par_tree= $(parent).attr("data_tree");
var par_lift= $(parent).attr("data_lift");
var par_right= $(parent).attr("data_right");
// var lcon=$(this).attr('class');
// console.debug(lcon);

//console.debug(par_lift,par_right,par_tree)
$("tr").each(function(k,v) {
 var tree= $(v).attr("data_tree");
 var lift= $(v).attr("data_lift");
 var right= $(v).attr("data_right");
    // console.debug(tree,lift,right);
 if(par_tree == tree &&  par_lift<lift-0 && par_right>right-0  ){
    // console.debug(tree,lift,right);
    
  $(v).toggle();
     
     
 }
 
 
})

$(this).toggleClass("glyphicon-triangle-bottom");
$(this).toggleClass("glyphicon-triangle-top");
});





js;
$this->registerJs($js);

?>