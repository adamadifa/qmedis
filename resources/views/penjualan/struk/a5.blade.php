<body>
    <div class="page">
        <div class="subpage" style="margin-left: 10mm; margin-right: 10mm; ">
            <br>
            <br>
            <div style="width: 100%; ">
                <table width="100%">
                    <tr>
                        <td>
                            <table>
                                <thead>
                                    <tr>
                                        <td>
                                        <th>
                                            <img class="user-image" src="/foto/19210819110808.jpg" alt=""
                                                style="width:auto; height:auto; max-width:70px; max-height:70px; display:block;">
                                        </th>
                                        <th>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th align="left">
                                                            <h5 style="margin: 0;">{{$penjualan->nama_apotek}}</h5>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <h6 style="margin: 0;">No. Surat Izin Apotek :
                                                                {{$penjualan->sia_no}}</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 style="margin: 0;">{{$penjualan->alamat_apotek}}</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h6 style="margin: 0;">Telp. {{$penjualan->telepon_apotek}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </th>
                        </td>
                    </tr>
                    </thead>
                </table>
                </td>
                <td id="invoice" width="35%"
                    style=" font-size: 250%;font-weight:bold; letter-spacing: 10px;padding-bottom:10px;" align="right"
                    valign="bottom">
                    KUITANSI </td>
                </tr>
                </table>
                <div style="padding-top:-5;">
                    <hr style="margin-top: -1; color: #000000; margin-bottom: 1;" />
                    <hr style="margin-top: 1; color: #000000; margin-bottom: 4;" />
                </div>

                <table width="100%" border="0">
                    <tr>
                        <td width="65%">
                            <table width="100%" style="font-size: 68%;font-weight:normal;" border="0" cellspacing="0">

                                <tr>
                                    <td width="17%" style="vertical-align: top; font-weight:bold;">Nama Pasien</td>
                                    <td style="vertical-align: top;">: {{$penjualan->nama_customer}}</td>
                                </tr>
                                <tr>
                                    <td width="17%" style="vertical-align: top; font-weight:bold; ">No. Telp</td>
                                    <td style="vertical-align: top;">:{{$penjualan->telepon_customer}}</td>
                                </tr>
                                <tr>
                                    <td width="17%" style="vertical-align: top; font-weight:bold; ">Alamat</td>
                                    <td style="vertical-align: top;">:{{$penjualan->alamat_customer}}</td>
                                </tr>

                            </table>
                        </td>
                        <td width="35%" style="vertical-align: top;">
                            <table width="100%" style="font-size: 68%;font-weight:normal;" border="0" cellspacing="0">
                                <tr>
                                    <td width="30%" style="vertical-align: top; font-weight:bold;">Kasir</td>
                                    <td style="vertical-align: top;">: {{$penjualan->name}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="vertical-align: top; font-weight:bold;">Tanggal</td>
                                    <td style="vertical-align: top;">:
                                        {{date('d-F-Y',strtotime($penjualan->tgl_transaksi))}}
                                        {{$penjualan->jam_transaksi}}</td>
                                </tr>
                                <tr>
                                    <td width="30%" style="vertical-align: top; font-weight:bold;">No. Faktur</td>
                                    <td style="vertical-align: top;">: {{$penjualan->no_faktur}}</td>
                                </tr>

                                <tr>
                                    <td width="30%" style="vertical-align: top; font-weight:bold;">Pembayaran</td>
                                    <td style="vertical-align: top;">
                                        : TUNAI </td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div><br />
            <table width="100%" border="0"
                style="font-size: 100%; vertical-align: top; font-weight:normal;border-collapse: collapse;">

                <thead>
                    <tr>
                        <td width="5%" align="center" style="font-weight:bold; border:1px solid black;">
                            No
                        </td>
                        <td width="23%" align="center" style="font-weight:bold; border:1px solid black;">
                            Nama Barang
                        </td>
                        <td width="5%" align="center" style="font-weight:bold; border:1px solid black;">
                            Qty
                        </td>
                        <td width="5%" align="center" style="font-weight:bold; border:1px solid black;">
                            Satuan
                        </td>
                        <td width="30%" align="center" style="font-weight:bold; border:1px solid black;">
                            Batch & ED
                        </td>
                        <td width="10%" align="center" style="font-weight:bold; border:1px solid black;">
                            Harga
                        </td>
                        <td width="7%" align="center" style="font-weight:bold; border:1px solid black;">
                            Disc
                        </td>
                        <td width="15%" align="center" style="font-weight:bold; border:1px solid black;">
                            Subtotal
                        </td>
                    </tr>
                </thead>
                @php
                $i = 1;
                $subtotal = 0;
                @endphp
                @foreach ($detailpenjualan as $d)
                @php
                $harga_jual = $d->harga_beli + ($d->harga_beli * ($d->persentase_laba/100));
                $total = ($harga_jual * $d->qty)-(($harga_jual * $d->qty) * ($d->diskon/100));
                $diskonrupiah = ($harga_jual * $d->qty) * ($d->diskon/100);
                $subtotal += $total;
                @endphp
                <tr>
                    <td width="5%" align="center" style="border-left: 1px solid black;">
                        {{$i}}
                    </td>
                    <td width="23%" style="border-left: 1px solid black; padding-left: 5px;">
                        {{$d->nama_produk}} </td>
                    <td width="5%" align="center" style="border-left: 1px solid black;">
                        {{$d->qty}} </td>
                    <td width="5%"
                        style="border-left: 1px solid black; border-right: 1px solid black; padding-left: 5px;">
                        {{ucfirst(strtolower($d->satuan))}} </td>
                    <td
                        style="width: 230px; overflow: hidden; display: inline-block; white-space: nowrap; padding-left: 5px; ">
                        <replacement>
                            <replacement> - (ED <replacement>{{ date('d-m-Y',strtotime($d->tgl_expired))}})<replacement>
                                        <replacement>
                    </td>
                    <td width="10%" align="right" style="border-left: 1px solid black; padding-right: 5px;">
                        {{number_format($harga_jual,'0','','.')}} </td>
                    <td width="7%" align="right" style="border-left: 1px solid black; padding-right: 5px;">
                        {{ ROUND($d->diskon,2) }}% </td>
                    <td width="15%" align="right"
                        style="border-left: 1px solid black; border-right: 1px solid black;padding-right: 5px;">
                        {{number_format($total,'0','','.')}} </td>
                </tr>
                @php
                $i+=1;
                @endphp
                @endforeach

                <tr>
                    <!-- garis untuk bawah table -->
                    <td align="center" style="border-bottom: 1px solid black;
					border-left: 1px solid black;border-right: 1px solid black;"></td>
                    <td align="center" style="border-bottom: 1px solid black;
					border-right: 1px solid black;"></td>
                    <td align="center" style="border-bottom: 1px solid black;
					border-right: 1px solid black;"></td>
                    <td align="center" style="border-bottom: 1px solid black;
					border-right: 1px solid black;"></td>
                    <td align="center" style="border-bottom: 1px solid black;
					border-right: 1px solid black;"></td>
                    <td align="center" style="border-bottom: 1px solid black;
					border-right: 1px solid black;"></td>
                    <td align="center" style="border-bottom: 1px solid black;
					border-right: 1px solid black;"></td>
                    <td align="center" style="border-bottom: 1px solid black;
					border-right: 1px solid black;"></td>
                </tr>
                <tr>
                    <td colspan="2">
                    </td>
                    <td align="center" style="border: 1px solid black;">1,00</td>
                    <td></td>
                    <td>&nbsp;</td>
                    <td align="right" colspan="2" style="padding-right: 5px; border: 1px solid black;">Total :</td>
                    <td align="right" style=" border: 1px solid black;padding-right: 5px;">
                        {{number_format($subtotal,'0','','.')}} </td>
                </tr>
                <tr>
                    <td colspan="5" rowspan="5" style="vertical-align: top;">
                        <table border="0" width="100%" style="font-size: 100%;" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="20%" style=" font-weight:bold;">
                                    Catatan </td>
                                <td width="4%">
                                    : </td>
                                <td id="promo">
                                    Terimakasih Telah berkunjung. semoga sehat selalu
                                    Maaf, barang yang sudah dibeli
                                    tidak dapat ditukar atau dikembalikan </td>
                            </tr>
                        </table>
                    </td>

                    <td align="right" colspan="2" style="padding-right: 5px; border: 1px solid black">Diskon :</td>
                    <td align="right" style=" border: 1px solid black;padding-right: 5px;">
                        @php
                        $diskon = ($penjualan->diskon/100) * $subtotal;
                        @endphp
                        {{number_format($diskon,'0','','.')}} </td>
                </tr>
                <tr>

                    <td align="right" colspan="2" style="padding-right: 5px;  border: 1px solid black">Pajak :</td>
                    <td align="right" style=" border: 1px solid black;padding-right: 5px;">
                        @php
                        $ppn = ($penjualan->ppn/100) * ($subtotal-$diskon);
                        @endphp
                        {{number_format($ppn,'0','','.')}} </td>
                </tr>

                <tr></tr>

                <tr></tr>

                <!-- <tr>
					<td align="right" colspan="2" style="padding-right: 5px; border: 1px solid black">Dijamin :</td>
					<td align="right" style=" border: 1px solid black;padding-right: 5px;">
					0					</td>
				</tr> -->
                <tr>

                    <td align="right" colspan="2" style="padding-right: 5px; border: 1px solid black;font-weight:bold;">
                        Grand Total :</td>
                    <td align="right" style=" border: 1px solid black;font-weight:bold;padding-right: 5px;">
                        @php
                        $total = $subtotal - $diskon + $ppn;
                        @endphp
                        {{number_format($total,'0','','.')}} </td>
                </tr>


                <tr>
                    <td rowspan="7" colspan="5">
                        <table width="100%" style="font-size: 100%; font-weight:normal;" border="0">
                            <tr>
                                <td align="center">Penerima / Pembeli</td>
                                <td align="center">{{$penjualan->nama_apotek}}</td>
                            </tr>
                            <tr>
                                <td align="center" height="40px"></td>
                                <td align="center" height="40px"></td>
                            </tr>
                            <tr>
                                <td align="center">__________________________________</td>
                                <td align="center">__________________________________</td>
                            </tr>
                        </table>
                    </td>

                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>
    <!-- ///////////////////////// Custom Etiket 57 /////////////////////////// -->

    <div class="clearf pagebreak"> </div>
    <br>
    <div class="epage">
        <!-- ///////////////////////// Custom Etiket 57 /////////////////////////// -->

    </div>
</body>
<style>
    .epage {
        margin: 0 auto;
        width: 210mm;
        height: auto;
        background-color: white !important;
        display: table;
        content: "";
        clear: both;
    }

    .pagebreak {
        page-break-before: always;
    }

    /* page-break-after works, as well */
    .etiket {
        padding: 1%;
        width: 31%;
        border: 1px dashed #ccc;
        float: left;
    }

    .clearf {
        margin: 0;
        padding: 0;
        display: table;
        content: "";
        clear: both;
    }

    .sm50 {
        float: left;
        width: 45%;
        height: 50px;
    }

    #promo {
        white-space: pre-line;
    }

    .lefts {
        float: left;
    }

    .rights {
        float: right;
    }

    .clearfix {
        clear: both;
        float: none;
    }

    /*--------- EHeader ------*/
    .eheader {
        width: 100%;
        font-size: 10px;
    }

    .identitas {
        max-width: 70%;
        height: auto;
    }

    .foto {
        width: 25%;
        height: auto;
    }

    .user-image {
        margin-right: 10px;
        max-width: 50px;
        max-height: 50px;
    }

    .kl-nama {
        margin: 0;
        padding: 0;
    }

    .kl-alamat {
        margin: 0;
        font-size: 8px;
    }


    /* ------ EContent ---------*/
    .econtent {
        width: 100%;
        font-size: 11px;
    }

    .econtent p {
        margin: 3px 5px 3px 1px;
    }
</style>
<style>
    body {
        font-family: Arial;
        font-size: 10px;
        font-style: bold;
        margin: 0;
        background-color: #404040;
    }

    #invoice {
        font-family: Courier New;
        font-style: bold;
        font-size: 200%;
        font-weight: bold;
        letter-spacing: 8px;
        padding-bottom: 10px;
    }

    .page {
        width: 210mm;
        /*height: 148.5mm;*/
        min-height: 147mm;
        /*padding: 1mm;*/
        margin: 1mm auto;
        background: white;
        /*border: 1px solid red;*/
    }

    .subpage {
        /*margin-left:0cm;*/
        /*margin-right:0cm;*/
        /*height: 148mm;*/
        /*margin-bottom: 0cm;*/
        /*border: 1px solid red;*/
    }

    #promo {
        white-space: pre-line;
    }

    @page {
        size: A5 landscape;
        margin: 0;
    }

    @media print {

        /*html, body {
			width: 210mm;
			height: 148.5mm;
		}*/
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
<script type="text/javascript">
    function myFunction() {
		    window.print();
		}
		window.onload = myFunction;
</script>
