<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ValidarFormulario;// ese modelo fue add por 
use app\models\ValidarFormularioAjax;// modelo mio
use yii\widgets\ActiveForm;// se agrega para que funcione Ajax use yii\web\Response
use yii\web\Response;
use app\models\FormAlumnos;
use app\models\Alumnos;
use app\models\FormUsuarios;
use app\models\Usuarios;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */

public function actionView()
{
    $table = new Usuarios;
    $model = $table->find()->all();
    return $this->render("view",["model"=> $model]);
}


public function actionCreate()
{
    $model = new FormUsuarios; // con esto se crea la instancia es decir se crea el objeto 
    $msg = null;// seteamos esto en null para verificar cuando el registro sea guardado correctamente 
           if ($model->load(Yii::$app->request->post()))
            {
                if($model->validate())// se valida el modelo
                {// con esto es que realizamos el record en la tabla usuarios 
                    $table = new Usuarios;
                    $table->usuario = $model->usuario;// con esta forma acedemos a las columnas 
                    $table->nombre = $model->nombre;
                    $table->apellido = $model->apellido;
                    $table->dpto = $model->dpto;
                    if ($table->insert())
                    {
                        $msg = "Registros fueron guardados correctamente";
                        $model->usuario = null;
                        $model->nombre = null;
                        $model->apellido= null;
                        $model->dpto= null;
                    }
                    else
                    {
                        $msg = "Ha ocurrido un error al insertar los datos";// error al validar el modelo
                    }
                }
                else
                {
                    $model->getErrors();// se muestra el mensaje de error del modelo validado
                }
    }
    return $this->render("create", ['model'=> $model, 'msg'=> $msg]);// despues de create, viene la forma de pasar los datos a la vista 
}

public function actionSaludo($get ="Estamos Preparando todo")//$get = "Vamos")    
    {
        $mensaje= "Bienvenidos al APP.CP";
        $numeros =[0,1,2,3,4,5];
        return $this->render("saludo",[
                    "mensaje"=>$mensaje,
                    "numeros"=>$numeros,
                    "get"=>$get,
                ]);

    }
    public function actionFormulario($mensaje = null)
    {
        return $this->render("formulario",["mensaje"=>$mensaje]);
    }
    public function actionRequest()
    {
        $mensaje = null;
        if (isset($_REQUEST["nombre"]))
        {
            $mensaje =  "Gracias por enviar tu nombre de forma correcta: " . $_REQUEST["nombre"];        }   
         $this->redirect(["site/formulario","mensaje"=>$mensaje]);        
    }

    public function actionValidarformulario()
    {
        $model = new ValidarFormulario;
        if ($model->load(Yii::$app->request->post()))
            {
                if ($model->validate())
                {
                    // Ejemplo:consultar bd 
                }
                else
                {
                    $model->getErrors();
                    }
                 }
        return $this->render("validarformulario",["model"=>$model]);
    }    

    public function actionValidarformularioajax()
    {
        $model = new ValidarformularioAjax; // ESTO ES PARA INSTANCIAR EL MODELO CREADO
        $msg = null;        
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)// comprobamos metodo que sea post 
        {
            Yii::$app->response->format=Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()))
            {
                if($model->validate())
                {
                    // por ejemplo consultar bd
                    $msg="Formulario Enviado correctamente";
                    $model->nombre=null;
                    $model->email=null;
                } 
                else
                {
                    $model->getErrors();
                }

            }

        return $this->render("Validarformularioajax",['model'=>$model,'msg'=>$msg]);
    }
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
