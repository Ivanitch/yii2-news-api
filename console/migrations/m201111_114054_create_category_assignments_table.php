<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_assignments}}`.
 */
class m201111_114054_create_category_assignments_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%category_assignments}}', [
            'news_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%pk-category_assignments}}', '{{%category_assignments}}', ['news_id', 'category_id']);

        $this->createIndex('{{%idx-category_assignments-news_id}}', '{{%category_assignments}}', 'news_id');
        $this->createIndex('{{%idx-category_assignments-category_id}}', '{{%category_assignments}}', 'category_id');

        $this->addForeignKey('{{%fk-category_assignments-news_id}}', '{{%category_assignments}}', 'news_id', '{{%news}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-category_assignments-category_id}}', '{{%category_assignments}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%category_assignments}}');
    }
}
