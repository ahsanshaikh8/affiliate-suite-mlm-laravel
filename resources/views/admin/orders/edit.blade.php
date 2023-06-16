@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Order Edit {{ $order->id }}</h1>
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
                <form method="POST" enctype="multipart/form-data" id="order-form" action="{{ route('admin.orders.store') }}">
                    @csrf
                    <input id="total" type="hidden" name="total" {{ $order->total }}>

                   

                    <div class="row mb-2">
                        <div class="col-md-12">
                            <select class="form-control" name="user_id">
                                @foreach ($users  as $value)
                                    <option value="{{ $value->id }}" {{ ($value->id == $order->user_id)?'selected':'' }} > 
                                        {{ $value->email }} 
                                    </option>
                                @endforeach    
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2" id="dup-order-row" >
                        <?php $i=0;?>
                        @foreach($order_details as $detail)
                        
                        <div class="col-md-7" >
                            <select id="{{ ($i==0)?'product':'product_'.$i }}" class="form-control product_ids" name="product_id[]">
                                @foreach ($products  as $value)
                                    <option  {{ ($value->id == $detail->product_id)?'selected':'' }}  data-price="{{ $value->price }}" value="{{ $value->id }}" > 
                                        {{ $value->name }} 
                                    </option>
                                @endforeach    
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input id="{{ ($i==0)?'quantity':'quantity_'.$i }}" type="number" placeholder="Add Quantity" min=1  value="{{ $detail->quantity }}" class="form-control @error('quantity') is-invalid @enderror" name="quantity[]" value="{{ old('quantity') }}" required autocomplete="quantity" autofocus>
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <?php $i++;?>
                        @endforeach
                  
                    </div>
                    <button type="button" id="btn_add_new_product" class="btn btn-info float-right">
                        <span class="fa fa-plus-circle" aria-hidden="true"></span> 
                    </button>

                    <div class="row mb-0">
                        <div class="col-md-2">
                            <button type="submit" id="btn_save_order" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-3">

                <h3 >Order Total: <span id="price">{{  $order->total }}</span> </h3>
                <a class="btn btn-info" id="cal-price" >Calculate</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var counter = {{ count($order_details) }};
       $('#btn_add_new_product').click(function(){
            if($('#quantity').val() != '' && $('#quantity_'+counter).val() != ''){
                    $('#dup-order-row').append(
                        '<br><div class="col-md-7" >'+
                            '<select  id="product_'+counter+'" class="form-control product_ids" name="product_id[]">'+
                                '<option>Select Product</option>'+
                                '@foreach ($products  as $value)'+
                                    '<option  data-price="{{ $value->price }}" value="{{ $value->id }}" > '+
                                        '{{ $value->name }}'+ 
                                    '</option>'+
                                '@endforeach   '+ 
                            '</select>'+
                        '</div>'+
                        '<div class="col-md-5">'+
                            '<input id="quantity_'+counter+'" type="number" placeholder="Add Quantity" min=1  class="form-control @error("quantity") is-invalid @enderror" name="quantity[]"  required autocomplete="quantity" autofocus>'+
                            '@error("quantity[]")'+
                                '<span class="invalid-feedback" role="alert">'+
                                    '<strong>{{ $message }}</strong>'+
                                '</span>'+
                            '@enderror'+
                        '</div>'
                    );
                  

                    counter++;
                }else{
                    alert('Select Product and Enter Quantity');
                }
       });

       $('#cal-price').on('click',function(e){
            var product_select = jQuery('.product_ids');
            var product_price = 0;
            for(var i=0; i< product_select.length;i++){
                console.log(i)
                if( i == 0 ){
                    product_price = product_price + $('#product  option:selected').data('price') * parseInt($('#quantity').val());
                }else{
                    product_price = product_price + $('#product_'+i+'  option:selected').data('price') *  parseInt($('#quantity_'+i).val());
                }
                $('#price').text(product_price);
                $('#total').val(product_price);
            }
           
        });
    });
</script>
@stop
