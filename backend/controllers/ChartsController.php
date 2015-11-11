<?php

namespace backend\controllers;

use Yii;
use backend\models\chart_Survey;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ChartsController extends Controller
{
    public function actionIndex()
    {
        
        $query = chart_Survey::find();
        
        
        // Trae las 5 COMPRAS más altas de todos los clientes
        $tops = (new \yii\db\Query())
        ->select('client_id, prod_id, order, survey_date')
        ->from('survey')
        ->orderBy(['order' => SORT_DESC,])
        ->limit(5)
        ->all();
        
        
        // Trae las 5 CANTIDADES de COMPRAS más altas de todos los clientes o sea los que compraron más veces sin importar la cantidad de productos
         $cantPedidos = (new \yii\db\Query())
        ->select('client_id, COUNT(client_id)')
        ->from('survey')
        ->where('survey_date > DATE_SUB(CURDATE(), INTERVAL 300 DAY)')
        ->groupBy('client_id')
        ->all();
        
        
    
        
        
        
       
        return $this->render('index', [
            'tops' => $tops,'cantPedidos' => $cantPedidos,
           
        ]);
        
        
        /*//-------------- cantidad de pedidos de los últimos 10 días
        
        
        SELECT  `client_id` , COUNT(  `client_id` ) 
        FROM  `survey` 
        WHERE  `survey_date` > DATE_SUB( CURDATE( ) , INTERVAL 50 DAY ) 
        GROUP BY  `client_id`
        
        
        client_id    COUNT( `client_id` )
            1            3
            7            1

        
        //--------------*/
        
        
        
        
            
        /*
        $id_selected = $_POST['id_selected'];
        
        if ($id_selected == null){
            $id_selected = 1;
        }
        //Trae las 3 COMPRAS más altas de un cliente  $client
        $query = (new \yii\db\Query())
        ->select('client_id, prod_id, order')
        ->from('survey')
        ->where('client_id=:id', array(':id'=>$id_selected))
        ->orderBy(['order' => SORT_DESC,])
        ->limit(3);
        // Crea un commando
        $command = $query->createCommand();
        // Ejecuta el commando
        $rows = $command->queryAll(); //TRAE un array con los datos
       // echo json_encode($rows);
       */ 
       
       
       
       
       
          //return $this->render('index');
    }
    
    
    /*
     protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }*/
    
    
      /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
     
     /*
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/
    
}
