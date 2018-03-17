<?php

namespace backend\controllers;

use backend\models\ArticleClass;
use yii\data\Pagination;

class ArticleClassController extends \yii\web\Controller
{
    public function actionIndex()
    {
        /**
         * 显示
         */
        $article = ArticleClass::find();
        $content = $article->count();
        //创建分页对象

        $page = new Pagination(['totalCount' => $content, 'pageSize' => 2]);
        //要显示的数据
        $articles = $article->orderBy(['order' => 'desc'])->offset($page->offset)->limit($page->limit)->all();
        return $this->render('index',compact('articles','page'));
    }

    /**添加
     * @return string|\yii\web\Response
     */


    public function actionInsert(){
        $model=new ArticleClass();
        //判断
        $request=\Yii::$app->request;
        if ($request->isPost) {
            //绑定
        $model->load($request->post());
        //后台验证
            if ($model->validate()) {
           //存入
                if ($model->save()) {
                    //提示    返回
                    echo \Yii::$app->session->setFlash('success','添加成功');
                    return $this->redirect(['index']);

                }

            }else{
               //打印错误
                var_dump($model->errors);
            }
        }
     //视图
        return $this->render('insert',compact('model'));
    }

    /**修改
     * @param $id
     * @return string|\yii\web\Response
     */

    public function actionUpdate($id){
        $model=ArticleClass::findOne($id);
        //判断
        $request=\Yii::$app->request;
        if ($request->isPost) {
            //绑定
            $model->load($request->post());
            //后台验证
            if ($model->validate()) {
                //存入
                if ($model->save()) {
                    //提示    返回
                    echo \Yii::$app->session->setFlash('success','修改成功');
                    return $this->redirect(['index']);

                }

            }else{
                //打印错误
                var_dump($model->errors);
            }
        }
        //视图
        return $this->render('insert',compact('model'));
    }

    /**删除
     * @param $id
     * @return \yii\web\Response
     */
public function actionDelete($id){
        $article=ArticleClass::findOne($id);
    if ($article->delete()) {
        //提示    返回
        echo \Yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['index']);
    }
}

}
