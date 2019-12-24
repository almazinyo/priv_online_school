<?php

namespace frontend\modules\api\components;

use phpDocumentor\Reflection\Types\String_;
use yii\base\Component;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

class Helpers extends Component
{
    /**
     * @param string $param
     * @return mixed[]
     */
    public function decodePostRequest(string $param): array
    {
        if (empty($param)){
            throw new NotFoundHttpException();
        }

        return
            json_decode(
                base64_decode(Html::encode($param)),
                true
            );
    }

    /**
     * @param string $imgUrl
     * @return string
     */
    public function downloadImage(string $imgUrl): string
    {
        if (empty($imgUrl)) {
            return '';
        }

        $imgName = preg_replace('~.*\/|\?.*~sui', '', $imgUrl);
        $downloadPath = \Yii::getAlias('@webRoot') . '/images/users/' . $imgName;

        $ch = curl_init($imgUrl);
        $fp = fopen($downloadPath, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        return $imgName;
    }
}
