<?php

namespace frontend\controllers;

use frontend\models\OrderForm;
use Yii;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (!isset(Yii::$app->request->cookies['language'])) {
            $language = 'ru-RU';
            Yii::$app->language = $language;
            $languageCookie = new Cookie([
                'name' => 'language',
                'value' => $language,
                'expire' => time() + 60 * 60 * 24 * 30,
            ]);
            Yii::$app->response->cookies->add($languageCookie);
        }
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new OrderForm();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionLanguageChange()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $language = Yii::$app->request->post('lng');
            Yii::$app->language = $language;
            $languageCookie = new Cookie([
                'name' => 'language',
                'value' => $language,
                'expire' => time() + 60 * 60 * 24 * 30,
            ]);
            Yii::$app->response->cookies->add($languageCookie);
            Yii::$app->response->data = ['success' => true];
        } catch (\Exception $e) {
            Yii::$app->response->data = ['error' => $e->getMessage()];
        }
        Yii::$app->response->send();
        Yii::$app->end();
    }
}
