<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m201111_090612_create_news_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string(),
            'content' => $this->text(),
            'slug' => $this->string()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'status' => $this->smallInteger()->defaultValue(0),
            'meta_json' => $this->json()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-news-slug}}', '{{%news}}', 'slug', true);
        $this->createIndex('{{%idx-news-category_id}}', '{{%news}}', 'category_id');
        $this->addForeignKey('{{%fk-news-category_id}}', '{{%news}}', 'category_id', '{{%category}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%news}}');
    }
}
