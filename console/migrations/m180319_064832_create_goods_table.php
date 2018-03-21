<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m180319_064832_create_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull()->comment('标题'),
            'intro'=>$this->string()->notNull()->comment('简介'),
            'logo'=>$this->string()->notNull()->comment('图片'),
            'market_price'=>$this->integer()->notNull()->comment('市场价'),
            'goods_price'=>$this->integer()->notNull()->comment('商场价'),
            'sn'=>$this->integer()->notNull()->comment('编号'),
            'goods_class_id'=>$this->integer()->notNull()->comment('商品分类id'),
            'brand_id'=>$this->integer()->notNull()->comment('品牌id'),
            'num'=>$this->integer()->notNull()->comment('库存'),
            'roder'=>$this->integer()->notNull()->defaultValue(100)->comment('排序'),
            'status'=>$this->integer()->notNull()->defaultValue(1)->comment('是否上架'),
            'add_time'=>$this->integer()->notNull()->comment('添加时间'),


        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('goods');
    }
}
