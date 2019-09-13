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
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            'promotional_code',
            [
                'id' => $this->primaryKey(),
                'key' => $this->string(300),
                'price' => $this->integer(11),
                'user_id' => $this->integer(11),
                'subjects_id' => $this->integer(11),
                'section_id' => $this->integer(11),
                'created_at' => $this->string(300),
                'updated_at' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],
            $tableOptions

        );
        $this->addForeignKey('FK_promotional_user', 'promotional_code', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_promotional_subject', 'promotional_code', 'subjects_id', 'subjects', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_promotional_section', 'promotional_code', 'section_id', 'section_subjects', 'id', 'CASCADE',
            'CASCADE');
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('promotional_code');
    }
}
