<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Persguardiaisla */

$this->title = 'Detalles';
$this->params['breadcrumbs'][] = ['label' => 'Personal de guardia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="view">
    <p>
        <?= Html::a('Personal de guardia', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $persguardia,
        'attributes' => [
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
                },
            ],
            [
                'label'=>'Actividad',
                'attribute'=>'actividad',
                'value'=>function($data){
                    return $data->actividad;
                },
            ],
            [
                'label'=>'F Salida',
                'attribute'=>'fsalida',
                'value'=>function($data){
                    return $data->fsalida;
                },
            ],
            [
                'label'=>'F Retorno',
                'attribute'=>'fretorno',
                'value'=>function($data){
                    return $data->fretorno;
                },
            ],
            [
                'label'=>'Tipo Pers',
                'attribute'=>'tippers',
                'value'=>function($data){
                    return $data->tippers;
                },
            ],
            [
                'label'=>'Sexo',
                'attribute'=>'sexo',
                'value'=>function($data){
                    return $data->getpers()->sexo == 'M' ? 'Hombre' : 'Mujer';
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
                'label'=>'Alojamiento',
                'attribute'=>'alojamiento',
                'value'=>function($data){
                    return $data->gethosp()['alojamiento'] == null ? 'SIN ASIGNAR' : $data->gethosp()['alojamiento'];
                }
            ],
        ],
    ]) ?>

</div>
