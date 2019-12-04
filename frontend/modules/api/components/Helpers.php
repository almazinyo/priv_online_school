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
}
