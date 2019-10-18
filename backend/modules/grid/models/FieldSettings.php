<?php


namespace backend\modules\grid\models;


use yii\base\Model;

class FieldSettings extends Model
{
    public $label;

    public $width_column;

    public $format;

    public $search;


    public function rules()
    {
        return [
            [['format', 'search', 'label','width_column'], 'safe'],
            [['width_column'], 'number', ],
            [['label'], 'string'],
        ];
    }
}