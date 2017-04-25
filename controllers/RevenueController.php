<?php

namespace app\controllers;

use Yii;
use app\models\Revenue;
use app\models\RevenueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Account;
use app\models\Student;
use yii\filters\AccessControl;

/**
 * ReceiptController implements the CRUD actions for Receipt model.
 */
class RevenueController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class'=>AccessControl::className(),
                'only'=>['index','create','update','view','delete'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','view'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Receipt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RevenueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Receipt model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Receipt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Revenue();
        $model->date = date("Y-m-d");
        $model->user_id = Yii::$app->user->identity->id;

        $accountsList = ArrayHelper::map(Account::find()->all(),'id','title');
        $studentsList = ArrayHelper::map(
            Student::find()->orderBy('lname, fname, mname')->all(),'id','formalName');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'accountsList' => $accountsList,
                'studentsList' => $studentsList,
            ]);
        }
    }

    /**
     * Updates an existing Receipt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $accountsList = ArrayHelper::map(Account::find()->all(),'id','title');
        $studentsList = ArrayHelper::map(
            Student::find()->orderBy('lname, fname, mname')->all(),'id','formalName');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'accountsList' => $accountsList,
                'studentsList' => $studentsList,
            ]);
        }
    }

    /**
     * Deletes an existing Receipt model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Receipt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Receipt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Revenue::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
