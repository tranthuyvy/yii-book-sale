<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type_detail}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%type}}`
 * - `{{%products}}`
 */
class m230707_048200_create_type_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type_detail}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer(11)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
        ]);

        // creates index for column `type_id`
        $this->createIndex(
            '{{%idx-type_detail-type_id}}',
            '{{%type_detail}}',
            'type_id'
        );

        // add foreign key for table `{{%type}}`
        $this->addForeignKey(
            '{{%fk-type_detail-type_id}}',
            '{{%type_detail}}',
            'type_id',
            '{{%type}}',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-type_detail-product_id}}',
            '{{%type_detail}}',
            'product_id'
        );

        // add foreign key for table `{{%products}}`
        $this->addForeignKey(
            '{{%fk-type_detail-product_id}}',
            '{{%type_detail}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%type}}`
        $this->dropForeignKey(
            '{{%fk-type_detail-type_id}}',
            '{{%type_detail}}'
        );

        // drops index for column `type_id`
        $this->dropIndex(
            '{{%idx-type_detail-type_id}}',
            '{{%type_detail}}'
        );

        // drops foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-type_detail-product_id}}',
            '{{%type_detail}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-type_detail-product_id}}',
            '{{%type_detail}}'
        );

        $this->dropTable('{{%type_detail}}');
    }
}
