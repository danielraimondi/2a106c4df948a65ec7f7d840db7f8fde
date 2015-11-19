<?php

namespace backend\controllers;

use Yii;

use backend\models\User;
use backend\models\Route;
use backend\models\Client;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class AutorouteController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        if (!Yii::$app->user->identity->isAdmin)
            return $this->redirect('../../frontend/web');
            
        else{
            
        //TODOS los Relevadores
         $tot_rel = (new \yii\db\Query())
        ->select('id, user_lat, user_lng, user_radius')
        ->from('user')
        ->orderBy(['id' => SORT_ASC,])
        ->all();
        
        
        //TODOS de Clientes
         $tot_cli = (new \yii\db\Query())
        ->select('client_id, client_lat, client_long, priority, day')
        ->from('client')
        ->orderBy(['priority' => SORT_ASC,]) //de 1  a  10
        ->all();
        
        
        return $this->render('index',[
                    'tot_rel' => $tot_rel,
                    'tot_cli' => $tot_cli
                    ]);
        }
    }

}
