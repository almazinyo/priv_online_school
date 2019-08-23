<?php

use yii\db\Migration;

/**
 * Class m190823_013733_reviews
 */
class m190823_013733_reviews extends Migration
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
        echo "m190823_013733_reviews cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable(
            'reviews',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer(11),
                'subjects_id' => $this->integer(11),
                'rating' => $this->tinyInteger(2),
                'description' => $this->text(),
                'created_at' => $this->string(300),
                'updated_at' => $this->string(300),
                'is_status' => $this->tinyInteger(2),
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
        $this->addForeignKey('FK_reviews_user', 'reviews', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_reviews_subjects', 'reviews', 'subjects_id', 'subjects', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->dropTable('reviews');
    }
}
