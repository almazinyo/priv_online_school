<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $user_id
 * @property int $subjects_id
 * @property int $section_id
 * @property int $rating
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_status
 *
 * @property SectionSubjects $section
 * @property Subjects $subjects
 * @property User $user
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'subjects_id', 'section_id', 'rating', 'is_status'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'string', 'max' => 300],
            [
                ['section_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => SectionSubjects::className(),
                'targetAttribute' => ['section_id' => 'id'],
            ],
            [
                ['subjects_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Subjects::className(),
                'targetAttribute' => ['subjects_id' => 'id'],
            ],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'subjects_id' => Yii::t('app', 'Subjects ID'),
            'section_id' => Yii::t('app', 'Section ID'),
            'rating' => Yii::t('app', 'Rating'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'is_status' => Yii::t('app', 'Is Status'),
        ];
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
    public function getSubjects()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subjects_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function receiveAllData(): array
    {
        $select =
            sprintf(
                '%s.*, %s, %s, %s, %s, %s, %s',
                self::tableName(),
                'DATE(FROM_UNIXTIME(reviews.created_at)) as created_at',
                'DATE(FROM_UNIXTIME(reviews.updated_at)) as updated_at',
                'subjects.title as subject_name ',
                'section_subjects.name as section_name',
                'profile.first_name as first_name',
                'profile.last_name as last_name'
            );

        return
            self::find()
                ->select($select)
                ->joinWith('subjects')
                ->joinWith('section')
                ->joinWith('user.profiles')
                ->where(['reviews.is_status' => true])
                ->asArray()
                ->all()
            ;
    }
}
