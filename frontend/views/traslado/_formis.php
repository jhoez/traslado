<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Persguardiaisla */
/* @var $form yii\widgets\ActiveForm */
$fecha = date( "Y-m-d h:i:s",time() );

?>

<div class="form">
    <div class="clearfix">
        <div class="col-md-offset-4 col-md-4">
            <?php $form = ActiveForm::begin(); ?>
            <div class="form-group">
                <div class="">
                    <?= $form->field($persguardia, "fkpers")->textInput(['disabled' => true,'value'=>$persguardia->getpers()->nombcompleto]); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($persguardia, "actividad")->textarea(['disabled' => true,'maxlength' => true,'style'=>['resize'=>'none']]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($persguardia,"fsalida")->textInput(['disabled' => true]);?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($persguardia,"fretorno")->textInput(['disabled' => true]);?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($persguardia,"tippers")->dropDownList(
                        [
                            'guardia'=>'Guardia',
                            'foraneo'=>'Foraneo'
                        ],
                        ['prompt' => '---- Seleccione ----','class' => 'form-control input-md','disabled' => true]
                    )?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($hospedaje,"alojamiento")->textInput();?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
