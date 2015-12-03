<?php

namespace frontend\controllers;

use Yii;

class ChartsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        $surveys = \backend\models\Survey::find()->asArray()->orderBy(['order' => SORT_DESC,])->all();
        
      
        //TOTAL clientes que deberían visitar los relevadores
        // $tot_cli_para_visitar = (new \yii\db\Query())
        // ->select('user_id, COUNT(client_id)')
        // ->from('route r, routeclient rc')
        // ->where('r.route_id = rc.route_id') 
        // ->groupBy('user_id')
        // ->all();
        
        $tot_cli_para_visitar = Yii::$app->db->createCommand('SELECT user_id, count(distinct client_id, route_date) as cantidad 
                                                              FROM route group by user_id')->queryAll();
        
        //TOTAL clientes que VISITARON los relevadores
        //  $tot_cli_ya_visitaron = (new \yii\db\Query())
        // ->select('user_id, COUNT(client_id)')
        // ->from('survey ')
        // ->groupBy('user_id')
        // ->all();
        
        $tot_cli_ya_visitaron = Yii::$app->db->createCommand('SELECT user_id, count(distinct client_id, survey_date) as cantidad 
                                                              FROM survey group by user_id')->queryAll();
        
        //TOTAL de rutas asignadas
        $tot_rutas_asignadas = (new \yii\db\Query())
        ->select('*')
        ->from('route')
        ->all();
        
        
  
       //ENVIANDOUUUU...
        return $this->render('index', [
            'tot_rutas_asignadas' => $tot_rutas_asignadas,
            'tot_cli_para_visitar' => $tot_cli_para_visitar,
            'tot_cli_ya_visitaron' => $tot_cli_ya_visitaron
            
        ]);
       
    }

}
