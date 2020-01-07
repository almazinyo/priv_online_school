<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_list".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $subjects_id
 * @property int|null $section_id
 * @property string|null $name
 * @property string|null $email
 * @property int|null $price
 * @property int|null $sender
 * @property int|null $operation_label
 * @property int|null $operation_id
 * @property string|null $datetime
 * @property string|null $notification_type
 * @property int|null $is_status
 *
 * @property SectionSubjects $section
 * @property Subjects $subjects
 * @property User $user
 */
class OrderList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'subjects_id', 'section_id', 'price', 'sender', 'operation_label', 'operation_id', 'is_status'], 'integer'],
            [['name', 'email', 'datetime', 'notification_type'], 'string', 'max' => 300],
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
            'user_id' => Yii::t('app', 'User ID'),
            'subjects_id' => Yii::t('app', 'Subjects ID'),
            'section_id' => Yii::t('app', 'Section ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'price' => Yii::t('app', 'Price'),
            'sender' => Yii::t('app', 'Sender'),
            'operation_label' => Yii::t('app', 'Operation Label'),
            'operation_id' => Yii::t('app', 'Operation ID'),
            'datetime' => Yii::t('app', 'Datetime'),
            'notification_type' => Yii::t('app', 'Notification Type'),
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
