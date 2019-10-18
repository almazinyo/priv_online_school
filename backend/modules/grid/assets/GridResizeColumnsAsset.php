<?php


namespace backend\modules\grid\assets;

use backend\modules\grid\AppAsset;

/**
 * Asset bundle for resizable columns functionality for the [[GridView]] widget.
 *
 */
class GridResizeColumnsAsset extends AppAsset
{
    public $js = [
        "js/jquery.resizableColumns.js"
    ];
    public $css = [
        "css/jquery.resizableColumns.css"
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->depends = array_merge($this->depends, ['backend\modules\grid\assets\GridViewAsset']);

        parent::init();
    }
}
