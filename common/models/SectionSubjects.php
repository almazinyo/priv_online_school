<?php

namespace common\models;

use Yii;
use  yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "section_subjects".
 *
 * @property int $id
 * @property int $subject_id
 * @property int $parent_id
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
 * @property int $sortable_id
 * @property string $img_path
 *
 * @property Lessons[] $lessons
 * @property OrderList[] $orderLists
 * @property PromotionalCode[] $promotionalCodes
 * @property Reviews[] $reviews
 * @property Subjects $subject
 */
class SectionSubjects extends \yii\db\ActiveRecord
{
    const   STATUS_ACTIVE = 1;

    private static $slugLesson;

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
            [['subject_id', 'parent_id', 'is_status', 'sortable_id'], 'integer'],
            [['name', 'price', 'slug'], 'required'],
            [['short_description', 'description'], 'string'],
            [['name', 'price', 'slug', 'icon', 'img_path'], 'string', 'max' => 500],
            [
                ['background', 'seo_keywords', 'seo_description', 'created_at', 'updated_at', 'stock'],
                'string',
                'max' => 300,
            ],
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject_id' => Yii::t('app', 'Subject ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
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
            'sortable_id' => Yii::t('app', 'Sortable ID'),
            'img_path' => Yii::t('app', 'Img Path'),
            'stock' => Yii::t('app', 'Stock'),
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
    public function getOrderLists()
    {
        return $this->hasMany(OrderList::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionalCodes()
    {
        return $this->hasMany(PromotionalCode::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subject_id']);
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

    public function getCountLessons()
    {
        return $this->hasOne(Lessons::className(), ['section_id' => 'id'])->count();
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

    /**
     * @return mixed[]
     */
    public static function receiveTitles()
    {
        return
            ArrayHelper::map(
                self::find()->all(), 'id', 'name'
            );
    }

    public static function receiveSpecificData($slug, $slugLesson)
    {

        self::$slugLesson = $slugLesson;
        return
            self::find()
                ->joinWith(
                    [
                        'sections' => function ($query) {
                            $query->onCondition(['sections.is_status' => SectionSubjects::STATUS_ACTIVE])
                                ->orderBy(['sections.sortable_id' => SORT_ASC])
                                ->with(
                                    [
                                        'lessons' => function ($query) {
                                            $query->orderBy(['lessons.sort_lessons' => SORT_ASC]);
                                        },
                                    ]
                                )
                            ;
                        },
                    ]
                )->joinWith(
                    [
                        'lessons' => function ($query) {
                            $query
                                ->limit(1)
                                ->joinWith('storageLessons')
                                ->joinWith('quizzes')
                            ;

                            if (!empty(self::$slugLesson)) {
                                $query->andWhere(['lessons.slug' => self::$slugLesson]);
                            }
                        },

                    ]
                )
                ->joinWith('subject')
                ->joinWith('subject.teachers')
                ->where(['section_subjects.slug' => Html::encode($slug)])
                ->asArray()
                ->one()
            ;
    }
}
