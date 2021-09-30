<?php

namespace app\controllers;

use app\models\AuthAssignment;
use app\models\Order;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public $layout = 'order';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'delete', 'make-admin', 'make-client'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'delete', 'make-admin', 'make-client'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        Order::getWalletBalance();
        Order::getOrdersCount();
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMakeAdmin($id)
    {
        $model = AuthAssignment::find()->where(['item_name' => 'client'])->andWhere(['user_id' => $id])->one();
        if (!$model) {
            Yii::$app->session->setFlash('danger', 'The user is not assignment a role client');
            return $this->redirect(['user/index']);
        }

        $model->user_id = $id;
        $model->item_name = 'admin';
        if (!$model->save()) {
            Yii::$app->session->setFlash('danger', 'There was an error updating the role of the user=' . $id . ' to admin');
            return $this->redirect(['user/index']);
        }

        Yii::$app->session->setFlash('success', 'The role was updated successfully.');
        return $this->redirect(['user/index']);
    }

    public function actionMakeClient($id)
    {
        $model = AuthAssignment::find()->where(['item_name' => 'admin'])->andWhere(['user_id' => $id])->one();
        if (!$model) {
            Yii::$app->session->setFlash('danger', 'The user is not assignment a role admin');
            return $this->redirect(['user/index', 'id' => $id]);
        }

        $model->user_id = $id;
        $model->item_name = 'client';
        if (!$model->save()) {
            Yii::$app->session->setFlash('danger', 'There was an error updating the role of the user=' . $id . ' to client');
            return $this->redirect(['user/index', 'id' => $id]);
        }

        Yii::$app->session->setFlash('success', 'The role was updated successfully');
        return $this->redirect(['user/index']);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionView($id)
    {
        Order::getWalletBalance();
        Order::getOrdersCount();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public
    function actionCreate()
    {
        Order::getWalletBalance();
        Order::getOrdersCount();
        $model = new User();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
    {
        Order::getWalletBalance();
        Order::getOrdersCount();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
