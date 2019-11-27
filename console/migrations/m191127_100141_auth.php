<?php

use yii\db\Migration;

/**
 * Class m191127_100141_auth
 */
class m191127_100141_auth extends Migration
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
        echo "m191127_100141_auth cannot be reverted.\n";

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
            'auth',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->notNull(),
                'source' => $this->string()->notNull(),
                'source_id' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'fk-auth-user_id-user-id',
            'auth',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('auth');
    }
}
