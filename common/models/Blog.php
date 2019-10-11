<?php

namespace common\models;

use Yii;
use  yii\db\ActiveRecord;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title
 * @property string $img_name
 * @property string $slug
 * @property string $short_description
 * @property string $description
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_status
 */
class Blog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'is_status'], 'integer'],
            [['title', 'slug'], 'required'],
            [['short_description', 'description'], 'string'],
            [['title', 'img_name', 'slug'], 'string', 'max' => 500],
            [['seo_keywords', 'seo_description', 'created_at', 'updated_at'], 'string', 'max' => 300],
            [
                ['subject_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Subjects::className(),
                'targetAttribute' => ['subject_id' => 'id'],
            ],
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
                'attribute' => 'title',
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
            'subject_id' => Yii::t('app', 'Subject ID'),
            'title' => Yii::t('app', 'Title'),
            'img_name' => Yii::t('app', 'Img Name'),
            'slug' => Yii::t('app', 'Slug'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'seo_keywords' => Yii::t('app', 'Seo Keywords'),
            'seo_description' => Yii::t('app', 'Seo Description'),
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

    public static function receiveAllData(ActiveRecord $object): array
    {
        $select =
            sprintf(
                '%s.*, %s, %s,',
                $object::tableName(),
                'DATE(FROM_UNIXTIME(created_at)) as created_at',
                'DATE(FROM_UNIXTIME(updated_at)) as updated_at'
            );

        return
            $object::find()
                ->select($select)
                ->joinWith('subjects')
                ->asArray()
                ->all()
            ;
    }
}
