<?php

namespace frontend\modules\api\controllers\service;

use common\models\User;
use yii\base\Component;
use yii\helpers\Html;
use \common\models\Session;

class UsersService extends Component
{
    public function receiveUserId(string $token): int
    {
        return Session::findOne(['token' => Html::encode($token)])->user_id;
    }

    public function receiveUser(string $token): User
    {
        $userId = $this->receiveUserId($token);

        return
            User::find()
                ->where(['user.id' => $userId])
                ->joinWith('profiles')
                ->one()
            ;
    }
}
