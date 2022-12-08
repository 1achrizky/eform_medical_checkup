<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Mcekup extends Model
{

	protected $clist = "xcekuplist";
	// public $ckp = "cekuplist";

	public function getAll(){
		$res = Yii::$app->db->createCommand('SELECT * FROM cekuplist')
           ->queryAll();
        return $res;
	}

	public static $a = "OKE";
	public function getIdPeserta($id){
		// // return $this->_cekuplist;
		// $cek = $this->a;
		// return $cek;

		// $res = Yii::$app->db->createCommand('SELECT * FROM cekuplist WHERE Id='.$id)->queryOne();
		// return $res;

		// $res = Yii::$app->db->createCommand('SELECT * FROM '.$this->clist.' WHERE Id='.$id)->queryOne();
		// return $res;

		// return $this->clist; 
		// return [$this->cekuplist];

    $command = Yii::$app->db->createCommand('SELECT * FROM '.$this->clist.' WHERE Id=:id')
    	// ->bindValue(':tbl', $this->clist)
    	// ->bindValue(':tbl', '')
    	->bindValue(':id',$id);
    $res = $command->queryOne();
    return $res;
	}

	
	// TES SQL INJECTION
	// http://192.168.1.68/riz/belajaryii/basic2/web/index.php?r=cekup/insertget&id=2'&nama=okk'
	// http://192.168.1.68/riz/belajaryii/basic2/web/index.php?r=cekup/insertget&id=2%27&nama=okk%27
	// result: OK, SUKSES. TERINSERT
	public function insertPeserta($data=null){
    $res = Yii::$app->db->createCommand('INSERT INTO '.$this->clist.' (Id, nama, bagian, tgllahir, status, sex, perusahaan) VALUES(:Id, :nama, :bagian, :tgllahir, :status, :sex, :perusahaan)')
    ->bindValue(':Id', $data['id'])
    ->bindValue(':nama', $data['nama'])
    ->bindValue(':bagian', $data['bagian'])
    ->bindValue(':tgllahir', $data['tgllahir'])
    ->bindValue(':status', $data['status'])
    ->bindValue(':sex', $data['sex'])
    ->bindValue(':perusahaan', $data['perusahaan'])
    ->execute();
    return $res;
	}


	// // TES SQL INJECTION
	// // http://192.168.1.68/riz/belajaryii/basic2/web/index.php?r=cekup/insertget&id=2%27&nama=okk%27
	// // result: muncul error. tidak terinsert
	// public function insertPesertaInsecure($data=null){
	// 	// TIDAK AMAN
 //    $res = Yii::$app->db->createCommand("INSERT INTO ".$this->clist." (Id, nama, bagian, tgllahir, status, sex, perusahaan) VALUES('".$data['id']."', '".$data['nama']."', '".$data['bagian']."', '".$data['tgllahir']."', '".$data['status']."', '".$data['sex']."', '".$data['perusahaan']."')")
 //    ->execute();
 //    return $res;
	// }

	public function updatePeserta($data=null){
    // belum
		// $res = Yii::$app->db->createCommand()->update('cekuplist', ['Id' => ':Id'], 'age > :minAge', [':minAge' => $minAge])->execute();
		$set = [
			'nama' => ':nama',
			'bagian' => ':bagian',

		];
		$res = Yii::$app->db->createCommand()->update('cekuplist', $set, 'Id = :Id', [':Id' => $data['id']])->execute();
    return $res;
	}

	public function deletePeserta($id){
    $status = 0;
		$res = Yii::$app->db->createCommand()->delete('cekuplist', 'Id = :Id', [':Id' => $id])->execute();
    return $res;
	}
}