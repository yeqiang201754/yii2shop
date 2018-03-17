<?php

use yii\db\Migration;

/**
 * Handles the creation of table `author`.
 */
class m180317_035305_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('author', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull()->comment('标题'),
            'intro'=>$this->string()->notNull()->comment('简介'),
            'order'=>$this->integer()->notNull()->defaultValue(100)->comment('排序'),
            'status'=>$this->integer()->notNull()->defaultValue(1)->comment('状态'),
            'class_id'=>$this->integer()->notNull()->comment('分类id'),
            'add_time'=>$this->integer()->comment('添加时间'),
            'update_time'=>$this->integer()->comment('更新时间'),
        ]);

        $this->createTable('author_content', [
            'id' => $this->primaryKey(),
            'content'=>$this->text()->comment('内容'),
            'author_id'=>$this->integer()->comment('文章id')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('author');
        $this->dropTable('author_content');
    }
}
