<?php
namespace app\controllers;

use app\models\DishOrder;
use Yii;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\ConflictHttpException;

class OrderController extends ActiveController
{
    public $modelClass = 'app\models\Order';

    public function actionAddDish($id, $dishId) {
        if (DishOrder::find()->where(['order_id' => $id, 'dish_id' => $dishId])->exists()) throw new ConflictHttpException('Dish already added');
        $dishOrder = new DishOrder();
        $dishOrder->order_id = $id;
        $dishOrder->dish_id = $dishId;
        if (!$dishOrder->save()) {
            throw new BadRequestHttpException('Validation error');
        } 
        return $dishOrder;
    }
}