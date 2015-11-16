<?php

namespace backend\controllers;

use Yii;
use backend\models\Survey;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ChartsController extends Controller
{
    public function actionIndex()
    {
        
      
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
        ->where('survey_date > DATE_SUB(CURDATE(), INTERVAL 200 DAY)')  //SELECIONA cuantos días atrás se ve !! --<<<--<-<---<<<
        ->groupBy('client_id')
        ->all();
        
        
        // Trae todos los clientes que realizaron alguna compra
        $tot_cli = (new \yii\db\Query())
        ->select('client_id')
        ->from('survey')
        ->distinct(true)
        ->all();
        
// Trae los CLIENTES ordenados de menor a mayor con las ordenes de mayor a menor
        $tops1 = (new \yii\db\Query())
        ->select('client_id, prod_id, order, survey_date')
        ->from('survey')
        ->orderBy( ['client_id'=>SORT_ASC, 'order' => SORT_DESC,])
        ->all();
        
        
        
   // Trae todos los datos del cliente seleccionado

      $cli = 1;
    
        $cli_sleccionado = (new \yii\db\Query())
        ->select('client_id, prod_id, order, survey_date')
        ->from('survey')
        ->where('client_id=:id',array(':id'=>$cli)) //CARGO el cliente seleccinado
        ->orderBy( ['client_id'=>SORT_ASC, 'order' => SORT_DESC,])
        ->all();
        
        
       //ENVIANDOUUUU...
        return $this->render('index', [
            'tops' => $tops,
            'cantPedidos' => $cantPedidos, 
            'tot_cli' => $tot_cli, 
            'var' => $var, 
            'tops1' => $tops1,
            'tot_cli' => $tot_cli,
            'cli_sleccionado' => $cli_sleccionado,
            'surveys'=> $surveys
           
        ]);
        
    }
    
    
   }
