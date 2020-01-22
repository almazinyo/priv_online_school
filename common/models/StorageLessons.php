<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

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
        $rules =
            [
                [['lesson_id', 'is_status'], 'integer'],
                [['lesson_id'], 'required'],
                [['name', 'type'], 'string', 'max' => 500],
                [
                    ['lesson_id'],
                    'exist',
                    'skipOnError' => true,
                    'targetClass' => Lessons::className(),
                    'targetAttribute' => ['lesson_id' => 'id'],
                ],
            ];

        if (Yii::$app->controller->action->id != 'update') {
            $rules[] = [['name'], 'required'];
        }

        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lesson_id' => Yii::t('app', 'Lesson ID'),
            'name' => Yii::t('app', 'Name'),
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
     * @param $lessonId
     * @return mixed[]
     */
    public static function receiveFileName($lessonId): array
    {
        return
            ArrayHelper::map(
                self::find()
                    ->select('name,id')
                    ->where(['lesson_id' => Html::decode($lessonId)])
                    ->asArray()
                    ->all(),
                'id',
                'name'
            );
    }
}
