<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_class`.
 */
class m180318_033859_create_goods_class_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods_class', [
            'id' => $this->primaryKey(),
            'tree' => $this->integer()->notNull(),
            'lift' => $this->integer()->notNull()->comment('左'),
            'right' => $this->integer()->notNull()->comment('右'),
            'deep' => $this->integer()->notNull()->comment('深度'),
            'name' => $this->string()->notNull()->comment('名字'),
            'intor' => $this->string()->notNull()->comment('简介'),
            'p_id' => $this->string()->notNull()->comment('父级id'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('goods_class');
    }
}
