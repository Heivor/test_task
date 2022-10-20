<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\slider\Slider;
use yii\web\JsExpression;

/** @var View $this */
/** @var \frontend\models\OrderForm $model */

$languageArray = ['ru-RU' => 'RU','en-US' => 'EN'];

$this->title = 'My Yii Application';
$this->registerJsVar('LNG_AJAX', Url::to(['/site/language-change']), View::POS_HEAD);
$createEventJs = <<<'JS'

        var slideEvent = function (data) {
              $.ajax({
                    url: '/api/price',
                    type: 'get',
                    data: {num: data.value}
                }).done(function (response) {
                    if (response.success) {
                       $('#price_text').html(response.data.price);
                    }
                });
        }    

JS;
$this->registerJs($createEventJs, View::POS_HEAD);


?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4"><?=Yii::t('app', 'select-lang')?></h1>
            <?= Html::dropDownList('lng_select',Yii::$app->language,$languageArray,['id' => 'lng_select']) ?>
            <br/>
            <br/>
                <div class="d-none alert alert-success">
                    <?=Yii::t('app', 'order-success')?>
                </div>
            <br/>
            <br/>

            <div class="row">
                <div class="offset-lg-3 col-lg-6">

                    <?php $form = ActiveForm::begin(['id' => 'order-form','action' => '/api/order']); ?>

                    <?= $form->field($model, 'range')->label(false)->widget(Slider::classname(), [
                        'sliderColor' => Slider::TYPE_GREY,
                        'pluginOptions'=>[
                            'handle' => 'round',
                            'min'=>1,
                            'max'=>100,
                            'step'=>1,
                            'tooltip'=>'always',
                        ],
                        'pluginEvents' => [
                            'slideStop' => new JsExpression('slideEvent'),
                        ],
                    ]); ?>

                    <div class="form-group">
                        <div class="d-inline-block"><?=Yii::t('app', 'price')?>:</div>
                        <div id="price_text" class="d-inline-block">100</div>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'order'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'title1')?></h2>

                <p><?=Yii::t('app', 'text1')?></p>

            </div>
            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'title2')?></h2>

                <p><?=Yii::t('app', 'text2')?></p>


            </div>
            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'title3')?></h2>

                <p><?=Yii::t('app', 'text3')?></p>


            </div>
        </div>

    </div>
</div>
