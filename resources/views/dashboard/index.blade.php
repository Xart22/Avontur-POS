@extends('layout') @section('header')
<script src="{{ asset('assets/js/jquery.easy-autocomplete.min.js') }}"></script>
<link
    rel="stylesheet"
    href="{{ asset('assets/css/easy-autocomplete.min.css') }}"
/>
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"
></script>

@section('title','Dashboard') @section('content')
@section('pageheader','Dashboard')

<div class="container mt-3">
    <h4>Produk</h4>
    <div class="flex-container">
        <div class="produk">
            <div class="produk-item">
                @foreach($produk as $produk)
                <div class="card-produk mt-2">
                    <form action="" method="post">
                        <div class="d-flex">
                            <div class="item-produk">
                                <input
                                    type="text"
                                    name=""
                                    value="{{$produk->name_produk}}"
                                    readonly
                                />
                                <input
                                    type="text"
                                    name="id"
                                    hidden
                                    value="{{$produk->id}}"
                                />
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        <div class="cart">awdwadwa dawdaw dawdawdawdwad awdawdaw d</div>
    </div>
</div>
@endsection
