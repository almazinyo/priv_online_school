<?php

use yii\db\Migration;

/**
 * Class m190910_070454_teachers
 */
class m190910_070454_teachers extends Migration
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
        echo "m190910_070454_teachers cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            'teachers',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(500)->notNull(),
                'subject_id' => $this->integer(11)->notNull(),
                'social_link' => $this->string(500),
                'work_experience' => $this->tinyInteger(2),
                'img_name' => $this->string(500),
                'small_img_path' => $this->string(500),
                'large_img_path' => $this->string(500),
                'slug' => $this->string(500),
                'description' => $this->text(),
                'created_at' => $this->string(300),
                'updated_at' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'FK_teachers',
            'teachers',
            'subject_id',
            'subjects',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('teachers');
    }
}
