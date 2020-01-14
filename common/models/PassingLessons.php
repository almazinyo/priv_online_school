<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "passing_lessons".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $lesson_id
 * @property int|null $section_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $is_status
 *
 * @property Lessons $lesson
 * @property SectionSubjects $section
 * @property User $user
 */
class PassingLessons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'passing_lessons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'lesson_id', 'section_id', 'is_status'], 'integer'],
            [['created_at', 'updated_at'], 'string', 'max' => 300],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::className(), 'targetAttribute' => ['lesson_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => SectionSubjects::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'lesson_id' => Yii::t('app', 'Lesson ID'),
            'section_id' => Yii::t('app', 'Section ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'is_status' => Yii::t('app', 'Is Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lessons::className(), ['id' => 'lesson_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(SectionSubjects::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
