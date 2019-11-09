<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "teachers".
 *
 * @property int $id
 * @property string $name
 * @property int $subject_id
 * @property string $social_link
 * @property int $work_experience
 * @property string $img_name
 * @property string $small_img_path
 * @property string $large_img_path
 * @property string $slug
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_status
 *
 * @property Subjects $subject
 */
class Teachers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teachers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'subject_id'], 'required'],
            [['subject_id', 'work_experience', 'is_status'], 'integer'],
            [['description'], 'string'],
            [['name', 'social_link', 'img_name', 'small_img_path', 'large_img_path', 'slug'], 'string', 'max' => 500],
            [['created_at', 'updated_at'], 'string', 'max' => 300],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute' => 'slug',
                'attribute' => 'name',
                // optional params
                'ensureUnique' => true,
                'replacement' => '-',
                'lowercase' => true,
                'immutable' => false,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;',
            ],
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
            'name' => Yii::t('app', 'Name'),
            'subject_id' => Yii::t('app', 'Subject ID'),
            'social_link' => Yii::t('app', 'Social Link'),
            'work_experience' => Yii::t('app', 'Work Experience'),
            'img_name' => Yii::t('app', 'Img Name'),
            'small_img_path' => Yii::t('app', 'Small Img Path'),
            'large_img_path' => Yii::t('app', 'Large Img Path'),
            'slug' => Yii::t('app', 'Slug'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'is_status' => Yii::t('app', 'Is Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subject_id']);
    }
}
