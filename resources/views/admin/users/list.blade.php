@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users List</h1>
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
                    <th>Email</th>
                    <th>Image</th>
                    <th>Phone</th>
                    <th>CNIC</th>
                    <th>DOB</th>
                    <th>Address</th>
                    <th>Investment</th>
                    <th>Referral Code</th>
                    <th>Referred By</th>
                    <th width="300px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($users) && $users->count())
                    @foreach($users as $key => $value)
                        <tr>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>
                                <img src="{{ asset('file/'.$value->doc_img) }}" width="100px" height="100px"/>
                                @php if(isset($value->doc_img_1)):@endphp
                                    <img src="{{ asset('file/'.$value->doc_img_1) }}" width="100px" height="100px"/>
                                @php endif; @endphp
                            </td>
                            <td>{{ $value->phone_no }}</td>
                            <td>{{ $value->cnic }}</td>
                            <td>{{ $value->dob }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->initial_investment }}</td>
                            <td>{{ $value->referral_code }}</td>
                            <td>{{ Helper::getReferralCodeById($value->referred_by) }}</td>
                            <td style="display:flex;">
                            <button type="button" class="btn btn-secondary view-user-data" record-id="{{ $value->id }}" data-toggle="modal" data-target="#viewUserData">View</button>
                            <a href="{{ route('admin.user.edit',$value->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.user.destroy',$value->id) }}" method="POST">
                                <input type="hidden" value="{{ $value->id }}" name="user_id" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                            <form action="{{ route('admin.user.changeStatus',$value->id) }}" method="POST">
                            <input type="hidden" value="{{ $value->id }}" name="user_id" >
                           
                                @csrf

                                @if($value->status == 'pending') 
                                    <button type="submit" class="btn btn-success">Activate</button>
                                    <input type="hidden" value="active" name="status" >
                                @else
                                    <button type="submit" class="btn btn-info">Pending</button>
                                    <input type="hidden" value="pending" name="status" >
                                @endif
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

<!-- Modal -->
<div class="modal fade" id="viewUserData" tabindex="-1" role="dialog" aria-labelledby="viewUserDatalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewUserDataModalLabel">User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body user-data-modal">
            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
      </div>
     
    </div>
  </div>
</div>
        
        {!! $users->links() !!}
        </div>
    </div>
</div>
@endsection
