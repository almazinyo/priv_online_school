<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property string $key
 * @property string $value
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }
}
