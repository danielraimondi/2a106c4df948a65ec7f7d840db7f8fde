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
        ->select('s.client_id, s.prod_id, s.order, s.survey_date, c.client_name')
        ->from('survey s, client c')
        ->where('c.client_id = s.client_id')
        ->orderBy(['s.order' => SORT_DESC,])
        ->all();
        
        
        // Trae las 5 CANTIDADES de COMPRAS más altas de todos los clientes o sea los que compraron más veces sin importar la cantidad de productos
         $cantPedidos = (new \yii\db\Query())
        ->select('s.client_id, COUNT(s.client_id), c.client_name')
        ->from('survey s, client c')
        ->where('s.survey_date > DATE_SUB(CURDATE(), INTERVAL 20 DAY) AND c.client_id = s.client_id and s.order > 0')  //SELECIONA cuantos días atrás se ve !! --<<<--<-<---<<<
        ->groupBy('s.client_id')
        ->orderBy(['s.order' => SORT_DESC,])
        ->all();
        
        
        // Trae todos los clientes que realizaron alguna compra
        $tot_cli = (new \yii\db\Query())
        ->select('client_id, client_name')
        ->from('client')
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
        
        // //TOTAL clientes que VISITARON los relevadores
        //  $tot_cli_ya_visitaron = (new \yii\db\Query())
        // ->select('user_id, COUNT(client_id)')
        // ->from('survey ')
        // ->groupBy('user_id')
        // ->all();
        
        
        $tot_cli_ya_visitaron = Yii::$app->db->createCommand('SELECT user_id, count(distinct client_id, survey_date) as cantidad 
                                                              FROM survey group by user_id')->queryAll();
                                                              
                                                              
        
  
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
