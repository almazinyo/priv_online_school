<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "lessons".
 *
 * @property int $id
 * @property int $sort_lessons
 * @property string $name
 * @property int $section_id
 * @property string $background
 * @property string $logo
 * @property string $slug
 * @property string $price
 * @property string $short_description
 * @property string $description
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_status
 *
 * @property SectionSubjects $section
 * @property StorageLessons[] $storageLessons
 */
class Lessons extends ActiveRecord
{
    const   STATUS_ACTIVE = 1;
    const   STATUS_FREE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort_lessons', 'section_id', 'is_status'], 'integer'],
            [['name', 'slug'], 'required'],
            [['short_description', 'description','price'], 'string'],
            [['name', 'logo', 'slug'], 'string', 'max' => 500],
            [['background', 'seo_keywords', 'seo_description', 'created_at', 'updated_at'], 'string', 'max' => 300],
            [
                ['section_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => SectionSubjects::className(),
                'targetAttribute' => ['section_id' => 'id'],
            ],
        ];
    }

    public static function receiveTitles()
    {
        return
            ArrayHelper::map(
                self::find()->all(), 'id', 'name'
            );
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

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sort_lessons' => Yii::t('app', 'Sort Lessons'),
            'name' => Yii::t('app', 'Name'),
            'section_id' => Yii::t('app', 'Section ID'),
            'background' => Yii::t('app', 'Background'),
            'logo' => Yii::t('app', 'Logo'),
            'price' => Yii::t('app', 'Price'),
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
    public function getSection()
    {
        return $this->hasOne(SectionSubjects::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizzes()
    {
        return $this->hasMany(Quiz::className(), ['lessons_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorageLessons()
    {
        return $this->hasMany(StorageLessons::className(), ['lesson_id' => 'id']);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function receiveAllData()
    {
        return
            self::find()
                ->joinWith('quizzes')
                ->joinWith('storageLessons')
                ->where(['lessons.is_status' => true])
                ->asArray()
                ->all()
            ;
    }

    public static function receiveSpecificData($slug)
    {
        return
            self::find()
                ->joinWith('section')
                ->joinWith('quizzes')
                ->joinWith('storageLessons')
                ->where(['lessons.slug' => Html::encode($slug)])
                ->asArray()
                ->one()
            ;
    }

    public static function receiveLessonsForSection($sectionId)
    {
        return
            self::find()
                ->select('id, name, slug, section_id, is_status, price')
                ->where(['section_id' => Html::encode($sectionId)])
                ->andWhere(['!=', 'is_status', false])
                ->asArray()
                ->all()
            ;
    }
}
