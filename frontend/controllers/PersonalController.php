<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Personal;
use frontend\models\PersonalSearch;
use frontend\models\Departamento;
use frontend\models\Usuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\HtmlPurifier;

/**
 * PersonalController implements the CRUD actions for Personal model.
 */
class PersonalController extends Controller
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
     * Lists all Personal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Personal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $personal = Personal::find()->where(['idpers'=>$param])->one();

        return $this->render('view', [
            'personal' => $personal,
        ]);
    }

    /**
     * Creates a new Personal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $personal = new Personal;
        $userdepart = Usuario::find()->where(['!=','fkdepart',0])->all();
        $departamento = Departamento::find()->all();

        if ( $personal->load(Yii::$app->request->post()) ) {
            if ($personal->validate()) {
                if ( $personal->save() ) {
                    return $this->redirect(['view', 'id' => $personal->idpers]);
                }
            }
        }

        return $this->render('create', [
            'personal' => $personal,
            'userdepart' => $userdepart,
            'departamento' => $departamento
        ]);
    }

    /**
     * Updates an existing Personal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $personal= Personal::find()->where(['idpers'=>$param])->one();
        $userdepart = Usuario::find()->where(['!=','fkdepart',0])->all();
        $departamento = Departamento::find()->all();

        if ( $personal->load(Yii::$app->request->post()) ) {
            if ( $personal->validate() ) {
                if ($personal->save()) {
                    return $this->redirect(['view', 'id' => $personal->idpers]);
                }
            }
        }

        return $this->render('update', [
            'personal' => $personal,
            'userdepart' => $userdepart,
            'departamento' => $departamento
        ]);
    }

    /**
     * Deletes an existing Personal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $purifier = new HtmlPurifier;
        $param = $purifier->process( Yii::$app->request->get('id') );
        $this->findModel($param)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Personal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Personal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Personal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
