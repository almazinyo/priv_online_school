<?php

namespace backend\modules\grid;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = "@app/modules/grid/web";


    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];




/*    public function init()
    {
        $this->setSourcePath(__DIR__ . "/web");
        parent::init();
    }


    private function setSourcePath($path)
    {
        return $this->sourcePath = "@app";
    }*/
}
