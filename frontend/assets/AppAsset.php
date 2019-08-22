<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';

    /**
     * @var string
     */
    public $baseUrl = '@web';

    /**
     * @var array
     */
    public $css =
        [
            'css/site.css',
            'css/main.css',
            'css/html_styles.css',
        ];

    /**
     * @var array
     */
    public $js =
        [
            'js/scripts.min.js',
            'js/html_js.min.js',
            'js/image_lazyload.min.js',
            'js/font_face_observer.min.js',
        ];

    /**
     * @var array
     */
    public $depends =
        [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
        ];
}
