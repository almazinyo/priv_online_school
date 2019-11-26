<?php

namespace frontend\modules\api\controllers\service;

use common\models\Auth;
use common\models\Session;
use common\models\User;
use phpDocumentor\Reflection\Types\String_;
use yii\base\Component;
use  yii;

class MainService extends Component
{
    public function receiveCurrentUser(User $user)
    {
        $session = Session::findOne(['user_id' => $user->id]);

        return
            [
                'status' => 200,
                'data' => [
                    'username' => $user->username,
                    'token' => $session->token,
                ],
            ];
    }

    /**
     * @param $mid
     * @return array|\yii\db\ActiveRecord|null
     */
    public function findAuth($mid)
    {
        return
            Auth::find()
                ->where(['source_id' => $mid])
                ->one()
            ;
    }

    public function createAccount(string $mid)
    {
        $user =
            new User(
                [
                    'username' => $mid,
                    'email' => ' ',
                    'status' => 10,
                    'auth_key' => Yii::$app->security->generateRandomString(),
                    'password_hash' => Yii::$app->security->generatePasswordHash(Yii::$app->security->generateRandomString()),
                    'created_at' => $time = time(),
                    'updated_at' => $time,
                ]
            );

        if ($user->save(false)) {
            $auth =
                new Auth(
                    [
                        'user_id' => $user->id,
                        'source' => 'vkontakte',
                        'source_id' => $mid,
                    ]
                );
        }

        if ($auth->save(false)) {
            $session =
                new Session(
                    [
                        'id' => Yii::$app->security->generateRandomString(40),
                        'expire' => time(),
                        'user_id' => $user->id,
                        'status' => 1,
                        'token' => Yii::$app->security->generateRandomString(),
                    ]
                );
            $session->save(false);
        }

        return $user;
    }
}
