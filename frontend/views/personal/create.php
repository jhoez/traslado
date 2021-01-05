<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Personal */

$this->title = 'Crear Personal';
$this->params['breadcrumbs'][] = ['label' => 'Personal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-create">
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
