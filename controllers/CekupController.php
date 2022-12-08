<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Mcekup;
use app\models\Mxlink_cekup;

class CekupController extends Controller
{
	public function getCekupListx(){
		$val = ['aa' => 123456];
		return $val;
	}	

	public function actionTes(){
		// echo "tes"; 
		$c = $this->getCekupList();
		// print_r($c);
		exit(json_encode($c));
		// exit('OKE');
		// return "tes";
	}

	public function actionTesdb($id){
		$ce = Mcekup::getIdPeserta($id);
		// $c = $this->getCekupList();
		// var_dump($ce);
		exit(json_encode($ce));
	}

	public function actionIdpeserta($id){
		$Mcekup = new Mcekup;
		$px = $Mcekup->getIdPeserta($id);
		// $c = $this->getCekupList();
		// var_dump($ce);
		exit(json_encode($px));
	}

	// http://192.168.1.68/rscm/simrsnew/web/index.php?r=cekup/get_mst_pasien_by_norm&norm=115428
	public function actionGet_mst_pasien_by_norm($norm){
		$Mxlink_cekup = new Mxlink_cekup;
		$px = $Mxlink_cekup->getPxCekup($norm);
		// $c = $this->getCekupList();
		// var_dump($ce);
		exit(json_encode($px));
	}

	public function actionInsertget($id=null, $nama=null){
		// echo $id.' _ '.$nama; exit;
		$dataIns = [
			"id" 		=> $id, 
			"nama" 	=> $nama, 
			"bagian"=> "", 
			"tgllahir" => "1994-01-01", 
			"status"=> "", 
			"sex" 	=> "", 
			"perusahaan" => ""
		];
		echo "<pre>",print_r($dataIns),"</pre>";

		$Mcekup = new Mcekup;
		$ins = $Mcekup->insertPeserta($dataIns);
		// $ins = $Mcekup->insertPesertaInsecure($dataIns);
		var_dump($ins);
		// exit(json_encode($px));
	}

	private $con = "xyz";
	public function actionAttr($id){
		$mc = new Mcekup;
		echo $mc->ckp."<br>";
		echo $this->con."<br>";
		echo print_r($mc->getIdPeserta($id))."<br>";
		echo $mc->getIdPeserta($id)['nama'];
	}

	public function actionGetall(){
		$ce = Mcekup::getAll();
		// $c = $this->getCekupList();
		// var_dump($ce);
		exit(json_encode($ce));
	}

	public function actionTesid($id=null){
		echo 'id='.$id;
	}

	public function actionFormInsert(){
        return $this->render('form-insert');
    }
}