@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="" style="text-align: right">
                        <form action="{{route('new.voucher')}}" method="post">
                            @csrf
                            <button class="btn btn-primary btn-large" type="submit"> New Voucher Request</button>
                        </form>
                        <br/>
                    </div>
                        @if ($voucherRequests)
                            @foreach($voucherRequests as $voucherRequest)
                                <div class="card">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <p>Date: {{$voucherRequest->created_at}}</p>
                                        <p>Status: {{$voucherRequest->status}}</p>
                                        @if ($voucherRequest->status==='approved')
                                            <p>Code: {{$voucherRequest->code}}</p>
                                        @endif
                                        @if ($voucherRequest->status==='declined')
                                            <p>Reason: {{$voucherRequest->rej_reason}}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        @if (! $voucherRequests)
                            No voucher request have been created
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
