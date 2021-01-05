<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Persexterno */

$this->title = 'Actualizar Invitado: ' . $invitado->nombcompleto;
$this->params['breadcrumbs'][] = ['label' => 'Invitados', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="persupdate">
    <p>
        <?=Html::a('Invitados',['index'],['class'=>'btn btn-primary']); ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <!-- nota colocar otra vista para actualizar todo solo si es superadmin -->
    <?= $this->render('_formis', [
        'invitado' => $invitado,
        'hospedaje' => $hospedaje
    ]) ?>

</div>
