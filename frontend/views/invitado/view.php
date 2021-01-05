<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Persexterno */

$this->title = 'Detalles del invitado';
$this->params['breadcrumbs'][] = ['label' => 'Invitado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="persview">
    <p>
        <?= Html::a('Invitados', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 text-center><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $invitado,
        'attributes' => [
            [
                'label'=>'CI',
                'attribute'=>'ci',
                'value'=>function($data){
                    return $data->ci;
                },
            ],
            [
                'label'=>'Invitado',
                'attribute'=>'nombcompleto',
                'value'=>function($data){
                    return $data->nombcompleto;
                },
            ],
            [
                'label'=>'Ente',
                'attribute'=>'ente',
                'value'=>function($data){
                    return $data->ente;
                },
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
                'value'=>function($data){
                    return $data->tippers;
                }
            ],
            [
                'label'=>'Sexo',
                'attribute'=>'sexo',
                'value'=>function($data){
                    return $data->sexo == 'M' ? 'Hombre' : 'Mujer';
                }
            ],
            [
                'label'=>'Status',
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->status == 1 ? 'Aceptado' : 'No aceptado';
                }
            ],
        ],
    ]) ?>

</div>
