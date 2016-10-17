<?php

use yii\db\Migration;

/**
 * Handles the creation for table `type_products`.
 */
class m161017_111304_create_type_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('type_products', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('type_products');
    }
}
