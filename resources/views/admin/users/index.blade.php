@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('metronics/plugins/bootstrap-toastr/toastr.min.css') }}">

<link rel="stylesheet" href="{{ asset('metronics/plugins/datatables/custom.css') }}">
@endpush

@section('content')

<div class="row">
    
    <div class="col-md-12">
        <div class="portlet box blue-hoki">

            @section('portlet-button')
                <a class="btn btn-sm green user-modal" action="Create"><span><i class="fa fa-plus"></i> Create</span></a>
            @endsection

            @include('admin.partials.portlet-header')

            <div class="portlet-body">
                @if(session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Action</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Role</td>
                        </tr>
                    </thead>
                    @foreach($users as $user)
                    <tr data-id="{{ $user->id }}">
                        <div class="custom-row">
                            <td>
                                <a class="btn btn-sm blue user-modal" data="{{ $user }}" action="Edit" href="javascript:void(0);"> <i class="fa fa-edit"></i> Edit</a>
                                <a class="btn btn-sm red user-delete" data-id="{{ $user->id }}" href="javascript:void(0);" class="btn-no"> <i class="fa fa-trash"></i> Delete</a>
                            </td>
                            <td>
                                <div class="text-elipsis">
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td>
                                <div class="text-elipsis">
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td>
                                <div class="text-elipsis">
                                    {{ $user->role->name }}
                                </div>
                            </td>
                        </div>
                    </tr>
                    @endforeach
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </div>

</div>

<div class="modals">
    <div class="modal fade" id="user-modal" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><span id="user-modal-action">Create</span> User</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('users/store') }}" class="form-horizontal" id="user-modal-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label> 
                            <div class="col-md-6">
                                <input type="hidden" name="id" id="id" value="" class="form-control">
                                <input id="name" type="text" name="name" value="" required="required" autocomplete="disabled" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label> 
                            <div class="col-md-6">
                                <input id="email" type="email" name="email" value="" required="required" class="form-control" autocomplete="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Roles</label> 
                            <div class="col-md-6">
                                <select class="form-control" id="role" name="role_id">
                                    <option value="">--Select--</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="display:none" id="change-password-container">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label"></label> 
                                <div class="col-md-6">
                                    <label><input type="checkbox" name="change-password" id="change-password"> Do you want to change the password of this user ?</label>
                                </div>
                            </div>

                            <div id="password-field-container" style="display:none">
                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Password</label> 
                                    <div class="col-md-6">
                                        <input id="password" type="password" name="password" required="required" class="form-control" autocomplete="disabled">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Change Password</label> 
                                    <div class="col-md-6">
                                        <input id="password" type="password" name="confirm_password" required="required" class="form-control" autocomplete="disabled">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue" id="save-user">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('metronics/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ url('js/admin/users.js') }}"></script>
@endpush