<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Persguardiaisla */

$this->title = 'Añadir Personal Isla';
$this->params['breadcrumbs'][] = ['label' => 'Personal de guardia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="create">
    <p>
        <?= Html::a('Personal de guardia', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'persguardia' => $persguardia,
        'personal' => $personal
    ]) ?>

</div>
