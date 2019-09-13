<?php

use yii\db\Migration;

/**
 * Class m190913_024036_profile
 */
class m190913_024036_profile extends Migration
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
        echo "m190913_024036_profile cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable(
            'profile',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(11),
                'bonus_points' => $this->integer(11),
                'first_name' => $this->string(300),
                'last_name' => $this->string(300),
                'phone' => $this->string(300),
                'city' => $this->string(300),
                'created_at' => $this->string(300),
                'updated_at' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
        $this->addForeignKey('FK_profile_user', 'profile', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('profile');
    }
}
