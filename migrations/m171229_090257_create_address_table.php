<?php

use yii\db\Migration;

/**
 * Handles the creation of table `address`.
 */
class m171229_090257_create_address_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("SET foreign_key_checks = 0;");
        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'street' => $this->string(),
            'city' => $this->string(),
            'country' => $this->string(),
        ],
            'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
        );
        $this->execute("SET foreign_key_checks = 1;");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('address');
    }
}
