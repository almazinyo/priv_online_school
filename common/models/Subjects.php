<?php

namespace common\models;

use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;
use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "subjects".
 *
 * @property int $id
 * @property string $title
 * @property string $sortable_id
 * @property string $slug
 * @property string $short_description
 * @property string $description
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_status
 */
class Subjects extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'icon', 'color', 'sortable_id'], 'string'],
            ['sortable_id', 'default', 'value' => 0],
            [['is_status'], 'integer'],
            [['title'], 'required'],
            [['title', 'slug'], 'string', 'max' => 500],
            [
                ['short_description', 'seo_keywords', 'seo_description', 'created_at', 'updated_at'],
                'string',
                'max' => 300,
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
            'title' => Yii::t('app', 'Title'),
            'sortable_id' => Yii::t('app', 'Sortable Id'),
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
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['subjects_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionSubjects()
    {
        return $this->hasMany(SectionSubjects::className(), ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasMany(Blog::className(), ['subject_id' => 'id']);
    }

    /**
     * @return array|ActiveRecord[]
     */
    public static function receiveAllData()
    {
        return
            self::find()
                ->joinWith('sectionSubjects')
                ->joinWith('sectionSubjects.lessons')
                ->joinWith('sectionSubjects.lessons.storageLessons')
                ->where(['subjects.is_status' => true])
                ->asArray()
                ->all()
            ;
    }

    /**
     * @param $slug
     * @return array|ActiveRecord|null
     */
    public static function receiveSpecificData($slug)
    {

        return
            self::find()
                ->joinWith(
                    [
                        'sectionSubjects' => function ($query) {
                            $query->onCondition(
                                [
                                    'section_subjects.is_status' => SectionSubjects::STATUS_ACTIVE,
                                    'section_subjects.parent_id' => 0,
                                ]
                            )->joinWith(
                                [
                                    'sections' => function ($query) {
                                        $query->onCondition(
                                            ['sections.is_status' => SectionSubjects::STATUS_ACTIVE]
                                        )->with('lessons')
                                        ;
                                    },
                                ]
                            )
                            ;
                        },
                    ]
                )
                ->where(['subjects.slug' => Html::encode($slug)])
                ->asArray()
                ->one()
            ;
    }

    /**
     * @return array|ActiveRecord[]
     */
    public static function receiveMenu()
    {
        return
            self::find()
                ->select(
                    [
                        'subjects.id',
                        'subjects.title',
                        'subjects.slug',
                        'subjects.icon',
                        'subjects.color',
                        'subjects.is_status',
                        'section_subjects.name as  sectionName',
                        'section_subjects.slug sectionSlug',
                    ]
                )
                ->joinWith('sectionSubjects')
                ->where([' != ', 'subjects.is_status', 0])
                ->orWhere([' != ', 'section_subjects.is_status', 0])
                ->orderBy(['sortable_id' => SORT_ASC])
                ->asArray()
                ->all()
            ;
    }

    /**
     * @return mixed[]
     */
    public static function receiveTitles()
    {
        return
            ArrayHelper::map(
                self::find()->all(), 'id', 'title'
            );
    }
}
