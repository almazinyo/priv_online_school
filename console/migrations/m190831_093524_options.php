<?php

use yii\db\Migration;

/**
 * Class m190831_093524_options
 */
class m190831_093524_options extends Migration
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
        echo "m190831_093524_options cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable(
            'options',
            [
                'id' => $this->primaryKey(),
                'key' => $this->string(500)->notNull(),
                'value' => $this->text(),
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('options');
    }
}
