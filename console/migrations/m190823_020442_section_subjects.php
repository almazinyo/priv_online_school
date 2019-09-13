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

    /**
     * @return bool|void
     */
    public function up()
    {
        $this->createTable(
            'section_subjects',
            [
                'id' => $this->primaryKey(),
                'subject_id' => $this->integer(11),
                'parent_id' => $this->integer(11),
                'name' => $this->string(500)->notNull(),
                'slug' => $this->string(500)->notNull(),
                'background' => $this->string(300),
                'icon' => $this->string(500),
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

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('section_subjects');
    }
}

