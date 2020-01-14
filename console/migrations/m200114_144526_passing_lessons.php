<?php

use yii\db\Migration;

/**
 * Class m200114_144526_passing_lessons
 */
class m200114_144526_passing_lessons extends Migration
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
        echo "m200114_144526_passing_lessons cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            'passing_lessons',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(11),
                'lesson_id' => $this->integer(11),
                'section_id' => $this->integer(11),
                'created_at' => $this->string(300),
                'updated_at' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],
            $tableOptions

        );

        $this->addForeignKey('FK_passing_lessons', 'passing_lessons', 'lesson_id', 'lessons', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_passing_lessons_user', 'passing_lessons', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_passing_lessons_section', 'passing_lessons', 'section_id', 'section_subjects', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('passing_lessons');
    }
}
