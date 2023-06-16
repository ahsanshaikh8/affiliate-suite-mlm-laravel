@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Order List</h1>
            </div>
            <div class="col-sm-6">
                @include('admin.includes.breadcrums')
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                    <th width="300px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($orders) && $orders->count())
                    @foreach($orders as $key => $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->user_id }}</td>
                            <td>{{ $value->status }}</td>
                            <td>{{ $value->total }}</td>
                            <td>
                                <form action="{{ route('admin.orders.destroy',$value->id) }}" method="POST">
                                    <a href="{{ route('admin.orders.edit',$value->id) }}" class="btn btn-warning">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {!! $orders->links() !!}
        </div>
    </div>
</div>
@endsection
