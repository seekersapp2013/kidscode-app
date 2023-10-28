@extends('voyager::master')

@section('content')

<span>Balance: {{$wallet->balance}}</span>

<div>
    <h3>Transaction History</h3>

    <div class="">
        <span>Transaction Type</span>
        <span>Transaction Reference</span>
        <span>Transaction Amount</span>
        <span>Transaction Time</span>
    </div>

    @if(count($transactions) === 0)
    <p>You've not made any transaction yet.</p>
    @endif

    @foreach($transactions as $transaction)
    <div>
        <span>{{$transaction->type}}</span>
        <span>{{$transaction->reference}}</span>
        <span>{{$transaction->amount}}</span>
        <span>{{$transaction->created_at}}</span>
    </div>
    @endforeach
</div>

@stop