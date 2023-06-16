@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Product List</h1>
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
                    <th>Name</th>
                    <th>Image</th>
                    <th>ROI</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Updated By</th>
                    <th width="300px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($products) && $products->count())
                    @foreach($products as $key => $value)
                        <tr>
                            <td>{{ $value->name }}</td>
                            <td><img src="{{ asset('file/'.$value->image) }}" width="100px" height="100px"/></td>
                            <td>{{ $value->roi }}</td>
                            <td>{{ $value->price }}</td>
                            <td>{{ Helper::getCategoryNameById($value->category_id) }}</td>
                            <td>{{ Helper::getUserNameById($value->updated_by) }}</td>
                            <td>
                                <form action="{{ route('admin.products.destroy',$value->id) }}" method="POST">
                                    <a href="{{ route('admin.products.edit',$value->id) }}" class="btn btn-warning">Edit</a>
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
        {!! $products->links() !!}
        </div>
    </div>
</div>
@endsection
