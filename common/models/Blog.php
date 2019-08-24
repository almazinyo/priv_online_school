<?php

namespace common\models;

use Yii;

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
class Blog extends \yii\db\ActiveRecord
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
            [['title', 'slug'], 'required'],
            [['short_description', 'description'], 'string'],
            [['is_status'], 'integer'],
            [['title', 'img_name', 'slug'], 'string', 'max' => 500],
            [['seo_keywords', 'seo_description', 'created_at', 'updated_at'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'img_name' => 'Img Name',
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
}
