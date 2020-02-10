<?php

use yii\db\Migration;

/**
 * Class m190901_212843_lessons
 */
class m190901_212843_lessons extends Migration
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
        echo "m190901_212843_lessons cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable(
            'lessons',
            [
                'id' => $this->primaryKey(),
                'sort_lessons' => $this->integer(11)->defaultValue(0),
                'name' => $this->string(500)->notNull(),
                'section_id' => $this->integer(11),
                'background' => $this->string(300),
                'logo' => $this->string(500),
                'price' => $this->string(500)->defaultValue(0),
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

        $this->addForeignKey(
            'FK_lessons',
            'lessons',
            'section_id',
            'section_subjects',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('lessons');
    }
}
