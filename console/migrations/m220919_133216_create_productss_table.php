<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%productss}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%category}}`
 */
class m220919_133216_create_productss_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%productss}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'body' => $this->text(),
            'price' => $this->integer(),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-productss-category_id}}',
            '{{%productss}}',
            'category_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            '{{%fk-productss-category_id}}',
            '{{%productss}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            '{{%fk-productss-category_id}}',
            '{{%productss}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-productss-category_id}}',
            '{{%productss}}'
        );

        $this->dropTable('{{%productss}}');
    }
}
