<?php
    $transaction = !empty($data["transaction"]) ? $data["transaction"] : null;
    $transactions = !empty($data["transactions"]) ? $data["transactions"] : [];
?>
@extends("app")
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <!-- Details -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <span class="me-3">Last 5 transactions</span>
                            </div>
                        </div>
                        @if($transactions)
                            <table class="table table-borderless">
                                <tbody>
                                @foreach($transactions as $value)
                                    <tr>
                                        <td width="80%" colspan="2">{{$value->description}}</td>
                                        <td width="20%" class="text-end {{ ($value->type == "top-up") ? "text-success" : "text-danger" }}">Rp {{number_format($value->amount)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3 class="h6">Payment Type</h3>
                                <p>{{strtoupper($transaction->type)}} <br>
                                    Total: Rp. {{number_format($transaction->amount)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($transaction->type == 'top-up')
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class='mb-4'>Upload Transaction Payment</div>
                                    <img src="/{{$transaction->image_url}}" style="max-width:400px;width:400px" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
