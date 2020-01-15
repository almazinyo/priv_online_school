<?php

namespace frontend\modules\api\controllers\service;

use common\models\PassingLessons;
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
        $passingLessons = new PassingLessons();
        $percentPassage = 0;

        $correctly = 0;
        $wrong = 0;
        $questions = $this->receiveQuestions($source['data']);
        $answers = ArrayHelper::map($source['data'], 'id', 'answer');

        foreach ($questions as $question) {
            $answer = $answers[$question['id']];

            if ($answer == $question['correct_answer']) {
                $correctly++;
                continue;
            }

            $wrong++;
        }

        $percentPassage = (100 / count($answers)) * $correctly;
        $passingLessons->section_id =  $section_id;
        $passingLessons->lesson_id =  $lesson_id;
        $passingLessons->user_id =  $userId;
        $passingLessons->created_at = time();

        if ($percentPassage >= 70) {
            $passingLessons->is_status = true;
        }

        return
            [
                'correct_answers' => $correctly,
                'wrong_answers' => $wrong,
                'percent_passage' => $percentPassage,
            ];
    }
}
