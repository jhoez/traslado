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
        <div class="">
            <?php $form = ActiveForm::begin(); ?>
            <?= Html::activeHiddenInput($persguardia,"fcarga",['value'=>$fecha]);?>
            <?php foreach ($personal as $clave => $valor): ?>
                <div class="clearfix">
                    <div class="form-group">
                        <div class="col-md-2">
                            <?= $form->field($persguardia, "fkpers[$clave]")->checkbox(['value'
                            =>"$valor->idpers",'labelOptions'=>['style'=>'display:inline;']])->label("$valor->nombcompleto"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <?= $form->field($persguardia, "actividad[$clave]")->textarea(['maxlength' => true,'style'=>['resize'=>'none']]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2">
                            <?= $form->field($persguardia,"fsalida[$clave]")->widget(
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
                        <div class="col-md-2">
                            <?= $form->field($persguardia,"fretorno[$clave]")->widget(
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
                        <div class="col-md-2">
                            <?= $form->field($persguardia,"tippers[$clave]")->dropDownList(
                                [
                                    'guardia'=>'Guardia',
                                    'foraneo'=>'Foraneo'
                                ],
                                ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                            )?>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <div class="col-md-1">
                            <?php//= $form->field($persguardia, "sexo[$clave]")->radioList(['M'=>'M','F'=>'F']); ?>
                        </div>
                    </div>-->
                </div>
            <?php endforeach; ?>
            <div class="form-group">
                <div class="col-md-12">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
