<title>Struk kecil (76 mm) Penjualan Obat</title>
<div style="height: 0cm; width: 6cm;"></div>
<div style="width: 6cm; padding-left: 0.8cm; padding-right: 0.8cm;font-family : Arial;font-size : 12px;">
    <table width="100%" align="center" style="text-align: center; font-size: 100%; font-weight:bold;" border="0"
        cellpadding="0" cellspacing="0">
        <tr>
            <td style="font-weight:bold;">{{$penjualan->nama_apotek}}</td>
        </tr>
        <tr>
            <td>{{$penjualan->alamat_apotek}}</td>
        </tr>
        <tr>
            <td>{{date('d-F-Y',strtotime($penjualan->tgl_transaksi))}}</td>
        </tr>
        <tr>
            <td>{{$penjualan->telepon_apotek}}</td>
        </tr>
    </table>

    <br style="margin-top: 1; color: #000000; margin-bottom: 5;" />
    <!-- <hr style="margin-top: 0; color: #000000; margin-bottom: 0.02cm;" /> -->
    <!-- <hr style="margin-top: 0; color: #000000;" /> -->
    <table width="100%" style="font-size: 100%;font-weight:bold;" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="40%" align="left" valign="top">Tanggal</td>
            <td width="2%" align="left" valign="top">:</td>
            <td style="padding-left: 5px;">{{date('d-m-Y',strtotime($penjualan->tgl_transaksi))}}
                {{$penjualan->jam_transaksi}}</td>
        </tr>
        <tr>
            <td width="40%" align="left" valign="top">No. Faktur</td>
            <td width="2%" align="left" valign="top">:</td>
            <td style="padding-left: 5px;">{{$penjualan->no_faktur}}</td>
        </tr>
        <tr>
            <td width="40%" align="left" valign="top">Kasir</td>
            <td width="2%" align="left" valign="top">:</td>
            <td style="padding-left: 5px;">{{$penjualan->name}}</td>
        </tr>


    </table>
    <hr style="margin-top: 5; color: #000000; margin-bottom: 1;" />
    <hr style="margin-top: 1; color: #000000; margin-bottom: 5;" />
    <table width="100%" style="font-size: 100%; font-weight:bold;" border="0" cellpadding="0" cellspacing="0">
        @php
        $i = 0;
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
            <td
                style="width: 130px; overflow: hidden; display: inline-block; white-space: normal; word-wrap: break-word;">
                {{$d->nama_produk}}</td>
            <td align="left" valign="top">;{{ucfirst(strtolower($d->satuan))}}</td>
        </tr>
        <tr>
            <td colspan="2">
                <replacement>
                    <replacement>ED: {{ date('d-m-Y',strtotime($d->tgl_expired))}}<replacement>
                            <replacement>
            </td>
        </tr>
        <tr>
            <td align="left" width="58%">
                {{ $d->qty}} x
                {{number_format($harga_jual,'0','','.')}} </td>
            <td align="right">
                {{number_format($total,'0','','.')}}</td>
        </tr>
        <tr>

            <td colspan="2">Diskon
                {{number_format($diskonrupiah,'0','','.')}} </td>
            <!-- <td colspan="2">Diskon 500</td> -->
        </tr>
        @php
        $i+=1;
        @endphp
        @endforeach


    </table>

    <hr style="margin-top: 5; color: #000000; margin-bottom: 5" />
    <table width="100%" style="font-size: 100%; font-weight:bold;" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="3">{{$i}} item</td>
        </tr>
        <tr>
            <td>Subtotal</td>
            <td>&nbsp;</td>
            <td align="right">
                {{number_format($subtotal,'0','','.')}} </td>
        </tr>
        <tr>
            <td>Diskon</td>
            <td>&nbsp;</td>
            <td align="right">
                @php
                $diskon = ($penjualan->diskon/100) * $subtotal;
                @endphp
                {{number_format($diskon,'0','','.')}} </td>
        </tr>
        <tr>
            <td>Pajak</td>
            <td>&nbsp;</td>
            <td align="right">
                @php
                $ppn = ($penjualan->ppn/100) * ($subtotal-$diskon);
                @endphp
                {{number_format($ppn,'0','','.')}} </td>
        </tr>
        <tr>
            <td>Total</td>
            <td>&nbsp;</td>
            <td align="right">
                @php
                $total = $subtotal - $diskon + $ppn;
                @endphp
                {{number_format($total,'0','','.')}} </td>
        </tr>
    </table>
    <hr style="margin-top: 5; color: #000000; margin-bottom: 1;" />
    <hr style="margin-top: 1; color: #000000; margin-bottom: 5;" />
    <table width="100%" style="font-size: 100%; font-weight:bold;" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="40%" style="vertical-align: top;">Terbilang</td>
            <td width="2%" style="vertical-align: top;">:</td>
            <td style="padding-left: 5px;">{{ucwords(terbilang($total))}}</td>
        </tr>
        <tr>
            <td width="40%" style="vertical-align: top;">Pembayaran</td>
            <td width="2%" style="vertical-align: top;">:</td>
            <td style="padding-left: 5px;">
                Tunai </td>
        </tr>
        <tr>
            <td width="40%" style="vertical-align: top;">Jumlah Tunai</td>
            <td width="2%" style="vertical-align: top;">:</td>
            <td align="right" style="padding-left: 5px;">
                {{number_format($penjualan->jumlah_tunai,'0','','.')}} </td>
        </tr>
        <tr>
            <td width="40%" style="vertical-align: top;">Kembalian</td>
            <td width="2%" style="vertical-align: top;">:</td>
            <td align="right" style="padding-left: 5px;">
                {{number_format($penjualan->jumlah_tunai-$total,'0','','.')}} </td>
        </tr>

        <tr>
            <td colspan="3" align="center" style="vertical-align: top;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" align="center" style="vertical-align: top;">Terimakasih Telah berkunjung. semoga sehat
                selalu
                Maaf, barang yang sudah dibeli
                tidak dapat ditukar atau dikembalikan</td>
        </tr>
    </table>

    <!-- ///////////////////////// Custom Etiket 57 /////////////////////////// -->
    <br>

    <!-- ///////////////////////// Custom Etiket 57 /////////////////////////// -->

</div>
</div>
</style>
<style>
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
<script type="text/javascript">
    function myFunction() {
        window.print();
    }
    window.onload = myFunction;
</script>
<script type="text/javascript">
    function myFunction() {
		    window.print();
		}
		window.onload = myFunction;
</script>
