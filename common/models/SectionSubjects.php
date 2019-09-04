<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "section_subjects".
 *
 * @property int $id
 * @property int $subject_id
 * @property string $name
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
            [['subject_id', 'is_status'], 'integer'],
            [['name', 'slug'], 'required'],
            [['short_description', 'description'], 'string'],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_id' => 'Subject ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'background' => 'Background',
            'icon' => 'Icon',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'seo_keywords' => 'Seo Keywords',
            'seo_description' => 'Seo Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_status' => 'Is Status',
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
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function receiveAllData()
    {
        return
            self::find()
                ->joinWith('lessons')
                ->joinWith('lessons.storageLessons')
                ->asArray()
                ->all()
            ;
    }
}
