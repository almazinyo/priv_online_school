<?php

namespace frontend\controllers;

use common\models\User;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;

/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     * @SWG\Get(path="/user",
     *     tags={"User"},
     *     summary="Retrieves the collection of User resources.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/User")
     *     ),
     * )
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $dataProvider;
    }
}
