<?php

use yii\db\Migration;

/**
 * Handles the creation of table `person`.
 * Has foreign keys to the tables:
 *
 * - `company`
 * - `address`
 */
class m171229_090308_create_person_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("SET foreign_key_checks = 0;");
        $this->createTable('person', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'email' => $this->string(50)->notNull(),
            'phone' => $this->string(20)->notNull(),
            'company_id' => $this->integer(11),
            'address_id' => $this->integer(11),
        ],
            'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
        );

        // creates index for column `company_id`
        $this->createIndex(
            'idx-person-company_id',
            'person',
            'company_id'
        );

        // add foreign key for table `company`
        $this->addForeignKey(
            'fk-person-company_id',
            'person',
            'company_id',
            'company',
            'id',
            'CASCADE'
        );

        // creates index for column `address_id`
        $this->createIndex(
            'idx-person-address_id',
            'person',
            'address_id'
        );

        // add foreign key for table `address`
        $this->addForeignKey(
            'fk-person-address_id',
            'person',
            'address_id',
            'address',
            'id',
            'CASCADE'
        );
        $this->execute("SET foreign_key_checks = 1;");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `company`
        $this->dropForeignKey(
            'fk-person-company_id',
            'person'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-person-company_id',
            'person'
        );

        // drops foreign key for table `address`
        $this->dropForeignKey(
            'fk-person-address_id',
            'person'
        );

        // drops index for column `address_id`
        $this->dropIndex(
            'idx-person-address_id',
            'person'
        );

        $this->dropTable('person');
    }
}
