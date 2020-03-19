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
    public $name;

    public $description;

    public $img_name;

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
        $rules = [
            [['key'], 'required'],
            [['value', 'name', 'description', 'img_name'], 'string'],
            [['key'], 'string', 'max' => 500],
        ];


        if (Yii::$app->controller->action->id == 'logo') {
            array_push($rules, [['img_name'], 'file', 'skipOnEmpty' => false, 'extensions' => 'svg']);
        }

        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Content'),
            'name' => Yii::t('app', 'Name'),
            'img_name' => Yii::t('app', 'Image'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
