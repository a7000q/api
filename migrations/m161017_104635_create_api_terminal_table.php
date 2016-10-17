<?php

use yii\db\Migration;

/**
 * Handles the creation for table `api_terminal`.
 */
class m161017_104635_create_api_terminal_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('api_terminal', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'imei' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('api_terminal');
    }
}
