$(function (){
	// console.log('OK web');

	if( open_site('web/index.php?r=bpjs2/caripeserta') ){
		$('#btnCariPx').click(function(){
			console.log($('#inNoka').val());

			let url = 'http://192.168.1.68/rscm/simrsnew/web/index.php?r=bpjs2/peserta&noKartu='+$('#inNoka').val();
			let res = _ajax('GET', url, '');
			console.log(res);
			let js_str = JSON.stringify(res, null, 4);
			$('#val').val(js_str);
		});
	}



	if( open_site('web/index.php?r=bpjs2/create-sep') ){
		$('#btnCariPx').click(function(){
			console.log($('#inNoka').val());

			let url = 'http://192.168.1.68/rscm/simrsnew/web/index.php?r=bpjs2/peserta&noKartu='+$('input[name=noka_bpjs]').val();
			let r = _ajax('GET', url, '');
			console.log(r);

			$('input[name=nik_bpjs]').val(r.peserta.nik);
			$('input[name=nama_bpjs]').val(r.peserta.nama);
			$('input[name=tgllahir_bpjs]').val(r.peserta.tglLahir);
			$('input[name=kelas_bpjs]').val(r.peserta.hakKelas.keterangan);
			$('input[name=asalPPK_bpjs]').val();
			$('input[name=jns_peserta]').val(r.peserta.jenisPeserta.keterangan);
			$('input[name=norm_bpjs]').val(r.peserta.mr.noMR);
			$('input[name=telp_bpjs]').val(r.peserta.mr.noTelepon);
		});


		 $("input[name=asalPPK_bpjs]").keypress(function (e) { //TEKAN ENTER
      let keyFaskes = $(this).val();
      let jenis = 1;
      // console.log(norm);
      if (e.which == 13) {
        console.log(keyFaskes);

				let url = baseUrl()+'/web/index.php?r=bpjs2/ref-faskes&nama='+keyFaskes+'&jenis='+jenis;
				let r = _ajax('GET', url, '');
				console.log(r);


				let tbl = {
            id : 'tbl_mdl_faskes',
            headers : [
              ['kode', 'Kode'], ['nama','Nama Faskes'],  
              // ['Kelas','Kelas'], ['Status','Status','style="text-align:center;"'], 
              // ['Tarif_Include','Tarif Include', 'style="text-align:right;"','numeral']
            ],
            data : r.faskes,
            button : {
              color : 'success',
              head : 'OPSI',
              label : 'PILIH',
            },
          };
        
        let el_tbl = create_table_return(tbl, r.faskes); 


        let mdl = {
          id    : 'modal_faskes',
          bodyId: 'el_modal2',
          size  : 'lg',
          title : 'Daftar Faskes',
          table : el_tbl,
        };
        let el = create_modal(mdl);
        $('#modal_list').append(el);
        $('#tbl_mdl_faskes').DataTable({"scrollX": true});
        $('#modal_faskes').modal('show');
				
			}
		});



		// keyFaskes = 'rohma'; jenis = 1;
	 // 	let url = baseUrl()+'/web/index.php?r=bpjs2/ref-faskes&nama='+keyFaskes+'&jenis='+jenis;
		// 	let r = _ajax('GET', url, '');
		// 	console.log(r);


		// 	let tbl = {
  //         id : 'tbl_mdl_faskes',
  //         headers : [
  //           ['kode', 'Kode'], ['nama','Nama'],  
  //           // ['Kelas','Kelas'], ['Status','Status','style="text-align:center;"'], 
  //           // ['Tarif_Include','Tarif Include', 'style="text-align:right;"','numeral']
  //         ],
  //         data : r.faskes,
  //         button : {
  //           color : 'success',
  //           head : 'OPSI',
  //           label : 'PILIH',
  //         },
  //       };
      
  //     let el_tbl = create_table_return(tbl, r); 
  //     console.log(el_tbl);
  //     $('#xtbl_list').append(el_tbl);




	}



	if( open_site('web/index.php?r=cekup/form-insert') ){
		console.log('cekupforminsert');
		// http://192.168.1.68/riz/belajaryii/basic2/web/index.php?r=cekup/insertpost

		$('input[name=id]').focus();

		$('.Form_post').submit(function(e){
		  e.preventDefault();
		  let data = $(this).serialize();
		  let url  = $(this).attr('action');
		  console.log([data, url]);
		  // return false;

		  // let js = _ajax_web("POST", baseUrl()+"akreditasi/insert_insiden/akinsiden", data );
		  let js = _ajax("POST", url, data);
		  console.log(js);

		  if(js.metadata.code==200){
		    alert(js.metadata.message);
		    reload();
		  }else{
		    alert('Tidak Berhasil Entry. Ulangi proses.');
		  }

		  return false;
		});

		// 136753, 096406
		$('#btnCariPx').click(function(e){
			e.preventDefault();
			let id = $('input[name=id]').val();
			let js = _ajax('GET', baseUrl()+'web/index.php?r=cekup/get_mst_pasien_by_norm&norm='+id, '');
			console.log(js);
			$('input[name=nama]').val(js.Nama);
			$('input[name=tgllahir]').val(js.TglLahir);

			// marital = ['D', 'J', 'T', 'Y']
			let lblMarital = '';
			if(js.Marital=='Y') lblMarital = 'MENIKAH';
			else if(js.Marital=='T') lblMarital = 'BELUM MENIKAH';
			$('select[name=status]').val(lblMarital);

			// sex = ['L', 'P', '-']
			let lblSex = '';
			if(js.Sex=='L') lblSex = 'LAKI-LAKI';
			else if(js.Sex=='P') lblSex = 'PEREMPUAN';
			$('select[name=sex]').val(lblSex);


		});

		

	}

});