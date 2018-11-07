@extends('layouts.admin')

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

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>User Email</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($voucherRequests as $voucherRequest)
                                <tr>
                                    <td>{{$voucherRequest->email}}</td>
                                    <td>{{$voucherRequest->created_at}}</td>
                                    <td>
                                        @if ($voucherRequest->status==='pending' || $voucherRequest->status===null)
                                            <span>
                                            <form method="post" action="/voucher/{{$voucherRequest->id}}">
                                                @csrf
                                                @method('put')
                                                <button class="btn btn-success" type="submit" name="approved" value="declined">Approve</button>
                                                <button class="btn btn-danger" type="submit" name="declined" value="declined">Reject</button>
                                            </form>
                                        </span>
                                        @endif
                                        @if ($voucherRequest->status!=='pending')
                                            {{$voucherRequest->status}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
