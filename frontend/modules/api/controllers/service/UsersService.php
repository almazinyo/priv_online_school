<?php

namespace frontend\modules\api\controllers\service;

use common\models\OrderList;
use common\models\PassingLessons;
use common\models\Profile;
use common\models\SectionSubjects;
use common\models\Subjects;
use common\models\User;
use yii\base\Component;
use yii\helpers\Html;
use \common\models\Session;
use yii\helpers\ArrayHelper;
use yii;

class UsersService extends Component
{
    private $lessonsId = [];

    private $sectionId = [];

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
                ->where(['user_id' => $userId])
                ->joinWith('subject')
                ->joinWith('section')
                ->asArray()
                ->all()
        ;

        $model = [];

        foreach ($passingLessons as $passing) {
            $subjectId = $passing['subject']['id'];
            $subject = [
                'name' => $passing['subject']['title'],
                'background' => $passing['subject']['color'],
            ];

            if (empty($model[$subjectId])) {
                $model[$subjectId] = $subject;
            }

            $model[$subjectId]['sectionSubjects'][$passing['section']['id']][] =
                [
                    'name' => $passing['section']['name'],
                    'background' => $passing['section']['background'],
                    'bonus_points' => $passing['points'],
                ];
        }

        foreach ($model as $index => $item) {
            $model[$index]['sectionSubjects'] = [];

            foreach ($item['sectionSubjects'] as $section) {
                $sectionSubjects = [];

                foreach ($section as $value) {
                    $sectionSubjects = [
                        'name' => $value['name'],
                        'background' => $value['background'],
                        'bonus_points' => ($sectionSubjects['bonus_points'] ?? 0) + $value['bonus_points'],
                    ];
                }

                $model[$index]['sectionSubjects'][] = $sectionSubjects;
            }
        }

        return array_values($model);
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
        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($content)
            ->send()
            ;
    }
}
