<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "gt.habitacion".
 *
 * @property int $idhab
 * @property int|null $habhombres
 * @property int|null $habmujeres
 */
class Habitacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt.habitacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['habhombres', 'habmujeres'], 'default', 'value' => null],
            [['habhombres', 'habmujeres'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idhab' => 'Idhab',
            'habhombres' => 'Cantidad Hombres',
            'habmujeres' => 'Cantidad Mujeres',
        ];
    }
}
