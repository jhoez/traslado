<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usuario */

$this->title = $usuario->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuario-view">
    <p>
        <?= Html::a('Usuarios', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $usuario,
        'attributes' => [
            [
                'label'=>'Usuario',
                'attribute'=>'username',
                'value'=>function($data){
                    return $data->username;
                }
            ],
            [
                'label'=>'Llave de autenticación',
                'attribute'=>'auth_key',
                'value'=>function($data){
                    return $data->auth_key;
                }
            ],
            [
                'label'=>'Contraseña',
                'attribute'=>'password',
                'value'=>function($data){
                    return $data->password;
                }
            ],
            [
                'label'=>'Password reset de token',
                'attribute'=>'password',
                'value'=>function($data){
                    return $data->password;
                }
            ],
            [
                'label'=>'Correo',
                'attribute'=>'email',
                'value'=>function($data){
                    return $data->email;
                }
            ],
            [
                'label'=>'Status',
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->status === 1 ? 'Activo' : 'Inactivo';
                }
            ],
            [
                'label'=>'F. creado',
                'attribute'=>'created_at',
                'value'=>function($data){
                    return $data->created_at;
                }
            ],
            [
                'label'=>'Verificación de token',
                'attribute'=>'verification_token',
                'value'=>function($data){
                    return $data->verification_token;
                }
            ],
            [
                'label'=>'Departamento',
                'attribute'=>'nombdepart',
                'value'=>function($data){
                    return $data->getdepartamento()['nombdepart'] !== null ? $data->getdepartamento()['nombdepart'] : 'sin departamento';
                }
            ],
        ],
    ]) ?>

</div>
