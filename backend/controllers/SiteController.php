<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use dektrium\user\Finder;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /** @var Finder */
    protected $finder;
    /**
     * @inheritdoc
     */
    
    /**
     * @param string $id
     * @param \yii\base\Module $module
     * @param Finder $finder
     * @param array $config
     */
    public function __construct($id, $module, Finder $finder, $config = [])
    {
        $this->finder = $finder;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'logout'],
                        'allow' => true,
                    ],
                    [
                        //'actions' => ['logout', 'index'],
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        // 'matchCallback' => function ($rule) {
                        //     return Yii::$app->user->identity->isAdmin;
                        // },
                        // 'denyCallback' => function ($rule) {
                        //      return $this->redirect('../../frontend/web');;
                        // },
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
        ];
    }

    public function actionIndex()
    {
        $id = Yii::$app->user->identity->id;
        $profile = $this->finder->findProfileById($id);

        if ($profile === null) {
            throw new NotFoundHttpException;
        }

        $this->view->params['profile'] = $profile;

        if (Yii::$app->user->identity->isAdmin)
            return $this->render('index');
            
        else{
            Yii::$app->user->logout();
            return $this->redirect('../../frontend/web');
        }
    }

    
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionRegister()
    {
        return $this->render('signup');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
