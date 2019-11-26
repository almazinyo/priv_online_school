<?php

namespace frontend\modules\api\controllers;

use Cassandra\Exception\UnauthorizedException;
use common\models\Auth;
use common\models\Menu;
use common\models\Options;
use common\models\Session;
use frontend\models\User;
use frontend\modules\api\components\Select;
use frontend\modules\api\controllers\service\MainService;
use yii\base\Controller;
use yii\helpers\Html;
use yii\web\ForbiddenHttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;
use  Yii;

class MainController extends Controller
{
    /**
     * @var MainService
     */
    private $mainService;

    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        return \yii\helpers\ArrayHelper::merge([
            [
                'class' => \yii\filters\Cors::className(),
                'cors' =>
                    [
                        'Origin' => ['*'],
                        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                        'Access-Control-Request-Headers' => [
                            'Origin',
                            'X-Requested-With',
                            'Content-Type',
                            'accept',
                            /*'Authorization'*/
                        ],
                        'Access-Control-Expose-Headers' =>
                            [
                                'X-Pagination-Per-Page',
                                'X-Pagination-Total-Count',
                                'X-Pagination-Current-Page',
                                'X-Pagination-Page-Count',
                            ],
                    ],
            ],
        ],
            parent::behaviors()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->mainService = new MainService();
        \Yii::$app->response->format = Response::FORMAT_JSON;
        parent::init();
    }

    public function actions()
    {
        \Yii::$app->user->loginUrl = '/site/test/';
        return parent::actions(); // TODO: Change the autogenerated stub
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return [];
    }

    public function actionUser()
    {

        $session =
            Session::find()
                ->where(['user_id' => \Yii::$app->user->id])
                ->andWhere(['!=', 'user_id', ''])
                ->orderBy(['expire' => SORT_DESC])->asArray()->one()
        ;

        if (empty($session)) {
            throw new UnauthorizedHttpException();
        }

        return [
            'status' => 200,
            'user' => [
                'username' => \Yii::$app->user->identity['username'],
                'email' => \Yii::$app->user->identity['email'],
                'access_token' => \Yii::$app->user->identity['auth_key'],
                'session' => $session,
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionMenu()
    {
        $model = Select::receiveAllData(new Menu());
        return
            [
                'status' => 200,
                'data' => $model,
            ];
    }

    /**
     * @return array
     */
    public function actionInit()
    {
        $mainService = $this->mainService;
        $getRequest = \Yii::$app->request->get();

        if (empty($getRequest)) {
            throw new UnauthorizedHttpException();
        }

        $auth = $mainService->findAuth(Html::encode($getRequest['mid']));

        if ($auth) {
            return $mainService->receiveCurrentUser($auth->user);
        }

        throw new UnauthorizedHttpException();
    }

    /**
     * @return string
     */
    public function actionOptions()
    {
        $model = Options::find()->asArray()->all();

        $optionsData = [];

        foreach ($model as $option) {
            $optionsData[$option['key']][] = \Opis\Closure\unserialize($option['value']);
        }

        return
            [
                'status' => 200,
                'data' => $optionsData,
            ];
    }
}
