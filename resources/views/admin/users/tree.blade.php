@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Connected Affiliates</h1>
            </div>
            <div class="col-sm-6">
               @include('admin.includes.breadcrums')
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
    <div class="container bootdey">
<div class="row">
    <div class="col">
        <div class="user-widget-2">
            <div id="accordion">
            @foreach($users as $key => $value)

                <!-- card start  -->

                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-{{ $key }}" aria-expanded="false" aria-controls="collapse-{{ $key }}">
                            <img class="rounded-circle d-flex align-self-center" src="{{ asset('file/'.$value['admin']->doc_img) }}" alt="">                              
                            </button>
                        </h5>
                    </div>
                    <div id="collapse-{{ $key }}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body" id="child{{ $key }}">
                            <h5>{{ $value['admin']->name }}</h5>
                            <p>{{ $value['admin']->email }}</p>
                            <p><span class="badge badge-outline badge-sm badge-info badge-pill">{{ $value['admin']->phone_no }}</span>
                            <p><span class="badge badge-outline badge-sm badge-primary badge-pill">{{ $value['admin']->status }}</span></p>
                            <p><span class="badge badge-outline badge-sm badge-danger badge-pill">{{ $value['admin']->address }}</span></p>
        
                            @foreach($value['users'] as $userkey => $uservalue)

                            <div class="card">
                                <div class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapseOne{{  $userkey }}"> <img class="rounded-circle d-flex align-self-center" src="{{ asset('file/'.$uservalue->doc_img) }}" alt=""> </a>
                                </div>
                                <div class="card-body collapse" data-parent="#child{{ $key }}" id="collapseOne{{  $userkey }}">
                                <h5>{{ $uservalue->name }}</h5>
                                <p>{{ $uservalue->email }}</p>
                                <p><span class="badge badge-outline badge-sm badge-info badge-pill">{{ $uservalue->phone_no }}</span>
                                <p><span class="badge badge-outline badge-sm badge-primary badge-pill">{{ $uservalue->status }}</span></p>
                                <p><span class="badge badge-outline badge-sm badge-danger badge-pill">{{ $uservalue->address }}</span></p>
        
                                </div>
                            </div>

                            @endforeach  

                        </div>
                    </div>
                </div>
                <!-- card end  -->
            @endforeach   
            </div>
        </div>
    </div>

    <!-- <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0 d-inline">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Collapsible #1
                    </button>
                 </h5>
                 <a href="#" data-target="[data-parent='#child1']" data-toggle="collapse" class="my-2 float-right">close all</a>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body" id="child1">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapseOneA">Child A</a>
                        </div>
                        <div class="card-body collapse" data-parent="#child1" id="collapseOneA">
                            Crunch wolf moon tempor, sunt aliqua put a bird.
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a href="#" data-toggle="collapse" data-target="#collapseOneB">Child B</a>
                        </div>
                        <div class="card-body collapse" data-parent="#child1" id="collapseOneB">
                            Another flipp runch wolf moon tempor, sunt aliqua put a bird.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Collapsible #2
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                    on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                    raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Collapsible #3
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird
                    on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                    raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
    </div> -->
</div>
</div>



<style type="text/css">
body {
    margin-top: 20px;
}

.user-widget-2 .media {
    margin-bottom: 20px;
}

.user-widget-2 h5 {
    font-size: 0.9375rem;
    font-weight: 400;
    margin-bottom: 10px;
}

.user-widget-2 p {
    font-size: 0.8125rem;
    margin-bottom: 10px;
}

.user-widget-2 p .badge {
    margin-right: 10px;
}

.user-widget-2 i {
    margin-left: 20px;
    margin-right: 20px;
}

.user-widget-2 .rounded-circle {
    border: 3px solid #fff;
    height: 50px;
    width: 50px;
    -webkit-box-shadow: 0px 2px 4px -1px rgba(0, 0, 0, 0.2), 0px 4px 5px 0px rgba(0, 0, 0, 0.14), 0px 1px 10px 0px rgba(0, 0, 0, 0.12);
    box-shadow: 0px 2px 4px -1px rgba(0, 0, 0, 0.2), 0px 4px 5px 0px rgba(0, 0, 0, 0.14), 0px 1px 10px 0px rgba(0, 0, 0, 0.12);
    margin-right: 20px;
}

.sample-badges .badge {
    margin-right: 10px;
}

.badge {
    border-radius: 8px;
    border: 0;
    font-size: 0.75rem;
    text-align: center;
    line-height: 0.8;
    padding: 8px 12px;
    font-weight: normal;
}

.badge.badge-sm {
    font-size: 0.625rem;
    line-height: 0.6;
}

.badge.badge-lg {
    font-size: 0.875rem;
    line-height: 1;
}

.badge.badge-rounded {
    padding: 0;
    height: 24px;
    width: 24px;
    line-height: 24px;
    border-radius: 50%;
    display: inline-block;
    vertical-align: middle;
}

.badge.badge-rounded.badge-sm {
    height: 18px;
    width: 18px;
    line-height: 18px;
    border-radius: 50%;
}

.badge.badge-rounded.badge-sm.badge-outline {
    line-height: 16px;
}

.badge.badge-rounded.badge-lg {
    height: 30px;
    width: 30px;
    line-height: 30px;
    border-radius: 50%;
}

.badge.badge-rounded.badge-lg.badge-outline {
    line-height: 28px;
}

.badge.badge-light:not(.badge-outline) {
    background-color: #ffffff;
    color: #fff;
}

.badge.badge-outline.badge-light {
    border: 1px solid #ffffff;
    background-color: transparent;
    color: #ffffff;
}

.badge.badge-dark:not(.badge-outline) {
    background-color: #212121;
    color: #fff;
}

.badge.badge-outline.badge-dark {
    border: 1px solid #212121;
    background-color: transparent;
    color: #212121;
}

.badge.badge-default:not(.badge-outline) {
    background-color: #212121;
    color: #fff;
}

.badge.badge-outline.badge-default {
    border: 1px solid #212121;
    background-color: transparent;
    color: #212121;
}

.badge.badge-primary:not(.badge-outline) {
    background-color: #303f9f;
    color: #fff;
}

.badge.badge-outline.badge-primary {
    border: 1px solid #303f9f;
    background-color: transparent;
    color: #303f9f;
}

.badge.badge-secondary:not(.badge-outline) {
    background-color: #7b1fa2;
    color: #fff;
}

.badge.badge-outline.badge-secondary {
    border: 1px solid #7b1fa2;
    background-color: transparent;
    color: #7b1fa2;
}

.badge.badge-info:not(.badge-outline) {
    background-color: #0288d1;
    color: #fff;
}

.badge.badge-outline.badge-info {
    border: 1px solid #0288d1;
    background-color: transparent;
    color: #0288d1;
}

.badge.badge-success:not(.badge-outline) {
    background-color: #388e3c;
    color: #fff;
}

.badge.badge-outline.badge-success {
    border: 1px solid #388e3c;
    background-color: transparent;
    color: #388e3c;
}

.badge.badge-warning:not(.badge-outline) {
    background-color: #ffa000;
    color: #fff;
}

.badge.badge-outline.badge-warning {
    border: 1px solid #ffa000;
    background-color: transparent;
    color: #ffa000;
}

.badge.badge-danger:not(.badge-outline) {
    background-color: #d32f2f;
    color: #fff;
}

.badge.badge-outline.badge-danger {
    border: 1px solid #d32f2f;
    background-color: transparent;
    color: #d32f2f;
}
</style>

    </div>
</div>
@stop
