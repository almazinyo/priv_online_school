<?php

namespace backend\modules\grid;

use Yii;

/**
 * This module allows global level configurations for the enhanced Krajee [[GridView]]. One can configure the module
 * in their Yii configuration file as shown below:
 *
 * ```php
 * 'modules' => [
 *     'grid' => [
 *          'class' => 'kartik\grid\ModuleOld',
 *          'downloadAction' => '/gridview/export/download' // your grid export download setting
 *     ]
 * ]
 * ```
 *
 */
class Module extends \kartik\base\Module
{

    public $controllerNamespace = 'backend\modules\grid\controllers';

    /**
     * The module name for Krajee gridview
     */
    const MODULE = "grid";

    /**
     * Session key variable name for storing the export encryption salt.
     */
    const SALT_SESS_KEY = "krajeeGridExportSalt";

    /**
     * @var string a random salt that will be used to generate a hash string for export configuration. If not set, this
     * will be generated using [[\yii\base\Security::generateRandomKey()]] to generate a random key. The randomly
     * generated salt will be stored in a session variable identified by [[SALT_SESS_KEY]].
     */
    public $exportEncryptSalt;

    /**
     * @var string|array the action (url) used for downloading exported file
     */
    public $downloadAction = '/gridview/export/download';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->_msgCat = 'kvgrid';
        parent::init();
        $app = Yii::$app;
        if ($app->has('session') && !isset($this->exportEncryptSalt)) {
            $session = $app->session;
            if (!$session->get(self::SALT_SESS_KEY)) {
                $session->set(self::SALT_SESS_KEY, $app->security->generateRandomKey());
            }
            $this->exportEncryptSalt = $session->get(self::SALT_SESS_KEY);
        }
        if (isset($dummyDemoTranslations)) {
            /** @noinspection PhpUnusedLocalVariableInspection */
            $dummyMessages = Yii::t('kvgrid', 'Add Book') .
                Yii::t('kvgrid', 'Book Listing') .
                Yii::t('kvgrid', 'Download Selected') .
                Yii::t('kvgrid', 'Library') .
                Yii::t('kvgrid', 'Reset Grid') .
                Yii::t('kvgrid', 'The page summary displays SUM for first 3 amount columns and AVG for the last.') .
                Yii::t('kvgrid', 'The table header sticks to the top in this demo as you scroll') .
                Yii::t('kvgrid', 'Resize table columns just like a spreadsheet by dragging the column edges.');
        }
    }
}
