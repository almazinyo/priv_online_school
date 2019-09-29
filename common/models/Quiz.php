<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%quiz}}".
 *
 * @property int $id
 * @property int $lessons_id
 * @property int $bonus_points
 * @property string $question
 * @property string $hint
 * @property string $correct_answer
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_status
 *
 * @property Lessons $lessons
 * @property QuizzesUsers[] $quizzesUsers
 */
class Quiz extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%quiz}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lessons_id', 'bonus_points', 'is_status'], 'integer'],
            [['question', 'hint', 'correct_answer'], 'string', 'max' => 500],
            [['created_at', 'updated_at'], 'string', 'max' => 300],
            [['lessons_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::className(), 'targetAttribute' => ['lessons_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lessons_id' => Yii::t('app', 'Lessons ID'),
            'bonus_points' => Yii::t('app', 'Bonus Points'),
            'question' => Yii::t('app', 'Question'),
            'hint' => Yii::t('app', 'Hint'),
            'correct_answer' => Yii::t('app', 'Correct Answer'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'is_status' => Yii::t('app', 'Is Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessons()
    {
        return $this->hasOne(Lessons::className(), ['id' => 'lessons_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizzesUsers()
    {
        return $this->hasMany(QuizzesUsers::className(), ['quiz_id' => 'id']);
    }
}
