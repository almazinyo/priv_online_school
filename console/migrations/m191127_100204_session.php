<?php

use yii\db\Migration;

/**
 * Class m191127_100204_session
 */
class m191127_100204_session extends Migration
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
        echo "m191127_100204_session cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            'session',
            [
                'id' => $this->primaryKey(),
                'expire' => $this->integer(),
                'data' => $this->binary(),
                'token' => $this->string('500'),
                'user_id' => $this->integer(),
                'status' => $this->smallInteger(1)->defaultValue(0),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'fk-session-user_id-user-id',
            'session',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('session');
    }
}
