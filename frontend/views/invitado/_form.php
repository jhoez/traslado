<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Persexterno */
/* @var $form yii\widgets\ActiveForm */
$fecha = date( "Y-m-d" );
?>

<div class="persform">
    <div class="row clearfix">
        <div class="col-md-offset-4 col-md-4">
            <?php $form = ActiveForm::begin(); ?>
            <?= Html::activeHiddenInput($invitado,"fcarga",['value'=>$fecha]);?>
            <div class="form-group">
                <?= $form->field($invitado, 'ci')->textInput(['maxlength' => true,'placeholder'=>'11.222.333']) ?>
            </div>

            <div class="form-group">
                <?= $form->field($invitado, 'nombcompleto')->textInput(['maxlength' => true,'placeholder'=>'Nombre completo']) ?>
            </div>

            <div class="form-group">
                <?= $form->field($invitado, "actividad")->textarea(['maxlength' => true,'placeholder'=>'Descripción de la actividad','style'=>['resize'=>'none']]) ?>
            </div>

            <div class="form-group">
                <?= $form->field($invitado, "sexo")->radioList(['M'=>'M','F'=>'F']); ?>
            </div>

            <div class="form-group">
                <?= $form->field($invitado, 'ente')->textInput(['maxlength' => true,'placeholder'=>'Ente gubernamental']) ?>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <?= $form->field($invitado,"fsalida")->widget(
                        DatePicker::className(),
                        [
                            'type' => DatePicker::TYPE_INPUT,//'type' => DatePicker::TYPE_BUTTON,
                            'options' => ['placeholder' => '0000-00-00'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]
                    )?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <?= $form->field($invitado,"fretorno")->widget(
                        DatePicker::className(),
                        [
                            'type' => DatePicker::TYPE_INPUT,//'type' => DatePicker::TYPE_BUTTON,
                            'options' => ['placeholder' => '0000-00-00'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]
                    )?>
                </div>
            </div>

            <div class="form-group">
                <?= $form->field($invitado,"tippers")->dropDownList(
                    [
                        'guardia'=>'Guardia',
                        'foraneo'=>'Foraneo'
                    ],
                    ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                )?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
