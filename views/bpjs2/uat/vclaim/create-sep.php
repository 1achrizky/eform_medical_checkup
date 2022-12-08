
<style>
	/*.input-xs {
	  height: 22px;
	  padding: 2px 5px;
	  font-size: 12px;
	  line-height: 1.5; 
	  border-radius: 3px;
	}*/

</style>


<!-- <table name="tbl_data_bpjs" class="my_tbl table table-sm"> -->
<table name="tbl_data_bpjs" class="my_tbl">
  <tr><td colspan=4 style="text-align:center;"><h4 id="lbl_data_bpjs" style="cursor:pointer;" title="DoubleClick: tampil tombol SEP">DATA BPJS</h4></td></tr>
  <tr><td>Nomor KIS</td><td>
	  	<div class="input-group input-group-sm">
	  		<input type="text" name="noka_bpjs" class="form-control"> 
	  		<span class="input-group-append">	  			
	  			<button id="btnCariPx" class="btn btn-info btn-sm">Cari</button>
	  		</span>
	  	</div>
  	</td></tr>
  <tr><td>Nomor KTP</td><td><input type="text" name="nik_bpjs" disabled="disabled"></td></tr>
  <tr><td>Nama Peserta</td><td><input type="text" name="nama_bpjs" disabled="disabled"></td></tr>
  <tr><td>Tanggal Lahir</td><td><input type="text" name="tgllahir_bpjs" disabled="disabled"></td></tr>
  <tr><td>Kelas</td><td><input type="text" name="kelas_bpjs" disabled="disabled"></td></tr>
  <tr><td>PPK Asal Rujukan</td><td><input type="text" name="asalPPK_bpjs"></td></tr>
  <tr><td>Jenis Peserta</td><td><input type="text" name="jns_peserta" disabled="disabled"></td></tr>
  <tr><td>Tanggal Rujukan</td><td><input type="text" name="get_tglRujukan" autocomplete="off"></td></tr>
  <tr><td>Nomor Rujukan</td><td><input type="text" name="norujukan" autocomplete="off"></td></tr>
  <tr><td>Nomor SKDP</td>
      <td>
      	<div class="input-group input-group-sm"  style="width:170px;">
		  		<input type="text" name="skdp" autocomplete="off" class="form-control">
		  		<span class="input-group-append">	  			
		  			<button id="cari_skdp" title="Cari SKDP"><i class="fa fa-search"></i></button>
		  		</span>
		  	</div>


      	
          
      </td>                        
  </tr>
  <tr><td>DPJP Pemberi SKDP</td><td><input type="text" name="kd_dpjp_bpjs" autocomplete="off"></td></tr>
  <tr><td>Tanggal SEP</td><td><input type="text" name="tglsep" autocomplete="off" value="<?=date('Y-m-d');?>"></td></tr>
  <tr><td>Nomor RM</td><td><input type="text" name="norm_bpjs" autocomplete="off"></td></tr>
  <tr><td>Diagnosa <input type="text" name="dxkey_bpjs" autocomplete="off" style="width:50px;"> </td>
      <td>
        <select name="dx_bpjs" style="width:155px;">
          <option value=""></option>
        </select>
      </td>
  </tr>
  <tr><td>Nomor Telp</td><td><input type="text" name="telp_bpjs" autocomplete="off"></td></tr>
  <tr><td>Catatan</td><td><input type="text" name="catatan_bpjs" autocomplete="off"></td></tr>
  <tr><td>Status Kecelakaan</td><td><input type="text" name="status_laka" autocomplete="off"></td></tr>
  <tr><td>Katarak</td><td><input type="checkbox" name="chk_katarak"></td></tr>
  <tr><td></td><td><button id="btn_create_sep" class="btn btn-danger" style="display:none;">Create SEP</button></td></tr>
</table>

<div id="modal_list"></div>
<div id="xtbl_list"></div>
