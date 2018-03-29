<?php

use yii\db\Migration;

/**
 * Handles the creation of table `address`.
 */
class m180328_045613_create_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->comment('用户id'),
            'user_name'=>$this->string()->comment('用户名字'),
            'province'=>$this->string()->comment('省'),
            'city'=>$this->string()->comment('市'),
            'county'=>$this->string()->comment('区县'),
            'address'=>$this->string()->comment('具体地址'),
            'mobile'=>$this->string()->comment('手机号'),
            'status'=>$this->integer()->defaultValue(0)->comment('状态: 1默认 0非默认'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('address');
    }
}
