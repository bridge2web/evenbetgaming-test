<?php
namespace app\controllers;

use yii\rest\ActiveController;

class DishController extends ActiveController
{
    public $modelClass = 'app\models\Dish';
}