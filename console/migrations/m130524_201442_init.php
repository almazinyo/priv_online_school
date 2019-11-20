<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%user}}',
            [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull()->unique(),
                'auth_key' => $this->string(32)->notNull(),
                'password_hash' => $this->string()->notNull(),
                'password_reset_token' => $this->string()->unique(),
                'email' => $this->string()->notNull()->unique(),

                'status' => $this->smallInteger()->notNull()->defaultValue(10),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $user = new \common\models\User();
        $user->username = 'admin';
        $user->email = 'admin@example.com';
        $user->status = 10;
        $user->generateAuthKey();
        $user->setPassword('admin1234');
        $user->save(false);

        $this->createTable(
            'session',
            [
                'id' => $this->char(40)->notNull(),
                'expire' => $this->integer(),
                'data' => $this->binary(),
                'user_id' => $this->integer(),
            ]
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

        $this->createTable(
            'auth',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->notNull(),
                'source' => $this->string()->notNull(),
                'source_id' => $this->string()->notNull(),
            ]);

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
        $this->dropTable('{{%user}}');
    }
}
