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
                <a class="btn btn-sm green" href="{{ url('pages/create') }}" action="Create"><span><i class="fa fa-plus"></i> Create</span></a>
            @endsection

            @include('admin.partials.portlet-header')

            <div class="portlet-body">
                @if(session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif
                <form method="POST" action="{{ $url }}" class="form-horizontal" id="page-form" type="{{ $type }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Name</label> 
                        <div class="col-md-8">
                            <input id="name" type="text" name="name" value="{{ isset($data->name) ? $data->name : '' }}" required="required" autocomplete="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug" class="col-md-2 control-label">Slug</label> 
                        <div class="col-md-8">
                            <input id="slug" type="text" name="slug" value="{{ isset($data->slug) ? $data->slug : '' }}" required="required" class="form-control" autocomplete="disabled">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-2 control-label">Description</label> 
                        <div class="col-md-8">
                            <textarea id="description" type="text" name="description" required="required" class="form-control" autocomplete="disabled">{{ isset($data->description) ? $data->description : '' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-md-2 control-label">Page Content</label> 
                        <div class="col-md-8">
                            <textarea id="content" type="text" name="content" required="required" class="form-control" autocomplete="disabled">{{ isset($data->content) ? $data->content : '' }}</textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn green button-submit" style="">
                                    Submit
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('metronics/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ url('js/admin/pages.js') }}"></script>
@endpush