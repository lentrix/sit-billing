<?php

namespace app\controllers;

use yii\filters\AccessControl;

class ReportController extends \yii\web\Controller
{

    public function behaviors() {
        return [
            'access' => [
                'class'=>AccessControl::className(),
                'only'=>['cash-flow','income-statement', 'index'],
                'rules' => [
                    [
                        'actions' => ['cash-flow', 'income-statement','index'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
        ];
    }

    public function actionCashFlow()
    {
        return $this->render('cash-flow');
    }

    public function actionIncomeStatement()
    {
        return $this->render('income-statement');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
