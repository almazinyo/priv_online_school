<?php

use yii\db\Migration;

/**
 * Class m190913_031513_order_list
 */
class m190913_031513_order_list extends Migration
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
        echo "m190913_031513_order_list cannot be reverted.\n";

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
            'order_list',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(11),
                'subjects_id' => $this->integer(11),
                'section_id' => $this->integer(11),
                'name' => $this->string(300),
                'email' => $this->string(300),
                'price' => $this->string(300),
                'sender' => $this->string(300),
                'operation_label' => $this->string(300),
                'operation_id' => $this->string(300),
                'datetime' => $this->string(300),
                'notification_type' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],
            $tableOptions

        );
        $this->addForeignKey('FK_order_user', 'order_list', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_order_subject', 'order_list', 'subjects_id', 'subjects', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_order_section', 'order_list', 'section_id', 'section_subjects', 'id', 'CASCADE',
            'CASCADE');
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('order_list');
    }
}
