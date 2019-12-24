<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property string $id
 * @property int|null $expire
 * @property resource|null $data
 * @property string|null $token
 * @property int|null $user_id
 * @property int|null $status
 *
 * @property User $user
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expire', 'user_id', 'status'], 'integer'],
            [['data'], 'string'],
            [['token'], 'string', 'max' => 500],
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
            'expire' => Yii::t('app', 'Expire'),
            'data' => Yii::t('app', 'Data'),
            'token' => Yii::t('app', 'Token'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
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
