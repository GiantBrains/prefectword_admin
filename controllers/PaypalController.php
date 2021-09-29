<?php

namespace app\controllers;

use app\models\Order;
use app\models\Withdraw;
use Yii;
use app\models\Paypal;
use app\models\PaypalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaypalController implements the CRUD actions for Paypal model.
 */
class PaypalController extends Controller
{
    public $layout = 'order';
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
     * Lists all Paypal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $withdraw_count = Withdraw::find()->Where(['status' => 0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled' => 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available' => 1])->andWhere(['cancelled' => 0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available' => 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed' => 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed' => 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid' => 0])->andWhere(['cancelled' => 0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active' => 1])->andWhere(['cancelled' => 0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision' => 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing' => 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed' => 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved' => 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected' => 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed' => 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $deposit = 'not';
        Yii::$app->view->params['deposit'] = $deposit;
        $paypal = 'active';
        Yii::$app->view->params['paypal'] = $paypal;
        $searchModel = new PaypalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['complete'=>1]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'deposit' => $deposit,
            'paypal' => $paypal
        ]);
    }

    /**
     * Displays a single Paypal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Paypal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Paypal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Paypal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Paypal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Paypal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Paypal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paypal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
