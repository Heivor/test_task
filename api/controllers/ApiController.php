<?php

namespace api\controllers;

use frontend\models\OrderForm;
use Yii;
use yii\filters\VerbFilter;
use yii\rest\Controller;

class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'price' => ['get'],
                    'order' => ['post'],
                ],
            ],
        ];
    }

    public function actionPrice()
    {
        $num = filter_var(Yii::$app->getRequest()->getQueryParam('num'), FILTER_SANITIZE_NUMBER_INT);
        $price = 0;
        if ($num <= 20) {
            $price = 200;
        } elseif ($num > 20 && $num <= 50) {
            $price = 300;
        } elseif ($num > 50 && $num <= 100) {
            $price = 400;
        }
        Yii::$app->response->data = ['price' =>  $price];
        Yii::$app->response->send();
        Yii::$app->end();
    }

    public function actionOrder()
    {
        $model = new OrderForm();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->data = ['range' =>  $model->range];
        }
        Yii::$app->response->send();
        Yii::$app->end();
    }
}
