<?php

namespace backend\controllers;

use backend\models\Brand;
use Codeception\Module\Yii2;
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
         $img=$brand->img=UploadedFile::getInstance($brand,'img');
            //判断是否有接收图片
            if ($img!=null) {
                //定义路径
                $imgpath="images/".uniqid().".".$brand->img->extension;
               //移动
                $brand->img->saveAs($imgpath,false);
                $brand->logo=$imgpath;
            }
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
         $img=$brand->img=UploadedFile::getInstance($brand,'img');
            //判断是否有接收图片
            if ($img!=null) {
                //定义路径
                $imgpath="images/".uniqid().".".$brand->img->extension;
               //移动
                $brand->img->saveAs($imgpath,false);
                $brand->logo=$imgpath;
            }
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

    public  function actionDelete($id){
        $brand=Brand::findOne($id);
        if ($brand->delete()) {
           \Yii::$app->session->setFlash('success','删除成功');
           return $this->redirect(['index']);
        }
    }
}
