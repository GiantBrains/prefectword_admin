<?php

namespace app\controllers;

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
                'only' => ['create', 'index', 'cancel', 'update','attached', 'file-delete', 'file-upload',
                    'send-message', 'messages','image-upload','file-view','image-delete','cancel' ],
                'rules' => [
                    [
                        'actions' => ['create', 'index', 'cancel', 'update','attached', 'file-delete', 'file-upload',
                            'send-message', 'messages','image-upload','file-view','image-delete','cancel'],
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
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionPending()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['paid'=>1]);
        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAvailable()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['available'=>1]);
        return $this->render('available', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionActive()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['progress'=>1]);
        return $this->render('active', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionConfirmed()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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
        $order_messages = Message::find()->where(['order_number'=>$oid])->all();
        $client = Order::find()->where(['ordernumber'=>$oid])->one();
        if ($message->load(Yii::$app->request->post())) {
            $message->order_number = $oid;
            $message->sender_id = Yii::$app->user->id;
            if ($message->receiver_id == 3){
                $client->created_by == null? $message->receiver_id = null : $message->receiver_id = $client->created_by;
            }
            $message->status = 0;
            $message->save();
            return $this->redirect(['messages','oid'=>$oid]);
        }else{
            $pending_count = Order::find()->where(['paid'=> 0])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
            Yii::$app->view->params['pending_count'] = $pending_count;
            $active_count = Order::find()->where(['active'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
            Yii::$app->view->params['active_count'] = $active_count;
            $revision_count = Order::find()->where(['revision'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
            Yii::$app->view->params['revision_count'] = $revision_count;
            $editing_count = Order::find()->where(['editing'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
            Yii::$app->view->params['editing_count'] = $editing_count;
            $completed_count = Order::find()->where(['completed'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
            Yii::$app->view->params['completed_count'] = $completed_count;
            $approved_count = Order::find()->where(['approved'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
            Yii::$app->view->params['approved_count'] = $approved_count;
            $rejected_count = Order::find()->where(['rejected'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
            Yii::$app->view->params['rejected_count'] = $rejected_count;
            $disputed_count = Order::find()->where(['disputed'=> 1])->andFilterWhere(['created_by'=>Yii::$app->user->id])->count();
            Yii::$app->view->params['disputed_count'] = $disputed_count;
            $command1 = Yii::$app->db->createCommand('SELECT SUM(deposit) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
            $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM wallet WHERE customer_id ='.Yii::$app->user->id.'');
            $totaldeposit = $command1->queryScalar();
            $totalwithdrawal = $command2->queryScalar();
            $balance = $totaldeposit-$totalwithdrawal;
            Yii::$app->view->params['balance'] = $balance;
            $model = $this->findModelByNumber($oid);
            $messages = Message::find()->where(['order_number'=> $oid])->one();
            $searchModel = new MessageSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andFilterWhere(['sender_id'=>Yii::$app->user->id])->orFilterWhere(['receiver_id'=>Yii::$app->user->id]);
            return $this->render('messages', [
                'searchModel' => $searchModel,
                'order_messages'=>$order_messages,
                'dataProvider' => $dataProvider,
                'model'=>$model,
                'messages'=>$messages,
                'message'=>$message
            ]);
        }
    }

    public function actionView($oid)
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        return $this->render('view', [
            'model' => $this->findModelByNumber($oid),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $session = Yii::$app->session;

        $model = new Order();

        if ($model->load(Yii::$app->request->post())) {
            $orderid = Uniqueid::find()->where(['id'=>1])->one();
            $orderid->orderid = $orderid->orderid+1;
            $orderid->save();
            $model->ordernumber = $orderid->orderid;
            // for service
            if($model->service_id==1){
                $service = 12;
            }else if($model->service_id==2){
                $service=10;
            }else if($model->service_id==3){
                $service= 7.5;
            }
            //for order type
            if($model->type_id==1){
                $type = 1.1;
            }else if ($model->type_id==2){
                $type = 1.2;
            }else if ($model->type_id==3){
                $type = 1.1;
            }else if ($model->type_id==4){
                $type = 1.1;
            }else if ($model->type_id==5){
                $type = 1.1;
            }else if ($model->type_id==6){
                $type = 1.1;
            }else if ($model->type_id==7){
                $type = 1.2;
            }else if ($model->type_id==8){
                $type = 1.1;
            }else if ($model->type_id==9){
                $type = 1.1;
            }else if ($model->type_id==10){
                $type = 1.2;
            }else if ($model->type_id==11){
                $type = 1.2;
            }else if ($model->type_id==12){
                $type = 1.2;
            }else if ($model->type_id==13){
                $type = 1.2;
            }else if ($model->type_id==14){
                $type = 1.2;
            }else if ($model->type_id==15){
                $type = 1.2;
            }else if ($model->type_id==16){
                $type = 1.2;
            }else if ($model->type_id==17){
                $type = 1.2;
            }else if ($model->type_id==18){
                $type = 1.2;
            }else if ($model->type_id==20){
                $type = 1;
            }else if ($model->type_id==22){
                $type = 2.0;
            }else if ($model->type_id==23){
                $type = 2.2;
            }else if ($model->type_id==24){
                $type = 1.5;
            }else if ($model->type_id==25){
                $type = 1.1;
            }else if ($model->type_id==26){
                $type = 1.2;
            }else if ($model->type_id==27){
                $type = 0.7;
            }else if ($model->type_id==28){
                $type = 0.8;
            }else if ($model->type_id==31){
                $type = 1;
            }else if ($model->type_id==32){
                $type = 1.1;
            }else if ($model->type_id==33){
                $type = 1.2;
            }else if ($model->type_id==34){
                $type = 1;
            }else if ($model->type_id==35){
                $type = 2.2;
            }else if ($model->type_id==36){
                $type = 1.2;
            }else if ($model->type_id==37){
                $type = 1.2;
            }else if ($model->type_id==38){
                $type = 1.2;
            }else if ($model->type_id==39){
                $type = 1.5;
            }

            // for order level
            if($model->level_id==1){
                $level = 0.8;
            }else if($model->level_id==2){
                $level=1;
            }else if($model->level_id==4){
                $level= 1.1;
            }else if($model->level_id==5){
                $level= 1.2;
            }

            // for pages
            if($model->pages_id==1){
                $pages = 1;
            }else if($model->pages_id==2){
                $pages=2*0.95;
            }else if($model->pages_id==3){
                $pages= 3*0.95;
            }else if($model->pages_id==4){
                $pages=4*0.95;
            }else if($model->pages_id==5){
                $pages= 5*0.95;
            }else if($model->pages_id==6){
                $pages=6*0.925;
            }else if($model->pages_id==7){
                $pages= 7*0.925;
            }else if($model->pages_id==8){
                $pages=8*0.925;
            }else if($model->pages_id==9){
                $pages= 9*0.925;
            }else if($model->pages_id==10){
                $pages=10*0.9;
            }else if($model->pages_id==11){
                $pages= 11*0.9;
            }else if($model->pages_id==12){
                $pages=12*0.9;
            }else if($model->pages_id==13){
                $pages= 13*0.9;
            }else if($model->pages_id==14){
                $pages=14*0.9;
            }else if($model->pages_id==15){
                $pages= 15*0.9;
            }else if($model->pages_id==16){
                $pages=16*0.9;
            }else if($model->pages_id==17){
                $pages= 17*0.9;
            }else if($model->pages_id==18){
                $pages=18*0.9;
            }else if($model->pages_id==19){
                $pages= 19*0.9;
            }else if($model->pages_id==20){
                $pages=20*0.9;
            }else if($model->pages_id==21){
                $pages= 21*0.85;
            }else if($model->pages_id==22){
                $pages=22*0.85;
            }else if($model->pages_id==23){
                $pages= 23*0.85;
            }else if($model->pages_id==24){
                $pages=24*0.85;
            }else if($model->pages_id==25){
                $pages= 25*0.85;
            }else if($model->pages_id==26){
                $pages=26*0.85;
            }else if($model->pages_id==27){
                $pages= 27*0.85;
            }else if($model->pages_id==28){
                $pages=28*0.85;
            }else if($model->pages_id==29){
                $pages= 29*0.85;
            }else if($model->pages_id==30){
                $pages=30*0.85;
            }else if($model->pages_id==31){
                $pages= 31*0.85;
            }else if($model->pages_id==32){
                $pages=32*0.85;
            }else if($model->pages_id==33){
                $pages= 33*0.85;
            }else if($model->pages_id==34){
                $pages=34*0.85;
            }else if($model->pages_id==35){
                $pages= 35*0.85;
            }else if($model->pages_id==36){
                $pages=36*0.85;
            }else if($model->pages_id==37){
                $pages= 37*0.85;
            }else if($model->pages_id==38){
                $pages=38*0.85;
            }else if($model->pages_id==39){
                $pages= 39*0.85;
            }else if($model->pages_id==40){
                $pages=40*0.85;
            }else if($model->pages_id==41){
                $pages= 41*0.85;
            }else if($model->pages_id==42){
                $pages=42*0.85;
            }else if($model->pages_id==43){
                $pages= 43*0.85;
            }else if($model->pages_id==44){
                $pages=44*0.85;
            }else if($model->pages_id==45){
                $pages= 45*0.85;
            }else if($model->pages_id==46){
                $pages=46*0.85;
            }else if($model->pages_id==47){
                $pages=47*0.85;
            }else if($model->pages_id==48){
                $pages=48*0.85;
            }else if($model->pages_id==49){
                $pages= 49*0.85;
            }else if($model->pages_id==50){
                $pages=50*0.85;
            }else if($model->pages_id==51){
                $pages= 51*0.85;
            }else if($model->pages_id==52){
                $pages=52*0.85;
            }else if($model->pages_id==53){
                $pages= 53*0.85;
            }else if($model->pages_id==54){
                $pages=54*0.85;
            }else if($model->pages_id==55){
                $pages= 55*0.85;
            }else if($model->pages_id==56){
                $pages=56*0.85;
            }else if($model->pages_id==57){
                $pages= 57*0.85;
            }else if($model->pages_id==58){
                $pages=58*0.85;
            }else if($model->pages_id==59){
                $pages= 59*0.85;
            }else if($model->pages_id==60){
                $pages=60*0.85;
            }else if($model->pages_id==61){
                $pages= 61*0.85;
            }else if($model->pages_id==62){
                $pages=62*0.85;
            }else if($model->pages_id==63){
                $pages= 63*0.85;
            }else if($model->pages_id==64){
                $pages=64*0.85;
            }else if($model->pages_id==65){
                $pages= 65*0.85;
            }else if($model->pages_id==66){
                $pages=66*0.85;
            }else if($model->pages_id==67){
                $pages= 67*0.85;
            }else if($model->pages_id==68){
                $pages=68*0.85;
            }else if($model->pages_id==69){
                $pages= 69*0.85;
            }else if($model->pages_id==70){
                $pages=70*0.85;
            }else if($model->pages_id==71){
                $pages= 71*0.85;
            }else if($model->pages_id==72){
                $pages=72*0.85;
            }else if($model->pages_id==73){
                $pages= 73*0.85;
            }else if($model->pages_id==74){
                $pages=74*0.85;
            }else if($model->pages_id==75){
                $pages= 75*0.85;
            }else if($model->pages_id==76){
                $pages=76*0.85;
            }else if($model->pages_id==77){
                $pages= 77*0.85;
            }else if($model->pages_id==78){
                $pages=78*0.85;
            }else if($model->pages_id==79){
                $pages= 79*0.85;
            }else if($model->pages_id==80){
                $pages=80*0.85;
            }else if($model->pages_id==81){
                $pages= 81*0.85;
            }else if($model->pages_id==82){
                $pages=82*0.85;
            }else if($model->pages_id==83){
                $pages= 83*0.85;
            }else if($model->pages_id==84){
                $pages=84*0.85;
            }else if($model->pages_id==85){
                $pages= 85*0.85;
            }else if($model->pages_id==86){
                $pages=86*0.85;
            }else if($model->pages_id==87){
                $pages= 87*0.85;
            }else if($model->pages_id==88){
                $pages=88*0.85;
            }else if($model->pages_id==89){
                $pages= 89;
            }else if($model->pages_id==90){
                $pages=90*0.85;
            }else if($model->pages_id==91){
                $pages= 91*0.85;
            }else if($model->pages_id==92){
                $pages=92*0.85;
            }else if($model->pages_id==93){
                $pages= 93*0.85;
            }else if($model->pages_id==94){
                $pages=94*0.85;
            }else if($model->pages_id==95){
                $pages= 95*0.85;
            }else if($model->pages_id==96){
                $pages=96*0.85;
            }else if($model->pages_id==97){
                $pages= 97*0.85;
            }else if($model->pages_id==98){
                $pages=98*0.85;
            }else if($model->pages_id==99){
                $pages= 99*0.85;
            }else if($model->pages_id==100){
                $pages=100*0.85;
            }else if($model->pages_id==101){
                $pages= 101*0.85;
            }else if($model->pages_id==102){
                $pages=102*0.85;
            }else if($model->pages_id==103){
                $pages= 103*0.85;
            }else if($model->pages_id==104){
                $pages=104*0.85;
            }else if($model->pages_id==105){
                $pages= 105*0.85;
            }else if($model->pages_id==106){
                $pages=106*0.85;
            }else if($model->pages_id==107){
                $pages= 107*0.85;
            }else if($model->pages_id==108){
                $pages=108*0.85;
            }else if($model->pages_id==109){
                $pages= 109*0.85;
            }else if($model->pages_id==110){
                $pages=110*0.85;
            }else if($model->pages_id==111){
                $pages= 111*0.85;
            }else if($model->pages_id==112){
                $pages=112*0.85;
            }else if($model->pages_id==113){
                $pages= 113*0.85;
            }else if($model->pages_id==114){
                $pages=114*0.85;
            }else if($model->pages_id==115){
                $pages= 115*0.85;
            }else if($model->pages_id==116){
                $pages=116*0.85;
            }else if($model->pages_id==117){
                $pages= 117*0.85;
            }else if($model->pages_id==118){
                $pages=118*0.85;
            }else if($model->pages_id==119){
                $pages= 119*0.85;
            }else if($model->pages_id==120){
                $pages=120*0.85;
            }else if($model->pages_id==121){
                $pages= 121*0.85;
            }else if($model->pages_id==122){
                $pages=122*0.85;
            }else if($model->pages_id==123){
                $pages= 123*0.85;
            }else if($model->pages_id==124){
                $pages=124*0.85;
            }else if($model->pages_id==125){
                $pages= 125*0.85;
            }else if($model->pages_id==126){
                $pages=126*0.85;
            }else if($model->pages_id==127){
                $pages= 127*0.85;
            }else if($model->pages_id==128){
                $pages=128*0.85;
            }else if($model->pages_id==129){
                $pages= 129*0.85;
            }else if($model->pages_id==130){
                $pages=130*0.85;
            }else if($model->pages_id==131){
                $pages= 131*0.85;
            }else if($model->pages_id==132){
                $pages=132*0.85;
            }else if($model->pages_id==133){
                $pages= 133*0.85;
            }else if($model->pages_id==134){
                $pages=134*0.85;
            }else if($model->pages_id==135){
                $pages= 135*0.85;
            }else if($model->pages_id==136){
                $pages=136*0.85;
            }else if($model->pages_id==137){
                $pages= 137*0.85;
            }else if($model->pages_id==138){
                $pages=138*0.85;
            }else if($model->pages_id==139){
                $pages= 139*0.85;
            }else if($model->pages_id==140){
                $pages=140*0.85;
            }else if($model->pages_id==141){
                $pages= 141*0.85;
            }else if($model->pages_id==142){
                $pages=142*0.85;
            }else if($model->pages_id==143){
                $pages= 143*0.85;
            }else if($model->pages_id==144){
                $pages=144*0.85;
            }else if($model->pages_id==145){
                $pages= 145*0.85;
            }else if($model->pages_id==146){
                $pages=146*0.85;
            }else if($model->pages_id==147){
                $pages= 147*0.85;
            }else if($model->pages_id==148){
                $pages=148*0.85;
            }else if($model->pages_id==149){
                $pages= 149*0.85;
            }else if($model->pages_id==150){
                $pages=150*0.85;
            }else if($model->pages_id==151){
                $pages= 151*0.85;
            }else if($model->pages_id==152){
                $pages=152*0.85;
            }else if($model->pages_id==153){
                $pages= 153*0.85;
            }else if($model->pages_id==154){
                $pages=154*0.85;
            }else if($model->pages_id==155){
                $pages= 155*0.85;
            }else if($model->pages_id==156){
                $pages=156*0.85;
            }else if($model->pages_id==157){
                $pages= 157*0.85;
            }else if($model->pages_id==158){
                $pages=158*0.85;
            }else if($model->pages_id==159){
                $pages= 159*0.85;
            }else if($model->pages_id==160){
                $pages=160*0.85;
            }else if($model->pages_id==161){
                $pages= 161*0.85;
            }else if($model->pages_id==162){
                $pages=162*0.85;
            }else if($model->pages_id==163){
                $pages= 163*0.85;
            }else if($model->pages_id==164){
                $pages=164*0.85;
            }else if($model->pages_id==165){
                $pages= 165*0.85;
            }else if($model->pages_id==166){
                $pages=166*0.85;
            }else if($model->pages_id==167){
                $pages= 167*0.85;
            }else if($model->pages_id==168){
                $pages=168*0.85;
            }else if($model->pages_id==169){
                $pages= 169*0.85;
            }else if($model->pages_id==170){
                $pages=170*0.85;
            }else if($model->pages_id==171){
                $pages= 171*0.85;
            }else if($model->pages_id==172){
                $pages=172*0.85;
            }else if($model->pages_id==173){
                $pages= 173*0.85;
            }else if($model->pages_id==174){
                $pages=174*0.85;
            }else if($model->pages_id==175){
                $pages= 175*0.85;
            }else if($model->pages_id==176){
                $pages=176*0.85;
            }else if($model->pages_id==177){
                $pages= 177*0.85;
            }else if($model->pages_id==178){
                $pages=178*0.85;
            }else if($model->pages_id==179){
                $pages= 179*0.85;
            }else if($model->pages_id==180){
                $pages=180*0.85;
            }else if($model->pages_id==181){
                $pages= 181*0.85;
            }else if($model->pages_id==182){
                $pages=182*0.85;
            }else if($model->pages_id==183){
                $pages= 183*0.85;
            }else if($model->pages_id==184){
                $pages=184*0.85;
            }else if($model->pages_id==185){
                $pages= 185*0.85;
            }else if($model->pages_id==186){
                $pages=186*0.85;
            }else if($model->pages_id==187){
                $pages= 187*0.85;
            }else if($model->pages_id==188){
                $pages=188*0.85;
            }else if($model->pages_id==189){
                $pages= 189*0.85;
            }else if($model->pages_id==190){
                $pages=190*0.85;
            }else if($model->pages_id==191){
                $pages= 191*0.85;
            }else if($model->pages_id==192){
                $pages=192*0.85;
            }else if($model->pages_id==193){
                $pages= 193*0.85;
            }else if($model->pages_id==194){
                $pages=194*0.85;
            }else if($model->pages_id==195){
                $pages= 195*0.85;
            }else if($model->pages_id==196){
                $pages=196*0.85;
            }else if($model->pages_id==197){
                $pages= 197*0.85;
            }else if($model->pages_id==198){
                $pages=198*0.85;
            }else if($model->pages_id==199){
                $pages= 199*0.85;
            }else if($model->pages_id==200){
                $pages=200*0.85;
            }

            //single spaced
            else if($model->pages_id==201){
                $pages= 1;
            }else if($model->pages_id==202){
                $pages=2*0.95;
            }else if($model->pages_id==203){
                $pages= 3*0.95;
            }else if($model->pages_id==204){
                $pages= 4*0.95;
            }else if($model->pages_id==205){
                $pages= 5*0.95;
            }else if($model->pages_id==206){
                $pages=6*0.925;
            }else if($model->pages_id==207){
                $pages= 7*0.925;
            }else if($model->pages_id==208){
                $pages=8*0.925;
            }else if($model->pages_id==209){
                $pages= 9*0.925;
            }else if($model->pages_id==210){
                $pages=10*0.90;
            }else if($model->pages_id==211){
                $pages= 11*0.90;
            }else if($model->pages_id==212){
                $pages=12*0.90;
            }else if($model->pages_id==213){
                $pages= 13*0.90;
            }else if($model->pages_id==214){
                $pages=14*0.90;
            }else if($model->pages_id==215){
                $pages= 15*0.90;
            }else if($model->pages_id==216){
                $pages=16*0.90;
            }else if($model->pages_id==217){
                $pages= 17*0.90;
            }else if($model->pages_id==218){
                $pages=18*0.90;
            }else if($model->pages_id==219){
                $pages= 19*0.90;
            }else if($model->pages_id==220){
                $pages=20*0.90;
            }else if($model->pages_id==221){
                $pages= 21*0.85;
            }else if($model->pages_id==222){
                $pages=22*0.85;
            }else if($model->pages_id==223){
                $pages= 23*0.85;
            }else if($model->pages_id==224){
                $pages=24*0.85;
            }else if($model->pages_id==225){
                $pages= 25*0.85;
            }else if($model->pages_id==226){
                $pages=26*0.85;
            }else if($model->pages_id==227){
                $pages= 27*0.85;
            }else if($model->pages_id==228){
                $pages=28*0.85;
            }else if($model->pages_id==229){
                $pages= 29*0.85;
            }else if($model->pages_id==230){
                $pages=30*0.85;
            }else if($model->pages_id==231){
                $pages= 31*0.85;
            }else if($model->pages_id==232){
                $pages=32*0.85;
            }else if($model->pages_id==233){
                $pages= 33*0.85;
            }else if($model->pages_id==234){
                $pages=34*0.85;
            }else if($model->pages_id==235){
                $pages= 35*0.85;
            }else if($model->pages_id==236){
                $pages=36*0.85;
            }else if($model->pages_id==237){
                $pages= 37*0.85;
            }else if($model->pages_id==238){
                $pages=38*0.85;
            }else if($model->pages_id==239){
                $pages= 39*0.85;
            }else if($model->pages_id==240){
                $pages=40*0.85;
            }else if($model->pages_id==241){
                $pages= 41*0.85;
            }else if($model->pages_id==242){
                $pages=42*0.85;
            }else if($model->pages_id==243){
                $pages= 43*0.85;
            }else if($model->pages_id==244){
                $pages=44*0.85;
            }else if($model->pages_id==245){
                $pages= 45*0.85;
            }else if($model->pages_id==246){
                $pages=46*0.85;
            }else if($model->pages_id==247){
                $pages= 47*0.85;
            }else if($model->pages_id==248){
                $pages=48*0.85;
            }else if($model->pages_id==249){
                $pages= 49*0.85;
            }else if($model->pages_id==250){
                $pages=50*0.85;
            }else if($model->pages_id==251){
                $pages= 51*0.85;
            }else if($model->pages_id==252){
                $pages=52*0.85;
            }else if($model->pages_id==253){
                $pages= 53*0.85;
            }else if($model->pages_id==254){
                $pages=54*0.85;
            }else if($model->pages_id==255){
                $pages= 55*0.85;
            }else if($model->pages_id==256){
                $pages=56*0.85;
            }else if($model->pages_id==257){
                $pages= 57*0.85;
            }else if($model->pages_id==258){
                $pages=58*0.85;
            }else if($model->pages_id==259){
                $pages= 59*0.85;
            }else if($model->pages_id==260){
                $pages=60*0.85;
            }else if($model->pages_id==261){
                $pages= 61*0.85;
            }else if($model->pages_id==262){
                $pages=62*0.85;
            }else if($model->pages_id==263){
                $pages= 63*0.85;
            }else if($model->pages_id==264){
                $pages=64*0.85;
            }else if($model->pages_id==265){
                $pages= 65*0.85;
            }else if($model->pages_id==266){
                $pages=66*0.85;
            }else if($model->pages_id==267){
                $pages= 67*0.85;
            }else if($model->pages_id==268){
                $pages=68*0.85;
            }else if($model->pages_id==269){
                $pages= 69*0.85;
            }else if($model->pages_id==270){
                $pages=70*0.85;
            }else if($model->pages_id==271){
                $pages= 71*0.85;
            }else if($model->pages_id==272){
                $pages=72*0.85;
            }else if($model->pages_id==273){
                $pages= 73*0.85;
            }else if($model->pages_id==274){
                $pages=74*0.85;
            }else if($model->pages_id==275){
                $pages= 75*0.85;
            }else if($model->pages_id==276){
                $pages=76*0.85;
            }else if($model->pages_id==277){
                $pages= 77*0.85;
            }else if($model->pages_id==278){
                $pages=78*0.85;
            }else if($model->pages_id==279){
                $pages= 79*0.85;
            }else if($model->pages_id==280){
                $pages=80*0.85;
            }else if($model->pages_id==281){
                $pages= 81*0.85;
            }else if($model->pages_id==282){
                $pages=82*0.85;
            }else if($model->pages_id==283){
                $pages= 83*0.85;
            }else if($model->pages_id==284){
                $pages=84*0.85;
            }else if($model->pages_id==285){
                $pages= 85*0.85;
            }else if($model->pages_id==286){
                $pages=86*0.85;
            }else if($model->pages_id==287){
                $pages= 87*0.85;
            }else if($model->pages_id==288){
                $pages=88*0.85;
            }else if($model->pages_id==289){
                $pages= 89*0.85;
            }else if($model->pages_id==290){
                $pages=90*0.85;
            }else if($model->pages_id==291){
                $pages= 91*0.85;
            }else if($model->pages_id==292){
                $pages=92*0.85;
            }else if($model->pages_id==293){
                $pages= 93*0.85;
            }else if($model->pages_id==294){
                $pages=94*0.85;
            }else if($model->pages_id==295){
                $pages= 95*0.85;
            }else if($model->pages_id==296){
                $pages=96*0.85;
            }else if($model->pages_id==297){
                $pages= 97*0.85;
            }else if($model->pages_id==298){
                $pages=98*0.85;
            }else if($model->pages_id==299){
                $pages= 99*0.85;
            }else if($model->pages_id==300){
                $pages=100*0.85;
            }

            // for urgency
            if ($model->urgency_id == 1) {
                $urgency = 3;
            } elseif ($model->urgency_id == 2) {
                $urgency = 6;
            } elseif ($model->urgency_id == 3) {
                $urgency = 12;
            } elseif ($model->urgency_id == 4) {
                $urgency = 24;
            } elseif ($model->urgency_id == 5) {
                $urgency = 48;
            } elseif ($model->urgency_id == 6) {
                $urgency = 72;
            } elseif ($model->urgency_id == 7) {
                $urgency = 96;
            } elseif ($model->urgency_id == 8) {
                $urgency = 120;
            } elseif ($model->urgency_id == 9) {
                $urgency = 144;
            } elseif ($model->urgency_id == 10) {
                $urgency = 168;
            } elseif ($model->urgency_id == 11) {
                $urgency = 192;
            } elseif ($model->urgency_id == 12) {
                $urgency = 240;
            } elseif ($model->urgency_id == 13) {
                $urgency = 336;
            } elseif ($model->urgency_id == 14) {
                $urgency = 672;
            } elseif ($model->urgency_id == 14) {
                $urgency = 1344;
            }

            if($model->urgency_id==1){
                $deadline = 2.5;
            }else if ($model->urgency_id==2){
                $deadline = 2.0;
            }else if ($model->urgency_id==3){
                $deadline = 1.8;
            }else if ($model->urgency_id==4){
                $deadline = 1.5;
            }else if ($model->urgency_id==5){
                $deadline = 1.4;
            }else if ($model->urgency_id==6){
                $deadline = 1.3;
            }else if ($model->urgency_id==7){
                $deadline = 1.2;
            }else if ($model->urgency_id==8){
                $deadline = 1.1;
            }else if ($model->urgency_id==9){
                $deadline = 1.1;
            }else if ($model->urgency_id==10){
                $deadline= 1.0;
            }else if ($model->urgency_id==11){
                $deadline = 1.0;
            }else if ($model->urgency_id==12){
                $deadline = 1.0;
            }else if ($model->urgency_id==13){
                $deadline = 1.0;
            }else if ($model->urgency_id==14){
                $deadline = 1.0;
            }else if ($model->urgency_id==15){
                $deadline = 1.0;
            }

            //for spacing
            if ($model->spacing_id == 1) {
                $spacing = 1;
            } elseif ($model->spacing_id == 2) {
                $spacing = 2;
            }
            $model->amount = number_format(floatval($spacing*$deadline*$service*$level*$pages*$type), 2, '.', ',');
            //calculate the time in hours and days
            $seconds = $urgency*3600;
            $dt1 = new \DateTime("@0");
            $dt2 = new \DateTime("@$seconds");
            $hrsanddays = $dt1->diff($dt2)->format('+%a day +%h hour');
            //get the time from the db in UTC and convert it client timezone
            $startTime = new \DateTime(''.$model->created_at.'', new \DateTimeZone('UTC'));
            $startTime->setTimezone(new \DateTimeZone('Africa/Nairobi'));
            $ptime = $startTime->format("Y-m-d H:i:s");
            // calculate the future deadline and display it
            $cenvertedTime = date('Y-m-d H:i:s',strtotime(''.$hrsanddays.'',strtotime($ptime)));
            $model->deadline = $cenvertedTime;
            $model->created_by = Yii::$app->user->id;
            $model->save();
            unset($session['service_id']);
            unset($session['type_id']);
            unset($session['urgency_id']);
            unset($session['pages_id']);
            unset($session['level_id']);
            return $this->redirect(['view', 'oid' => $model->ordernumber]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionAttached($oid)
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
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

    public function actionFileDelete($order, $file)
    {
        $user = Yii::$app->user->id;
        $myorder = Order::find()->where(['id'=>$order])->one();
        $myfile = File::find()->where(['user_id'=>$user])->andFilterWhere(['order_id'=>$order])->andFilterWhere(['attached'=>$file])->one();
        $myfile->delete();
        $directory = Yii::getAlias('@app/web/images/order') . DIRECTORY_SEPARATOR;
        if (is_file($directory . DIRECTORY_SEPARATOR . $file)) {
            unlink($directory . DIRECTORY_SEPARATOR . $file);
        }
        return $this->redirect(['attached', 'oid'=>$myorder->ordernumber]);
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
    public function actionUpdate($oid)
    {
        $command1 = Yii::$app->db->createCommand('SELECT SUM(amount_paid) FROM paypal WHERE complete = 1');
        $command2 = Yii::$app->db->createCommand('SELECT SUM(withdraw) FROM paypal WHERE complete = 1');
        $totaldeposit = $command1->queryScalar();
        $totalwithdrawal = $command2->queryScalar();
        $balance = $totaldeposit-$totalwithdrawal;
        Yii::$app->view->params['balance'] = $balance;
        $model = $this->findModelByNumber($oid);

        if ($model->load(Yii::$app->request->post())){
            // for service
            if($model->service_id==1){
                $service = 12;
            }else if($model->service_id==2){
                $service=10;
            }else if($model->service_id==3){
                $service= 7.5;
            }

            //for order type
            if($model->type_id==1){
                $type = 1.1;
            }else if ($model->type_id==2){
                $type = 1.2;
            }else if ($model->type_id==3){
                $type = 1.1;
            }else if ($model->type_id==4){
                $type = 1.1;
            }else if ($model->type_id==5){
                $type = 1.1;
            }else if ($model->type_id==6){
                $type = 1.1;
            }else if ($model->type_id==7){
                $type = 1.2;
            }else if ($model->type_id==8){
                $type = 1.1;
            }else if ($model->type_id==9){
                $type = 1.1;
            }else if ($model->type_id==10){
                $type = 1.2;
            }else if ($model->type_id==11){
                $type = 1.2;
            }else if ($model->type_id==12){
                $type = 1.2;
            }else if ($model->type_id==13){
                $type = 1.2;
            }else if ($model->type_id==14){
                $type = 1.2;
            }else if ($model->type_id==15){
                $type = 1.2;
            }else if ($model->type_id==16){
                $type = 1.2;
            }else if ($model->type_id==17){
                $type = 1.2;
            }else if ($model->type_id==18){
                $type = 1.2;
            }else if ($model->type_id==20){
                $type = 1;
            }else if ($model->type_id==22){
                $type = 2.0;
            }else if ($model->type_id==23){
                $type = 2.2;
            }else if ($model->type_id==24){
                $type = 1.5;
            }else if ($model->type_id==25){
                $type = 1.1;
            }else if ($model->type_id==26){
                $type = 1.2;
            }else if ($model->type_id==27){
                $type = 0.7;
            }else if ($model->type_id==28){
                $type = 0.8;
            }else if ($model->type_id==31){
                $type = 1;
            }else if ($model->type_id==32){
                $type = 1.1;
            }else if ($model->type_id==33){
                $type = 1.2;
            }else if ($model->type_id==34){
                $type = 1;
            }else if ($model->type_id==35){
                $type = 2.2;
            }else if ($model->type_id==36){
                $type = 1.2;
            }else if ($model->type_id==37){
                $type = 1.2;
            }else if ($model->type_id==38){
                $type = 1.2;
            }else if ($model->type_id==39){
                $type = 1.5;
            }

            // for order level
            if($model->level_id==1){
                $level = 0.8;
            }else if($model->level_id==2){
                $level=1;
            }else if($model->level_id==4){
                $level= 1.1;
            }else if($model->level_id==5){
                $level= 1.2;
            }

            // for pages
            if($model->pages_id==1){
                $pages = 1;
            }else if($model->pages_id==2){
                $pages=2*0.95;
            }else if($model->pages_id==3){
                $pages= 3*0.95;
            }else if($model->pages_id==4){
                $pages=4*0.95;
            }else if($model->pages_id==5){
                $pages= 5*0.95;
            }else if($model->pages_id==6){
                $pages=6*0.925;
            }else if($model->pages_id==7){
                $pages= 7*0.925;
            }else if($model->pages_id==8){
                $pages=8*0.925;
            }else if($model->pages_id==9){
                $pages= 9*0.925;
            }else if($model->pages_id==10){
                $pages=10*0.9;
            }else if($model->pages_id==11){
                $pages= 11*0.9;
            }else if($model->pages_id==12){
                $pages=12*0.9;
            }else if($model->pages_id==13){
                $pages= 13*0.9;
            }else if($model->pages_id==14){
                $pages=14*0.9;
            }else if($model->pages_id==15){
                $pages= 15*0.9;
            }else if($model->pages_id==16){
                $pages=16*0.9;
            }else if($model->pages_id==17){
                $pages= 17*0.9;
            }else if($model->pages_id==18){
                $pages=18*0.9;
            }else if($model->pages_id==19){
                $pages= 19*0.9;
            }else if($model->pages_id==20){
                $pages=20*0.9;
            }else if($model->pages_id==21){
                $pages= 21*0.85;
            }else if($model->pages_id==22){
                $pages=22*0.85;
            }else if($model->pages_id==23){
                $pages= 23*0.85;
            }else if($model->pages_id==24){
                $pages=24*0.85;
            }else if($model->pages_id==25){
                $pages= 25*0.85;
            }else if($model->pages_id==26){
                $pages=26*0.85;
            }else if($model->pages_id==27){
                $pages= 27*0.85;
            }else if($model->pages_id==28){
                $pages=28*0.85;
            }else if($model->pages_id==29){
                $pages= 29*0.85;
            }else if($model->pages_id==30){
                $pages=30*0.85;
            }else if($model->pages_id==31){
                $pages= 31*0.85;
            }else if($model->pages_id==32){
                $pages=32*0.85;
            }else if($model->pages_id==33){
                $pages= 33*0.85;
            }else if($model->pages_id==34){
                $pages=34*0.85;
            }else if($model->pages_id==35){
                $pages= 35*0.85;
            }else if($model->pages_id==36){
                $pages=36*0.85;
            }else if($model->pages_id==37){
                $pages= 37*0.85;
            }else if($model->pages_id==38){
                $pages=38*0.85;
            }else if($model->pages_id==39){
                $pages= 39*0.85;
            }else if($model->pages_id==40){
                $pages=40*0.85;
            }else if($model->pages_id==41){
                $pages= 41*0.85;
            }else if($model->pages_id==42){
                $pages=42*0.85;
            }else if($model->pages_id==43){
                $pages= 43*0.85;
            }else if($model->pages_id==44){
                $pages=44*0.85;
            }else if($model->pages_id==45){
                $pages= 45*0.85;
            }else if($model->pages_id==46){
                $pages=46*0.85;
            }else if($model->pages_id==47){
                $pages=47*0.85;
            }else if($model->pages_id==48){
                $pages=48*0.85;
            }else if($model->pages_id==49){
                $pages= 49*0.85;
            }else if($model->pages_id==50){
                $pages=50*0.85;
            }else if($model->pages_id==51){
                $pages= 51*0.85;
            }else if($model->pages_id==52){
                $pages=52*0.85;
            }else if($model->pages_id==53){
                $pages= 53*0.85;
            }else if($model->pages_id==54){
                $pages=54*0.85;
            }else if($model->pages_id==55){
                $pages= 55*0.85;
            }else if($model->pages_id==56){
                $pages=56*0.85;
            }else if($model->pages_id==57){
                $pages= 57*0.85;
            }else if($model->pages_id==58){
                $pages=58*0.85;
            }else if($model->pages_id==59){
                $pages= 59*0.85;
            }else if($model->pages_id==60){
                $pages=60*0.85;
            }else if($model->pages_id==61){
                $pages= 61*0.85;
            }else if($model->pages_id==62){
                $pages=62*0.85;
            }else if($model->pages_id==63){
                $pages= 63*0.85;
            }else if($model->pages_id==64){
                $pages=64*0.85;
            }else if($model->pages_id==65){
                $pages= 65*0.85;
            }else if($model->pages_id==66){
                $pages=66*0.85;
            }else if($model->pages_id==67){
                $pages= 67*0.85;
            }else if($model->pages_id==68){
                $pages=68*0.85;
            }else if($model->pages_id==69){
                $pages= 69*0.85;
            }else if($model->pages_id==70){
                $pages=70*0.85;
            }else if($model->pages_id==71){
                $pages= 71*0.85;
            }else if($model->pages_id==72){
                $pages=72*0.85;
            }else if($model->pages_id==73){
                $pages= 73*0.85;
            }else if($model->pages_id==74){
                $pages=74*0.85;
            }else if($model->pages_id==75){
                $pages= 75*0.85;
            }else if($model->pages_id==76){
                $pages=76*0.85;
            }else if($model->pages_id==77){
                $pages= 77*0.85;
            }else if($model->pages_id==78){
                $pages=78*0.85;
            }else if($model->pages_id==79){
                $pages= 79*0.85;
            }else if($model->pages_id==80){
                $pages=80*0.85;
            }else if($model->pages_id==81){
                $pages= 81*0.85;
            }else if($model->pages_id==82){
                $pages=82*0.85;
            }else if($model->pages_id==83){
                $pages= 83*0.85;
            }else if($model->pages_id==84){
                $pages=84*0.85;
            }else if($model->pages_id==85){
                $pages= 85*0.85;
            }else if($model->pages_id==86){
                $pages=86*0.85;
            }else if($model->pages_id==87){
                $pages= 87*0.85;
            }else if($model->pages_id==88){
                $pages=88*0.85;
            }else if($model->pages_id==89){
                $pages= 89;
            }else if($model->pages_id==90){
                $pages=90*0.85;
            }else if($model->pages_id==91){
                $pages= 91*0.85;
            }else if($model->pages_id==92){
                $pages=92*0.85;
            }else if($model->pages_id==93){
                $pages= 93*0.85;
            }else if($model->pages_id==94){
                $pages=94*0.85;
            }else if($model->pages_id==95){
                $pages= 95*0.85;
            }else if($model->pages_id==96){
                $pages=96*0.85;
            }else if($model->pages_id==97){
                $pages= 97*0.85;
            }else if($model->pages_id==98){
                $pages=98*0.85;
            }else if($model->pages_id==99){
                $pages= 99*0.85;
            }else if($model->pages_id==100){
                $pages=100*0.85;
            }else if($model->pages_id==101){
                $pages= 101*0.85;
            }else if($model->pages_id==102){
                $pages=102*0.85;
            }else if($model->pages_id==103){
                $pages= 103*0.85;
            }else if($model->pages_id==104){
                $pages=104*0.85;
            }else if($model->pages_id==105){
                $pages= 105*0.85;
            }else if($model->pages_id==106){
                $pages=106*0.85;
            }else if($model->pages_id==107){
                $pages= 107*0.85;
            }else if($model->pages_id==108){
                $pages=108*0.85;
            }else if($model->pages_id==109){
                $pages= 109*0.85;
            }else if($model->pages_id==110){
                $pages=110*0.85;
            }else if($model->pages_id==111){
                $pages= 111*0.85;
            }else if($model->pages_id==112){
                $pages=112*0.85;
            }else if($model->pages_id==113){
                $pages= 113*0.85;
            }else if($model->pages_id==114){
                $pages=114*0.85;
            }else if($model->pages_id==115){
                $pages= 115*0.85;
            }else if($model->pages_id==116){
                $pages=116*0.85;
            }else if($model->pages_id==117){
                $pages= 117*0.85;
            }else if($model->pages_id==118){
                $pages=118*0.85;
            }else if($model->pages_id==119){
                $pages= 119*0.85;
            }else if($model->pages_id==120){
                $pages=120*0.85;
            }else if($model->pages_id==121){
                $pages= 121*0.85;
            }else if($model->pages_id==122){
                $pages=122*0.85;
            }else if($model->pages_id==123){
                $pages= 123*0.85;
            }else if($model->pages_id==124){
                $pages=124*0.85;
            }else if($model->pages_id==125){
                $pages= 125*0.85;
            }else if($model->pages_id==126){
                $pages=126*0.85;
            }else if($model->pages_id==127){
                $pages= 127*0.85;
            }else if($model->pages_id==128){
                $pages=128*0.85;
            }else if($model->pages_id==129){
                $pages= 129*0.85;
            }else if($model->pages_id==130){
                $pages=130*0.85;
            }else if($model->pages_id==131){
                $pages= 131*0.85;
            }else if($model->pages_id==132){
                $pages=132*0.85;
            }else if($model->pages_id==133){
                $pages= 133*0.85;
            }else if($model->pages_id==134){
                $pages=134*0.85;
            }else if($model->pages_id==135){
                $pages= 135*0.85;
            }else if($model->pages_id==136){
                $pages=136*0.85;
            }else if($model->pages_id==137){
                $pages= 137*0.85;
            }else if($model->pages_id==138){
                $pages=138*0.85;
            }else if($model->pages_id==139){
                $pages= 139*0.85;
            }else if($model->pages_id==140){
                $pages=140*0.85;
            }else if($model->pages_id==141){
                $pages= 141*0.85;
            }else if($model->pages_id==142){
                $pages=142*0.85;
            }else if($model->pages_id==143){
                $pages= 143*0.85;
            }else if($model->pages_id==144){
                $pages=144*0.85;
            }else if($model->pages_id==145){
                $pages= 145*0.85;
            }else if($model->pages_id==146){
                $pages=146*0.85;
            }else if($model->pages_id==147){
                $pages= 147*0.85;
            }else if($model->pages_id==148){
                $pages=148*0.85;
            }else if($model->pages_id==149){
                $pages= 149*0.85;
            }else if($model->pages_id==150){
                $pages=150*0.85;
            }else if($model->pages_id==151){
                $pages= 151*0.85;
            }else if($model->pages_id==152){
                $pages=152*0.85;
            }else if($model->pages_id==153){
                $pages= 153*0.85;
            }else if($model->pages_id==154){
                $pages=154*0.85;
            }else if($model->pages_id==155){
                $pages= 155*0.85;
            }else if($model->pages_id==156){
                $pages=156*0.85;
            }else if($model->pages_id==157){
                $pages= 157*0.85;
            }else if($model->pages_id==158){
                $pages=158*0.85;
            }else if($model->pages_id==159){
                $pages= 159*0.85;
            }else if($model->pages_id==160){
                $pages=160*0.85;
            }else if($model->pages_id==161){
                $pages= 161*0.85;
            }else if($model->pages_id==162){
                $pages=162*0.85;
            }else if($model->pages_id==163){
                $pages= 163*0.85;
            }else if($model->pages_id==164){
                $pages=164*0.85;
            }else if($model->pages_id==165){
                $pages= 165*0.85;
            }else if($model->pages_id==166){
                $pages=166*0.85;
            }else if($model->pages_id==167){
                $pages= 167*0.85;
            }else if($model->pages_id==168){
                $pages=168*0.85;
            }else if($model->pages_id==169){
                $pages= 169*0.85;
            }else if($model->pages_id==170){
                $pages=170*0.85;
            }else if($model->pages_id==171){
                $pages= 171*0.85;
            }else if($model->pages_id==172){
                $pages=172*0.85;
            }else if($model->pages_id==173){
                $pages= 173*0.85;
            }else if($model->pages_id==174){
                $pages=174*0.85;
            }else if($model->pages_id==175){
                $pages= 175*0.85;
            }else if($model->pages_id==176){
                $pages=176*0.85;
            }else if($model->pages_id==177){
                $pages= 177*0.85;
            }else if($model->pages_id==178){
                $pages=178*0.85;
            }else if($model->pages_id==179){
                $pages= 179*0.85;
            }else if($model->pages_id==180){
                $pages=180*0.85;
            }else if($model->pages_id==181){
                $pages= 181*0.85;
            }else if($model->pages_id==182){
                $pages=182*0.85;
            }else if($model->pages_id==183){
                $pages= 183*0.85;
            }else if($model->pages_id==184){
                $pages=184*0.85;
            }else if($model->pages_id==185){
                $pages= 185*0.85;
            }else if($model->pages_id==186){
                $pages=186*0.85;
            }else if($model->pages_id==187){
                $pages= 187*0.85;
            }else if($model->pages_id==188){
                $pages=188*0.85;
            }else if($model->pages_id==189){
                $pages= 189*0.85;
            }else if($model->pages_id==190){
                $pages=190*0.85;
            }else if($model->pages_id==191){
                $pages= 191*0.85;
            }else if($model->pages_id==192){
                $pages=192*0.85;
            }else if($model->pages_id==193){
                $pages= 193*0.85;
            }else if($model->pages_id==194){
                $pages=194*0.85;
            }else if($model->pages_id==195){
                $pages= 195*0.85;
            }else if($model->pages_id==196){
                $pages=196*0.85;
            }else if($model->pages_id==197){
                $pages= 197*0.85;
            }else if($model->pages_id==198){
                $pages=198*0.85;
            }else if($model->pages_id==199){
                $pages= 199*0.85;
            }else if($model->pages_id==200){
                $pages=200*0.85;
            }

            //single spaced
            else if($model->pages_id==201){
                $pages= 1;
            }else if($model->pages_id==202){
                $pages=2*0.95;
            }else if($model->pages_id==203){
                $pages= 3*0.95;
            }else if($model->pages_id==204){
                $pages= 4*0.95;
            }else if($model->pages_id==205){
                $pages= 5*0.95;
            }else if($model->pages_id==206){
                $pages=6*0.925;
            }else if($model->pages_id==207){
                $pages= 7*0.925;
            }else if($model->pages_id==208){
                $pages=8*0.925;
            }else if($model->pages_id==209){
                $pages= 9*0.925;
            }else if($model->pages_id==210){
                $pages=10*0.90;
            }else if($model->pages_id==211){
                $pages= 11*0.90;
            }else if($model->pages_id==212){
                $pages=12*0.90;
            }else if($model->pages_id==213){
                $pages= 13*0.90;
            }else if($model->pages_id==214){
                $pages=14*0.90;
            }else if($model->pages_id==215){
                $pages= 15*0.90;
            }else if($model->pages_id==216){
                $pages=16*0.90;
            }else if($model->pages_id==217){
                $pages= 17*0.90;
            }else if($model->pages_id==218){
                $pages=18*0.90;
            }else if($model->pages_id==219){
                $pages= 19*0.90;
            }else if($model->pages_id==220){
                $pages=20*0.90;
            }else if($model->pages_id==221){
                $pages= 21*0.85;
            }else if($model->pages_id==222){
                $pages=22*0.85;
            }else if($model->pages_id==223){
                $pages= 23*0.85;
            }else if($model->pages_id==224){
                $pages=24*0.85;
            }else if($model->pages_id==225){
                $pages= 25*0.85;
            }else if($model->pages_id==226){
                $pages=26*0.85;
            }else if($model->pages_id==227){
                $pages= 27*0.85;
            }else if($model->pages_id==228){
                $pages=28*0.85;
            }else if($model->pages_id==229){
                $pages= 29*0.85;
            }else if($model->pages_id==230){
                $pages=30*0.85;
            }else if($model->pages_id==231){
                $pages= 31*0.85;
            }else if($model->pages_id==232){
                $pages=32*0.85;
            }else if($model->pages_id==233){
                $pages= 33*0.85;
            }else if($model->pages_id==234){
                $pages=34*0.85;
            }else if($model->pages_id==235){
                $pages= 35*0.85;
            }else if($model->pages_id==236){
                $pages=36*0.85;
            }else if($model->pages_id==237){
                $pages= 37*0.85;
            }else if($model->pages_id==238){
                $pages=38*0.85;
            }else if($model->pages_id==239){
                $pages= 39*0.85;
            }else if($model->pages_id==240){
                $pages=40*0.85;
            }else if($model->pages_id==241){
                $pages= 41*0.85;
            }else if($model->pages_id==242){
                $pages=42*0.85;
            }else if($model->pages_id==243){
                $pages= 43*0.85;
            }else if($model->pages_id==244){
                $pages=44*0.85;
            }else if($model->pages_id==245){
                $pages= 45*0.85;
            }else if($model->pages_id==246){
                $pages=46*0.85;
            }else if($model->pages_id==247){
                $pages= 47*0.85;
            }else if($model->pages_id==248){
                $pages=48*0.85;
            }else if($model->pages_id==249){
                $pages= 49*0.85;
            }else if($model->pages_id==250){
                $pages=50*0.85;
            }else if($model->pages_id==251){
                $pages= 51*0.85;
            }else if($model->pages_id==252){
                $pages=52*0.85;
            }else if($model->pages_id==253){
                $pages= 53*0.85;
            }else if($model->pages_id==254){
                $pages=54*0.85;
            }else if($model->pages_id==255){
                $pages= 55*0.85;
            }else if($model->pages_id==256){
                $pages=56*0.85;
            }else if($model->pages_id==257){
                $pages= 57*0.85;
            }else if($model->pages_id==258){
                $pages=58*0.85;
            }else if($model->pages_id==259){
                $pages= 59*0.85;
            }else if($model->pages_id==260){
                $pages=60*0.85;
            }else if($model->pages_id==261){
                $pages= 61*0.85;
            }else if($model->pages_id==262){
                $pages=62*0.85;
            }else if($model->pages_id==263){
                $pages= 63*0.85;
            }else if($model->pages_id==264){
                $pages=64*0.85;
            }else if($model->pages_id==265){
                $pages= 65*0.85;
            }else if($model->pages_id==266){
                $pages=66*0.85;
            }else if($model->pages_id==267){
                $pages= 67*0.85;
            }else if($model->pages_id==268){
                $pages=68*0.85;
            }else if($model->pages_id==269){
                $pages= 69*0.85;
            }else if($model->pages_id==270){
                $pages=70*0.85;
            }else if($model->pages_id==271){
                $pages= 71*0.85;
            }else if($model->pages_id==272){
                $pages=72*0.85;
            }else if($model->pages_id==273){
                $pages= 73*0.85;
            }else if($model->pages_id==274){
                $pages=74*0.85;
            }else if($model->pages_id==275){
                $pages= 75*0.85;
            }else if($model->pages_id==276){
                $pages=76*0.85;
            }else if($model->pages_id==277){
                $pages= 77*0.85;
            }else if($model->pages_id==278){
                $pages=78*0.85;
            }else if($model->pages_id==279){
                $pages= 79*0.85;
            }else if($model->pages_id==280){
                $pages=80*0.85;
            }else if($model->pages_id==281){
                $pages= 81*0.85;
            }else if($model->pages_id==282){
                $pages=82*0.85;
            }else if($model->pages_id==283){
                $pages= 83*0.85;
            }else if($model->pages_id==284){
                $pages=84*0.85;
            }else if($model->pages_id==285){
                $pages= 85*0.85;
            }else if($model->pages_id==286){
                $pages=86*0.85;
            }else if($model->pages_id==287){
                $pages= 87*0.85;
            }else if($model->pages_id==288){
                $pages=88*0.85;
            }else if($model->pages_id==289){
                $pages= 89*0.85;
            }else if($model->pages_id==290){
                $pages=90*0.85;
            }else if($model->pages_id==291){
                $pages= 91*0.85;
            }else if($model->pages_id==292){
                $pages=92*0.85;
            }else if($model->pages_id==293){
                $pages= 93*0.85;
            }else if($model->pages_id==294){
                $pages=94*0.85;
            }else if($model->pages_id==295){
                $pages= 95*0.85;
            }else if($model->pages_id==296){
                $pages=96*0.85;
            }else if($model->pages_id==297){
                $pages= 97*0.85;
            }else if($model->pages_id==298){
                $pages=98*0.85;
            }else if($model->pages_id==299){
                $pages= 99*0.85;
            }else if($model->pages_id==300){
                $pages=100*0.85;
            }

            // for urgency
            if ($model->urgency_id == 1) {
                $urgency = 3;
            } elseif ($model->urgency_id == 2) {
                $urgency = 6;
            } elseif ($model->urgency_id == 3) {
                $urgency = 12;
            } elseif ($model->urgency_id == 4) {
                $urgency = 24;
            } elseif ($model->urgency_id == 5) {
                $urgency = 48;
            } elseif ($model->urgency_id == 6) {
                $urgency = 72;
            } elseif ($model->urgency_id == 7) {
                $urgency = 96;
            } elseif ($model->urgency_id == 8) {
                $urgency = 120;
            } elseif ($model->urgency_id == 9) {
                $urgency = 144;
            } elseif ($model->urgency_id == 10) {
                $urgency = 168;
            } elseif ($model->urgency_id == 11) {
                $urgency = 192;
            } elseif ($model->urgency_id == 12) {
                $urgency = 240;
            } elseif ($model->urgency_id == 13) {
                $urgency = 336;
            } elseif ($model->urgency_id == 14) {
                $urgency = 672;
            } elseif ($model->urgency_id == 14) {
                $urgency = 1344;
            }

            if($model->urgency_id==1){
                $deadline = 2.5;
            }else if ($model->urgency_id==2){
                $deadline = 2.0;
            }else if ($model->urgency_id==3){
                $deadline = 1.8;
            }else if ($model->urgency_id==4){
                $deadline = 1.5;
            }else if ($model->urgency_id==5){
                $deadline = 1.4;
            }else if ($model->urgency_id==6){
                $deadline = 1.3;
            }else if ($model->urgency_id==7){
                $deadline = 1.2;
            }else if ($model->urgency_id==8){
                $deadline = 1.1;
            }else if ($model->urgency_id==9){
                $deadline = 1.1;
            }else if ($model->urgency_id==10){
                $deadline= 1.0;
            }else if ($model->urgency_id==11){
                $deadline = 1.0;
            }else if ($model->urgency_id==12){
                $deadline = 1.0;
            }else if ($model->urgency_id==13){
                $deadline = 1.0;
            }else if ($model->urgency_id==14){
                $deadline = 1.0;
            }else if ($model->urgency_id==15){
                $deadline = 1.0;
            }

            //for spacing
            if ($model->spacing_id == 1) {
                $spacing = 1;
            } elseif ($model->spacing_id == 2) {
                $spacing = 2;
            }
            $model->amount = number_format(floatval($spacing*$deadline*$service*$level*$pages*$type), 2, '.', ',');
            //calculate the time in hours and days
            $seconds = $urgency*3600;
            $dt1 = new \DateTime("@0");
            $dt2 = new \DateTime("@$seconds");
            $hrsanddays = $dt1->diff($dt2)->format('+%a day +%h hour');
            //get the time from the db in UTC and convert it client timezone
            $startTime = new \DateTime(''.$model->created_at.'', new \DateTimeZone('UTC'));
            $startTime->setTimezone(new \DateTimeZone('Africa/Nairobi'));
            $ptime = $startTime->format("Y-m-d H:i:s");
            // calculate the future deadline and display it
            $cenvertedTime = date('Y-m-d H:i:s',strtotime(''.$hrsanddays.'',strtotime($ptime)));
            $model->deadline = $cenvertedTime;
            $model->save();
            return $this->redirect(['view', 'oid' => $model->ordernumber]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

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
