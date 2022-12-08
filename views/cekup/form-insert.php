<div class="col-md-6 offset-md-3">
      <div>FORM ENTRY CHECKUP</div>
      <form action="http://192.168.1.68/rscm/wscekup/web/index.php?r=cekup/insertpost" class="Form_post">
        
        <table class="table-sm">
          <tr>
            <td>ID</td>
            <td>:</td>
            <td><input type="text" name="id" style="width:160px;">
              <button id="btnCariPx" class="btn btn-sm btn-success">Cari</button>
            </td>
          </tr>
          <tr>
            <td>NAMA</td>
            <td>:</td>
            <td><input type="text" name="nama"></td>
          </tr>
          <tr>
            <td>BAGIAN</td>
            <td>:</td>
            <td><input type="text" name="bagian"></td>
          </tr>
          <tr>
            <td>TGL.LAHIR</td>
            <td>:</td>
            <td><input type="text" name="tgllahir"></td>
          </tr>
          <tr>
            <td>STATUS</td>
            <td>:</td>
            <td>
              <select name="status">
                <option value="">-pilih-</option>
                <option value="MENIKAH">MENIKAH</option>
                <option value="BELUM MENIKAH">BELUM MENIKAH</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>JENIS KELAMIN</td>
            <td>:</td>
            <td>
              <select name="sex">
                <option value="">-pilih-</option>
                <option value="LAKI-LAKI">LAKI-LAKI</option>
                <option value="PEREMPUAN">PEREMPUAN</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>PERUSAHAAN</td>
            <td>:</td>
            <td><input type="text" name="perusahaan"></td>
          </tr>
          <tr>
            <!-- <td><button id="btnSimpan">SIMPAN</button></td> -->
            <td><input type="submit" value="SIMPAN"></td>
          </tr>
        </table>
      </form>

      <!-- <button id="btnCariPx">cari</button> -->
    </div>