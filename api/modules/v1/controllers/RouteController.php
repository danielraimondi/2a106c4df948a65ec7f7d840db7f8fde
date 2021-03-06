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
            ->from('route r, client c')
            ->where('c.client_id=r.client_id and route_date=curdate() and r.user_id='.$user_id)  
            ->all();
            
        return $clientes;
        
    }
    
    public function actionPendientes(){
	    
	    $user_id = $_GET["user_id"];
	    
	    $clientes = (new \yii\db\Query())
	        ->select('*')
            ->from('route r, client c')
            ->where('not exists (select * from survey s where s.survey_date = curdate() and s.client_id = r.client_id and s.user_id = r.user_id) and c.client_id=r.client_id and route_date=curdate() and r.user_id='.$user_id)  
            ->all();
            
        return $clientes;
        
    }
    
    
    
    
}