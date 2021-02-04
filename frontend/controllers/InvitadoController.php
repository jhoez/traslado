<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Persexterno;
use frontend\models\PersexternoSearch;
use frontend\models\Habitacion;
use frontend\models\Hospedaje;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\HtmlPurifier;

/**
 * PersexternoController implements the CRUD actions for Persexterno model.
 */
class InvitadoController extends Controller
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
     * Lists all Persexterno models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersexternoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $numhab = Habitacion::find()->one();

        if ( Yii::$app->user->can('superadmin') || Yii::$app->user->can('secretariogg')) {
            $dataProvider->query->where(['status'=>false]);
        }

        if (Yii::$app->user->can('isla')) {
            $dataProvider->query->where(['status'=>true]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'numhab' => $numhab
        ]);
    }

    /**
     * Lists all Persexterno models.
     * @return mixed
     */
    public function actionIndexia()
    {
        $searchModel = new PersexternoSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $numhab = Habitacion::find()->one();

        if ( Yii::$app->user->can('superadmin') || Yii::$app->user->can('secretariogg')) {
            $dataProvider->query->where(['status'=>true]);
        }

        if (Yii::$app->user->can('isla')) {
            $dataProvider->query->where(['status'=>true]);
        }

        return $this->render('indexia', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'numhab' => $numhab
        ]);
    }

    /**
     * Displays a single Persexterno model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $invitado = Persexterno::find()->where(['idinv'=>$param])->one();
        return $this->render('view', [
            'invitado' => $invitado,
        ]);
    }

    /**
     * Creates a new Persexterno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $invitado = new Persexterno;

        if ( $invitado->load(Yii::$app->request->post()) ) {
            if ( $invitado->validate() ) {
                $result = Persexterno::find()->where(['fcarga'=>date('Y-m-d'),'ci'=>$invitado->ci])->one();
                if ( $result !== null ) {
                    Yii::$app->session->setFlash('error',"Ya Existe el invitado que intente registrar!!");
                    return $this->redirect(['create']);
                }
                if ($invitado->save()) {
                    return $this->redirect(['view', 'id' => $invitado->idinv]);
                }
            }
        }

        return $this->render('create', [
            'invitado' => $invitado,
        ]);
    }

    /**
     * Updates an existing Persexterno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $invitado = Persexterno::find()->where(['idinv'=>$param])->one();
        $hospedaje = $invitado->fkhosp != null ?
                    Hospedaje::find()->where(['idhosp'=>$invitado->fkhosp])->one() :
                    new Hospedaje;

        if ( $hospedaje->load(Yii::$app->request->post()) ) {
            if ( $hospedaje->save() ) {
                $invitado->fkhosp = $hospedaje->idhosp;
                if ( $invitado->save() ) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'invitado' => $invitado,
            'hospedaje' => $hospedaje
        ]);
    }

    /**
     * Deletes an existing Persexterno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
    *
    */
    public function actionUpdatestatus()
    {
        $purifier = new HtmlPurifier;
        $param = [];
        $habitacion = Habitacion::find()->one();

        if ( $habitacion != null || $habitacion != [] ) {
            if ( $habitacion->habhombres === 0 && $habitacion->habmujeres === 0 ) {
                Yii::$app->session->setFlash('error','No hay habitaciones disponibles!!');
                return $this->redirect(['index']);
            }

            if ( $habitacion->habhombres === 0 ) {
                Yii::$app->session->setFlash('error','No hay habitaciones disponibles para los Caballeros!!');
                return $this->redirect(['index']);
            }

            if ( $habitacion->habmujeres === 0 ) {
                Yii::$app->session->setFlash('error','No hay habitaciones disponibles para los Damas!!');
                return $this->redirect(['index']);
            }

            foreach ( Yii::$app->request->get() as $key => $value) {
                $param[$key] = $purifier->process($value);
            }

            // colocar en la tabla el sexo del trabajador
            $invitado = Persexterno::find()->where(['idinv'=>$param['id']])->one();
            if ( isset($param['param']) ){
                $param['param'] == 's' ? $invitado->status = true : $invitado->status = false;
                $invitado->sexo == 'M' && $invitado->status == true ?
                $habitacion->habhombres -= 1 : '';
                $invitado->sexo == 'F' && $invitado->status == true ?
                $habitacion->habmujeres -= 1 : '';

                $invitado->sexo == 'M' && $invitado->status == false ?
                $habitacion->habhombres += 1 : '';
                $invitado->sexo == 'F' && $invitado->status == false ?
                $habitacion->habmujeres += 1 : '';
                $habitacion->save();
            }

            if ( $invitado->save() ) {
                if ($param['param'] == 's'){
                    Yii::$app->session->setFlash('success',"Aceptado: ".$invitado->nombcompleto);
                }else if ($param['param'] == 'n'){
                    Yii::$app->session->setFlash('error',"No Aceptado: ".$invitado->nombcompleto);
                }
                return $this->redirect(['index']);
            }else {
                Yii::$app->session->setFlash('error','No se actualizo el status');
                return $this->redirect(['index']);
            }
        }else {
            Yii::$app->session->setFlash('error','No se puede realizar esta acción, No hay habitaciones disponibles!!');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Persexterno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Persexterno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Persexterno::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
