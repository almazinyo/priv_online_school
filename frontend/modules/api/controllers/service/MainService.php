<?php

namespace frontend\modules\api\controllers\service;

use common\models\Auth;
use common\models\Profile;
use common\models\PromotionalCode;
use common\models\SectionSubjects;
use common\models\Session;
use common\models\User;
use frontend\modules\api\components\Helpers;
use phpDocumentor\Reflection\Types\String_;
use yii\base\Component;
use  yii;

class MainService extends Component
{
    const  ACCESS_TOKEN_VK = '9717d5729717d5729717d572e8977a0a15997179717d572cad34a6c0ee980b0d742e42c';
    const  FIELDS_VK = 'photo_max,bdate,city,country,education,contacts,universities';

    public function receiveCurrentUser(User $user)
    {
        $session =
            Session::find()
                ->where(['user_id' => $user->id])
                ->andWhere(['>', 'expire', time()])
                ->one()
        ;

        if (empty($session)) {
            $session = $this->createSession($user->id);
        }

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
        $urlApiVk =
            sprintf(
                'https://api.vk.com/method/users.get?user_id=%s&fields=%s&access_token=%s&v=5.103',
                $mid,
                self::FIELDS_VK,
                self::ACCESS_TOKEN_VK
            );
        $informationUser = json_decode(file_get_contents($urlApiVk), true);

        $user =
            new User(
                [
                    'username' => $mid,
                    'email' => ' ',
                    'status' => 10,
                    'auth_key' => Yii::$app->security->generateRandomString(),
                    'password_reset_token' => Yii::$app->security->generateRandomString(),
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
            $this->createSession($user->id);
        }

        if (!empty($informationUser['response'])) {
            $profile =
                new Profile(
                    [
                        'user_id' => $user->id,
                        'first_name' => $informationUser['response'][0]['first_name'] ?? '',
                        'last_name' => $informationUser['response'][0]['last_name'] ?? '',
                        'city' => $informationUser['response'][0]['city']['title'],
                        'date_of_birth' => str_replace('.', '-', $informationUser['response'][0]['bdate'] ?? ''),
                        'image' => (new Helpers())->downloadImage($informationUser['response'][0]['photo_max']),
                        'created_at' => time(),
                        'is_status' => true,
                        'bonus_points' => 0,
                    ]
                );
            $profile->save(false);
        }

        return $user;
    }

    /**
     * @param $userId
     * @return bool
     * @throws yii\base\Exception
     */
    private function createSession($userId)
    {
        $session =
            new Session(
                [
                    'id' => Yii::$app->security->generateRandomString(40),
                    'expire' => strtotime('+90 days'),
                    'data' => time(),
                    'user_id' => $userId,
                    'status' => 1,
                    'token' => Yii::$app->security->generateRandomString(),
                ]
            );
        return $session->save(false);
    }

    public function promoCode($source)
    {
        $userService = new UsersService();
        $userId = $userService->receiveUserId($source['token']);
        $promoCode = $source['promo'];
        $price = SectionSubjects::findOne(['slug' => $source['slug']])->price;
        $result =
            [
                'price' => $price,
                'percent' => 0,
                'is_valid' => false,
            ];

        $model =
            PromotionalCode::findOne(
                [
                    'user_id' => $userId,
                    'key' => trim($promoCode),
                    'is_status' => true,
                ]);

        if (!empty($model)) {
            $result =
                [
                    'price' => ($price * $model->percent) / 100,
                    'percent' => $price * $model->percent,
                    'is_valid' => true,
                ];
            $model->is_status = 0;
            $model->save(false);
        }

        return $result;
    }
}
