<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_class`.
 */
class m180317_035903_create_article_class_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_class', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment('名字'),
            'intro'=>$this->string()->notNull()->comment('简介'),
            'order'=>$this->integer()->notNull()->defaultValue(100)->comment('排序'),
            'status'=>$this->integer()->notNull()->defaultValue(1)->comment('状态'),
            'is_help'=>$this->integer()->notNull()->defaultValue(0)->comment('是否帮助类'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_class');
    }
}
