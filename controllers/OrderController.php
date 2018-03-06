<?php

namespace app\controllers;

use app\components\Notification;
use app\models\Uploaded;
use app\models\Withdraw;
use Yii;
use app\models\Message;
use app\models\MessageSearch;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use app\models\File;
use app\models\Pages;
use app\models\Uniqueid;
use app\models\Order;
use app\models\OrderSearch;
use yii\data\Pagination;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
                'only' => ['create', 'view', 'index', 'cancel', 'update','attached', 'file-delete', 'file-upload',
                    'send-message', 'messages','image-upload','file-view','image-delete','uploaded-files',
                    'pending','available', 'active', 'confirmed', 'unconfirmed', 'editing', 'completed', 'revision',
                    'rejected', 'disputed', 'approved', 'order-upload', 'upload-delete','revision-view'],
                'rules' => [
                    [
                        'actions' => ['create', 'index', 'cancel', 'update','attached', 'file-delete', 'uploaded-files',
                            'file-upload', 'send-message', 'messages','image-upload','file-view','image-delete','cancel',
                            'view','pending','available', 'active', 'confirmed', 'unconfirmed', 'editing', 'completed',
                            'revision', 'rejected', 'disputed', 'approved', 'order-upload', 'upload-delete','revision-view'],
                        'allow' => true,
                        'roles' => ['@'],
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;

        $perm = Yii::$app->authManager->getPermissionsByUser(Yii::$app->user->id);
        $rol = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        $usd = Yii::$app->authManager->getUserIdsByRole('admin');

        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perm'=>$perm,
            'rol'=>$rol,
            'usd'=>$usd
        ]);
    }
    public function actionPending()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['paid'=>0]);
        $dataProvider->query->andFilterWhere(['cancelled'=>0]);
        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAvailable()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['available'=>1]);
        $dataProvider->query->andFilterWhere(['cancelled'=>0]);
        return $this->render('available', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionActive()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])
            ->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['active'=>1]);
        $dataProvider->query->andFilterWhere(['cancelled'=>0]);
        return $this->render('active', [
            'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCancelled()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])
            ->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['cancelled'=>1]);
        return $this->render('cancelled', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionConfirmed()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['confirmed'=>1]);
        return $this->render('confirmed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionUnconfirmed()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['confirmed'=>0]);
        return $this->render('unconfirmed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionEditing()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['editing'=>1]);
        return $this->render('editing', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCompleted()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['completed'=>1]);
        return $this->render('completed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionRevision()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['revision'=>1]);
        return $this->render('revision', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionRejected()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['rejected'=>1]);
        return $this->render('rejected', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDisputed()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['disputed'=>1]);
        return $this->render('disputed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionApproved()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['approved'=>1]);
        return $this->render('approved', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSendMessage()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('send-message', [
                'model' => $model,
            ]);
        }
    }
    public function actionMessages($oid)
    {
         $message = new Message();
        $order_messages = Message::find()->where(['order_number'=>$oid])->orderBy('id ASC')->all();
//        $countQuery = clone $order_messages;
//        $pages = new \loveorigami\pagination\ReversePagination(
//            [
//                'totalCount' => $countQuery->count(),
//                'pageSize' => 5,// or in config Yii::$app->params['pageSize']
//            ]
//        );
//        $pages->pageSizeParam = false;
//
//        $models = $order_messages->offset($pages->offset)
//            ->limit($pages->limit)
//            ->all();
        $client = Order::find()->where(['ordernumber'=>$oid])->one();
        if ($message->load(Yii::$app->request->post())) {
            $message->order_number = $oid;
            $message->sender_id = Yii::$app->user->id;
            if ($message->receiver_id == 3){
                $message->receiver_id = $client->created_by;
            }
            $message->status = 0;
            $message->save();
            // $message was just created by the logged in user, and sent to $recipient_id
            Notification::warning(Notification::KEY_NEW_MESSAGE, $client->created_by, $message->id);
            $notify = \app\models\Notification::find()->where(['key_id'=> $message->id])->one();
            $notify->order_number = $oid;
            $notify->save();
            return $this->redirect(['messages','oid'=>$oid]);
        }else{
            $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
            $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
            $totaldeposit = $command1->queryScalar();
            $totalwithdrawal = $command2->queryScalar();
            $balance = $totaldeposit-$totalwithdrawal;
            Yii::$app->view->params['balance'] = $balance;
            $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
            Yii::$app->view->params['withdraw_count'] = $withdraw_count;
            $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
            Yii::$app->view->params['cancel_count'] = $cancel_count;
            $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
            Yii::$app->view->params['available_count'] = $available_count;
            $bids_count = Order::find()->where(['available'=> 1])->count();
            Yii::$app->view->params['bids_count'] = $bids_count;
            $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
            Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
            $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
            Yii::$app->view->params['confirmed_count'] = $confirmed_count;

            $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
            Yii::$app->view->params['pending_count'] = $pending_count;
            $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
            Yii::$app->view->params['active_count'] = $active_count;
            $revision_count = Order::find()->where(['revision'=> 1])->count();
            Yii::$app->view->params['revision_count'] = $revision_count;
            $editing_count = Order::find()->where(['editing'=> 1])->count();
            Yii::$app->view->params['editing_count'] = $editing_count;
            $completed_count = Order::find()->where(['completed'=> 1])->count();
            Yii::$app->view->params['completed_count'] = $completed_count;
            $approved_count = Order::find()->where(['approved'=> 1])->count();
            Yii::$app->view->params['approved_count'] = $approved_count;
            $rejected_count = Order::find()->where(['rejected'=> 1])->count();
            Yii::$app->view->params['rejected_count'] = $rejected_count;
            $disputed_count = Order::find()->where(['disputed'=> 1])->count();
            Yii::$app->view->params['disputed_count'] = $disputed_count;
            $model = $this->findModelByNumber($oid);
            $messages = Message::find()->where(['order_number'=> $oid])->one();
            $searchModel = new MessageSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andFilterWhere(['sender_id'=>Yii::$app->user->id])->orFilterWhere(['receiver_id'=>Yii::$app->user->id]);
            $mymessages = Message::find()->where(['order_number'=>$oid])->andWhere(['or', ['receiver_id'=>Yii::$app->user->id]
            ])->orWhere(['and', ['receiver_id'=>null]])->all();
            foreach ($mymessages as $mymessage) {
                if ($mymessage->status == 0){
                    $mymessage->status = 1;
                    $mymessage->save();
                }
            }
            $notifications = \app\models\Notification::find()->where(['order_number'=>$oid])->andWhere(['seen'=>0,])->andFilterWhere(['user_id'=>Yii::$app->user->id])->all();
            foreach ($notifications as $notification) {
                $notification->seen = 1;
                $notification->save();
            }
            return $this->render('messages', [
                'searchModel' => $searchModel,
                'order_messages'=>$order_messages,
                'dataProvider' => $dataProvider,
                'model'=>$model,
                'messages'=>$messages,
                'message'=>$message,
//                'pagination'=>$pages
            ]);
        }
    }
    public function actionView($oid)
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        return $this->render('view', [
            'model' => $this->findModelByNumber($oid),
        ]);
    }
    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAttached($oid)
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $model = Order::find()->where(['ordernumber'=>$oid])->one();
        $this->layout = 'order';
        $file = new File();
        $models = File::find()->where(['order_id'=>$model->id])->orderBy('id DESC')->all();
        return $this->render('attached', [
            'file' => $file,
            'model'=>$model,
            'models'=>$models,
            'id'=>$model->id
        ]);

    }
    public function actionUploadedFiles($oid)
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $bids_count = Order::find()->where(['available'=> 1])->count();
        Yii::$app->view->params['bids_count'] = $bids_count;
        $unconfirmed_count = Order::find()->where(['confirmed'=> 0])->count();
        Yii::$app->view->params['unconfirmed_count'] = $unconfirmed_count;
        $confirmed_count = Order::find()->where(['confirmed'=> 1])->count();
        Yii::$app->view->params['confirmed_count'] = $confirmed_count;

        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $model = Order::find()->where(['ordernumber'=>$oid])->one();
        if ($model->paid == 1) {
            $this->layout = 'order';
            $upload = new Uploaded();
            $models = Uploaded::find()->where(['order_number'=>$model->id])->orderBy('id DESC')->all();
            return $this->render('uploaded-files', [
                'upload' => $upload,
                'model'=>$model,
                'models'=>$models,
                'id'=>$model->id
            ]);
        }else{
            return $this->redirect(['order/view','oid'=>$oid]);
        }

    }
    public function actionOrderUpload($id)
    {
        $user = Yii::$app->user->id;
        $order = Order::find()->where(['id'=>$id])->one();
        $model = new Uploaded();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->file_type == 1) {
                $order->completed = 1;
                $order->revision = 0;
                $order->available = 0;
                $order->active = 0;
                $order->save();
            }
            $model->name = UploadedFile::getInstances($model, 'name');
            $directory = Yii::getAlias('@app/web/images/uploads') . DIRECTORY_SEPARATOR;
            if (!is_dir($directory)) {
                FileHelper::createDirectory($directory);
            }
            foreach ($model->name as $key => $file) {
                $file->saveAs($directory . $file->baseName . '-' . date('His') . '.' . $file->extension);//Upload files to server
                $sfile = new Uploaded();
                if($model->file_type == 1){
                    $sfile->file_type =1;
                }else{
                    $sfile->file_type = 0;
                }
                $sfile->writer_id = $user;
                $sfile->order_number = $id;
                $sfile->file_date = date('His');
                $sfile->file_extension = $file->extension;
                $sfile->name = $file->baseName;//Save file names in database- '**' is for separating images
                $sfile->save();
            }
        }
        Notification::success(Notification::KEY_ORDER_COMPLETED, $order->created_by, $order->id);
        $supernote = \app\models\Notification::find()->where(['key'=>'order_completed'])->andWhere(['key_id'=>$order->id])->one();
        if (empty($supernote)){
            $notify = \app\models\Notification::find()->where(['key_id'=> $order->id])->andWhere(['seen'=>0])->one();
            $notify->order_number = $order->ordernumber;
            $notify->save();
        }
        return $this->redirect(['order/uploaded-files', 'oid' => $order->ordernumber]);
    }
    public function actionUploadDelete($order, $file, $file_date, $file_extension)
    {
        $user = Yii::$app->user->id;
        $myorder = Order::find()->where(['id'=>$order])->one();
        $myfile = Uploaded::find()->Where(['order_number'=>$order])->andFilterWhere(['name'=>$file])
            ->andFilterWhere(['file_date'=>$file_date])->andFilterWhere(['file_extension'=>$file_extension])->one();
        $myfile->delete();
        $order_file = $file.'-'.$file_date.'.'.$file_extension;
        $directory = Yii::getAlias('@app/web/images/uploads') . DIRECTORY_SEPARATOR;
        if (is_file($directory . DIRECTORY_SEPARATOR . $order_file)) {
            unlink($directory . DIRECTORY_SEPARATOR . $order_file);
        }
        return $this->redirect(['uploaded-files', 'oid'=>$myorder->ordernumber]);
    }
    public function actionSubcat()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'])){
            $parents = $_POST['depdrop_parents'];
            if(!empty($parents)){
                $spacing_id = $parents[0];
                $out = Pages::getSpacingList($spacing_id);

                return json_encode(['output'=> $out, 'selected'=>'']);
            }
        }
        return json_encode(['output'=>'', 'selected'=>'']);
    }
    public function actionFileUpload($id)
    {
        $user = Yii::$app->user->id;
        $model = new File();
        $order = Order::find()->where(['id'=>$id])->one();

        $model->attached = UploadedFile::getInstances($model, 'attached');
        $directory = Yii::getAlias('@app/web/images/order') . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }
        foreach ($model->attached as $key => $file) {
            $file->saveAs($directory.$file->baseName . '.' . $file->extension);//Upload files to server
            $sfile = new File();
            $sfile->user_id = $user;
            $sfile->order_id = $id;
            $sfile->attached = $file->baseName . '.' . $file->extension;//Save file names in database- '**' is for separating images
            $sfile->save();
        }
        return $this->redirect(['order/attached', 'oid' => $order->ordernumber]);
    }
    // action examples
    public function actionImageUpload($id)
    {
        $model = new File();
        $user = Yii::$app->user->id;
        $order = Order::findOne($id);
        $imageFile = UploadedFile::getInstance($model, 'attached');
        $directory = Yii::getAlias('@app/web/images/order') . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }
        if ($imageFile) {
            $uid = $imageFile->baseName.'-'.$user.'-'.$order->id;
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;
            //
            $file = new File();
            $file->user_id = Yii::$app->user->id;
            $file->order_id = $order->id;
            $file->attached = $fileName;
            $file->save();
            //
            if ($imageFile->saveAs($filePath)) {
                $path = Yii::$app->request->baseUrl.'/images/order/'.$imageFile->baseName.'-'.$user.'-'.$order->id. '.' . $imageFile->extension;
                return Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $imageFile->size,
                            'url' => $path,
                            'deleteUrl' => 'image-delete?name=' . $fileName,
                            'deleteType' => 'POST'
                        ],
                    ],
                ]);
            }
        }
        return null;
    }
    public function actionFileView($id)
    { $models = File::find()->where(['order_id'=>$id])->all();
        return $this->render('file-view',[
            'models'=>$models
        ]);
    }
    public function actionImageDelete($name)
    {
        $directory = Yii::getAlias('@app/web/images/order') . DIRECTORY_SEPARATOR;
        $sfiles = File::find()->where(['attached'=>$name])->one();
        $sfiles->delete();
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }
        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = Yii::$app->request->baseUrl.'/images/order/'. $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }
    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCancel($oid)
    {
        $payment = new \PayPal\Api\Payment();
        $payment->create($this->apiContext());
        if($this->findModelByNumber($oid)->cancelled == 0){
            $this->findModelByNumber($oid)->cancelled = 1;
            return $this->redirect(['index']);
        }else{
            $this->findModelByNumber($oid)->cancelled = 0;
        }
        return $this->redirect(['index']);
    }
    public function actionRevisionView($oid)
    {
        $cancel_count = Order::find()->where(['cancelled'=> 1])->count();
        Yii::$app->view->params['cancel_count'] = $cancel_count;
        $withdraw_count = Withdraw::find()->Where(['status'=>0])->count();
        Yii::$app->view->params['withdraw_count'] = $withdraw_count;
        $available_count = Order::find()->where(['available'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['available_count'] = $available_count;
        $pending_count = Order::find()->where(['paid'=> 0])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['pending_count'] = $pending_count;
        $active_count = Order::find()->where(['active'=> 1])->andWhere(['cancelled'=>0])->count();
        Yii::$app->view->params['active_count'] = $active_count;
        $revision_count = Order::find()->where(['revision'=> 1])->count();
        Yii::$app->view->params['revision_count'] = $revision_count;
        $editing_count = Order::find()->where(['editing'=> 1])->count();
        Yii::$app->view->params['editing_count'] = $editing_count;
        $completed_count = Order::find()->where(['completed'=> 1])->count();
        Yii::$app->view->params['completed_count'] = $completed_count;
        $approved_count = Order::find()->where(['approved'=> 1])->count();
        Yii::$app->view->params['approved_count'] = $approved_count;
        $rejected_count = Order::find()->where(['rejected'=> 1])->count();
        Yii::$app->view->params['rejected_count'] = $rejected_count;
        $disputed_count = Order::find()->where(['disputed'=> 1])->count();
        Yii::$app->view->params['disputed_count'] = $disputed_count;
        $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $model = $this->findModelByNumber($oid);
        return $this->render('revision-view',[
            'model'=>$model
        ]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelByNumber($oid)
    {
        if (($model = Order::findOne(['ordernumber' => $oid])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }
    public function  apiContext()
    {
        // After Step 1
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                'AZet_dAnrF5HdED8ffxi6rBrHya9IerPQzFpZnfY4hqHIa0zl8ekKq9LyMTNLTZJTFZXt1xLD17M3Dph',     // ClientID
                'ENWVtcPHt28veqXfiWxyCGdiyuP_l3ExsL2M9Cj2606RDhhCjazHBfdKkznx7a_YMa7Zqpavxc1ob84Y'      // ClientSecret
            )
        );
        return  $apiContext;
    }
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
