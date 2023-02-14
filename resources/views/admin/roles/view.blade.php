@extends('admin.layouts.app')
@section('content')
<!-- Dashboard Counts Section-->
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <!-- Form Elements -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{!! route('admin.roles.index') !!}" class="btn btn-primary">Back</a>
                        </div>
                        <form id="profileFrm" name="profileFrm" action="" class="form-horizontal">
                            @csrf
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Role</label>
                                <div class="col-sm-9">
                                    <p>{!! $role->name !!}</p>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-3 form-control-label">Permissions</label>
                                <div class="col-sm-9">
                                    @foreach ($role_permissions as $role_permission)
                                        <p>{!! $role_permission->name !!}</p>
                                    @endforeach
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')
<script src="{{ asset('assets/admin/js/auth.js') }}"></script>
@stop
@endsection
