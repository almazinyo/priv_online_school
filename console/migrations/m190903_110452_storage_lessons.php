<?php

use yii\db\Migration;

/**
 * Class m190903_110452_storage_lessons
 */
class m190903_110452_storage_lessons extends Migration
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
        echo "m190903_110452_storage_lessons cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable(
            'storage_lessons',
            [
                'id' => $this->primaryKey(),
                'lesson_id' => $this->integer(11),
                'name' => $this->string(500)->notNull(),
//                'type' => 'ENUM("pdf","image","video")',
                'is_status' => $this->tinyInteger(2),
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        $this->addForeignKey(
            'FK_storage',
            'storage_lessons',
            'lesson_id',
            'lessons',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('storage_lessons');
    }
}
