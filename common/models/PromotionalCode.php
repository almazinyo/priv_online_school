<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promotional_code".
 *
 * @property int $id
 * @property string $key
 * @property int $price
 * @property int $user_id
 * @property int $subjects_id
 * @property int $section_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_status
 *
 * @property SectionSubjects $section
 * @property Subjects $subjects
 * @property User $user
 */
class PromotionalCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promotional_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'user_id', 'subjects_id', 'section_id', 'is_status'], 'integer'],
            [['key', 'created_at', 'updated_at'], 'string', 'max' => 300],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => SectionSubjects::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['subjects_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subjects_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'price' => Yii::t('app', 'Price'),
            'user_id' => Yii::t('app', 'User ID'),
            'subjects_id' => Yii::t('app', 'Subjects ID'),
            'section_id' => Yii::t('app', 'Section ID'),
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
    public function getSubjects()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subjects_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
