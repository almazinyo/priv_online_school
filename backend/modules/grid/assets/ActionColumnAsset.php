<?php

namespace backend\modules\models\grid\assets;

use backend\modules\grid\AppAsset;

/**
 * Asset bundle for [[ActionColumn]] functionality of the [[GridView]] widget.
 *
 */
class ActionColumnAsset extends AppAsset
{

    public $js = [
        'js/grid-action.js'
    ];
    public $css = [
        'css/grid-action.css'
    ];

}
