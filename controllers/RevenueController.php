<?php

namespace app\controllers;

use Yii;
use app\models\Revenue;
use app\models\RevenueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * RevenueController implements the CRUD actions for Revenue model.
 */
class RevenueController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Revenue models.
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
     * Displays a single Revenue model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $revenueItem = new \app\models\RevenueItem();
        $revenueItem->revenue_id=$id;

        $accountsList = ArrayHelper::map(\app\models\Account::find()->orderBy('title')->all(), 'id','title');

        if($revenueItem->load(Yii::$app->request->post()) && $revenueItem->save()) {
            $revenueItem = new \app\models\RevenueItem();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'revenueItem' => $revenueItem,
            'accountsList' => $accountsList,
        ]);
    }

    /**
     * Creates a new Revenue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Revenue();
        $model->user_id = Yii::$app->user->identity->id;
        $model->date = date('Y-m-d');

        $revenueItem = new \app\models\RevenueItem();
        $accountsList = ArrayHelper::map(\app\models\Account::find()->orderBy('title')->all(), 'id', 'title');
        $studentsList = ArrayHelper::map(\app\models\Student::find()->orderBy('lname, fname')->all(), 'id', 'formalName');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $revenueItem->load(Yii::$app->request->post());
            $revenueItem->revenue_id = $model->id;
            $revenueItem->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'revenueItem' => $revenueItem,
                'accountsList' => $accountsList,
                'studentsList' => $studentsList,
            ]);
        }
    }

    /**
     * Updates an existing Revenue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Revenue model.
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
     * Finds the Revenue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Revenue the loaded model
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
