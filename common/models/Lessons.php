<?php

namespace common\models;

use Yii;

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
class Lessons extends \yii\db\ActiveRecord
{
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
            [['short_description', 'description'], 'string'],
            [['name', 'logo', 'slug'], 'string', 'max' => 500],
            [['background', 'seo_keywords', 'seo_description', 'created_at', 'updated_at'], 'string', 'max' => 300],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => SectionSubjects::className(), 'targetAttribute' => ['section_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sort_lessons' => 'Sort Lessons',
            'name' => 'Name',
            'section_id' => 'Section ID',
            'background' => 'Background',
            'logo' => 'Logo',
            'slug' => 'Slug',
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
    public function getSection()
    {
        return $this->hasOne(SectionSubjects::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStorageLessons()
    {
        return $this->hasMany(StorageLessons::className(), ['lesson_id' => 'id']);
    }
}