<?php

namespace frontend\modules\api\components;

;

use yii\db\ActiveRecord;

final class Select
{
    /**
     * @param ActiveRecord $object
     * @return mixed[]
     */
    public static function receiveAllData(ActiveRecord $object): array
    {
        return
            $object::find()->asArray()->all();
    }

    /**
     * @param ActiveRecord $object
     * @param array $conditions
     * @return int
     */
    public static function receiveId(ActiveRecord $object, array $conditions): int
    {

        $model = $object::findOne($conditions);

        return $model ? $model->id : -1;
    }

    /**
     * @param ActiveRecord $object
     * @param array $conditions
     * @return mixed[]
     */
    public static function receiveSpecificData(ActiveRecord $object, array $conditions): array
    {
        return
            $object::find()
                ->where($conditions)
                ->asArray()
                ->all()
            ;
    }
}