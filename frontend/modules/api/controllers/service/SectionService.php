<?php

namespace frontend\modules\api\controllers\service;

use common\models\Lessons;
use common\models\OrderList;
use yii\base\Component;

class SectionService extends Component
{
    /**
     * @param $sectionId
     * @param $lessonId
     * @param $token
     * @return array
     */
    public static function receiveLessonsForUsers($sectionId, $lessonId, $subjectId, $token)
    {
        $lessons = [];

        foreach (Lessons::receiveLessonsForSection($sectionId) as $index => $lesson) {
            $lessons[] =
                [
                    'id' => $lesson['id'],
                    'name' => $lesson['name'],
                    'slug' => $lesson['slug'],
                    'price' => $lesson['price'],
                    'is_status' => $lesson['is_status'],
                    'is_bought' => false,
                ];
        }

        $userId = (new UsersService())->receiveUserId($token);

        $orderListSection =
            OrderList::find()
                ->where(['section_id' => $sectionId, 'user_id' => $userId])
                ->asArray()
                ->all()
        ;

        $orderListLessons =
            OrderList::find()
                ->where(['lesson_id' => $lessonId, 'user_id' => $userId])
                ->asArray()
                ->all()
        ;

        $orderListSubject = OrderList::find()->where(['subjects_id' => $subjectId, 'user_id' => $userId])->one();

        if (!empty($orderListSubject)) {
            foreach ($lessons as $index => $validLesson) {
                $lessons[$index]['is_bought'] = true;
                $lessons[$index]['is_status'] = 3;
            }

            return $lessons;
        }

        if (!empty($orderListSection)) {
            foreach ($lessons as $index => $validLesson) {
                $lessons[$index]['is_bought'] = true;
                $lessons[$index]['is_status'] = 3;
            }

            return $lessons;
        }

        if (empty($orderListSection) && !empty($orderListLessons)) {
            foreach ($orderListLessons as $index => $order) {
                $lessonId = $order['lesson_id'];

                foreach ($lessons as $lessonKey => $lesson) {
                    if ($lessonId == $lesson['id']) {
                        $lessons[$lessonKey]['is_bought'] = true;
                        $lessons[$lessonKey]['is_status'] = 3;
                        break;
                    }
                }
            }
        }

        return $lessons;
    }

    /**
     * @param array $where
     * @return bool
     */
    public static function checkOrder(array $where)
    {
        $model =
            OrderList::find()
                ->where($where)
                ->asArray()
                ->all()
        ;

        if (!empty($model)) {
            return true;
        }

        return false;
    }
}
