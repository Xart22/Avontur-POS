@extends('layout')@section('header')
<link rel="stylesheet" href="{{ asset('assets/css/struk.css') }}">



@endsection


@section('header')
@section('title','Report') @section('content')
@section('pageheader','Report Penjualan')



<div class="container">
    <div class="struk">
        <div class="header-struk">
        <div class="img">
        <img src="{{ asset('assets/img/struk.png') }}" width="200"><br>
        </div>
        <div class="text">
        <span >📍 Jl. Pasteur No.29 Pasirkaliki </span>
         <span>Bandung - Jawa Barat</span>
        </div>
        </div>
        <div class="user-struk row">
             @if($invoice)
            <div class="no col">
                <span>No : {{$invoice->no_inv}}</span>
            </div>
            <div class="user col">
                <span>Kasir : {{$invoice->operator}}</span>
            </div>
         </div>
         @endif 
    <div class="container" >
    <div class="item-struk">
       @foreach($laporan as $item)
       <table class="w-100">
           <thead>
               <tr>
               <th width=50%></th>
               <th></th>
               <th></th>
            </tr>
           </thead>
           <tbody>
               <tr>
               <td>{{$item->name_produk}}</td>
               <td>x{{$item->qty}}</td>
               <td id="total">{{$item->total_harga}}</td>
            </tr>
           </tbody>
       </table>
       @endforeach
        </div>
      </div>
    
    <div class="total-item"style="border-top: 1px dashed black;">
        @if($invoice)
        <span style="margin-left: 5px;">Total Item : </span> <span style="float: right; margin-right: 5px;">{{count($laporan)}}</span><br>
        <span style="margin-left: 5px;">Tunai : </span><span style="float: right; margin-right: 5px; width: 78px;" id="tunai">Rp. {{$invoice->tunai}}</span><br>
        @endif
        @if($invoice->kembalian === null)
        <span style="margin-left: 5px;">Kembalian :</span><span style="float: right; margin-right: 5px; width: 78px;">0</span>
        @else
        <span style="margin-left: 5px;">Kembalian :</span><span style="float: right; margin-right: 5px; width: 78px;">{{$invoice->kembalian}}</span>
        @endif
    </div>
    <div class="footer">
      <span style="margin-left: 5px;">Tgl. </span><span id="tgl"></span>  <span id="wkt" style="float: right; margin-right: 5px;">Tgl.</span><br>
    </span>
    </div>
    <div class="tq">
        thank you for visiting
    </div>
</div>


    
</div>
@section('script')
<script src="{{ asset('assets/js/struk.js') }}"></script>


@endsection

@endsection