<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reviews}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%products}}`
 * - `{{%user}}`
 */
class m230707_054619_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull(),
            'comments' => $this->string(255),
            'star' => $this->integer(1),
            'created_at' => $this->integer(11),
            'created_by' => $this->integer(11)->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-reviews-product_id}}',
            '{{%reviews}}',
            'product_id'
        );

        // add foreign key for table `{{%products}}`
        $this->addForeignKey(
            '{{%fk-reviews-product_id}}',
            '{{%reviews}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-reviews-created_by}}',
            '{{%reviews}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-reviews-created_by}}',
            '{{%reviews}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-reviews-product_id}}',
            '{{%reviews}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-reviews-product_id}}',
            '{{%reviews}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-reviews-created_by}}',
            '{{%reviews}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-reviews-created_by}}',
            '{{%reviews}}'
        );

        $this->dropTable('{{%reviews}}');
    }
}
