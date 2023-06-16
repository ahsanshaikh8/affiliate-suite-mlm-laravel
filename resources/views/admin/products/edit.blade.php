@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Product Edit</h1>
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
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.update',$product->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-2">

                    <div class="col-md-12">
                        <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

    
                <div class="row mb-2">
                    <div class="col-md-6">
                        <input id="image" type="file" min="13"  class="form-control" name="image" >
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <img src="{{ $product->image }}" width="150px">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="roi" type="text" placeholder="roi" class="form-control" name="roi" required value="{{ $product->roi }}"  autocomplete="roi" >
                        @error('roi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
               
              
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="price" type="text" placeholder="price" class="form-control" name="price" value="{{ $product->price }}" required >
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
                            @foreach ($categories as $value)
                                <option value="{{ $value->id }}" {{ ($product->category_id == $value->id)?'selected':'' }} > 
                                    {{ $value->name }} 
                                </option>
                            @endforeach    
                        </select>
                    </div>
                </div>
                

                <div class="row mb-0">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>
            </form>
            </div>
            
        </div>
    </div>
</div>
@stop
