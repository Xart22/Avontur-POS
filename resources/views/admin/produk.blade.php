@extends('layout') @section('title','Produk') @section('content')
@section('pageheader','Produk')
<div class="container mt-5">
    <!-- Button trigger modal -->
    <button
        type="button"
        class="btn btn-success"
        data-toggle="modal"
        data-target="#exampleModal"
    >
        Tambah Produk
    </button>
    @if(Session::get('fail'))
    <div class="p-3 mt-2 bg-danger text-white">
        {{ Session::get('fail') }}
    </div>
    @endif @if(Session::get('success'))
    <div class="p-3 mt-2 bg-success text-white">
        {{ Session::get('success') }}
    </div>
    @endif @if($errors->any()) @foreach ($errors->all() as $error)
    <div class="p-3 mt-2 bg-danger text-white">
        {{ $error }}
    </div>
    @endforeach @endif
    <!-- Modal -->
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Tambah Produk
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addproduk') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Produk</label>
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                name="nm_produk"
                                aria-describedby="emailHelp"
                                autocomplete="off"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Harga</label>
                            <input
                                type="text"
                                class="form-control"
                                name="harga"
                                id="harga"
                                autocomplete="off"
                            />
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            Submit
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-dismiss="modal"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-detail mt-5">
        <h4 class="text-center">Detail Produk</h4>
        <div class="detail-table border">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                @foreach ($produk as $produk)
                <tbody>
                    <tr>
                        <td>{{$produk -> name_produk}}</td>
                        <td>{{$produk -> harga}}</td>
                        <td>
                            <a href="/produk/{{$produk->id}}">
                                <button
                                    type="button"
                                    class="btn btn-success w-100"
                                >
                                    Detail
                                </button>
                            </a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('assets/js/costum.js') }}"></script>
@endsection