<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PersguardiaislaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personal de guardia aceptado';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index">
    <p>
        <?php if ( Yii::$app->user->can('superadmin') || Yii::$app->user->can('personal') ): ?>
            <?= Html::a('Personal guardia', ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Añadir Pers Isla', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if( Yii::$app->user->can('superadmin') || Yii::$app->user->can('isla') ):?>
            <?= Html::a('Añadir habitaciones', ['numhab'], ['class' => 'btn btn-primary']); ?>
        <?php endif; ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if( Yii::$app->user->can('secretariogg') ):?>
            <?= Html::a('Personal no Aceptado', ['index'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
    </p>

    <div class="">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label'=>'Personal',
                    'attribute'=>'nombcompleto',
                    'value'=>function($data){
                        return $data->getpers()->nombcompleto;
                    },
                ],
                [
                    'label'=>'Departamento',
                    'attribute'=>'nombdepart',
                    'value'=>function($data){
                        return $data->getdepart()->nombdepart;
                    }
                ],
                [
                    'label'=>'Actividad',
                    'attribute'=>'actividad',
                    'value'=>function($data){
                        return $data->actividad;
                    }
                ],
                [
                    'label'=>'F Salida',
                    'attribute'=>'fsalida',
                    'value'=>function($data){
                        return $data->fsalida;
                    }
                ],
                [
                    'label'=>'F Retorno',
                    'attribute'=>'fretorno',
                    'value'=>function($data){
                        return $data->fretorno;
                    }
                ],
                [
                    'label'=>'Tipo pers',
                    'attribute'=>'tippers',
                    'filter'=>[
                        'guardia'=>'Guardia',
                        'foraneo'=>'Foraneo',
                    ],
                    'value'=>function($data){
                        return $data->tippers;
                    }
                ],
                [
                    'label'=>'Sexo',
                    'attribute'=>'sexo',
                    'value'=>function($data){
                        return $data->getpers()->sexo == 'M' ? 'Hombre' : 'Mujer';
                    }
                ],
                [
                    'label'=>'Alojamiento',
                    'attribute'=>'alojamiento',
                    'value'=>function($data){
                        return $data->gethosp()['alojamiento'] == null ? 'SIN ASIGNAR' : $data->gethosp()['alojamiento'];
                    }
                ],
                [
                    'label'=>'Status',
                    'attribute'=>'status',
                    'value'=>function($data){
                        return $data->status == 1 ? 'Aceptado' : 'No aceptado';
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Acción',
                    'headerOptions'=>['width'=>'70'],
                    'template'=>'{view}{update}{marcar}',
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
                            if ( Yii::$app->user->can('superadmin') || Yii::$app->user->can('isla') ) {
                                return Html::a(
                                Html::img('@web/fonts/pencil.svg'),
                                $url
                                );
                            }
                        },
                        'marcar' => function($url,$model,$key){
                            if ( Yii::$app->user->can('superadmin') || Yii::$app->user->can('secretariogg') ) {
                                return ButtonDropdown::widget([
                                    'encodeLabel'=>false,
                                    'label'=>'',
                                    'dropdown'=>[
                                        'encodeLabels'=>false,
                                        'items'=>[
                                            [
                                                'label'=>'Aceptar',
                                                'url'=>['updatestatus','id'=>$key,'param'=>'s']
                                            ],
                                            [
                                                'label'=>'No Aceptar',
                                                'url'=>['updatestatus','id'=>$key,'param'=>'n']
                                            ]
                                        ],
                                        'options'=>[
                                            'class'=>'dropdown-menu-right'
                                        ],
                                    ],
                                    'options'=>[
                                        'class'=>'btn-default'
                                    ],
                                    'split'=>false
                                ]);
                            }
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>

</div>
