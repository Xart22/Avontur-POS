@extends('layout') @section('title','Produk') @section('content')
@section('pageheader','Detail Produk')

<div class="container mt-5">
    @foreach($produk as $produk)

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
        </div>
        <div class="d-flex mx-auto mt-3">
            <button
                type="button"
                class="btn btn-warning mr-4"
                onclick="update()"
                id="update"
            >
                Update
            </button>
            <button
                type="button"
                class="btn btn-danger mr-4"
                onclick="delete1()"
                id="delete"
            >
                Delete
            </button>
            <button
                type="button"
                class="btn btn-light btncan"
                onclick="cancel()"
                id="cancel"
            >
                Cancel
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('addproduk') }}" method="POST" id="formPrd">
                @csrf
                <input
                    type="text"
                    class="d-none"
                    value="{{$produk->id}}"
                    name="id"
                />
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Produk</label>
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        name="nm_produk"
                        value="{{$produk->name_produk}}"
                        disabled
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
                        value="{{$produk->harga}}"
                        disabled
                        autocomplete="off"
                    />
                </div>
                <button
                    type="submit"
                    class="btn btn-success w-100 btn-sub"
                    id="subm"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

@endsection @section('script')
<script>
    function update() {
        let prd = document.getElementById("formPrd");
        prd.action = "{{ route('updateProduk') }}";
        enable();
        let btnDel = document.getElementById("delete");
        btnDel.style.display = "none";
        let bntcan = document.getElementById("cancel");
        bntcan.style.display = "block";
    }

    function enable() {
        var input = document.getElementsByTagName("INPUT");
        var i;
        for (i = 0; i < input.length; i++) {
            input[i].disabled = false;
        }
        let btnSub = document.getElementById("subm");
        btnSub.style.display = "block";
    }
    function disable() {
        var input = document.getElementsByTagName("INPUT");
        var i;
        for (i = 0; i < input.length; i++) {
            input[i].disabled = true;
        }
        let btnSub = document.getElementById("subm");
        btnSub.style.display = "none";
    }
    function cancel() {
        let can = document.getElementById("cancel");
        can.style.display = "none";
        let btnDel = document.getElementById("delete");
        btnDel.style.display = "block";

        let btnUp = document.getElementById("update");
        btnUp.style.display = "block";
        disable();
    }
    function delete1() {
        let prd = document.getElementById("formPrd");
        prd.action = "{{ route('deleteProduk') }}";
        enable();
        let btnDel = document.getElementById("update");
        btnDel.style.display = "none";
        let bntcan = document.getElementById("cancel");
        bntcan.style.display = "block";
    }
</script>

<script src="{{ asset('assets/js/costum.js') }}"></script>

@endsection
