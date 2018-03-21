<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_content`.
 */
class m180319_083900_create_goods_content_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods_content', [
            'id' => $this->primaryKey(),
            'content' => $this->string()->notNull()->comment('内容'),
            'goods_id' => $this->integer()->notNull()->comment('商品id'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('goods_content');
    }
}
