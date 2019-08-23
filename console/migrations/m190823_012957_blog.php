<?php

use yii\db\Migration;

/**
 * Class m190823_012957_blog
 */
class m190823_012957_blog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190823_012957_blog cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable(
            'blog',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(500)->notNull(),
                'img_name' => $this->string(500),
                'slug' => $this->string(500)->notNull(),
                'short_description' => $this->text(),
                'description' => $this->text(),
                'seo_keywords' => $this->string(300),
                'seo_description' => $this->string(300),
                'created_at' => $this->string(300),
                'updated_at' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('blog');
    }
}
