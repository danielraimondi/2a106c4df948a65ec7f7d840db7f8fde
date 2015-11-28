<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;


class SurveyController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Survey';    

	
	public function actionCumplidas_hoy(){
	
    	 $rutasCumplidas = (new \yii\db\Query())
          ->select(['COUNT(*) AS cantidad'])
          ->from('survey')
          ->where('survey_date = curdate() and user_id = 1')
          ->all();
           
        return $rutasCumplidas;
    
    // $tot_cli_ya_visitaron = (new \yii\db\Query())
    //     ->select('user_id, COUNT(client_id)')
    //     ->from('survey ')
    //     ->groupBy('user_id')
    //     ->all();
    
    // return $tot_cli_ya_visitaron;
    
    
        
	}
	
	
	
	
}