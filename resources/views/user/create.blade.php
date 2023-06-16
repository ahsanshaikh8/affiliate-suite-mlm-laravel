@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users Create</h1>
            </div>
            <div class="col-sm-6">
               @include('user.includes.breadcrums')
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 mb-10">
            <form method="POST" enctype="multipart/form-data" action="{{ route('user.save') }}">
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
                        <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">

                    <div class="col-md-12">
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">

                    <div class="col-md-12">
                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                     
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="phone_no" type="tel"  data-inputmask="'mask': '(+99) 9999 - 999999'" placeholder="Phone Number" class="form-control" value="{{ old('phone_no') }}" name="phone_no" required autocomplete="phone_no">
                        @error('phone_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="wallet_address" type="text" placeholder="Deposit Wallet Address" class="form-control"  value="{{ old('wallet_address') }}" name="wallet_address" required autocomplete="wallet_address" >
                        @error('wallet_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="cnic" type="text" data-inputmask="'mask': '99999-9999999-9'"  min="8" placeholder="CNIC" class="form-control" value="{{ old('cnic') }}"name="cnic" required  autocomplete="cnic" >
                        @error('cnic')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="house_street" type="text" placeholder="House and Street" class="form-control mb-2" name="house_street" value="{{ old('house_street') }}" required  autocomplete="house_street" >
                        <input id="area" type="text" placeholder="Area" class="form-control mb-2" name="area" value="{{ old('area') }}" required  autocomplete="area" >
                        <input id="city" type="text" placeholder="City" class="form-control mb-2" name="city" value="{{ old('city') }}" required  autocomplete="city" >
                        <input id="state" type="text" placeholder="Province / State" class="form-control mb-2" value="{{ old('state') }}" name="state" required  autocomplete="state" >
                        <input id="country" type="text" placeholder="Country" class="form-control mb-2" name="country" value="{{ old('country') }}" required  autocomplete="country" >
                        @error('house_street'||'area')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="dob" type="date" placeholder="DOB"  max="2007-12-31" class="form-control"  value="{{ old('dob') }}" name="dob" required >
                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="refferal_code" type="text" placeholder="Referal Code"  class="form-control"  value="{{ $referral_code }}" disabled>
                        <input type="hidden" value="{{ $referral_code }}" name="refferal_code">
                        @error('refferal_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <input id="initial_investment" type="text" value="{{ old('initial_investment') }}"  placeholder="Initial Investment" class="form-control" name="initial_investment" required >
                        @error('initial_investment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12  mb-2">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn bg-olive">
                                <input type="radio" name="doc_type" id="option_b1" autocomplete="off" value="driving_lisence" > Driving Lisence
                            </label>
                            <label class="btn bg-olive">
                                <input type="radio" name="doc_type" id="option_b2" autocomplete="off" value="cnic"> CNIC
                            </label>
                            <label class="btn bg-olive">
                                <input type="radio" name="doc_type" id="option_b3" autocomplete="off" value="passport"> Passport 
                            </label>
                            <label class="btn bg-olive">
                                <input type="radio" name="doc_type" id="option_b4" autocomplete="off" value="bank_statement"> Bank Statment
                            </label>
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
            
        </div>
    </div>
</div>

<script>
    $(":input").inputmask();
    $('.btn-group-toggle > label >input').click(function(){
        $('.btn-group-toggle > label').removeClass('active');
        $(this).parent().addClass('active');
        console.log($(this).val());
        if($(this).val() == 'driving_lisence' || $(this).val() == 'cnic' ){
            $('#doc_img_1').removeClass('hide');
        }else{
            $('#doc_img_1').addClass('hide');
        }
    });
</script>
@stop
