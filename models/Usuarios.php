<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Usuarios extends ActiveRecord{
// el siguiente metodo es estatico para incluir la BD
	public static function getDb()// con este metodo incluimos la connection a la BD
	{
		return Yii::$app->db;
	}

	public static function tableName()// con este metodo incluimos la tabla de la BD 
	{
		return 'usuarios';
	}


}


