@extends('layout') @section('title','Dashboard') @section('content')
@section('pageheader','Dashboard')

<div class="container mt-3">
    <h4>Produk</h4>
    <div class="flex-container">
        <div class="produk">
            <div class="produk-item">
                @foreach($produk as $produk)
                <div class="card-produk mt-2 mb-2">
                    <form action="/addTempCart/{{$produk->id}}" method="post">
                        @csrf
                        <div
                            class="d-flex"
                            onclick="this.closest('form').submit();return false;"
                        >
                            <div class="item-produk">
                                <input
                                    type="text"
                                    name=""
                                    value="{{$produk->name_produk}}"
                                    readonly
                                />
                            </div>
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
                    </tr>
                </thead>

                <tbody>
                    @foreach($tempcart as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name_produk}}</td>
                        <td>
                            <div class="quantity">
                                
                                <input
                                    type="number"
                                    min="1"
                                    max="9"
                                    step="1"
                                    value="{{$item->qty}}"
                                    readonly
                                    
                                />

                                <div class="quantity-nav"> 
                                    <form
                                            action="/tambahqty/{{$item->id}}"
                                            method="post"
                                        >
                                    <div
                                        class="quantity-button quantity-up"
                                        onclick="this.closest('form').submit();return false;"
                                    >
                                        +
                                       
                                    @csrf

                                    </form>
                                    </div>
                                    <form
                                    action="/kurangqty/{{$item->id}}"
                                    method="post"
                                >
                            <div
                                class="quantity-button quantity-down"
                                onclick="this.closest('form').submit();return false;"
                            >
                                -
                               
                            @csrf

                            </form>
                            </div>
                                </div>
                            </div>
                        </td>
                        <td id="ttd">{{$item->total_harga}}</td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

            <p>{{ session("itemcount") }}</p>
        </div>
    </div>
</div>
@endsection @section('script')
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
