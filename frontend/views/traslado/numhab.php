<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Carga de habitaciones';
$this->params['breadcrumbs'][] = ['label' => 'Personal de guardia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="habitaciones">
    <p>
        <?= Html::a('Personal guardia', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="form">
        <h1 class="text-center">Cargar de habitaciones</h1>
        <div class="row clearfix">
            <div class="col-md-offset-4 col-md-4">
                <?php $form = ActiveForm::begin([
                    'action'=>Url::toRoute('/traslado/numhab')
                ]); ?>
                <div class="form-group">
                    <div class="col-md-6">
                        <?= $form->field($habitacion,'habhombres')->textInput() ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <?= $form->field($habitacion,'habmujeres')->textInput() ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <?= Html::submitButton('Asignar',['class'=>'btn btn-success']); ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
