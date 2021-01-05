<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Persexterno */
/* @var $form yii\widgets\ActiveForm */
$fecha = date( "Y-m-d h:i:s",time() );
?>

<div class="persform">
    <div class="row clearfix">
        <div class="col-md-offset-4 col-md-4">
            <?php $form = ActiveForm::begin(); ?>
            <?= Html::activeHiddenInput($invitado,"fcarga",['value'=>$fecha]);?>
            <div class="form-group">
                <?= $form->field($invitado, 'ci')->textInput(['disabled' => true,'maxlength' => true,'placeholder'=>'11.222.333']) ?>
            </div>

            <div class="form-group">
                <?= $form->field($invitado, 'nombcompleto')->textInput(['disabled' => true,'maxlength' => true,'placeholder'=>'Nombre completo']) ?>
            </div>

            <div class="form-group">
                <?= $form->field($invitado, "actividad")->textarea(['disabled' => true,'maxlength' => true,'style'=>['resize'=>'none']]) ?>
            </div>

            <div class="form-group">
                <?= $form->field($invitado, "sexo")->textInput([
                    'disabled' => true,
                    'value'=>$invitado->sexo == 'M' ? 'Masculino':'Femenino'
                ]) ?>
            </div>

            <div class="form-group">
                <?= $form->field($invitado, 'ente')->textInput(['disabled' => true,'maxlength' => true,'placeholder'=>'Ente gubernamental']) ?>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <?= $form->field($invitado,"fsalida")->textInput(['disabled' => true,'value'=>$invitado->fsalida])?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <?= $form->field($invitado,"fretorno")->textInput(['disabled' => true,'value'=>$invitado->fretorno])?>
                </div>
            </div>

            <div class="form-group">
                <?= $form->field($invitado,"tippers")->dropDownList(
                    [
                        'guardia'=>'Guardia',
                        'foraneo'=>'Foraneo'
                    ],
                    ['prompt' => '---- Seleccione ----','class' => 'form-control input-md','disabled' => true]
                )?>
            </div>

            <div class="form-group">
                <div class="">
                    <?= $form->field($hospedaje,"alojamiento")->textInput();?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
