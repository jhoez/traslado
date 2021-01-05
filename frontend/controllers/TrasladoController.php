<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Persguardiaisla;
use frontend\models\PersguardiaislaSearch;
use frontend\models\Departamento;
use frontend\models\Hospedaje;
use frontend\models\Habitacion;
use frontend\models\Personal;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\HtmlPurifier;

/**
 * PersguardiaislaController implements the CRUD actions for Persguardiaisla model.
 */
class TrasladoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Persguardiaisla models.
     * @return mixed
     */
    public function actionIndex()
    {
        $habitacion = new Habitacion;
        $numhab = Habitacion::find()->one();
        $searchModel = new PersguardiaislaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->user->can('secretariogg')) {
            $dataProvider->query->where(['status'=>false]);
        }

        if (Yii::$app->user->can('personal')) {
            $dataProvider->query->where(['fkuser'=>Yii::$app->user->identity->iduser]);
        }

        if (Yii::$app->user->can('isla')) {
            $dataProvider->query->where(['status'=>true]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'habitacion' => $habitacion,
            'numhab' => $numhab
        ]);
    }

    /**
     * Lista de todo el personal de guardia Aceptado.
     * @return mixed
     */
    public function actionIndexpa()
    {
        $personal = Personal::find()->where(['fkuser'=>Yii::$app->user->identity->iduser])->all();
        $habitacion = new Habitacion;
        $numhab = Habitacion::find()->one();
        $searchModel = new PersguardiaislaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['status'=>true]);

        return $this->render('indexpa', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'habitacion' => $habitacion,
            'numhab' => $numhab
        ]);
    }

    /**
     * Displays a single Persguardiaisla model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $purifier = new HtmlPurifier;
        $param = [];
        foreach (Yii::$app->request->get('param') as $key => $value) {
            $param[$key] = $purifier->process($value);
        }
        $persguardia = Persguardiaisla::find()->where([
            'fcarga'=>date('Y-m-d'),
            'idpersgi'=>$param,
        ])->all();
        return $this->render('view', [
            'persguardia' => $persguardia,
        ]);
    }

    /**
     * Displays a single Persguardiaisla model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView2()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );

        $persguardia = Persguardiaisla::find()->where([
            'fcarga'=>date('Y-m-d'),
            'idpersgi'=>$param,
        ])->one();
        return $this->render('view2', [
            'persguardia' => $persguardia,
        ]);
    }

    /**
     * Creates a new Persguardiaisla model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $guardia = null;
        $aux = null;
        $personal = Personal::find()->where(['fkuser'=>Yii::$app->user->identity->iduser])->all();
        $persguardia = new Persguardiaisla();

        if ( $persguardia->load(Yii::$app->request->post()) ) {
            //if ( $persguardia->validate() ) {
                $result = null;
                for($i=0; $i < count($persguardia->fkpers);$i++) {
                    if ($persguardia->fkpers[$i] != '') {
                        $result[] = Persguardiaisla::find()->where(['fcarga'=>date('Y-m-d'),'fkpers'=>$persguardia->fkpers[$i]])->one();
                        if ( $result[$i] !== null ) {
                            Yii::$app->session->setFlash('error',"Ya Existe el trabajador que intente registrar!!");
                            return $this->redirect(['create']);
                        }
                    }
                }
                //echo "<pre>";var_dump($result);die;
                for($i=0; $i < count($persguardia->fkpers);$i++) {
                    if ($persguardia->fkpers[$i] != '') {
                        $guardia = new Persguardiaisla;
                        $guardia->fkpers = $persguardia->fkpers[$i];
                        $guardia->fkuser = Yii::$app->user->identity->getId();
                        $guardia->fkdepart = Yii::$app->user->identity->fkdepart;
                        $guardia->actividad = $persguardia->actividad[$i];
                        $guardia->fcarga = $persguardia->fcarga;
                        $guardia->fingreso = $persguardia->fingreso[$i];
                        $guardia->fegreso = $persguardia->fegreso[$i];
                        $guardia->tippers = $persguardia->tippers[$i];
                        if( $guardia->save() ){
                            $aux[] = $guardia->idpersgi;
                            unset($guardia);
                        }
                    }
                }
                return $this->redirect(['view', 'param' => $aux]);
            //}
        }

        return $this->render('create', [
            'persguardia' => $persguardia,
            'personal' => $personal
        ]);
    }

    /**
     * Updates an existing Persguardiaisla model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $persguardia = Persguardiaisla::find()->where(['idpersgi'=>$param])->one();
        $hospedaje = $persguardia->fkhosp != null ?
                    Hospedaje::find()->where(['idhosp'=>$persguardia->fkhosp])->one() :
                    new Hospedaje;

        if ( $hospedaje->load(Yii::$app->request->post()) ) {
            if ( $hospedaje->save() ) {
                $persguardia->fkhosp = $hospedaje->idhosp;
                if ( $persguardia->save() ) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'persguardia' => $persguardia,
            'hospedaje' => $hospedaje
        ]);
    }

    /**
    *
    */
    public function actionUpdatestatus()
    {
        $purifier = new HtmlPurifier;
        $param = [];
        $habitacion = Habitacion::find()->one();

        if ( $habitacion === null) {
            Yii::$app->session->setFlash('error','No hay habitaciones cargada para realizar este procedimiento!!');
            return $this->redirect(['index']);
        }

        foreach ( Yii::$app->request->get() as $key => $value) {
            $param[$key] = $purifier->process($value);
        }

        $persguardiaisla = Persguardiaisla::find()->where(['idpersgi'=>$param['id']])->one();

        $param['param'] == 's' ? $persguardiaisla->status = true : $persguardiaisla->status = false;
        $persguardiaisla->getpers()->sexo == 'M' && $persguardiaisla->status == true ?
        $habitacion->habhombres -= 1 : '';
        $persguardiaisla->getpers()->sexo == 'F' && $persguardiaisla->status == true ?
        $habitacion->habmujeres -= 1 : '';

        $persguardiaisla->getpers()->sexo == 'M' && $persguardiaisla->status == false ?
        $habitacion->habhombres += 1 : '';
        $persguardiaisla->getpers()->sexo == 'F' && $persguardiaisla->status == false ?
        $habitacion->habmujeres += 1 : '';
        $habitacion->save();

        if ( $persguardiaisla->save() ) {
            if ($param['param'] == 's'){
                Yii::$app->session->setFlash('success',"Aceptado: ".$persguardiaisla->getpers()->nombcompleto);
            }else if ($param['param'] == 'n'){
                Yii::$app->session->setFlash('error',"No Aceptado: ".$persguardiaisla->getpers()->nombcompleto);
            }
            return $this->redirect(['index']);
        }else {
            Yii::$app->session->setFlash('error','No se actualizo el status');
            return $this->redirect(['index']);
        }

    }

    /**
    *
    */
    public function actionNumhab()
    {
        $habitacion = new Habitacion;

        if ( $habitacion->load(Yii::$app->request->post()) ) {
            if ( $habitacion->validate() ) {
                if ( $habitacion->save() ) {
                    Yii::$app->session->setFlash('success','Cantidad de habitaciones por hombres y mujeres cargada!!');
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('numhab',[
            'habitacion'=>$habitacion
        ]);
    }

    /**
     * Deletes an existing Persguardiaisla model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Persguardiaisla model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Persguardiaisla the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Persguardiaisla::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
