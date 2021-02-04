<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "gt.persexterno".
 *
 * @property int $idinv
 * @property string|null $ci
 * @property string $nombcompleto
 * @property string $ente
 * @property string|null $actividad
 * @property string|null $fcarga
 * @property string|null $fsalida
 * @property string|null $fretorno
 * @property string|null $tippers
 * @property bool|null $status
 * @property string|null $sexo
 * @property int|null $fkhosp
 * @property int|null $fkuser
 */
class Persexterno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt.persexterno';
    }

    /**
     * {@inheritdoc}
     */
     public function rules()
     {
         return [
             [['nombcompleto', 'ente'], 'required'],
             [['fcarga', 'fsalida', 'fretorno'], 'safe'],
             [['status'], 'boolean'],
             [['fkhosp', 'fkuser'], 'default', 'value' => null],
             [['fkhosp', 'fkuser'], 'integer'],
             [['ci'], 'string', 'max' => 20],
             [['ci'],  'match', 'pattern' => '/(\.d*[0-9]{2})/','message'=>'La cedula debe contener puntos de separación!!'],
             [['nombcompleto', 'ente'], 'string', 'max' => 255],
             [['actividad'], 'string', 'max' => 510],
             [['tippers'], 'string', 'max' => 7],
             [['sexo'], 'string', 'max' => 1],
             [['fkhosp'], 'exist', 'skipOnError' => true, 'targetClass' => Hospedaje::className(), 'targetAttribute' => ['fkhosp' => 'idhosp']],
             [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkuser' => 'iduser']],
         ];
     }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idinv' => 'Idinv',
            'ci' => 'CI',
            'nombcompleto' => 'Nombre completo',
            'ente' => 'Ente',
            'actividad' => 'Actividad',
            'fcarga' => 'Fcarga',
            'fsalida' => 'Fingreso',
            'fretorno' => 'Fegreso',
            'tippers' => 'Tipo de Pers',
            'status' => 'Status',
            'sexo' => 'Sexo',
            'fkhosp' => 'Fkhosp',
            'fkuser' => 'user',
        ];
    }

    /**
    * @method obtiene el departamento asociado al personal
    */
    public function gethosp()
    {
        return Hospedaje::find()->where(['idhosp'=>$this->fkhosp])->one();
    }
}
