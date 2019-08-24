<?php

use yii\db\Migration;

/**
 * Class m190823_020442_section_subjects
 */
class m190823_020442_section_subjects extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    public function up()
    {
        $this->createTable(
            'section_subjects',
            [
                'id' => $this->primaryKey(),
                'subject_id' => $this->integer(11),
                'title' => $this->string(500)->notNull(),
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
            'FK_subjects',
            'section_subjects',
            'subject_id',
            'subjects',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('section_subjects');
    }
}

