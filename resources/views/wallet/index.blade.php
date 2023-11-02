@extends('voyager::master')

@section('content')

@if($wallet == NULL)
$balance = 0;
@else
$balance = $wallet->balance
@endif
<span>Balance: {{$balance}}</span>

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
    @else
    @foreach($transactions as $transaction)
    <div>
        <span>{{$transaction->type}}</span>
        <span>{{$transaction->reference}}</span>
        <span>{{$transaction->amount}}</span>
        <span>{{$transaction->created_at}}</span>
    </div>
    @endforeach
    @endif


</div>

@stop