<?php

namespace frontend\modules\api\components;

use phpDocumentor\Reflection\Types\String_;
use yii\base\Component;

class Helpers extends Component
{
    /**
     * @param string $param
     * @return mixed[]
     */
    public function decodePostRequest(string $param): array
    {
        return
            json_decode(
                base64_decode($param),
                true
            );
    }

    /**
     * @param string $imgUrl
     * @return string
     */
    public function downloadImage(string $imgUrl): string
    {
        if (empty($imgUrl)){
            return '';
        }

        $imgName = preg_replace('~.*\/|\?.*~sui', $imgUrl);
        $imgPath = '/var/www/html/priv_online_school/frontend/web/images/users/' . $imgName;

        $ch = curl_init($imgUrl);
        $fp = fopen($imgPath, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        return $imgPath;
    }
}
