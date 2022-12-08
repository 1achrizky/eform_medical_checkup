

// function _ajax_web(type, url, data){
function _ajax(type, url, data){
  let x;
  $.ajax({
    async : false,
    url   : url,
    type  : type,
    data  : data,
    success:function(result){
      x = JSON.parse(result);
    },
    error:function(jqXHR,textStatus,errorThrown){
      x = "ERROR["+name+"]: "+errorThrown;
    }
  });
  return x;
}

function reload(){
  window.location.reload(true);
}


let _baseUrl = "http://192.168.1.68/rscm/simrsnew/";
function baseUrl(){
  // let getUrl = window.location;
  // let path_index_tot = 4;
  // let path_tot = '';

  // for(let i=1; i<=path_index_tot; i++){
  //   path_tot += getUrl.pathname.split('/')[i] + "/";
  // }
  // return getUrl.protocol + "//" + getUrl.host + "/" + path_tot;

  // return $('body').data('baseurl');
  return _baseUrl;
}

let _ADDR = null;

function open_site(address=null){
	// let url_js = window.location.protocol + "//" + window.location.host + window.location.pathname;
	let url_js = window.location.href;
	let url_req = baseUrl()+address;
	// console.log([window.location, url_js, url_req]);

  if(url_js == url_req){
    _ADDR = address; // console.log(_ADDR);
    return true;
  }else{
    return false;
  }
}


function create_modal(mdl=null){
  let mdl_sample = {
    id    : 'modal_bed',
    bodyId: 'el_modal2',
    size  : 'lg',
    title : 'Daftar Kode Bed',
    table :  '', //HARUSNYA pakai elemen tabel(variabel js): el_tbl,
  };

  let el_all = '<div class="modal fade" id="'+mdl.id+'" role="dialog">'+
      '<div class="modal-dialog modal-'+mdl.size+'">'+
        '<div class="modal-content">'+
          '<div class="modal-header">'+
            '<button class="close" data-dismiss="modal">&times;</button>'+
            '<h4 class="modal-title">'+mdl.title+'</h4>'+
          '</div>'+
          '<div class="modal-body" id="mdl_body">'+
            // '<div class="container" style="margin:0px auto;">'+
            //   '<div class="row">'+
            //     '<div class="col-md-12">'+
                  mdl.table+
            //     '</div>'+
            //   '</div>'+
            // '</div>'+

          '</div>'+
          '<div class="modal-footer">'+
            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
          '</div>'+
        '</div>'+
      '</div>'+
    '</div>';
    return el_all;
}


 function create_table_return(tbl=null, data=null){
  let tbl_sample = {
    id : 'tbl_mdl_bedri',
    headers : [
      ['KodeBed', 'Kode Bed'], ['KeteranganBed','Keterangan'], ['Ruang','Ruang'], 
      ['Kelas','Kelas'], ['Status','Status','style="text-align:center;"'], 
      ['Tarif_Include','Tarif Include', 'style="text-align:right;"','numeral']
    ],
    data : data,
    button : {
      color : 'success',
      head : 'OPSI',
      label : 'PILIH',
    },
  };

  let thead='', thead_field='', 
      tbody='', btn_head='';

  for (let h = 0; h < tbl.headers.length; h++) {        
    thead_field += '<th style="text-align:center;">'+tbl.headers[h][1]+'</th>';          
  }
  
  // LOOP tiap baris data json
  for (let i = 0; i < tbl.data.length; i++) {
    let el_row_fields = '';
    let btn_el='';

    // CREATE HEADER
    for (let ih = 0; ih < tbl.headers.length; ih++) {
      let el_row_field = '';
      switch (tbl.headers[ih][3]) {              
        case 'numeral':
          el_row_field = numeral(tbl.data[i][tbl.headers[ih][0]]).format('0,0');
          break;
      
        default:
          el_row_field = tbl.data[i][tbl.headers[ih][0]];
          break;
      }

      let td_attr = '';
      if(tbl.headers[ih][2]!=null){
        td_attr = tbl.headers[ih][2];
      }            
      el_row_fields += '<td '+td_attr+'>'+el_row_field+'</td>';
      
    }
    //\CREATE HEADER

    if(tbl.button != null){
      btn_head = '<th style="text-align:center;">'+tbl.button.head+'</th>';      
      btn_el = '<td><button class="btn btn-'+tbl.button.color+'" data-id="'+i+'">'+tbl.button.label+'</button></td>';
    }else{
      btn_head = '';
      btn_el = '';
    }
    tbody += '<tr>'+btn_el+el_row_fields+'</tr>';          
  }

  let el_tbl = 
    '<table id="'+tbl.id+'" class="table table-bordered table-striped">'+
      '<thead><tr>'+btn_head+thead_field+'</tr></thead>'+
      '<tbody>'+tbody+'</tbody>'+        
    '</table>';
  return el_tbl;
}

  
// YANG BARU, PAKAI INI
function create_table_return2(tbl=null, data=null){
  let tbl_sample = {
    id : 'tbl_mdl_bedri',
    headers : [
      ['KodeBed', 'Kode Bed'], ['KeteranganBed','Keterangan'], ['Ruang','Ruang'], 
      ['Kelas','Kelas'], ['Status','Status','style="text-align:center;"'], 
      ['Tarif_Include','Tarif Include', 'style="text-align:right;"','numeral']
    ],
    data : data,
    button : {
      color : 'success',
      head : 'OPSI',
      label : 'PILIH',
    },
  };

  let thead='', thead_field='', 
      tbody='', btn_head='';

  for (let h = 0; h < tbl.headers.length; h++) {        
    thead_field += '<th style="text-align:center;">'+tbl.headers[h][1]+'</th>';          
  }
  
  // LOOP tiap baris data json
  for (let i = 0; i < tbl.data.length; i++) {
    let el_row_fields = '';
    let btn_el='';

    // CREATE HEADER
    for (let ih = 0; ih < tbl.headers.length; ih++) {
      let el_row_field = '';

      let chk = '';
      switch (tbl.headers[ih][3]) {              
        case 'numeral':
          el_row_field = numeral(tbl.data[i][tbl.headers[ih][0]]).format('0,0');
          break;

        case 'checkbox':
          // el_row_field = '<input type="checkbox" value="'+tbl.data[i][tbl.headers[ih][0]]+'"> '+ tbl.data[i][tbl.headers[ih][0]];
          
          if(tbl.data[i][tbl.headers[ih][0]] == ''){ chk = '';
          }else{ chk = 'checked'; }

          el_row_field = '<input class="cbox" type="checkbox" data-id="'+i+'" '+chk+'> ';
          break;
        
        case 'checkbox_disabled':
          // el_row_field = '<input type="checkbox" value="'+tbl.data[i][tbl.headers[ih][0]]+'"> '+ tbl.data[i][tbl.headers[ih][0]];
          
          if(tbl.data[i][tbl.headers[ih][0]] == ''){ chk = '';
          }else{ chk = 'checked'; }

          el_row_field = '<input class="cbox" type="checkbox" data-id="'+i+'" '+chk+' disabled> ';
          break;
        
        case 'button':
          let sub_btn = tbl.headers[ih][4];
          el_row_field = '<button class="btn btn-'+sub_btn.color+' '+sub_btn.trigger+'" data-id="'+i+'">'+sub_btn.label+'</button>';
          break;
      
        default:
          el_row_field = tbl.data[i][tbl.headers[ih][0]];
          break;
      }

      let td_attr = '';
      if(tbl.headers[ih][2]!=null){
        td_attr = tbl.headers[ih][2];
      }            
      el_row_fields += '<td '+td_attr+'>'+el_row_field+'</td>';
      
    }
    //\CREATE HEADER

    if(tbl.button != null){
      btn_head = '<th style="text-align:center;">'+tbl.button.head+'</th>';
      btn_el = '<td><button class="btn btn-'+tbl.button.color+'" data-id="'+i+'">'+tbl.button.label+'</button></td>';
    }else{
      btn_head = '';
      btn_el = '';
    }


    tbody += '<tr data-sort="'+i+'">'+btn_el+el_row_fields+'</tr>';          
  }

  let el_tbl = 
    '<table id="'+tbl.id+'" class="table table-bordered table-striped">'+
      '<thead><tr>'+btn_head+thead_field+'</tr></thead>'+
      '<tbody>'+tbody+'</tbody>'+        
    '</table>';
  return el_tbl;
}





// $('.Form_post').submit(function(e){
//   e.preventDefault();
//   let data = $(this).serialize();
//   let url  = $(this).attr('action');
//   console.log([data, url]);

//   let js = _ajax_web("POST", baseUrl()+"akreditasi/insert_insiden/akinsiden", data );
//   console.log(js);

//   if(js.code==200){
//     alert(js.message);
//     reload();
//   }else{
//     alert('Tidak Berhasil Entry. Ulangi proses.');
//   }

//   return false;
// });


//   // $("#myfile").change(function(e){
// $("input[type=file]").change(function(e){
//   let file = this.files[0];
//   let filetype = file.type;
//   // console.log([file, filetype, $(this), $(this)[0].name ]); 
//   // return false;
  
//   let formdata = new FormData( $("#frmBerkas")[0] );
//   formdata.append('inputName', $(this)[0].name);
//   formdata.append('nosep', sep);
//   console.log( formdata );
//   console.log( $("#frmBerkas")[0] );

//   // COBA SAJA
//   // var xhr = new XMLHttpRequest;
//   // xhr.open('POST', '/', true);
//   // xhr.send(formdata);
//   // return false;

//   $.ajax({
//     async : false,
//     url: baseUrl()+'eclaim/cek_upload_pdf_eclaim',
//     type: "POST",
//     // data: new FormData( $("#frmBerkas")[0] ),
//     data: formdata,
//     processData: false,
//     contentType: false,
//     cache: false,
//     success: function(data){
//       // console.log(data);
//       js = JSON.parse(data);
//       console.log(js);
//     }
//   });
//   return false;
// });

