<?php

namespace frontend\modules\api\controllers\service;

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

    public function checkTest(array $answers)
    {
        $correctly = 0;
        $wrong = 0;
        $questions = $this->receiveQuestions($answers);
        $answers = ArrayHelper::map($answers, 'id', 'answer');

        foreach ($questions as $question) {
            $answer = $answers[$question['id']];

            if ($answer == $question['correct_answer']) {
                $correctly++;
                continue;
            }

            $wrong++;
        }

        return
            [
                'correct_answers' => $correctly,
                'wrong_answers' => $wrong,
            ];
    }
}
