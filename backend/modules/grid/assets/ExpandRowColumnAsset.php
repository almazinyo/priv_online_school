<?php


namespace backend\modules\grid\assets;

use backend\modules\grid\AppAsset;

/**
 * Asset bundle for [[ExpandRowColumn]] functionality of the [[GridView]] widget.
 */
class ExpandRowColumnAsset extends AppAsset
{
    public $css = [
        'css/grid-expand.css'
    ];

    public $js = [
        'js/grid-expand.js'
    ];
}