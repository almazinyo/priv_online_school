<?php


namespace backend\modules\grid\assets;

use backend\modules\grid\AppAsset;


class GridViewAsset extends AppAsset
{
    public $css = [
        "css/grid.css"
    ];
    public $js = [
        'js/grid_sort.js',
        'js/field_settings.js'
    ];
}
