<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--    <p>-->
    <!--        --><?php //echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    <!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'phone',
//            'password_hash',
            //'auth_key',
            //'access_token:ntext',
            //'password_reset_token',
            //'status',
            //'site_code',
            //'country_id',
            //'confirmed',
            //'confirmed_at',
            'timezone',
            //'blocked_at',
            'registration_ip',
            //'flags',
            'created_at',
            //'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7; width: 130px'],
                'template' => '{view} {make_admin} {make_client} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        if (Yii::$app->user->can("view-user")) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,
                                ['title' => Yii::t('app', 'View'), 'class' => 'btn btn-sm btn-info']);
                        }
                    },


                    'make_admin' => function ($url, $model) {
                        if (Yii::$app->user->can("make_admin-user")) {
                            $userRole = \app\models\AuthAssignment::find()->where(['item_name' => 'client'])->andWhere(['user_id' => $model->id])->one();
                            if ($userRole) {
                                return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', $url,
                                    [
                                        'class' => 'btn btn-sm btn-success', 'title' => Yii::t('app', 'Make Admin'),
                                    ]);
                            }
                        }
                    },

                    'make_client' => function ($url, $model) {
                        if (Yii::$app->user->can("make_client-user")) {
                            $userRole = \app\models\AuthAssignment::find()->where(['item_name' => 'admin'])->andWhere(['user_id' => $model->id])->one();
                            if ($userRole && Yii::$app->user->id != $model->id) {
                                return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', $url,
                                    [
                                        'class' => 'btn btn-sm btn-warning', 'title' => Yii::t('app', 'Make Client'),
                                    ]);
                            }
                        }
                    },

                    'delete' => function ($url, $model) {
                        if (Yii::$app->user->can("delete-user")) {
                            if (Yii::$app->user->id != $model->id) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                                    [
                                        'class' => 'btn btn-sm btn-danger', 'title' => Yii::t('app', 'Delete'),
                                        'data' => [
                                            'confirm' => 'Are you absolutely sure ? You will lose all the information about this user.',
                                            'method' => 'post',
                                        ],
                                    ]);
                            }
                        }
                    }

                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url = ['user/view', 'id' => $model->id];
                        return $url;
                    }

                    if ($action === 'make_admin') {
                        $url = ['user/make-admin', 'id' => $model->id];
                        return $url;
                    }

                    if ($action === 'make_client') {
                        $url = ['user/make-client', 'id' => $model->id];
                        return $url;
                    }

                    if ($action === 'delete') {
                        $url = ['user/delete', 'id' => $model->id];
                        return $url;
                    }

                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
