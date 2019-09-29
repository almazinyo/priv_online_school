<?php

use yii\db\Migration;

/**
 * Class m190929_110848_quizzes_users
 */
class m190929_110848_quizzes_users extends Migration
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
        echo "m190929_110848_quizzes_users cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            'quizzes_users',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(11),
                'quiz_id' => $this->integer(11),
                'created_at' => $this->string(300),
                'updated_at' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],
            $tableOptions

        );

        $this->addForeignKey('FK_quizzes_users_user', 'quizzes_users', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_quizzes_users_quiz', 'quizzes_users', 'quiz_id', 'quiz', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('quizzes_users');
    }
}
