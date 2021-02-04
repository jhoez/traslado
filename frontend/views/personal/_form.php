<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Personal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-form">
    <div class="row clearfix">
        <div class="col-md-offset-4 col-md-4">
            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group">
                <?= $form->field($personal, 'ci')->textInput(['id'=>'cedula','maxlength' => true,'placeholder'=>'11.222.333']) ?>
            </div>

            <div class="form-group">
                <?= $form->field($personal, 'nombcompleto')->textInput(['maxlength' => true,'placeholder'=>'Nombre completo']) ?>
            </div>

            <div class="form-group">
            	<?= $form->field($personal,'sexo')->radioList(
            		['M'=>'Masculino','F'=>'Femenino']
            	)?>
            </div>

            <div class="form-group">
                <?= $form->field($personal, 'fkuser')->dropDownList(
                    ArrayHelper::map($userdepart,'iduser','username'),
                    ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                )?>
            </div>

            <div class="form-group">
                <?= $form->field($personal,'fkdepart')->dropDownList(
                    ArrayHelper::map($departamento, 'iddepart', 'nombdepart'),
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

<script type="text/javascript">
    const number = document.getElementById('cedula');
    //const number = document.querySelector('.cedula');

    function formatNumber (n) {
        n = String(n).replace(/\D/g, "");
        return n === '' ? n : Number(n).toLocaleString();
    }

    if(typeof number !== null){
        number.addEventListener('keyup', (e) => {
            const element = e.target;
            const value = element.value;
            element.value = formatNumber(value);
        });
    }
</script>
