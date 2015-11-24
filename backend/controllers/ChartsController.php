<?php

namespace backend\controllers;

use Yii;
use backend\models\Survey;
use backend\models\Route;
use backend\models\Routeclient;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ChartsController extends Controller
{
    public function actionIndex()
    {
     
     
     if (!Yii::$app->user->identity->isAdmin)
            return $this->redirect('../../frontend/web');
            
        else{
            
        
        
      
        // Array con todos los pedidos
        $surveys = \backend\models\Survey::find()->asArray()->orderBy(['order' => SORT_DESC,])->all();
      
        // Trae las COMPRAS más altas de todos los clientes
        $tops = (new \yii\db\Query())
        ->select('client_id, prod_id, order, survey_date')
        ->from('survey')
        ->orderBy(['order' => SORT_DESC,])
        ->all();
        
        
        // Trae las 5 CANTIDADES de COMPRAS más altas de todos los clientes o sea los que compraron más veces sin importar la cantidad de productos
         $cantPedidos = (new \yii\db\Query())
        ->select('client_id, COUNT(client_id)')
        ->from('survey')
        ->where('survey_date > DATE_SUB(CURDATE(), INTERVAL 20 DAY)')  //SELECIONA cuantos días atrás se ve !! --<<<--<-<---<<<
        ->groupBy('client_id')
        ->orderBy(['order' => SORT_ASC,])
        ->all();
        
        
        // Trae todos los clientes que realizaron alguna compra
        $tot_cli = (new \yii\db\Query())
        ->select('client_id')
        ->from('survey')
        ->distinct(true)
        ->all();
        
        // Trae todos los relevadores que visitaron a clientes
        $tot_usu = (new \yii\db\Query())
        ->select('user_id, username')
        ->from('survey s, user u')
        ->where('s.user_id = u.id')
        ->distinct(true)
        ->all();
        
        
        //TOTAL clientes que deberían visitar los relevadores
        $tot_cli_para_visitar = (new \yii\db\Query())
        ->select('user_id, COUNT(client_id)')
        ->from('route r, routeclient rc')
        ->where('r.route_id = rc.route_id')
        ->groupBy('user_id')
        ->all();
        
        //TOTAL clientes que VISITARON los relevadores
         $tot_cli_ya_visitaron = (new \yii\db\Query())
        ->select('user_id, COUNT(client_id)')
        ->from('survey ')
        ->groupBy('user_id')
        ->all();
        
  
       //ENVIANDOUUUU...
        return $this->render('index', [
            'tops' => $tops,
            'cantPedidos' => $cantPedidos, 
            'tot_cli' => $tot_cli, 
            'var' => $var, 
           'tot_cli' => $tot_cli,
           'tot_usu' => $tot_usu,
           'tot_cli_para_visitar' => $tot_cli_para_visitar,
           'tot_cli_ya_visitaron' => $tot_cli_ya_visitaron,
            'surveys'=> $surveys
           
        ]);
        
    
        }
        }
    
    
   }
