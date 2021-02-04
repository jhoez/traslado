<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Tabs;
//use yii\jui\DatePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PersguardiaislaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$fecha = date('Y-m-d');

$this->title = 'Personal de guardia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index">
    <p>
        <?php if ( Yii::$app->user->can('superadmin') || Yii::$app->user->can('personal') ): ?>
            <?= Html::a('Añadir Pers Isla', ['create'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php
        if( Yii::$app->user->can('superadmin') || Yii::$app->user->can('isla') ){
            echo Html::a('Añadir habitaciones', ['numhab'], ['class' => 'btn btn-primary']);
        }
        ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php if (
            Yii::$app->user->can('superadmin') ||
            Yii::$app->user->can('isla') ||
            Yii::$app->user->can('secretariogg')
        ): ?>
        <div class="text-right">
            <h3 class="">Habitaciones disponibles</h3>
            <h4 class="">Hombres: <?=Html::encode($numhab['habhombres']) ?></h4>
            <h4 class="">Mujeres: <?=Html::encode($numhab['habmujeres']) ?></h4>
        </div>
    <?php endif; ?>

    <?php if ( Yii::$app->user->can('superadmin') || Yii::$app->user->can('imprimirpdf') ): ?>
        <div class="pers-form">
            <div class="row clearfix">
                <div class="col-md-offset-4 col-md-4">
                    <h4 class="text-center">Exportar PDF de personal de Guardia de la Isla</h4>
                    <?php $form = ActiveForm::begin([
                        'id'=>'reportedia',
                        'method' => 'post',
                        'action'=>Url::toRoute('/traslado/reportepdf'),
                    ]); ?>

                    <?= Html::activeHiddenInput($persguardia,'fcarga',['value'=>$fecha]);?>
                    <?= Html::activeHiddenInput($persexterno,'fcarga',['value'=>$fecha]);?>

                    <div class="form-group">
                        <?= Html::submitButton('Exportar', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if( Yii::$app->user->can('superadmin') || Yii::$app->user->can('secretariogg') ){
            echo Html::a('Personal Aceptado', ['indexpa'], ['class' => 'btn btn-primary']);
        }
        ?>
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
                    'contentOptions' => [
                        'class' => 'text-center',
                    ],
                    'filterInputOptions' => ['class' => '', 'id' => 'nombre', 'prompt' => 'Nombre completo'],
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
                    'filter'=> DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'fsalida',
                        'language' => 'es',
                        'type' => DatePicker::TYPE_INPUT,//'type' => DatePicker::TYPE_BUTTON,
                        'options' => ['placeholder' => '0000-00-00'],
                        'pluginOptions' => [
                            'format' => 'yyyy-MM-dd'
                        ],
                    ]),
                    'value'=>function($data){
                        return $data->fsalida;
                    }
                ],
                [
                    'label'=>'F Retorno',
                    'attribute'=>'fretorno',
                    'filter'=> DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'fretorno',
                        'language' => 'es',
                        'type' => DatePicker::TYPE_INPUT,//'type' => DatePicker::TYPE_BUTTON,
                        'options' => ['placeholder' => '0000-00-00'],
                        'pluginOptions' => [
                            'format' => 'yyyy-MM-dd'
                        ],
                    ]),
                    'value'=>function($data){
                        return $data->fretorno;
                    }
                ],
                [
                    'label'=>'Tipo Guardia',
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
                    'filter'=>false,
                    'value'=>function($data){
                        return $data->status == 1 ? 'Aceptado' : 'No aceptado';
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Acción',
                    'headerOptions'=>['width'=>'70'],
                    'template'=>'{view2}{update}{marcar}',
                    'buttons'=> [
                        'view2'=>function($url,$model){
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
                                                'url'=>['/traslado/updatestatus','id'=>$key,'param'=>'s']
                                            ],
                                            [
                                                'label'=>'No Aceptar',
                                                'url'=>['/traslado/updatestatus','id'=>$key,'param'=>'n']
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
