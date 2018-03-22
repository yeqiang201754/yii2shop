<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m180322_030724_create_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('名字'),
            'auth_key' => $this->string(32)->notNull()->comment('令牌'),
            'password_hash' => $this->string()->notNull()->comment('密码'),
            'password_reset_token' => $this->string()->unique()->comment('密码重置'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('状态'),
            'created_at' => $this->integer()->notNull()->comment('添加时间'),
            'updated_at' => $this->integer()->notNull()->comment('修改时间'),
            'login_at' => $this->integer()->notNull()->comment('登陆时间'),
            'login_ip' => $this->integer()->notNull()->comment('登陆ip'),


        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('admin');
    }
}
