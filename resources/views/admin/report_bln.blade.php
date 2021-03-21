@extends('layout')@section('header')
<link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/print.css') }}">


@endsection

@section('title','Report') @section('content')
@section('pageheader','Report Bulanan') 


<div class="container">
    <div class="table-bulan">
        <h3 style="display:none;">Laporan Bulanan</h3 style="display:none;">
    <table id="example" class="table table-striped table-light " style="width:100%">
        <thead class="bg-success">
            <tr>
                <th>No Inv</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Operator</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $item)
            <tr>
                <td>{{$item->no_inv}}</td>
                <td>{{$item->name_produk}}</td>
                <td id="harga">{{$item->total_harga}}</td>
                <td>{{$item->qty}}</td>
                <td>{{$item->operator}}</td>
                <td>{{$item->tgl_order}}</td>
                
            </tr>
            @endforeach
        </tbody>

        <tfoot class="omset" style="visibility: hidden;">
            <th>Omset Bulan ini :</th>
            <th id="omset"></th>
        </tfoot>
    </table>
</div>
</div>


@section('script')
<script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script>
    function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }
    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

document.addEventListener("DOMContentLoaded", function () {
    var harga =document.querySelectorAll('#harga');
    var arr=[];
    for (let i = 0; i < harga.length; i++) {
        arr.push(parseInt(harga[i].innerHTML));
        harga[i].innerHTML= formatRupiah(harga[i].innerHTML+'000','Rp. ' );
    }
    var total = arr.reduce((a, b) => a + b, 0);
    document.getElementById('omset').innerHTML=formatRupiah(total+"000",'Rp. ');

   

})
</script>
@endsection



@endsection