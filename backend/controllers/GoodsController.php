<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsClass;
use backend\models\GoodsContent;
use backend\models\GoodsLogo;
use crazyfd\qiniu\Qiniu;
use SebastianBergmann\Diff\TimeEfficientLongestCommonSubsequenceCalculator;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class GoodsController extends \yii\web\Controller
{


    public function actionIndex()
    {

// 创建一个 DB 查询来获得所有 status 为 1 的文章
        $query = Goods::find();
        $max=\Yii::$app->request->get('max');
        $min=\Yii::$app->request->get('min');
        $kd=\Yii::$app->request->get('kd');
        $status=\Yii::$app->request->get('status');


        //搜索
        if ($min) {
            $query->andWhere(['>=','goods_price',$min]);
        }
        if ($max) {
            $query->andWhere(['<=','goods_price',$max]);
        }

        if ($kd) {
            $query->andWhere("title like '%{$kd}%' or sn like '%{$kd}%'");
        }

       if ($status==="0" || $status==="1"){
            $query->andWhere(['status'=>$status]);

       }



// 得到文章的总数（但是还没有从数据库取数据）
        $count = $query->count();

// 使用总数来创建一个分页对象
        $pagination = new Pagination(['totalCount' => $count,'pageSize' => 3]);

// 使用分页对象来填充 limit 子句并取得文章数据
        $goodss = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index', compact("goodss",'pagination'));
    }

    /**添加
     * @return string|\yii\web\Response
     */

    public function actionInsert()
    {

        $model = new Goods();
        $brands = Brand::find()->asArray()->all();
        $brands = ArrayHelper::map($brands, 'id', 'name');

        $goods_classs = GoodsClass::find()->orderBy('deep', 'tree', 'lift')->asArray()->all();
        $class = [];

        foreach ($goods_classs as $goods_class) {
            $goods_class['namet'] = str_repeat("-", $goods_class['deep'] * 2) . $goods_class['name'];
            $class[] = $goods_class;
        }
        $class = ArrayHelper::map($class, 'id', 'namet');

        $request = \Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());

            if ($model->sn == "") {

                //$timea = strtotime(date('Ymd'));
              //  $rows = Goods::find()->where("add_time" < $timea)->all();

                //$count = count($rows)+1;

              //  var_dump(uniqid() );

                $model->sn = date('Ymd') . uniqid();
                //var_dump($model->sn);
               // exit;
            }
            if ($model->validate()) {
                if ($model->save()) {
                    //  \Yii::$app->session->setFlash('success','添加成功商品成功请添加商品详情');
                    return $this->redirect(['goods-content/insert', 'id' => $model->id]);
                }
            } else {
                var_dump($model->errors);
            }
        }
        return $this->render('insert', compact('model', 'class', 'brands'));
    }

    /**修改
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {

        $model = Goods::findOne($id);
        $brands = Brand::find()->asArray()->all();
        $brands = ArrayHelper::map($brands, 'id', 'name');

        $goods_classs = GoodsClass::find()->orderBy('deep', 'tree', 'lift')->asArray()->all();
        $class = [];
        foreach ($goods_classs as $goods_class) {
            $goods_class['namet'] = str_repeat("-", $goods_class['deep'] * 2) . $goods_class['name'];
            $class[] = $goods_class;
        }
        $class = ArrayHelper::map($class, 'id', 'namet');
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());

            if ($model->sn == "") {

                //$timea = strtotime(date('Ymd'));
                //  $rows = Goods::find()->where("add_time" < $timea)->all();

                //$count = count($rows)+1;

                //  var_dump(uniqid() );

                $model->sn = date('Ymd') . uniqid();
                //var_dump($model->sn);
                // exit;
            }
            if ($model->validate()) {
                if ($model->save()) {
                    //  \Yii::$app->session->setFlash('success','添加成功商品成功请添加商品详情');
                    return $this->redirect(['goods-content/update', 'id' => $model->id]);
                }
            } else {
                var_dump($model->errors);
            }
        }
        return $this->render('insert', compact('model', 'class', 'brands'));
    }


    public function actionDelete($id)
    {
        $goods = Goods::findOne($id);
        $goods_content=GoodsContent::findOne(['goods_id'=>$id]);

        if ($goods->delete() && $goods_content->delete() && GoodsLogo::deleteAll(['goods_id'=>$id])) {
          \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['goods/index']);

        }

    }



}
