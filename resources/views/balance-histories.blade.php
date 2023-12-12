@extends("app")
@section('content')
    <div class="container mt-5">
        <form method="GET" action="{{route("balancehistory.index")}}">
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search" value="{{$search}}" placeholder="Search Transaction Code & Description">
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success btn-block">Search</button>
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col">Type</th>
                <th scope="col" >Code</th>
                <th scope="col" >Amount</th>
                <th scope="col" >Description</th>
                <th scope="col" >Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                <?php $color = $transaction->type == "top-up" ? 'text-success' : 'text-danger' ?>
                <tr>
                    <th scope="row">{{ $transaction->id }}</th>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ $transaction->code }}</td>
                    <td><p class="{{$color}}">{{ $transaction->amount }}</p></td>
                    <td>{{ $transaction->description }}</td>
                    <td><a href="{{route("balancehistory.detail", $transaction->id)}}">Detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex float-right">
            {!! $transactions->links() !!}
        </div>
    </div>
@endsection
