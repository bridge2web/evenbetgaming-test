<?php
namespace app\controllers;

use app\models\DishOrder;
use Yii;
use yii\rest\ActiveController;

class CookController extends ActiveController
{
    public $modelClass = 'app\models\Cook';

    public function actionPopular() {
        $periodFrom = Yii::$app->request->get('periodFrom') ? strtotime(Yii::$app->request->get('periodFrom')) : null;
        $periodTo = Yii::$app->request->get('periodTo') ? strtotime(Yii::$app->request->get('periodTo')) : null;

        $popularDishOrders = DishOrder::find()
        ->select(['dish_order.dish_id', 'dish.cook_id', 'dishCount' => 'COUNT(dish_order.dish_id)'])
        ->andFilterWhere(['>=', 'dish_order.created_at', $periodFrom])
        ->andFilterWhere(['<=', 'dish_order.created_at', $periodTo])
        ->joinWith(['order', 'dish'])
        ->groupBy('dish_order.dish_id')
        ->orderBy(['dishCount' => SORT_DESC])
        ->all();

        $popularCooks = [];
        foreach ($popularDishOrders as $dishOrder) {
            $popularCooks[$dishOrder->dish->cook->id] = $dishOrder->dish->cook;
        }

        $popularCooks = array_values($popularCooks);

        return $popularCooks;
    }
}