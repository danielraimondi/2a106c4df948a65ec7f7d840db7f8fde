<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

use dektrium\user\helpers\Password;

use api\modules\v1\models\User;

use Yii;

class UserController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\User';    

    public function actionLogin(){
        
        //$user = User::find(['username'=>$_POST['username']])->one();
        
        
        
        $user = User::find()->where(['username' => ['username'=>$_POST['username']]])->one();

        if ($user){
            $loginOk = Password::validate($_POST['password'], $user->password_hash);
            if($loginOk)
                return $user->id;
        }
        
        return false;
        
    }	
}