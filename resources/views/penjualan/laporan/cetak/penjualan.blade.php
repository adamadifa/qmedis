<style>
  body {
    font-family: Arial;
    font-style: bold;
    margin: 0;
    background-color: #404040;
  }

  .page {
    width: 297mm;
    min-height: 210mm;
    padding: 1mm;
    margin: 0mm auto;
    background: white;
  }

  .subpage {
    margin-left: 14mm;
    margin-right: 4mm;
    margin-top: 4mm;
    /*border: 1px solid red;*/
  }

  @page {
    size: A4 landscape;
    margin: 0;
  }

  @media print {
    .page {
      margin: 0;
      border: initial;
      border-radius: initial;
      width: initial;
      min-height: initial;
      box-shadow: initial;
      background: initial;
      page-break-after: always;
    }
  }
</style>
<div class="page">
  <div class="subpage">
    <table border="0" width="100%" cellspacing="0" cellspacing="0">
      <tr>
        <td align="center" width="10%" style="vertical-align: center;">
          <img class="user-image" src="{{asset('assets/static/logo.svg')}}" alt=""
            style="width:auto; height:auto; max-width:70px; max-height:70px; display:block;"> </td>
        <td>
          <table border="0" width="100%" cellspacing="0" cellspacing="0">
            <tr>
              <td align="left">
                <h5 style="margin: 0;">APOTEK FANDA FARMA</h5>
              </td>
            </tr>
            <tr>
              <td>
                <h6 style="margin: 0;">No. Surat Izin Apotek : 503/00686/DPM-PTSP/kes/XII/2018</h6>
              </td>
            </tr>
            <tr>
              <td>
                <h6 style="margin: 0;">Jln. Ahmad Yani. no56, Kab. Timor Tengah Selatan</h6>
              </td>
            </tr>
            <tr>
              <td>
                <h6 style="margin: 0;">Telp. 08125457845, Email : support@vmedis.com, Website :
                  vmedis.com
                </h6>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <hr style="margin-top:2px;">
    <h5 align="center" style="margin-top: 0px;">
      <b></b>
    </h5>
    <h5 align="center" style="margin-top: -18px;">
      <b>LAPORAN REKAP DATA PENJUALAN OBAT</b>
    </h5>
    <h5 align="center" style="margin-top:-18px">
      <b> PERIODE TANGGAL </b>
    </h5>
    <hr style="margin-top:0px; margin-bottom:5px; margin-top: -15px;">

  </div>
</div>
