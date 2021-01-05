<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PersguardiaislaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persguardiaisla-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idpersgi') ?>

    <?= $form->field($model, 'fkpers') ?>

    <?= $form->field($model, 'fkuser') ?>

    <?= $form->field($model, 'fkdepart') ?>

    <?= $form->field($model, 'actividad') ?>

    <?php // echo $form->field($model, 'fcarga') ?>

    <?php // echo $form->field($model, 'fingreso') ?>

    <?php // echo $form->field($model, 'fegreso') ?>

    <?php // echo $form->field($model, 'tippers') ?>

    <?php // echo $form->field($model, 'sexo') ?>

    <?php // echo $form->field($model, 'status')->checkbox() ?>

    <?php // echo $form->field($model, 'fkhosp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
