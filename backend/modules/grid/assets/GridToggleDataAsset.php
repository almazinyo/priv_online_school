<?php


namespace backend\modules\grid\assets;

use backend\modules\grid\AppAsset;

/**
 * Asset bundle used for toggling data (from page mode to all records) for the [[GridView]] widget.
 *
 */
class GridToggleDataAsset extends AppAsset
{
    public $js =[
        'js/grid-toggle.js'
    ];
}
