<?php

use yii\db\Migration;

/**
 * Handles the creation for table `bad_cards`.
 */
class m161025_083251_create_bad_cards_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('bad_cards', [
            'id' => $this->primaryKey(),
            'date' => $this->integer(),
            'id_electro' => $this->text(),
            'id_terminal' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('bad_cards');
    }
}
