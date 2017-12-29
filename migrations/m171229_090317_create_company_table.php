<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company`.
 * Has foreign keys to the tables:
 *
 * - `person`
 */
class m171229_090317_create_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->execute("SET foreign_key_checks = 0;");
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'about' => $this->text(),
            'person_id' => $this->integer(),
        ],
            'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'
        );

        // creates index for column `person_id`
        $this->createIndex(
            'idx-company-person_id',
            'company',
            'person_id'
        );

        // add foreign key for table `person`
        $this->addForeignKey(
            'fk-company-person_id',
            'company',
            'person_id',
            'person',
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
        // drops foreign key for table `person`
        $this->dropForeignKey(
            'fk-company-person_id',
            'company'
        );

        // drops index for column `person_id`
        $this->dropIndex(
            'idx-company-person_id',
            'company'
        );

        $this->dropTable('company');
    }
}
