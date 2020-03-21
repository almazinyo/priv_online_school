<?php

namespace frontend\modules\api\controllers\service;

use common\models\PassingLessons;
use common\models\Profile;
use common\models\Quiz;
use yii\base\Component;
use yii\helpers\ArrayHelper;

class SubjectsService extends Component
{
    private function receiveQuestions(array $answers): array
    {
        return
            Quiz::find()
                ->where(['in', 'id', ArrayHelper::map($answers, 'id', 'id')])
                ->asArray()
                ->all()
            ;
    }

    public function checkTest(array $source)
    {
        $userId = (new UsersService())->receiveUserId($source['token']);
        $section_id = $source['section_id'];
        $lesson_id = $source['lesson_id'];
        $subject_id = $source['subject_id'];

        $passingLessons = PassingLessons::findOne([
            'lesson_id' => $lesson_id,
            'user_id' => $userId,
            'section_id' => $section_id,
        ]);

        if (empty($passingLessons)) {
            $passingLessons = new PassingLessons();
        }

        $percentPassage = 0;
        $points = 0;

        $correctly = 0;
        $wrong = 0;

        $questions = $this->receiveQuestions($source['data']);
        $answers = ArrayHelper::map($source['data'], 'id', 'answer');

        foreach ($questions as $index => $question) {
            $answer = $answers[$question['id']];

            if ($this->createFloatNumber($answer) == $this->createFloatNumber($question['correct_answer'])) {
                $correctly++;

                if (!$source['data'][$index]['hint']) {
                    $points += $source['data'][$index]['points'];
                }

                continue;
            }

            $wrong++;
        }

        $percentPassage = (100 / count($answers)) * $correctly;
        $passingLessons->section_id = $section_id;
        $passingLessons->lesson_id = $lesson_id;
        $passingLessons->subject_id = $subject_id;
        $passingLessons->user_id = $userId;
        $passingLessons->created_at = time();
        $passingLessons->is_status = false;

        if ($percentPassage >= 70 && $this->checkQuiz([
                'lesson_id' => $lesson_id,
                'user_id' => $userId,
                'section_id' => $section_id,
            ])) {
            $passingLessons->is_status = true;
            $passingLessons->points = $points;
            $profile = Profile::findOne(['user_id' => $userId]);
            $profile->bonus_points = $profile->bonus_points + $points;
            $profile->save(false);
        }

        $passingLessons->save(false);

        return
            [
                'correct_answers' => $correctly,
                'wrong_answers' => $wrong,
                'percent_passage' => $percentPassage,
            ];
    }

    /**
     * @param array $where
     * @return bool
     */
    private function checkQuiz(array $where): bool
    {
        $model = PassingLessons::find()
            ->where($where)
            ->asArray()
            ->all()
        ;

        if (empty($model) || !$model['is_status']) {
            return true;
        }

        return false;
    }


    /**
     * @param string $source
     * @return float
     */
    private function createFloatNumber(string $source): float
    {
        return
            (float) preg_replace(
                ['~,~sui', '~[^\.\d]~sui'],
                ['.', ''],
                $source
            );
    }
}
