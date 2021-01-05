<?php

[
    'class' => 'yii\grid\ActionColumn',
    'header'=>'Acción',
    'headerOptions'=>['width'=>'30'],
    'template'=>'{marcar}',
    'buttons'=> [
        'marcar' => function($url,$model,$key){
            return ButtonDropdown::widget([
                'encodeLabel'=>false,
                'label'=>'',
                'dropdown'=>[
                    'encodeLabels'=>false,
                    'items'=>[
                        [
                            'label'=>Html::img('@web/fonts/si.svg'),
                            'url'=>['marcarstatus','id'=>$key,'param'=>'s']
                        ],
                        [
                            'label'=>Html::img('@web/fonts/no.svg'),
                            'url'=>['marcarstatus','id'=>$key,'param'=>'n']
                            )
                        ]
                    ],
                    'options'=>[
                        'class'=>'dropdown-menu-right'
                    ],
                ],
                'options'=>[
                    'class'=>'btn-primary'
                ],
                'split'=>false
            ]);
        },
    ],
],

?>
