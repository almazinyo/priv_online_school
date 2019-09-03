<?php

use yii\db\Migration;

/**
 * Class m190903_104002_menu
 */
class m190903_104002_menu extends Migration
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
        echo "m190903_104002_menu cannot be reverted.\n";

        return false;
    }

    /**
     * @return bool|void
     */
    public function up()
    {
        $this->createTable(
            'menu',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(500)->notNull(),
                'slug' => $this->string(500)->notNull(),
                'logo' => $this->string(500),
                'parent_id' => $this->string(300)->defaultValue(0),
                'created_at' => $this->string(300),
                'updated_at' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
