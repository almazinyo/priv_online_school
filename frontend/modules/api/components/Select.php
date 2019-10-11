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
        $select =
            sprintf(
                '%s.*, %s, %s,',
                $object::tableName(),
                'DATE(FROM_UNIXTIME(created_at)) as created_at',
                'DATE(FROM_UNIXTIME(updated_at)) as updated_at'
            );

        return
            $object::find()
                ->select($select)
                ->asArray()
                ->all()
            ;
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
        $select =
            sprintf(
                '%s.*, %s, %s,',
                $object::tableName(),
                'DATE(FROM_UNIXTIME(created_at)) as created_at',
                'DATE(FROM_UNIXTIME(updated_at)) as updated_at'
            );

        return
            $object::find()
                ->select($select)
                ->where($conditions)
                ->asArray()
                ->all()
            ;
    }
}
