<?php

namespace frontend\components;

use common\models\PromotionalCode;
use common\models\Session;
use Yii;
use frontend\models\Auth;
use frontend\models\User;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        if (!Yii::$app->user->isGuest) {
            return;
        }

        $attributes = $this->client->getUserAttributes();

        $auth = $this->findAuth($attributes);
        if ($auth) {
            return $this->auth($auth->user);
        }
        if ($user = $this->createAccount($attributes)) {
            return $this->auth($user);
        }
    }

    /**
     * @param $user
     * @return \yii\console\Response|\yii\web\Response
     * @throws \yii\base\Exception
     */
    private function auth($user)
    {
        Yii::$app->user->login($user);

        $session = new Session();
        $session->id = Yii::$app->security->generateRandomString(40);
        $session->expire = time();
        $session->user_id = $user->id;
        $session->status = 1;
        $session->token = Yii::$app->security->generateRandomString();

        $session->save(false);

        return Yii::$app->getResponse()->redirect(Yii::$app->getUser()->getReturnUrl('/api/main/user'));
    }

    /**
     * @param array $attributes
     * @return Auth
     */
    private function findAuth($attributes)
    {
        $id = ArrayHelper::getValue($attributes, 'id');
        $params = [
            'source_id' => $id,
            'source' => $this->client->getId(),
        ];
        return Auth::find()->where($params)->one();
    }

    /**
     *
     * @param type $attributes
     * @return User|null
     */
    private function createAccount($attributes)
    {
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');
        $name = ArrayHelper::getValue($attributes, 'name');
        $firstName = ArrayHelper::getValue($attributes, 'first_name');

        if (empty($name)) {
            $name = ArrayHelper::getValue($attributes, 'screen_name');
        }

        if ($email !== null && User::find()->where(['email' => $email])->exists()) {
            return;
        }

        $user = $this->createUser($email, $name, $firstName);

        $transaction = User::getDb()->beginTransaction();
        if ($user->save()) {
            $promoCode = new PromotionalCode([
                'key' => $this->generateCode(),
                'percent' => 10,
                'user_id' => $user->id,
                'created_at' => time(),
                'updated_at' => time(),
                'is_status' => 1,
            ]);
            $promoCode->save(false);

            $auth = $this->createAuth($user->id, $id);
            if ($auth->save()) {
                $transaction->commit();
                return $user;
            }
        }
        $transaction->rollBack();
    }

    private function createUser($email, $name, $firstName)
    {
        return new User([
            'username' => $name ?: $firstName,
            'email' => $email ?: ' ',
            'status' => 10,
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash(Yii::$app->security->generateRandomString()),
            'created_at' => $time = time(),
            'updated_at' => $time,
        ]);
    }

    private function generateCode($code_length = 5)
    {
        $min = pow(10, $code_length);
        $max = $min * 10 - 1;

        return mt_rand($min, $max);
    }

    private function createAuth($userId, $sourceId)
    {
        return new Auth([
            'user_id' => $userId,
            'source' => $this->client->getId(),
            'source_id' => (string) $sourceId,
        ]);
    }
}
