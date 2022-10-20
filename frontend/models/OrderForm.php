<?php

namespace frontend\models;

use Yii;
use yii\base\Model;


class OrderForm extends Model
{
    public $range;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['range'], 'required'],
            ['range', 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {

    }

}
