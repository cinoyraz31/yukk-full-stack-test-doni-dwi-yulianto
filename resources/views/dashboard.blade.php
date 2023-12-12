<?php
    $transaction = !empty($transactions["transaction"]) ? $transactions["transaction"] : 0;
    $topup = !empty($transactions["top-up"]) ? $transactions["top-up"] : 0;
?>
@extends('app')
@section('content')
    <div class="row m-4">
        <div class="col-sm-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                Current Balance</div>
                            <div class="h5 mb-0 font-weight-bold text-success">Rp. {{number_format($balance)}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-alt fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                TOP UP</div>
                            <div class="h5 mb-0 font-weight-bold text-success">{{$transaction}}x</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-level-up-alt fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                Transaction</div>
                            <div class="h5 mb-0 font-weight-bold text-success">{{$topup}}x</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-level-down-alt fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
