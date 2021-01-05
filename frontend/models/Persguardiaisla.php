<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "gt.persguardiaisla".
 *
 * @property int $idpersgi
 * @property int|null $fkpers
 * @property int|null $fkuser
 * @property int|null $fkdepart
 * @property string|null $actividad
 * @property string|null $fcarga
 * @property string|null $fsalida
 * @property string|null $fretorno
 * @property string|null $tippers
 * @property bool|null $status
 * @property int|null $fkhosp
 */
class Persguardiaisla extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt.persguardiaisla';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkpers', 'fkuser', 'fkdepart', 'fkhosp'], 'default', 'value' => null],
            [['fkpers', 'fkuser', 'fkdepart', 'fkhosp'], 'integer'],
            [['fcarga', 'fsalida', 'fretorno'], 'safe'],
            [['status'], 'boolean'],
            [['actividad'], 'string', 'max' => 510],
            [['tippers'], 'string', 'max' => 7],
            [['fkdepart'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['fkdepart' => 'iddepart']],
            [['fkhosp'], 'exist', 'skipOnError' => true, 'targetClass' => Hospedaje::className(), 'targetAttribute' => ['fkhosp' => 'idhosp']],
            [['fkpers'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::className(), 'targetAttribute' => ['fkpers' => 'idpers']],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkuser' => 'iduser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpersgi' => 'Idpersgi',
            'fkpers' => '',
            'fkuser' => 'Usuario',
            'fkdepart' => 'Departamento',
            'actividad' => 'Actividad',
            'fcarga' => 'F registro',
            'fsalida' => 'F Ingreso',
            'fretorno' => 'F Egreso',
            'tippers' => 'Tipo de Guardia',
            'status' => 'Status',
            'fkhosp' => 'Hospedaje',
        ];
    }

    public function getguarddepart()
    {
        return $this->hasOne(Departamento::className(),['iddepart'=>'fkdepart']);
    }

    public function getguardpers()
    {
        return $this->hasOne(Personal::className(),['idpers'=>'fkpers']);
    }

    /**
    * @method obtiene el departamento asociado al personal
    */
    public function getdepart()
    {
        return Departamento::find()->where(['iddepart'=>$this->fkdepart])->one();
    }

    /**
    * @method obtiene el departamento asociado al personal
    */
    public function gethosp()
    {
        return Hospedaje::find()->where(['idhosp'=>$this->fkhosp])->one();
    }

    /**
    * @method obtiene el departamento asociado al personal
    */
    public function getpers()
    {
        return Personal::find()->where(['idpers'=>$this->fkpers])->one();
    }
}
