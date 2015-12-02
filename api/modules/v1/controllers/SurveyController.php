<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use Yii;


class SurveyController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Survey';    

	
	public function actionCumplidas_hoy(){
	
    // 	 $rutasCumplidas = (new \yii\db\Query())
    //       ->select(['COUNT(*) AS cantidad'])
    //       ->from('survey')
    //       ->where('survey_date = curdate() and user_id = 15')
    //       ->all();
           
        
         $rutasCumplidas = Yii::$app->db->createCommand('SELECT count(distinct client_id) as cantidad 
                                                        FROM survey 
                                                        where survey_date = curdate() and user_id = 15')->queryAll();
        
        return $rutasCumplidas;
    
        
	}
	
	
	
	
	
	
}