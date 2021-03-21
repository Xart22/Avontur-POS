@extends('layout') @section('title','Produk') @section('content')
@section('pageheader','Detail Akun') @if(Session::get('fail'))
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

<div class="container mt-5">
    @foreach($akun as $akun)

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Akun</h5>
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
                    value="{{$akun->id}}"
                    name="id"
                />
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputEmail1"
                        name="username"
                        value="{{$akun->username}}"
                        disabled
                        autocomplete="off"
                    />
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        disabled
                    />
                </div>
                <label class="my-1 mr-2" for="inlineFormCustomSelectPref"
                    >User Role</label
                >
                <select
                    class="custom-select my-1 mr-sm-2 mb-5"
                    id="role"
                    disabled
                    name="isRole"
                >
                    <option value="1">Admin</option>
                    <option value="0">Kasir</option>
                </select>

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
        prd.action = "{{ route('updateakun') }}";
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
        let role = document.getElementById("role");
        role.disabled = false;
    }
    function disable() {
        var input = document.getElementsByTagName("INPUT");
        var i;
        for (i = 0; i < input.length; i++) {
            input[i].disabled = true;
        }
        let btnSub = document.getElementById("subm");
        btnSub.style.display = "none";
        let role = document.getElementById("role");
        role.disabled = true;
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
        prd.action = "{{ route('deleteakun') }}";
        enable();
        let btnDel = document.getElementById("update");
        btnDel.style.display = "none";
        let bntcan = document.getElementById("cancel");
        bntcan.style.display = "block";
    }
</script>
@endsection
