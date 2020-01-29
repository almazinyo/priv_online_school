<?php

use yii\db\Migration;

/**
 * Class m190913_083839_promotional_code
 */
class m190913_083839_promotional_code extends Migration
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
        echo "m190913_083839_promotional_code cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            'promotional_code',
            [
                'id' => $this->primaryKey(),
                'key' => $this->string(300),
                'percent' => $this->integer(11),
                'user_id' => $this->integer(11),
                'created_at' => $this->string(300),
                'updated_at' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],

            $tableOptions
        );

        $this->addForeignKey('FK_promotional_user', 'promotional_code', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('promotional_code');
    }
}
