<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%quiz}}".
 *
 * @property int $id
 * @property int $lessons_id
 * @property int $subject_id
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
class Quiz extends ActiveRecord
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
            [['lessons_id','subject_id', 'bonus_points', 'is_status'], 'integer'],
            [['question', 'hint', 'correct_answer'], 'string', 'max' => 500],
            [['created_at', 'updated_at'], 'string', 'max' => 300],
            [
                ['lessons_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Lessons::className(),
                'targetAttribute' => ['lessons_id' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
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
            'subject_id' => Yii::t('app', 'Subjects ID'),
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
    public function getSubjects()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizzesUsers()
    {
        return $this->hasMany(QuizzesUsers::className(), ['quiz_id' => 'id']);
    }
}
