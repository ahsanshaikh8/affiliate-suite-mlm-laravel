<!DOCTYPE html>
<html lang="en">
   @if(auth()->user()->is_admin)
      @include('admin.includes.head')
   @else
      @include('user.includes.head')
   @endif
    <script src="{{ asset('js/app.js') }}"></script>
   <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
   <body class="hold-transition sidebar-mini">
      <div class="wrapper" id="app">
         @if(auth()->user()->is_admin)
            @include('admin.includes.header')
         @else
            @include('user.includes.header')
         @endif
         <div class="content-wrapper">
            @if ($errors->any())
               <div class="alert alert-danger">
                  {{$errors->first()}}
               </div>
            @endif
            @if ($message = Session::get('success'))
               <div class="alert alert-success">
                  <p>{{ $message }}</p>
               </div>
            @endif
            @yield('content')
         </div>
         <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
               <h5>Title</h5>
               <p>Sidebar content</p>
            </div>
         </aside>
         <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
               Anything you want
            </div>
            <strong>Copyright &copy; 2020-2022 <a href="https://metamagic.io">MetaMagic</a>.</strong> All rights reserved.
         </footer>
      </div>

         <script>

         jQuery(document).ready(function () {

            jQuery(document).on("click",".view-user-data", function() {
                        
                        jQuery(".fa-spin").css({"visibility":"visible"});

                        var recordId = jQuery(this).attr("record-id");

                        jQuery.ajax({
                           type:'POST',
                           url:'/getFieldDataHTML',
                           data: {action:"get_field_html","user_id":recordId},
                           success:function(data) {
                              jQuery(".fa-spin").css({"visibility":"hidden"});
                              jQuery("#viewUserData").find(".user-data-modal").html(data);
                              
                           }
                        });             


                  });

                  jQuery(":input").inputmask();
                  jQuery('.btn-group-toggle > label >input').click(function(){
                     jQuery('.btn-group-toggle > label').removeClass('active');
                     jQuery(this).parent().addClass('active');
                     console.log(jQuery(this).val());
                     if(jQuery(this).val() == 'driving_lisence' || jQuery(this).val() == 'cnic' ){
                           jQuery('#doc_img_1').removeClass('hide');
                     }else{
                           jQuery('#doc_img_1').addClass('hide');
                     }
                  });

               });
         </script>

    
   </body>
</html>