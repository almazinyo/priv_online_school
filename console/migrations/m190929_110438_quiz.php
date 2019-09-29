<?php

use yii\db\Migration;

/**
 * Class m190929_110438_quiz
 */
class m190929_110438_quiz extends Migration
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
        echo "m190929_110438_quiz cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            'quiz',
            [
                'id' => $this->primaryKey(),
                'lessons_id' => $this->integer(11),
                'bonus_points' => $this->integer(11),
                'question' => $this->string(500),
                'hint' => $this->string(500),
                'correct_answer' => $this->string(500),
                'created_at' => $this->string(300),
                'updated_at' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],
            $tableOptions

        );
        $this->addForeignKey('FK_quiz_lessons', 'quiz', 'lessons_id', 'lessons', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('quiz');
    }
}
