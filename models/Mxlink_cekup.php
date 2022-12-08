<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Mxlink_cekup extends Model
{	
	public function getPxCekup($norm){
    $command = Yii::$app->db->createCommand('SELECT * FROM fomstpasien WHERE NoRM=:norm')
    	->bindValue(':norm',$norm);
    $res = $command->queryOne();
    return $res;
	}
}