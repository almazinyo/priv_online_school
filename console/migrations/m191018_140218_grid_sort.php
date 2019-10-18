<?php

use yii\db\Migration;

/**
 * Class m191018_140218_grid_sort
 */
class m191018_140218_grid_sort extends Migration
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
        echo "m191018_140218_grid_sort cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable(
            'grid_sort',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(11),
                'visible_columns' => $this->text(),
                'default_columns' => $this->text(),
                'page_size' => $this->string(300),
                'class_name' => $this->string(300),
                'theme' => $this->string(300),
                'label' => $this->string(300),
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('grid_sort');
    }
}
