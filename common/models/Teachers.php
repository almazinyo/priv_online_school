<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "teachers".
 *
 * @property int $id
 * @property string $name
 * @property string $position
 * @property int $section_id
 * @property string $img_name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_status
 *
 * @property SectionSubjects $section
 */
class Teachers extends ActiveRecord
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
            [['name', 'section_id'], 'required'],
            [['section_id', 'is_status'], 'integer'],
            [['description'], 'string'],
            [['name', 'position', 'img_name', 'short_description', 'slug'], 'string', 'max' => 500],
            [['created_at', 'updated_at'], 'string', 'max' => 300],
            [
                ['section_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => SectionSubjects::className(),
                'targetAttribute' => ['section_id' => 'id'],
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
            'position' => Yii::t('app', 'Position'),
            'section_id' => Yii::t('app', 'Section ID'),
            'img_name' => Yii::t('app', 'Img Name'),
            'short_description' => Yii::t('app', 'Short Description'),
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
    public function getSection()
    {
        return $this->hasOne(SectionSubjects::className(), ['id' => 'section_id']);
    }
}