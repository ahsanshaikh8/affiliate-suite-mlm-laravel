@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users List</h1>
            </div>
            <div class="col-sm-6">
                @include('user.includes.breadcrums')
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
                                @php if(isset($value->doc_img_1)): @endphp
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
                          
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {!! $users->links() !!}
        </div>
    </div>
</div>
@endsection
