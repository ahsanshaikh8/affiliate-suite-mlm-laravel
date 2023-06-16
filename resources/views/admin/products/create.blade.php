@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Product Create</h1>
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
            <div class="col-md-7 mb-10">
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.store') }}">
                @csrf

                <div class="row mb-2">

                    <div class="col-md-12">
                        <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

    
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="image" type="file" class="form-control" name="image" >
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="roi" type="text" placeholder="roi" class="form-control" name="roi" required  autocomplete="roi" >
                        @error('roi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
               
              
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="price" type="text" placeholder="price" class="form-control" name="price" required >
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-2">
                    <div class="col-md-12">
                        <select class="form-control" name="category_id">
                            <option>Select Category</option>
                            @foreach ($categories as $value)
                                <option value="{{ $value->id }}" > 
                                    {{ $value->name }} 
                                </option>
                            @endforeach    
                        </select>
                    </div>
                </div>
                

                <div class="row mb-0">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
                        </button>
                    </div>
                </div>
            </form>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-product-category">
                    Add Category
                    </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="modal-add-product-category" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Save Product Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.category.store') }}">
                    @csrf
                     <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
        
    </div>
    
</div>
<script>

</script>
@stop
