<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "comedor.personal".
 *
 * @property int $idpers
 * @property string|null $ci
 * @property string|null $nombcompleto
 * @property string|null $sexo
 * @property int|null $fkuser
 * @property int|null $fkdepart
 */
class Personal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt.personal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ci','nombcompleto','sexo','fkuser','fkdepart'],  'required'],
            [['fkuser', 'fkdepart'], 'default', 'value' => null],
            [['fkuser', 'fkdepart'], 'integer'],
            [['ci'],  'match', 'pattern' => '/(\.d*[0-9]{2})/','message'=>'La cedula debe contener puntos de separación!!'],
            [['nombcompleto'], 'string', 'max' => 255],
            [['sexo'], function($attribute,$param){
                if (is_array($attribute)) {
                    $this->addError($attribute,'No coincide el tipo de dato!!');
                }else{
                    $this->sexo = $this->sexo[0];
                }
            }],
            [['fkdepart'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['fkdepart' => 'iddepart']],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkuser' => 'iduser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpers' => 'Id',
            'ci' => 'Cedula',
            'nombcompleto' => 'Nombre completo',
            'sexo' => 'Sexo',
            'fkuser' => 'Usuario',
            'fkdepart' => 'Departamento',
        ];
    }

    public function getpersdepart()
    {
        return Departamento::find()->where(['iddepart'=>$this->fkdepart])->one();
    }

    public function getpersdepartamento()
    {
        return $this->hasOne(Departamento::className(),['iddepart'=>'fkdepart']);
    }
}
