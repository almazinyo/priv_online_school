<?php

namespace frontend\modules\api\controllers\service;

use common\models\OrderList;
use common\models\PassingLessons;
use common\models\Profile;
use common\models\SectionSubjects;
use common\models\User;
use yii\base\Component;
use yii\helpers\Html;
use \common\models\Session;
use yii\helpers\ArrayHelper;
use yii;

class UsersService extends Component
{
    private $lessonsId = [];

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

    public function receiveOrderList(string $token)
    {
        $userId = $this->receiveUserId($token);

        return
            OrderList::find()
                ->where(['order_list.user_id' => $userId])
                ->select('order_list.*, section_subjects.name as section_name')
                ->joinWith('section')
                ->asArray()
                ->all()
            ;
    }

    public function receivePassingLessons(string $token): array
    {
        $userId = $this->receiveUserId($token);
        $passingLessons =
            PassingLessons::find()
                ->where(['user_id' => $userId, 'is_status' => 1])
                ->asArray()
                ->all()
        ;

        $sectionId = ArrayHelper::map($passingLessons, 'section_id', 'section_id');
        $this->lessonsId = ArrayHelper::map($passingLessons, 'lesson_id', 'lesson_id');

        return
            SectionSubjects::find()
                ->joinWith(
                    [
                        'lessons' => function ($query) {
                            $query->andWhere(['lessons.id'=>$this->lessonsId]);
                        },

                    ]
                )
                ->where(['section_subjects.id' => $sectionId])
                ->asArray()
                ->all()
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
