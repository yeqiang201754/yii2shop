<?php

namespace backend\controllers;

use backend\models\GoodsContent;
use backend\models\GoodsLogo;

class GoodsContentController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => "http://admin.yii2shop.com",//图片访问路径前缀

            ],
            ]
        ];
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    /**添加
     * @return string|\yii\web\Response
     */
    public function actionInsert()
    {
        $model = new GoodsContent();
        $id = \Yii::$app->request->get();
        $model->goods_id = $id['id'];
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            if ($model->validate()) {


                $model->save();
                $imgs = $model->img;
                foreach ($imgs as $img) {
                    $goods_logo = new GoodsLogo();
                    $goods_logo->name = $img;
                    $goods_logo->goods_id = $model->goods_id;
                    $goods_logo->save();

                }

                \Yii::$app->session->setFlash('success', '添加内容成功');
                return $this->redirect(['goods/index']);


            } else {
                var_dump($model->errors);
            }
        }

            return $this->render('insert', compact('model'));

    }


    /**修改
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = GoodsContent::findOne(['goods_id'=>$id]);
      $goods_logo=GoodsLogo::find()->where(['goods_id'=>$id])->all();
        $goods_logo=array_column($goods_logo,'name');
       // var_dump($goods_logo);exit;
      $model->img=$goods_logo;
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());
            if ($model->validate()) {

                $model->save();
                //删除原有图片
                GoodsLogo::deleteAll(['goods_id'=>$id]);

                $imgs = $model->img;

                foreach ($imgs as $img) {
                    $goods_logo = new GoodsLogo();
                    $goods_logo->name = $img;
                    $goods_logo->goods_id = $model->goods_id;
                    $goods_logo->save();

                }

                \Yii::$app->session->setFlash('success', '添加内容成功');
                return $this->redirect(['goods/index']);


            } else {
                var_dump($model->errors);
            }
        }

        return $this->render('insert', compact('model'));

    }
}