<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "section_subjects".
 *
 * @property int $id
 * @property int $subject_id
 * @property string $name
 * @property string $price
 * @property string $slug
 * @property string $background
 * @property string $icon
 * @property string $short_description
 * @property string $description
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_status
 *
 * @property Lessons[] $lessons
 * @property Subjects $subject
 */
class SectionSubjects extends \yii\db\ActiveRecord
{

   const   STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'section_subjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'is_status', 'parent_id'], 'integer'],
            [['name', 'slug'], 'required'],
            [['parent_id', 'price'], 'default', 'value' => '0'],
            [['short_description', 'description', 'price'], 'string'],
            [['name', 'slug', 'icon'], 'string', 'max' => 500],
            [['background', 'seo_keywords', 'seo_description', 'created_at', 'updated_at'], 'string', 'max' => 300],
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
            'subject_id' => Yii::t('app', 'Subject ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'price'),
            'slug' => Yii::t('app', 'Slug'),
            'background' => Yii::t('app', 'Background'),
            'icon' => Yii::t('app', 'Icon'),
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
    public function getLessons()
    {
        return $this->hasMany(Lessons::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teachers::className(), ['section_id' => 'id']);
    }

    public function getSections()

    {

        return $this->hasMany(self::className(), ['parent_id' => 'id'])->from(self::tableName() . ' sections');
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function receiveAllData()
    {
        return
            self::find()
                ->joinWith('subject')
                ->joinWith('teachers')
                ->joinWith('lessons')
                ->joinWith('lessons.storageLessons')
                ->asArray()
                ->all()
            ;
    }

    public static function receiveSpecificData($slug)
    {
        return
            self::find()
                ->joinWith('sections')
                ->joinWith('subject')
                ->joinWith('teachers')
                ->joinWith('lessons')
                ->where(['section_subjects.slug' => Html::encode($slug)])
                ->asArray()
                ->one()
            ;
    }
}
