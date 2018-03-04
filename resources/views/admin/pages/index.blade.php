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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Action</td>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Slug</td>
                        </tr>
                    </thead>
                    @foreach($pages as $page)
                    <tr data-id="{{ $page->id }}">
                        <div class="custom-row">
                            <td>
                                <a class="btn btn-sm blue" action="Edit" href="{{ url('pages/edit/'.$page->id) }}"> <i class="fa fa-edit"></i> Edit</a>
                                <a class="btn btn-sm green page-delete" href="{{ url($page->slug) }}" target="_blank" class="btn-no"> <i class="fa fa-trash"></i> View</a>
                                <a class="btn btn-sm red page-delete" data-id="{{ $page->id }}" href="javascript:void(0);" class="btn-no"> <i class="fa fa-trash"></i> Delete</a>
                            </td>
                            <td>
                                <div class="text-elipsis">
                                    {{ $page->name }}
                                </div>
                            </td>
                            <td>
                                <div class="text-elipsis">
                                    {{ $page->description }}
                                </div>
                            </td>
                            <td>
                                <div class="text-elipsis">
                                    {{ $page->slug }}
                                </div>
                            </td>
                        </div>
                    </tr>
                    @endforeach
                </table>
                {{ $pages->links() }}
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('metronics/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ url('js/admin/pages.js') }}"></script>
@endpush