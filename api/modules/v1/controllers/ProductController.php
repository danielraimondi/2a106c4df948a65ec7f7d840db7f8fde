<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

use api\modules\v1\models\Product;

class ProductController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Product';    
    
    /*
    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);

        return $actions;
    }
	public function actionIndex(){
	    
	    $productos = Product::find()->all();
	    
	    $resultado = new \stdClass;
	    
        $datos = [];
	    foreach ($productos as $key=>$producto):
	        
	        $datos[$key][] = $producto->attributes['prod_id'];
	        $datos[$key][] = $producto->attributes['prod_name'];
	        $datos[$key][] = $producto->attributes['cat_id'];
	        $datos[$key][] = $producto->attributes['prod_id'];
	    
	    endforeach; 
	    
	    $resultado->data = $datos;
	    
	    return $resultado;

	}
	*/
	
		public function actionVer(){
	    
	    $productos = Product::find()->all();
	    
	    $resultado = new \stdClass;
	    
        $datos = [];
	    foreach ($productos as $key=>$producto):
	        
	        $datos[$key][] = $producto->attributes['prod_id'];
	        $datos[$key][] = $producto->attributes['prod_name'];
	        $datos[$key][] = $producto->attributes['cat_id'];
	        $datos[$key][] = $producto->attributes['prod_id'];
	    
	    endforeach; 
	    
	    $resultado->data = $datos;
	    
	    return $resultado;

	}
}