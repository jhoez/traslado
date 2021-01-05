<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Persguardiaisla */

$this->title = 'Detalles';
$this->params['breadcrumbs'][] = ['label' => 'Personal de guardia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="view">
    <p>
        <?= Html::a('Personal de guardia', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
            <tr>
              <th scope="col">Personal</th>
              <th scope="col">Departamento</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($persguardia as $clave => $valor): ?>
                <tr>
                    <td><?=$valor->getpers()->nombcompleto; ?></td>
                    <td><?=$valor->getdepart()->nombdepart; ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="<?=count($persguardia); ?>" class='text-center'>Cantidad de personal: <?=count($persguardia);?></td>
            </tr>
        </tbody>
    </table>

</div>
