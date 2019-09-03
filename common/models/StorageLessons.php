<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "storage_lessons".
 *
 * @property int $id
 * @property int $lesson_id
 * @property string $name
 * @property string $type
 * @property int $is_status
 *
 * @property Lessons $lesson
 */
class StorageLessons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'storage_lessons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lesson_id', 'is_status'], 'integer'],
            [['name'], 'required'],
            [['type'], 'string'],
            [['name'], 'string', 'max' => 500],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::className(), 'targetAttribute' => ['lesson_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lesson_id' => 'Lesson ID',
            'name' => 'Name',
            'type' => 'Type',
            'is_status' => 'Is Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lessons::className(), ['id' => 'lesson_id']);
    }
}
