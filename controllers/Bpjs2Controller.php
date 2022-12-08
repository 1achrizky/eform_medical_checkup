<?php

/*
Informasi Consid Vclaim Tester pengembangan WS Vclaim 2.0
Kode RS : 0195R028
Nama RS : RS Citra Medika
Consumer ID : 16141
Consumer Secret : 8uG8E36B37
User Key : 51fdad8f2d96176adbb736406c1e67dc
Masa berlaku : 31 Januari 2022


1. Untuk melihat catalog WS Vclaim 2.0 dapat melakukan pendaftaran melalui BPJS Trust Mark dengan link berikut ini : https://trustmark.bpjs-kesehatan.go.id/trustmark
2. setelah melakukan pendaftaran bisa konfirmasi alamat email ke Milla IT untuk dilakukan verifikasi dan persetujuan user. terimakasih
*/

namespace app\controllers;

use Yii;
// use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;
use app\common\helpers\Sitehelper;
use app\common\libraries\Ws2bpjs;
// use yii\web\Response;
// use yii\filters\VerbFilter;
// use app\models\LoginForm;

// use linslin\yii2\curl;

class Bpjs2Controller extends Controller{
	private $Ws2bpjs;
	private $baseUrlBpjs;

	// SOLUTION
	// https://stackoverflow.com/questions/31771386/yii2-how-can-i-create-constructor-in-a-controller
	public function __construct($id, $module, $config = []){
	    // \yii\helpers\VarDumper::dump([$id, $module, $config]);
	    parent::__construct($id, $module, $config);
	    $this->Ws2bpjs = new Ws2bpjs;
	    $this->baseUrlBpjs = $this->Ws2bpjs->baseUrlBpjs;
	}


	
	public function actionWshead(){
		// $Ws2bpjs = new Ws2bpjs;
		exit(json_encode( [ $this->Ws2bpjs->ws_header_encript_MY() , $this->Ws2bpjs->baseUrlBpjs['vclaimdev'], Url::base(true) ] ));
		// print_r($this->Ws2bpjs['baseUrlBpjs']);
		// exit(json_encode($Ws2bpjs->ws_header_encript_MY() ));
		// echo "<pre>",print_r($this->Ws2bpjs),"</pre>";
		// echo "<pre>",print_r($this->Ws2bpjs->baseUrlBpjs),"</pre>";
	}


	// tes
	public function actionWsheader(){
		exit(json_encode($this->ws_header_encript_MY() ));
	}


	

	public function actionPeserta(){
		$get = $_GET;
		if(!isset($get['tglSep'])) $get['tglSep'] = date('Y-m-d');
		$path = 'Peserta/nokartu/'.$get['noKartu'].'/tglSEP/'.$get['tglSep'];
		// exit(json_encode([$path, $_GET] ));
		// exit(json_encode([$this->baseUrlBpjs['vclaim'].$path] ));

		$res = $this->Ws2bpjs->ws('GET', $this->baseUrlBpjs['vclaimdev'].$path); // arr

		exit(json_encode($res ));
		// var_dump($res);

		// echo $res['peserta']['noKartu'];
		// echo '<br>';
		// echo $res['peserta']['nama'];		
	}


	public function actionMultirujukan($noka=null){
		// $get = $_GET;
		// if(!isset($get['tglSep'])) $get['tglSep'] = date('Y-m-d');
		$path = 'Rujukan/List/Peserta/'.$noka;
		// echo $path; exit;
		$res = $this->Ws2bpjs->ws('GET', $this->baseUrlBpjs['vclaimdev'].$path); // arr

		exit(json_encode($res ));	
	}

	public function actionMonitoring_data_kunjungan($tgl_sep=null, $jnsPelayanan=2){
		// $get = $_GET;
		// if(!isset($get['tglSep'])) $get['tglSep'] = date('Y-m-d');
		$path = 'Monitoring/Kunjungan/Tanggal/'.$tgl_sep.'/JnsPelayanan/'.$jnsPelayanan;
		// echo $path; exit;
		$res = $this->Ws2bpjs->ws('GET', $this->baseUrlBpjs['vclaimdev'].$path); // arr

		exit(json_encode($res ));	
	}

	public function actionRefFaskes($nama=null, $jenis=1){
		$path = 'referensi/faskes/'.$nama.'/'.$jenis;
		$res = $this->Ws2bpjs->ws('GET', $this->baseUrlBpjs['vclaimdev'].$path); // arr
		exit(json_encode($res ));	
	}



	public function actionUat_sep(){
		$login = ["user"=>"rizky", "datetime"=>date('Y-m-d H:i:s')];
		echo $this->render('@app/views/layouts/header');
	}

	public function actionMain(){
		$login = ["user"=>"rizky", "datetime"=>date('Y-m-d H:i:s')];
		echo $this->render('@app/views/layouts/main');
	}

	
	public function actionCaripeserta(){
		$login = ["user"=>"rizky", "datetime"=>date('Y-m-d H:i:s')];
		// return $this->render('header', ['login' => $login,]);
		// return $this->render('headerr');

		// $this->render('..\site\bpjs2\cari_peserta');
		// return $this->render('cari_peserta');

    return $this->render('uat/vclaim/cari_peserta');
		// echo 'ok';

		// echo $this->render('@app/views/layouts/main-login');

	}


	public function actionCreateSep(){
		$login = ["user"=>"rizky", "datetime"=>date('Y-m-d H:i:s')];

    return $this->render('uat/vclaim/create-sep');
	}

	
	public function actionWs_create_sep1(){
		$create_sep_send = [
			"request"=> [
			  "t_sep"=> [
			     "noKartu"=> "0001112230666",
			     "tglSep"=> "2017-10-18",
			     "ppkPelayanan"=> "0301R001",
			     "jnsPelayanan"=> "2",
			     "klsRawat"=> "3",
			     "noMR"=> "123456",
			     "rujukan"=> [
			        "asalRujukan"=> "1",
			        "tglRujukan"=> "2017-10-17",
			        "noRujukan"=> "1234567",
			        "ppkRujukan"=> "00010001"
			     ],
			     "catatan"=> "test",
			     "diagAwal"=> "A00.1",
			     "poli"=> [
			        "tujuan"=> "INT",
			        "eksekutif"=> "0"
			     ],
			     "cob"=> [
			        "cob"=> "0"
			     ],
			     "katarak"=> [
			        "katarak"=> "0"
			     ],
			     "jaminan"=> [
			        "lakaLantas"=> "0",
			        "penjamin"=> [
			            "penjamin"=> "1",
			            "tglKejadian"=> "2018-08-06",
			            "keterangan"=> "kll",
			            "suplesi"=> [
			                "suplesi"=> "0",
			                "noSepSuplesi"=> "0301R0010718V000001",
			                "lokasiLaka"=> [
			                    "kdPropinsi"=> "03",
			                    "kdKabupaten"=> "0050",
			                    "kdKecamatan"=> "0574"
			                    ]
			            ]
			        ]
			     ],
			     "skdp"=> [
			        "noSurat"=> "000002",
			        "kodeDPJP"=> "31661"
			     ],
			     "noTelp"	=> "081919999",
			     "user"		=> "Coba Ws"
			  ]
			]
    ];
    exit(json_encode($create_sep_send ));
    // exit(json_encode($res ));

	}



	public function actionHelp(){
		// $Site = new Sitehelper::dt();
		$Site = new Sitehelper;
		echo $Site->dt();
	}

	public function actionWs_create_sep(){
		$create_sep_send = [
			"request"=> [
			  "t_sep"=> [
					"noKartu"=> "0001112230666",
					"tglSep"=> "2017-10-18", 
					"ppkPelayanan"=> "0301R001",
					"jnsPelayanan"=> "2",
					"klsRawat"=> [
					  "klsRawatHak"	=> "2",
					  "klsRawatNaik"=> "1",
					  "pembiayaan"	=> "1",
					  "penanggungJawab"	=> "Pribadi"
					],
					"noMR"=> "123456",
					"rujukan"=> [
					  "asalRujukan"=> "1",
					  "tglRujukan"=> "2017-10-17",
					  "noRujukan"=> "1234567",
					  "ppkRujukan"=> "00010001"
					],
					"catatan"=> "test",
					"diagAwal"=> "A00.1",
					"poli"=> [
					  "tujuan"=> "INT",
					  "eksekutif"=> "0"
					],
					"cob"=> [
					  "cob"=> "0"
					],
					"katarak"=> [
					  "katarak"=> "0"
					],
					"jaminan"=> [
					  "lakaLantas"=> "0",
					  "penjamin"=> [
					      "tglKejadian"=> "2018-08-06",
					      "keterangan"=> "kll",
					      "suplesi"=> [
					          "suplesi"=> "0",
					          "noSepSuplesi"=> "0301R0010718V000001",
					          "lokasiLaka"=> [
					              "kdPropinsi"=> "03",
					              "kdKabupaten"=> "0050",
					              "kdKecamatan"=> "0574"
					              ]
					      ]
					  ]
					],
					"tujuanKunj"	=> "0",
					"flagProcedure"=> "",
					"kdPenunjang"	=> "",
					"assesmentPel"	=> "",
					"skdp"=> [
					  "noSurat"=> "000002",
					  "kodeDPJP"=> "31661"
					],
					"dpjpLayan" => "",
					"noTelp"	=> "081919999",
					"user"		=> "Coba Ws"
			  ]
			]
    ];
    exit(json_encode($create_sep_send ));
    // exit(json_encode($res ));

	}




	


}