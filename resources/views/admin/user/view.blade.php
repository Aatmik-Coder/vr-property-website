@extends('admin.layouts.app')
@section('content')
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="form-group row col-sm-6">
                                <label class="col-sm-4 form-control-label">First Name</label>
                                <div class="col-sm-8">
                                    {{ $user->first_name }}
                                </div>
                            </div>
                            <div class="form-group row col-sm-6">
                                <label class="col-sm-4 form-control-label">Last Name</label>
                                <div class="col-sm-8">
                                    {{ $user->last_name }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group row col-sm-6">
                                <label class="col-sm-4 form-control-label">Email</label>
                                <div class="col-sm-8">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <div class="form-group row col-sm-6">
                                <label class="col-sm-4 form-control-label">Nickname</label>
                                <div class="col-sm-8">
                                    {{ $user->nick_name }}
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group row col-sm-6">
                                <label class="col-sm-4 form-control-label">Buisness Name</label>
                                <div class="col-sm-8">
                                    {{ $user->business_name }}
                                </div>
                            </div>
                            <div class="form-group row col-sm-6">
                                <label class="col-sm-4 form-control-label">Status</label>
                                <div class="col-sm-8">
                                    @if($user->is_active) Active @else Inactive @endif
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group row col-sm-6">
                                <label class="col-sm-4 form-control-label">Created At</label>
                                <div class="col-sm-8">
                                    {{ $user->created_at->format('F d, Y g:i a') }}
                                
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <button type="button" onclick="location.href='{{ route('admin.user.list') }}';" class="btn btn-secondary">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
