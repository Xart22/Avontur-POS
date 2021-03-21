@extends('layout')
@section('title','Dashboard')
@section('content')
@section('pageheader','Dashboard')


<h4>Produk</h4>
<div class="flex-container">
    <div class="produk">
        <div class="produk-item">
            @foreach($produk as $produk)
                <div class="nama-produk">
                    <form action="/addTempCart/{{ $produk->id }}" method="post">
                        @csrf
                        <div class="item-produk" onclick="this.closest('form').submit();return false;">
                            <span>{{ $produk->name_produk }}</span>
                            <input type="hidden" value="{{$produk->harga}}" name="harga">
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    <div class="cart">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="30%">Nama Produk</th>
                    <th width="20%">Qty</th>
                    <th width="20%">Sub Total</th>
                    <th width="10%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tempcart as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name_produk }}</td>
                        <td>
                            <div class="quantity">

                                <input id="qty" type="number" min="1" max="9" step="1" value="{{ $item->qty }}"
                                    readonly />

                                <div class="quantity-nav">
                                    <form action="/tambahqty/{{ $item->id }}" method="post">
                                        <div class="quantity-button quantity-up"
                                            onclick="this.closest('form').submit();return false;">
                                            +


                                            @csrf

                                    </form>
                                </div>
                                <form action="/kurangqty/{{ $item->id }}" method="post">
                                    <div class="quantity-button quantity-down"
                                        onclick="this.closest('form').submit();return false;">
                                        -
                                        <input type="hidden" name="qty" value="{{ $item->qty }}">
                                        @csrf

                                </form>
                            </div>
    </div>
</div>
</td>
<td id="ttd">{{ $item->total_harga }}</td>
<td>
    <button type="submit" class="btn btn-block text-white bg-danger" style="width: 40px;">
        X
    </button>
</td>
</tr>

@endforeach
<tr>
    <td></td>
    <td><span style="font-weight: bolder; font-size: large;">TOTAL</span></td>
    <td></td>

    <td id="total" style="font-weight: bolder;"></td>

    <td></td>
</tr>
</tbody>
</table>
<div class="container d-flex pembayaran">
    <div>
        <button type="submit" class="btn btn-block text-white bg-success" data-toggle="modal"
        data-target="#nontunai">
            Pembayaran NonTunai
        </button>
    </div>
    <div>
        <button type="submit" class="btn btn-block text-white bg-success" data-toggle="modal"
            data-target="#exampleModal">
            Pembayaran Tunai
        </button>
    </div>
    <div>
        <a href="/deleteall">
        <button type="submit" class="btn btn-block text-white bg-danger" >
            Hapus Semua
        </button></a>
    </div>
</div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Pembayaran
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('addlaporan') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{strtoupper(session('loggedUser')->username)}}}" name="user_id">
                    <input type="hidden" value="tunai" name="jns">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total</label>
                        <input type="text" class="form-control" id="totalread" name="total" readonly />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tunai</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="text" class="form-control" aria-label="Username"
                                aria-describedby="basic-addon1" id="harga" name="tunai" oninput="sumKem()" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Kembalian</label>
                        <input type="text" class="form-control" name="kembalian" id="harga" readonly />
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        Submit
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <span class="text-danger"
                            >@error('password'){{ $message }}@enderror</span
                        >
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nontunai" tabindex="-1" aria-labelledby="nontunaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nontunaiLabel">
                    Pembayaran
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('addlaporan') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{strtoupper(session('loggedUser')->username)}}}" name="user_id">
                    <input type="hidden" value="nontunai" name="jns">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Pembelian</label>
                        <input type="text" class="form-control" id="totalread1" name="total" readonly />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">No.hp / No. Rek</label>
                        <input type="text" class="form-control" name="norek"autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Transfer</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="text" class="form-control" aria-label="Username"
                                aria-describedby="basic-addon1" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" name="tunai" required autocomplete="off">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        Submit
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <span class="text-danger"
                            >@error('password'){{ $message }}@enderror</span
                        >
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('assets/js/costum.js') }}"></script>
<script>
    jQuery(".quantity").each(function () {
        var spinner = jQuery(this),
            input = spinner.find('input[type="number"]'),
            btnUp = spinner.find(".quantity-up"),
            btnDown = spinner.find(".quantity-down"),
            min = input.attr("min"),
            max = input.attr("max");

        btnUp.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

        btnDown.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });
    });

</script>

@endsection
