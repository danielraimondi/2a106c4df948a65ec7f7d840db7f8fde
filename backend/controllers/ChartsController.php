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
        
        
        $tops = $query->limit(5)
        ->orderBy(['order' => SORT_DESC,])
        ->all();
       
        return $this->render('index', [
            'tops' => $tops,
           
        ]);
        
        
            
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
    
}
