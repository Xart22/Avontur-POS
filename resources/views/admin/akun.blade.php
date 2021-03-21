@extends('layout') @section('title','Akun') @section('content')
@section('pageheader','Akun')
<div class="container mt-5">
    <!-- Button trigger modal -->
    <button
        type="button"
        class="btn btn-success"
        data-toggle="modal"
        data-target="#exampleModal"
    >
        Tambah Akun
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
                        Tambah Akun
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
                    <form action="{{ route('addakun') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                name="username"
                                aria-describedby="emailHelp"
                                autocomplete="off"
                            />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                name="password"
                                id="exampleInputPassword1"
                                autocomplete="off"
                            />
                        </div>
                        <div class="form-group form-check">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="isRole"
                                id="exampleCheck1"
                                value="1"
                            />
                            <label class="form-check-label" for="exampleCheck1"
                                >Admin</label
                            >
                        </div>
                        <div class="form-group form-check">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="isRole"
                                id="exampleCheck1"
                                value="0"
                            />
                            <label class="form-check-label" for="exampleCheck1"
                                >Kasir</label
                            >
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
        <h4 class="text-center">Detail Akun</h4>
        <div class="detail-table border">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Last Login</th>
                        <th scope="col">Last Logout</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                @foreach ($akun as $akun)
                <tbody>
                    <tr>
                        <td>{{$akun -> username}}</td>
                        <td>{{$akun -> last_login}}</td>
                        <td>{{$akun -> last_logout}}</td>
                        <td>
                            <a href="/akun/{{$akun->id}}">
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
<script>
    $("input:checkbox").on("click", function () {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
</script>
@endsection
