<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

class RouteController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Route';    

	

    
    public function actionClientes(){
	    
	    $user_id = $_GET["user_id"];
	    $clientes = (new \yii\db\Query())
	        ->select('*')
            ->from('route r, client c, routeclient rc ')
            ->where('r.route_id=rc.route_id and c.client_id=rc.client_id and route_date=curdate() and r.user_id='.$user_id)    //  Hardcodeado en el usuario 1 hasta poder obtener el usuario de la app movil
            ->all();
        
        return $clientes;
        
    }
    
    
    
    
}