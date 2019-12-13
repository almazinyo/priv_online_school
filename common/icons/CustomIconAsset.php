<?php
namespace common\icons;
class CustomIconAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@common/icons/';
    public $depends = array(
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset'
    );
    public $css=[
        'css/animation.css',
        'css/custom-codes.css',
        'css/custom-embedded.css',
        'css/custom-ie7.css',
        'css/custom-ie7-codes.css',
        'css/custom.css',
    ];
}
