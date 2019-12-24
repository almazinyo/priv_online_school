<?php

namespace frontend\modules\api\controllers\service;

use common\models\Profile;
use common\models\User;
use yii\base\Component;
use yii\helpers\Html;
use \common\models\Session;
use yii;

class UsersService extends Component
{
    public function receiveUserId(string $token): int
    {
        return Session::findOne(['token' => Html::encode($token)])->user_id;
    }

    public function receiveSessionCurrentUser(string $token): Session
    {
        return Session::findOne(['token' => Html::encode($token)]);
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

    public function updateUserInfo(array $data)
    {
        $userId = $this->receiveUserId($data['token']);
        $user = User::findOne(['id' => $userId]);
        $profile = Profile::findOne(['user_id' => $userId]);

        if (empty($profile)) {
            $profile = new Profile();
            $profile->user_id = $user->id;
        }

        $user->email = $data['data']['email'];
        $profile->first_name = $data['data']['first_name'];
        $profile->last_name = $data['data']['last_name'];
        $profile->date_of_birth = $data['data']['date_birth'];
        $profile->phone = $data['data']['phone'];
        $profile->city = $data['data']['city'];

        if ($user->save(false) && $profile->save(false)) {
            return ['status' => 200];
        }

        return false;
    }

    public function sendEmail($data)
    {
        $content =
            sprintf(
                'ЭЛЕКТРОННАЯ ПОЧТА: %s <br /> НОМЕР ТЕЛЕФОНА: %s <br />ВОПРОС: %s <br />',
                $data['email'],
                $data['phone'],
                $data['content']
            );
        return Yii::$app->mailer->compose(['text' => 'contact', 'html' => 'contact'], ['content' => $content])
            ->setTo($data['email'])
//            ->setFrom([$this->email => $this->name])
//            ->setSubject('')
//            ->setTextBody( sprintf(' email:%s \n %s ',$this->email,$this->body))
            ->send()
            ;
    }
}
