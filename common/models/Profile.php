<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property int $bonus_points
 * @property string $first_name
 * @property string $last_name
 * @property string $image
 * @property string $date_of_birth
 * @property string $phone
 * @property string $city
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_status
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'bonus_points', 'is_status'], 'integer'],
            [
                ['first_name', 'last_name', 'phone', 'city', 'date_of_birth', 'created_at', 'updated_at'],
                'string',
                'max' => 300,
            ],
            ['image', 'string'],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'bonus_points' => Yii::t('app', 'Bonus Points'),
            'date_of_birth' => Yii::t('app', 'Date of Birth'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'phone' => Yii::t('app', 'Phone'),
            'city' => Yii::t('app', 'City'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'is_status' => Yii::t('app', 'Is Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
