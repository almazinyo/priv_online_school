<?php

namespace common\models;

use Yii;

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
            [['name', 'section_id'], 'required'],
            [['section_id', 'is_status'], 'integer'],
            [['description'], 'string'],
            [['name', 'position', 'img_name'], 'string', 'max' => 500],
            [['created_at', 'updated_at'], 'string', 'max' => 300],
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
            'name' => 'Name',
            'position' => 'Position',
            'section_id' => 'Section ID',
            'img_name' => 'Img Name',
            'description' => 'Description',
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
}
