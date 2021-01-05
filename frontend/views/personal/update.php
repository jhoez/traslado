<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Personal */

$this->title = 'Actualizar Personal: ' . $personal->nombcompleto;
$this->params['breadcrumbs'][] = ['label' => 'Personal', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="persupdate">
    <p>
        <?= Html::a('Personal', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'personal' => $personal,
        'userdepart' => $userdepart,
        'departamento' => $departamento
    ]) ?>

</div>
