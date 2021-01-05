<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "gt.hospedaje".
 *
 * @property int $idhosp
 * @property string|null $alojamiento
 */
class Hospedaje extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt.hospedaje';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alojamiento'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idhosp' => 'Idhosp',
            'alojamiento' => 'Alojamiento',
        ];
    }
}
