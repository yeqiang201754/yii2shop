<?php

use yii\db\Migration;

/**
 * Handles the creation of table `articleclass`.
 */
class m180317_040854_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('articleclass', [
            'id' => $this->primaryKey(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('articleclass');
    }
}
