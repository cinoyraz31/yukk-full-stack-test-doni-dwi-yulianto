<?php
    $transcation_type = old("transaction_type");
    $uploadHideStyle = ($transcation_type != 'top-up') ? "display: none;" : '';
?>
@extends("app")
@section('content')
    <div class="box-input-form">
        <div class="container-fluid">
            <form method="post" action="{{route("transaction.create")}}" enctype="multipart/form-data">
                @csrf
                <h4 class="mb-4">Masukkan Nilai Transaksi</h4>
                <div class="form-group row">
                    <label for="transaction-type" class="col-sm-2 col-form-label">Tipe Transaksi *</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="transaction-type" name="transaction_type">
                            <option value="">Pilih Tipe Transaksi</option>
                            <option value="top-up" {{($transcation_type == 'top-up' ? 'selected' : '')}}>TOP UP</option>
                            <option value="transaction" {{($transcation_type == 'transaction' ? 'selected' : '')}}>Transaksi</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-2 col-form-label">Jumlah *</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" class="form-control" id="amount" name="amount" value="{{old("amount")}}" placeholder="Jumlah Transaksi (Rp)">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Keterangan *</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" name="description" rows="3">{{old("description")}}</textarea>
                    </div>
                </div>
                <div class="wrapper-upload-file" style="{{$uploadHideStyle}}">
                    <div class="form-group row">
                        <label for="upload-file" class="col-sm-2 col-form-label">Upload File</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" id="upload-file" name="upload_file">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('local_script')
    <script>

        var regExp = /[a-z]/i;
        $('#amount').on('keydown keyup', function(e) {
            var value = String.fromCharCode(e.which) || e.key;

            // No letters
            if (regExp.test(value)) {
                e.preventDefault();
                return false;
            }
        });

        if($("#transaction-type").length > 0){
            $("#transaction-type").change(function(){
                var self = $(this);
                var val = self.val();

                switch (val){
                    case "top-up":
                        $( '.wrapper-upload-file' ).fadeIn();
                        break;
                    default:
                        $( '.wrapper-upload-file' ).fadeOut();
                        break;
                }
            });
        }
    </script>
@endsection
