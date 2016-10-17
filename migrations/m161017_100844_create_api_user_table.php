<?php

use yii\db\Migration;

/**
 * Handles the creation for table `api_user`.
 */
class m161017_100844_create_api_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('api_user', [
            'id' => $this->primaryKey(),
            'id_terminal' => $this->integer(),
            'login' => $this->string(),
            'password' => $this->string(),
            'token' => $this->string(),
            'date' => $this->integer(),
            'name' => $this->string(),
            'surname' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('api_user');
    }
}
