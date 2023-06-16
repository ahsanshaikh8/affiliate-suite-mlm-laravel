@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User Edit</h1>
            </div>
            <div class="col-sm-6">
               @include('admin.includes.breadcrums')
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <form method="POST"  enctype="multipart/form-data"  action="{{ route('admin.user.update') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="row">
                <div class="col-md-7 mb-10">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input id="email" disabled type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" >

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input id="phone_no" type="tel"  data-inputmask="'mask': '0399-99999999'" placeholder="Phone Number" class="form-control" name="phone_no" value="{{ $user->phone_no }}" required autocomplete="phone_no">
                            @error('phone_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input id="wallet_address" type="text" disabled placeholder="wallet_address" class="form-control" value="{{ $user->wallet_address }}" required autocomplete="wallet_address" >
                            @error('wallet_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input id="cnic" type="text" min="13" placeholder="CNIC" class="form-control" name="cnic" value="{{ $user->cnic }}" required  autocomplete="cnic" >
                            @error('cnic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input id="address" type="text" placeholder="Address" class="form-control" name="address" value="{{ $user->address }}" required  autocomplete="address" >
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input id="dob" type="date" placeholder="DOB" class="form-control" value="{{ $user->dob }}" name="dob" required >
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input id="reffered_by" type="text" placeholder="Referal Code" class="form-control" value="{{ $user->reffered_by }}" name="reffered_by"    autocomplete="reffered_by">
                            @error('reffered_by')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <input id="initial_investment" type="text" placeholder="Initial Investment" class="form-control"  value="{{ $user->initial_investment }}" name="initial_investment" required >
                            @error('initial_investment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12  mb-2">
                        <input id="doc_img" type="file"  value="{{ old('doc_img') }}" class="form-control" name="doc_img" >
                        @error('doc_img')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <input id="doc_img_1" type="file"  value="{{ old('doc_img_1') }}" class="form-control" name="doc_img_1" >
                        @error('doc_img_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-10 ml-10">
                    <img src="{{ asset('file/'.$user->doc_img) }}" width="250px" height="250px"/>
                    <hr>
                    @php if(isset($user->doc_img_1)):@endphp
                        <img src="{{ asset('file/'.$user->doc_img_1) }}" width="250px" height="250px"/>
                    @php endif; @endphp
                </div>
        </div>
    </form>

    </div>
</div>
@stop
