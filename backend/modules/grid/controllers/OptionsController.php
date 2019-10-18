<?php

namespace backend\modules\grid\controllers;


use backend\modules\grid\models\GridSort;
use yii\web\Controller;
use Yii;

class OptionsController extends Controller
{

    /**
     * @return bool
     */
    public function actionSettings()
    {
        if (Yii::$app->request->isAjax) {
            $postRequest = Yii::$app->request->post();

            if (!empty($postRequest)) {

                $model = GridSort::findOne([
                    'user_id' => Yii::$app->user->id,
                    'class_name' => $postRequest['class_name']
                ]);


                $model->page_size = $postRequest['page_size'];

                if (!empty($postRequest['visible_columns'])) {
                    $model->visible_columns = json_encode($postRequest['visible_columns']);
                } else {
                    $model->visible_columns = null;
                }
                if (!empty($postRequest['default_columns'])) {
                    $model->default_columns = json_encode($postRequest['default_columns']);
                } else {
                    $model->default_columns = null;
                }
                $model->class_name = $postRequest['class_name'];
                $model->theme = $postRequest['theme'];

                return $model->save();
            }

        }
        return false;
    }

    /**
     * @return bool
     */
    public function actionReset()
    {
        if (Yii::$app->request->isAjax) {
            $postRequest = Yii::$app->request->post();

            if (!empty($postRequest)) {
                $user_id = Yii::$app->user->id;

                $model = GridSort::findOne([
                    'user_id' => $user_id,
                    'class_name' => $postRequest['class_name']
                ]);


                $model->page_size = null;
                $model->visible_columns = null;
                $model->theme = null;

                return $model->save();
            }

        }
        return false;
    }


    public function actionFieldSettings()
    {
        if (Yii::$app->request->isAjax) {
            $postRequest = Yii::$app->request->post();


            if (!empty($postRequest)) {
                $user_id = Yii::$app->user->id;


                $model = GridSort::findOne([
                    'user_id' => $user_id,
                    'class_name' => $postRequest['class_name']
                ]);

                if (!empty($postRequest['column_name'])) {
                    /**
                     * get visible attributes
                     */
                    if (!empty($model->visible_columns)) {
                        $visibleAttributes = json_decode($model->visible_columns, true);
                    } else {
                        $visibleAttributes = $postRequest['visible_columns'];
                    }


                    $key = array_search($postRequest['column_name'], $visibleAttributes);

                    if ($key === false) {
                        $key = array_search($postRequest['column_name'], array_column($visibleAttributes, 'attribute'));
                    }


                    if ($key !== false) {
                        if (!is_array($visibleAttributes[$key])) {
                            $visibleAttributes[$key] = [
                                'attribute' => $postRequest['column_name'],
                            ];
                        }


                        if (!empty($postRequest['format'])) {
                            $visibleAttributes[$key] = array_merge($visibleAttributes[$key], ['format' => $postRequest['format']]);
                        } else {
                            if (isset($visibleAttributes[$key]['format'])) {
                                unset($visibleAttributes[$key]['format']);
                            }
                        }
                        if (!empty($postRequest['width_column'])) {
                            $visibleAttributes[$key] = array_merge($visibleAttributes[$key], ['width' => $postRequest['width_column'] . "px"]);
                        } else {
                            if (isset($visibleAttributes[$key]['width'])) {
                                unset($visibleAttributes[$key]['width']);
                            }
                        }
                        if (!empty($postRequest['label'])) {
                            $visibleAttributes[$key] = array_merge($visibleAttributes[$key], ['label' => $postRequest['label']]);
                        } else {
                            if (isset($visibleAttributes[$key]['label'])) {
                                unset($visibleAttributes[$key]['label']);
                            }
                        }


                        if (!empty($postRequest['search'])) {
                            $visibleAttributes[$key] = array_merge($visibleAttributes[$key], ['filterType' => $postRequest['search']]);
                        } else {
                            if (isset($visibleAttributes[$key]['filterType'])) {
                                unset($visibleAttributes[$key]['filterType']);
                            }
                        }


                        $model->visible_columns = json_encode($visibleAttributes);

                        return $model->save();
                    }
                }
            }
        }

        return false;
    }


    public function actionFieldSettingsUsedData()
    {
        if (Yii::$app->request->isAjax) {
            $postRequest = Yii::$app->request->post();

            if (!empty($postRequest)) {

                $model = GridSort::findOne([
                    'user_id' => Yii::$app->user->id,
                    'class_name' => $postRequest['class_name']
                ]);


                if (!empty($postRequest['column_name'])) {
                    /**
                     * get visible attributes
                     */
                    if (!empty($model->visible_columns)) {
                        $visibleAttributes = json_decode($model->visible_columns, true);
                    } else {
                        $visibleAttributes = $postRequest['visible_columns'];
                    }


                    $key = array_search($postRequest['column_name'], $visibleAttributes);

                    if ($key === false) {
                        $key = array_search($postRequest['column_name'], array_column($visibleAttributes, 'attribute'));
                    }


                    if ($key !== false) {
                        $usedData = [];
                        if (is_array($visibleAttributes[$key])) {

                            if (!empty($visibleAttributes[$key]['format'])) {
                                $usedData['format'] = $visibleAttributes[$key]['format'];
                            }
                            if (!empty($visibleAttributes[$key]['width'])) {
                                $usedData['width_column'] = (int)$visibleAttributes[$key]['width'];
                            }
                            if (!empty($visibleAttributes[$key]['label'])) {
                                $usedData['label'] = $visibleAttributes[$key]['label'];
                            }
                            if (!empty($visibleAttributes[$key]['filterType'])) {
                                $usedData['search'] = $visibleAttributes[$key]['filterType'];
                            }
                        }

                        return json_encode($usedData);
                    }
                }
            }
        }

        return false;
    }
}