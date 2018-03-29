<?php

namespace backend\controllers;

use backend\models\GoodsClass;
use yii\db\Exception;
use yii\helpers\Json;

class GoodsClassController extends \yii\web\Controller
{
    public $arr=[];
    /**显示
     * @return string
     */
    public function actionIndex()
    {
        $goods_classs=GoodsClass::find()->orderBy('tree','lift')->all();

     // $goods_classs=$this->actionTree($goods_classs);


        return $this->render('index',compact('goods_classs'));
    }

    public function actionTree($goods_classs,$pid=0,$space=0,$exclude=0){
        foreach ($goods_classs as $class){


            if ($class->p_id==$pid && $class->id!=$exclude){

                $class->name1=str_repeat('&nbsp;',$space*10).$class->name;
                $this->arr[]=$class;

                $this->actionTree($goods_classs,$class->id,$space+1,$exclude);
             }
        }

        return $this->arr;

    }

    /**添加
     * @return string|\yii\web\Response
     */

    public function actionInsert(){
        $model=new  GoodsClass();
         $goods_class=GoodsClass::find()->asArray()->all();
          $goods_classs="";
         foreach ($goods_class as $class){


         }

         $goods_class[]=['id'=>0,'name'=>'一级分类','p_id'=>0,'open'=>true];

         $goods_class=Json::encode($goods_class);

    $request=\Yii::$app->request;
        if ($request->isPost) {
          $model->load($request->post());
            if ($model->validate()) {
                if($model->p_id==0){
                $model->makeRoot();
      \Yii::$app->session->setFlash('success','添加一级分类'.$model->name.'成功');
      return $this->refresh();
                }else{
                    $p_id=GoodsClass::findOne($model->p_id);
                    $model->prependTo($p_id);
                    \Yii::$app->session->setFlash('success','添加'.$p_id->name.'的下一级分类'.$model->name.'成功');
                    return $this->refresh();

                }
            }
        }
        return $this->render('insert',compact('model','goods_class'));
    }

    /**修改
     * @param $id
     * @return string|\yii\web\Response
     */

    public function actionUpdate($id){
        $model=GoodsClass::findOne($id);
        $goods_class=GoodsClass::find()->all();
      // $goods_class=$this->actionTree($goods_class,0,0,$model->id);
        $goods_class[]=['id'=>0,'name'=>'一级分类','p_id'=>0];
        $goods_class=Json::encode($goods_class);

        $request=\Yii::$app->request;
        if ($request->isPost) {

            $model->load($request->post());
            if ($model->validate()) {
                try{
                    if($model->p_id==0){
                        $model->save();
                        \Yii::$app->session->setFlash('success','修改成功');
                        return $this->redirect(['index']);
                    }else{
                        $p_id=GoodsClass::findOne($model->p_id);
                        $model->prependTo($p_id);
                        \Yii::$app->session->setFlash('success','修改成功');
                        return $this->redirect(['index']);

                    }
                }catch(Exception $exception){
                   \Yii::$app->session->setFlash('danger','不能修改到自己的子孙级');
                }

            }else{
                var_dump($model->errors);exit;
            }
        }
        return $this->render('insert',compact('model','goods_class'));
    }

public function actionDelete($id){
    $class=GoodsClass::findOne($id);
    $rows=GoodsClass::find()->where(['p_id'=>$class->id]);
    if($rows){
        \Yii::$app->session->setFlash('danger','有子级 不能删除');
        return $this->redirect(['index']);
    }else{
    if ($class->delete()) {
        \Yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['index']);
    }}

}
}
