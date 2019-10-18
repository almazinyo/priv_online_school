<?php

namespace backend\modules\grid\models;

use yii\db\ActiveRecord;


/**
 * This is the model class for table "grid_sort".
 *
 * @property integer $id
 * @property string $class_name
 * @property string $visible_columns
 * @property string $page_size
 * @property integer $user_id
 * @property integer $default_columns
 * @property integer $label
 * @property integer $theme
 */
class GridSort extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grid_sort';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            ['page_size', 'integer',"min"=>10, 'max'=>200],
            [['class_name'], 'string',],
            [['default_columns', "visible_columns", "theme", "page_size","label"], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_name' => 'Class Name',
            'default_columns' => 'Default Columns',
            'sort' => 'Sort',
            'theme' => 'Theme',
            'user_id' => 'User ID',
        ];
    }
}
