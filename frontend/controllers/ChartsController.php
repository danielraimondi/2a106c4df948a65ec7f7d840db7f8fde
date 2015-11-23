<?php

namespace frontend\controllers;

class ChartsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        $surveys = \backend\models\Survey::find()->asArray()->orderBy(['order' => SORT_DESC,])->all();
        
      
        //TOTAL clientes que deberían visitar los relevadores
        $tot_cli_para_visitar = (new \yii\db\Query())
        ->select('user_id, COUNT(client_id)')
        ->from('route r, routeclient rc')
        ->where('r.route_id = rc.route_id') // <<<<<<<<<---------FALTA traer EL ID del usuario logeado!!!
        ->groupBy('user_id')
        ->all();
        
        //TOTAL clientes que VISITARON los relevadores
         $tot_cli_ya_visitaron = (new \yii\db\Query())
        ->select('user_id, COUNT(client_id)')
        ->from('survey ')
        ->groupBy('user_id')
        ->all();
        
        //TOTAL de rutas asignadas
        $tot_rutas_asignadas = (new \yii\db\Query())
        ->select('user_id, COUNT(client_id)')
        ->from('survey ')
        ->groupBy('user_id')
        ->all();
        
        
  
       //ENVIANDOUUUU...
        return $this->render('index', [
           'tot_cli_para_visitar' => $tot_cli_para_visitar,
           'tot_cli_ya_visitaron' => $tot_cli_ya_visitaron
            
        ]);
       
    }

}
