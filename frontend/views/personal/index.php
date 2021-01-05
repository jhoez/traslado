<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PersonalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index">
    <p>
        <?= Html::a('Añadir Personal', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'CI',
                'attribute'=>'ci',
                'value'=>function($data){
                    return $data->ci;
                },
            ],
            [
                'label'=>'Personal',
                'attribute'=>'nombcompleto',
                'value'=>function($data){
                    return $data->nombcompleto;
                },
            ],
            [
                'label'=>'Departamento',
                'attribute'=>'nombdepart',
                'value'=>function($data){
                    return $data->getpersdepart()->nombdepart;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Acción',
                'headerOptions'=>['width'=>'70'],
                'template'=>'{view}{update}{delete}',
                'buttons'=> [
                    'view'=>function($url,$model){
                        if ( Yii::$app->user->can('superadmin') || Yii::$app->user->can('personal') ) {
                            return Html::a(
                                Html::img('@web/fonts/view.svg'),
                                $url
                            );
                        }
                    },
                    'update'=>function($url,$model){
                        if ( Yii::$app->user->can('superadmin') ) {
                            return Html::a(
                                Html::img('@web/fonts/pencil.svg'),
                                $url
                            );
                        }
                    },
                    'delete'=>function($url,$model){
                        if ( Yii::$app->user->can('superadmin') || Yii::$app->user->can('personal') ) {
                            return Html::a(
                                Html::img('@web/fonts/cross.svg'),
                                $url
                            );
                        }
                    },
                ],
            ],
        ],
    ]); ?>


</div>
