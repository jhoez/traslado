<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Persexterno */

$this->title = 'Añadir Invitado';
$this->params['breadcrumbs'][] = ['label' => 'Invitados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="create">
    <?php if ( Yii::$app->user->can('superadmin') || Yii::$app->user->can('despacho') ): ?>
        <p>
            <?= Html::a('Invitados', ['index'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'invitado' => $invitado,
    ]) ?>

</div>
