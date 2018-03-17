<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleClass;
use backend\models\ArticleContent;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{

    public function actions()
    {
        //ueditor
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => "admin.yii2shop.com/imges/",//图片访问路径前缀
                    "imagePathFormat" => "/image/{yyyy}{mm}{dd}/{time}{rand:6}" ,//上传保存路径
                "imageRoot" => \Yii::getAlias("@webroot"),
            ],
       ]
    ];
    }
    /**显示
     * @return string
     */

    public function actionIndex()
    {
        $articles=Article::find();
        $count=$articles->count();
        $page=new Pagination(['totalCount' => $count,'pageSize' => 3]);
        $articless=$articles->orderBy(['order'=>'desc'])->offset($page->offset)->limit($page->limit)->all();

        return $this->render('index',compact('articless','page'));
    }

    /**添加
     * @return string|\yii\web\Response
     */

    public function actionInsert(){
        //创建一个article
        $model=new Article();
        //所有分类
        $articleclass=ArticleClass::find()->all();
        $articleclass=ArrayHelper::map($articleclass,'id','name');
        //创建内容
        $content=new ArticleContent();
        //判断
        $request=\Yii::$app->request;
        if ($request->isPost) {
            //绑定
            $model->load($request->post());
            //后台验证
            if ($model->validate()) {
                //存入
                if ($model->save()) {
                    //给内容绑定
                    $content->load($request->post());
                    //给文章id赋值
                    $content->article_id=$model->id;
                    //验证
                    if ($content->validate()) {
                        //存入
                        if ($content->save()) {
                            //提示    返回
                            \Yii::$app->session->setFlash('success','添加成功');
                            return $this->redirect(['index']);
                        }
                    }else{
                        //打印错误
                        var_dump($content->errors);
                    }
                }
            }else{
                //打印错误
                var_dump($model->errors);
            }
        }
        //视图
        return $this->render('insert',compact('model','articleclass','content'));
    }

    /**修改
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id){
        //创建一个article
        $model=Article::findOne($id);
        //所有分类
        $articleclass=ArticleClass::find()->all();
        $articleclass=ArrayHelper::map($articleclass,'id','name');
        //创建内容
        $content=new ArticleContent();
        //判断
        $request=\Yii::$app->request;
        if ($request->isPost) {
            //绑定
            $model->load($request->post());
            //后台验证
            if ($model->validate()) {
                //存入
                if ($model->save()) {
                    //给内容绑定
                    $content->load($request->post());
                    //给文章id赋值
                    $content->article_id=$model->id;
                    //验证
                    if ($content->validate()) {
                        //存入
                        if ($content->save()) {
                            //提示    返回
                            \Yii::$app->session->setFlash('success','修改成功');
                            return $this->redirect(['index']);
                        }
                    }else{
                        //打印错误
                        var_dump($content->errors);
                    }
                }
            }else{
                //打印错误
                var_dump($model->errors);
            }
        }
        //视图
        return $this->render('insert',compact('model','articleclass','content'));
    }

    /**删除
     * @param $id
     * @return \yii\web\Response
     */

    public function actionDelete($id){
        $article=Article::findOne($id);
        if ($article->delete()) {
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }
    }
}
