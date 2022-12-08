<?php
// echo 'curl';
$b = new Bpjs1Controller();
// print_r($b->ws_header_encript_MY());
print_r($b->actionPeserta());

class Bpjs1Controller{
	private $consid = "16141";
	private $secretKey = "8uG8E36B37";
	private $kodeppk_rscm = "0195R028"; // 2020.01.20
	private $baseUrlBpjs = [
		"vclaim" => "https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/",
	];


	
	public function ws_header_encript_MY(){
		$consid = $this->consid; //Ganti dengan consumerID dari BPJS
		$secretKey = $this->secretKey; //Ganti dengan consumerSecret dari BPJS
		// Computes the timestamp
		date_default_timezone_set('UTC');
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		// Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac('sha256', $consid."&".$tStamp, $secretKey, true);
	 	
		$encodedSignature = base64_encode($signature); // base64 encode…
		$urlencodedSignature = urlencode($encodedSignature); // urlencode…
		
		$arrheader =  array(
				//'Accept: application/json',
				'X-cons-id: '.$consid,
				'X-timestamp: '.$tStamp,
				'X-signature: '.$encodedSignature        
			);
		//	'Content-Type: application/x-www-form-urlencoded'  //jerone arrheader

		return $arrheader;
	}


	// BEER WS_ARR
	public function ws($method, $path, $data_post=null){
		$url = $path;
		$arrheader = $this->ws_header_encript_MY();
		// if($app == 'aplicare'){
		// 	array_push($arrheader, "Content-Type: application/json");	
		// }	


    $ch= curl_init();
    $timeout = 10; // second
		
		switch($method){
			case "GET":
				$setopt_arr = [
					CURLOPT_HTTPHEADER 		=> $arrheader,
					CURLOPT_URL 			=> $url,
					CURLOPT_RETURNTRANSFER => 1, //batas
					//CURLOPT_ENCODING => "",
					//CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_SSL_VERIFYPEER => 0,	//tambahan HTTPS
					CURLOPT_SSL_VERIFYHOST => 0, 	//tambahan HTTPS
					CURLOPT_TIMEOUT => $timeout,
				];
								
				break;

			case "POST":
				$setopt_arr = [
					CURLOPT_HTTPHEADER 		=> $arrheader,
					CURLOPT_URL 			=> $url,
					CURLOPT_POST 			=> 1,
					CURLOPT_POSTFIELDS 		=> $data_post,
					CURLOPT_RETURNTRANSFER  => 1,
					CURLOPT_SSL_VERIFYPEER  => 0,	//tambahan HTTPS
					CURLOPT_SSL_VERIFYHOST  => 0, 	//tambahan HTTPS
					CURLOPT_TIMEOUT => $timeout,
				];
					
				break;
			
			case "PUT":
				$setopt_arr = [
					CURLOPT_HTTPHEADER 		=> $arrheader,
					CURLOPT_URL 			=> $url,
					CURLOPT_CUSTOMREQUEST 	=> "PUT",
					CURLOPT_POSTFIELDS 		=> $data_post,
					CURLOPT_RETURNTRANSFER  => 1,
					CURLOPT_SSL_VERIFYPEER  => 0,	//tambahan HTTPS
					CURLOPT_SSL_VERIFYHOST  => 0, 	//tambahan HTTPS
					CURLOPT_TIMEOUT => $timeout,
			  ];
				break;

			case "DELETE":
				$setopt_arr = [
					    CURLOPT_HTTPHEADER 		=> $arrheader,
			        CURLOPT_URL 			=> $url,
			        CURLOPT_CUSTOMREQUEST 	=> "DELETE",
			        CURLOPT_POSTFIELDS 		=> $data_post,
			        CURLOPT_RETURNTRANSFER	=> 1,
			        CURLOPT_SSL_VERIFYPEER  => 0,	//tambahan HTTPS
					    CURLOPT_SSL_VERIFYHOST  => 0, 	//tambahan HTTPS
					    CURLOPT_TIMEOUT => $timeout,
				];
				break;
		}
		
		curl_setopt_array($ch, $setopt_arr);

		// AKTIFKAN INI UNTUK TESTING, BACA DATA YG AKAN DIKIRIM
		$cek = [
			"url" => $url,
			"arrheader" => $arrheader,
			"data_post" => $data_post,
			"setopt_arr" => $setopt_arr,
		];
		// die(json_encode($cek));




		$send = curl_exec($ch);
		// die( "<pre>",print_r($send),"</pre>" );
		// var_dump($send); exit;

		// if (curl_errno($ch)) {
		// 	$error_msg = curl_error($ch);
		// 	echo $error_msg; exit;
		// }
		

		curl_close($ch);//tambahan

		if($send===false){
			
			// die("Error fetching data: ".curl_error($ch));
			// $error = [
      //   "metaData" => [
      //     "label" => "error_my_curl",
      //     "code" => 21,
      //     "status" => "failed",
      //     "message" => "Koneksi bermasalah. BPJS error nasional.",
      //     "path" => $path,
      //   ],
      //   "response" => null,    
			// ];
			// echo json_encode($error); // LANGSUNG ECHO JSON. TERUS DI EXIT, SUPAYA PROGRAM LANGSUNG BERHENTI DISINI.
			
			return null; exit;
		}else{
			// die('y');
			//$data_json= htmlspecialchars("$send", ENT_QUOTES);
		  return json_decode($send,1);
		  // echo $send;
		}

	}



	// public function actions()
 //  {
 //      return [
 //          'error' => [
 //              'class' => 'yii\web\ErrorAction',
 //          ],
 //      ];
 //  }




    

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
		// exit(json_encode($this->ws('GET', $this->baseUrlBpjs['vclaim'].$path) ));

		exit(json_encode($this->ws('GET', $this->baseUrlBpjs['vclaim'].$path) ));

		// var_dump($this->ws('GET', $this->baseUrlBpjs['vclaim'].$path) );

		// echo $this->ws('GET', $this->baseUrlBpjs['vclaim'].$path) ;
	}

	public function actionPs(){
		echo "PS";
	}

	public function actionGoogle(){
      // Init curl
      $curl = new curl\Curl();

      //get http://example.com/
      $response = $curl->get('http://google.com/');
      var_dump($response);
		// echo "tes";
  }


}



?>