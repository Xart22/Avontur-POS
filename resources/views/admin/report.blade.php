@extends('layout')@section('header')
<link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">
<script src="{{ asset('assets/fontawesome/js/all.js') }}"></script>


@endsection


@section('header')
@section('title','Report') @section('content')
@section('pageheader','Report Penjualan')



<div class="container">
    <div class="row">
        <div class="box col">
            <h4 class="text-center ">PENDAPATAN HARIAN</h4>
            <img src="{{asset('assets/img/rp.png')}}" width="100">
            <span id="total">Rp. 2.000.000</span>
        </div>
        @if($total)
        <div class="box col">
            <h4 class="text-center ">PENDAPATAN  BULAN INI</h4>
            <img src="{{asset('assets/img/rp.png')}}" width="100">
            <span id="bulanan">{{$total}}</span>
        </div>
        @endif
    </div>
    <div class="history container">
        <div class="w-100 only">
        <h3 class="text-center text-light">History Transaksi</h3>
        </div>
        @if(Session::get('fail'))
        <div class="p-3 mb-2 bg-danger text-white">
            {{ Session::get('fail') }}
        </div>
        @endif
        @if(Session::get('success'))
        <div class="p-3 mt-2 bg-success text-white">
            {{ Session::get('success') }}
        </div>
        @endif
        <div class="table-history">
        <table id="example" class="table table-striped table-light " style="width:100%">
            <thead>
                <tr>
                    <th>No Invoice</th>
                    <th>Operator</th>
                    <th>Total Pembayaran</th>
                    <th>Jenis Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice as $item)
               <tr>
                <td>{{$item->no_inv}}</td>
                <td class="text-uppercase">{{$item->operator}}</td>
                <td id="ttlHr">{{$item->total}}</td>
                <td class="text-uppercase">{{$item->jns}}</td>
                <td>{{$item->tgl_pembayaran}}</td>
                <td><a href="{{ route('detailreport', $item->id) }}"><span style="color:blue"><i class="fas fa-print"></span></i></a>
                    <button style="border: none; padding: 0;background-color: unset;" data-toggle="modal"
                    data-target="#exampleModal"><span style="color:red"><i class="far fa-trash-alt"></i></span></a></button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Hapus
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('deletelaporan') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{strtoupper(session('loggedUser')->username)}}" name="user_id">
                                        <input type="hidden" name="no_inv" value="{{$item->no_inv}}">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">keterangan</label>
                                            <input type="text" class="form-control" name="keterangan" required />
                                        </div>
                                        <button type="submit" class="btn btn-danger">
                                            Hapus
                                        </button>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">
                                            Cancel
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                
                </td>
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    </div>



</div>

@section('script')
<script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/report.js') }}"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script src="{{ asset('assets/js/costum.js') }}"></script>
@endsection



@endsection