<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_logo`.
 */
class m180319_083506_create_goods_logo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods_logo', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('名字'),
            'goods_id' => $this->integer()->notNull()->comment('goods_id'),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('goods_logo');
    }
}
