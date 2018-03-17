<?php

namespace backend\controllers;

use backend\models\Brand;
use Codeception\Module\Yii2;
use crazyfd\qiniu\Qiniu;
use yii\data\Pagination;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{
    /**
     * 显示
     * @return string
     */
    public function actionIndex()
    {

        //总条数
        $brand=Brand::find();

        $count=$brand->count();

        //分页对象
        $page=new Pagination(['totalCount'=>$count,
            'pageSize' => 3]);
        //要显示的数据
        $brands = $brand->orderBy(['sort'=>'desc'])->offset($page->offset) ->limit($page->limit)->all();

        return $this->render('index',compact('brands','$page', 'page'));
    }


    /**添加
     * @return string
     */
    public function actionInsert(){
        $brand=new Brand();
      //判断接收
        $request=\Yii::$app->request;
        if ($request->isPost) {
             //绑定数据
            $brand->load($request->post());
            //接收图片
         //$img=$brand->img=UploadedFile::getInstance($brand,'img');
            //判断是否有接收图片
           // if ($img!=null) {
                //定义路径
             //   $imgpath="images/".uniqid().".".$brand->img->extension;
               //移动
              //  $brand->img->saveAs($imgpath,false);
           //  //   $brand->logo=$imgpath;
           // }
      //后台验证
            if ($brand->validate()) {

                if ($brand->save(false)) {
                   //提示   跳转
                    \Yii::$app->session->setFlash('success','添加成功');
                    return $this->redirect(['index']);
                }
            }else{
                var_dump($brand->errors);
            }
       }
        return $this->render('insert',compact('brand'));
    }

    /**
     * 修改
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id){
        $brand=Brand::findOne($id);
      //判断接收
        $request=\Yii::$app->request;
        if ($request->isPost) {
             //绑定数据
            $brand->load($request->post());
            //接收图片
        // $img=$brand->img=UploadedFile::getInstance($brand,'img');
            //判断是否有接收图片
        //    if ($img!=null) {
                //定义路径
        //        $imgpath="images/".uniqid().".".$brand->img->extension;
               //移动
           //     $brand->img->saveAs($imgpath,false);
         //       $brand->logo=$imgpath;
        // }
      //后台验证
            if ($brand->validate()) {

                if ($brand->save(false)) {
                   //提示   跳转
                    \Yii::$app->session->setFlash('success','修改成功');
                    return $this->redirect(['index']);
                }
            }else{
                var_dump($brand->errors);
            }
       }
        return $this->render('insert',compact('brand'));
    }

    /**
     * 删除
     * @param $id
     * @return \yii\web\Response
     */

    public  function actionDelete($id){
        $brand=Brand::findOne($id);
        if ($brand->delete()) {
           \Yii::$app->session->setFlash('success','删除成功');
           return $this->redirect(['index']);
        }
    }

    /**图片处理
     * @return string
     */

   public function actionUpload(){
//七牛云处理
$ak = 'EAd29Qrh05q78_cZhajAWcbB1wYCBLyHLqkanjOG';//用户
$sk = '_R5o3ZZpPJvz8bNGBWO9YWSaNbxIhpsedbiUtHjW';//密码
$domain = 'http://p5nv0polm.bkt.clouddn.com/';//地址
$bucket = 'php1108';//仓库名字
$zone = 'south_china';//区域（华南）

$qiniu = new Qiniu($ak, $sk,$domain, $bucket,$zone);
$key = time();
//路径
$key .= strtolower(strrchr($_FILES['file']['name'], '.'));
//转存
$qiniu->uploadFile($_FILES['file']['tmp_name'],$key);

$url = $qiniu->getLink($key);

       $ok=[
           'code'=>0,
           'url'=>$url,//预览地址
           "attachment"=>$url//图片上传后地址
       ];
       //返回数据   josn格式
       return json_encode($ok);

        exit;
/*
 * 本地
 */
        //获取图片

        $img=UploadedFile::getInstanceByName('file');

       //判断是否接收到图片
       if ($img!==null) {
           //拼接地址

           $imgPath="images/".uniqid().".".$img->extension;
           //移动
           if ($img->saveAs($imgPath,false)) {
           //{"code": 0, "url": "http://domain/预览图片地址", "attachment": "保存图片地址"}
          return json_encode(['code'=>0,'url'=>'/'.$imgPath,'attachment'=>$imgPath]);
           }
       }else{
           // {"code": 1, "msg": "error"}
         return json_encode(['code'=>1,'msg'=>'error']);
       }
   }

    /**上线该为下线
     * @param $id
     * @return \yii\web\Response
     */
public function actionUp($id){
       $brand=Brand::findOne($id);
       $brand->status=0;
    if ($brand->save()) {
        return $this->redirect(['index']);
    }
}

    /**下线改为上线
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDown($id){
        $brand=Brand::findOne($id);
        $brand->status=1;
        if ($brand->save()) {
            return $this->redirect(['index']);
        }
    }
}
