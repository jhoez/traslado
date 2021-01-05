<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Persguardiaisla */

$this->title = 'Actualizar: ' . $persguardia->getpers()->nombcompleto;
$this->params['breadcrumbs'][] = ['label' => 'Personal de guardia', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="update">
    <p>
        <?= Html::a('Personal de guardia', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formis', [
        'persguardia' => $persguardia,
        'hospedaje'=>$hospedaje
    ]) ?>

</div>
