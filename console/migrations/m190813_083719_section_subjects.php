<?php

use yii\db\Migration;

/**
 * Class m190813_083719_section_subjects
 */
class m190813_083719_section_subjects extends Migration
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
        echo "m190813_083719_section_subjects cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable(
            'section_subjects',
            [
                'id' => $this->primaryKey(),
                'subject_id' => $this->integer(11)->notNull(),
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
    }

    public function down()
    {
        $this->dropTable('section_subjects');
    }
}
