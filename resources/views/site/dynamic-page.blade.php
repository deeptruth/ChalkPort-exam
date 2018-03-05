<!DOCTYPE html>
<html>
<head>
	<title>{{ $data->title }}</title>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('metronics/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('metronics/plugins/simple-line-icons-v2/css/simple-line-icons.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('metronics/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('metronics/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('metronics/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="{{ asset('metronics/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('metronics/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('metronics/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="{{ asset('metronics/pages/css/tasks.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{ asset('metronics/css/components.css') }}" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('metronics/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
    
    <link href="{{ asset('metronics/layout/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('metronics/pages/css/timeline.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('metronics/plugins/bootstrap-toastr/toastr.min.css') }}">
    <meta content="{{ csrf_token() }}" name="_token" />
    <meta name="site-url" content="{{ url('') }}">
    <style type="text/css">
    	.timeline-badge-userpic{
    		width: 50px;
    		margin-left: 15px;
    	}

    	body{
    		padding: 15px !important
    	}
    </style>
</head>
<body>
	<section id="dynamic-content">
		{!! $data->content !!}
	</section>
	<section id="comment">
		<h3>Comments</h3>
		<div class="timeline">
			<!-- TIMELINE ITEM -->
			@if($comments)
				@foreach($comments as $comment)
				<div class="timeline-item" id="comment-{{ $comment->id }}">
					<div class="timeline-badge">
						<img class="timeline-badge-userpic" src="{{ url('metronics/pages/media/profile/avatar.png') }}">
					</div>
					<div class="timeline-body">
						<div class="timeline-body-arrow">
						</div>
						<div class="timeline-body-head">
							<div class="timeline-body-head-caption">
								<a href="javascript:;" class="timeline-body-title font-blue-madison">{{ $comment->user->name }}</a>
								<span class="timeline-body-time font-grey-cascade">Replied at {{ comment_time($comment->created_at) }}</span>
							</div>
							@if(Auth::check())
								@if($comment->user_id == Auth::user()->id || Auth::user()->role_id == 1)
								<div class="timeline-body-head-actions">
									<div class="btn-group">
										<button class="btn btn-circle green-haze btn-sm dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
										Actions <i class="fa fa-angle-down"></i>
										</button>
										<ul class="dropdown-menu pull-right" role="menu">
											<li>
												<a href="javascript:;" class="edit-comment">Edit </a>
											</li>
											<li>
												<a href="javascript:;" class="delete-comment" data-id="{{ $comment->id }}">Delete </a>
											</li>
										</ul>
									</div>
								</div>
								@endif
							@endif
						</div>
						<div class="timeline-body-content">
							<input type="text" class="form-control edit-comment-input" style="display: none" data-id="{{ $comment->id }}" value="{{ $comment->comment }}">
							<span class="font-grey-cascade">
							{{ $comment->comment }} </span>

						</div>
					</div>
				</div>
				@endforeach
			@endif
			<div id="dynamic-timeline-item-append">
				
			</div>
			<div class="timeline-item timeline-item-template hidden">
				<div class="timeline-badge">
					<img class="timeline-badge-userpic" src="{{ url('metronics/pages/media/profile/avatar.png') }}">
				</div>
				<div class="timeline-body">
					<div class="timeline-body-arrow">
					</div>
					<div class="timeline-body-head">
						<div class="timeline-body-head-caption">
							<a href="javascript:;" class="timeline-body-title font-blue-madison"></a>
							<span class="timeline-body-time font-grey-cascade">Replied at <span></span></span>
						</div>
						<div class="timeline-body-head-actions">
							<div class="btn-group">
								<button class="btn btn-circle green-haze btn-sm dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								Actions <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li>
										<a href="javascript:;" class="edit-comment" data-id="">Edit </a>
									</li>
									<li>
										<a href="javascript:;" class="delete-comment" data-id="">Delete </a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="timeline-body-content">
						<input type="text" class="form-control edit-comment-input" style="display: none" value="">
						<span class="font-grey-cascade">
						 </span>
					</div>
				</div>
			</div>
			@if(Auth::check())
			<div class="timeline-item">
				<div class="timeline-badge">
					<!-- <img class="timeline-badge-userpic" src="{{ url('metronics/pages/media/profile/avatar.png') }}"> -->
				</div>
				<div class="timeline-body">
					<h4>Leave a comment</h4>
					<div class="timeline-body-content" style="margin-top: 15px;">
						<input type="text" class="form-control" id="comment-input">
						<div style="color: #95A5A6 !important;font-size: 12px;margin-top: 8px">Press enter to post your comment</div>
					</div>
				</div>
			</div>
			@endif
			<!-- END TIMELINE ITEM -->
		</div>
		<input type="hidden" id="page_id" value="{{ $data->id }}">
	</section>
	<script src="{{ asset('metronics/plugins/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('metronics/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('metronics/plugins/bootbox/bootbox.min.js') }}" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{ asset('metronics/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('metronics/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('metronics/scripts/metronic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('metronics/layout/scripts/layout.js') }}" type="text/javascript"></script>
    <script src="{{ asset('metronics/layout/scripts/quick-sidebar.js') }}" type="text/javascript"></script>
    <script src="{{ asset('metronics/layout/scripts/demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('metronics/pages/scripts/index.js') }}" type="text/javascript"></script>
    <script src="{{ asset('metronics/pages/scripts/tasks.js') }}" type="text/javascript"></script>
    <script src="{{ asset('metronics/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

    <script src="https://js.pusher.com/3.0/pusher.min.js"></script>
    <script>
        Pusher.log = function(msg) {
          console.log(msg);
        };
        var pusher = new Pusher("{{env("PUSHER_APP_KEY")}}",{
          cluster: "{{env("PUSHER_APP_CLUSTER")}}"
        });

        // for new comment
        var channel = pusher.subscribe('page-{{ $data->id }}');
        channel.bind('comment-notification', function(data) {
            var cloned_item = $('.timeline-item-template').clone();
            alert(123123)
            cloned_item.find('.timeline-body-title').text(data.user.name);
            cloned_item.find('.timeline-body-content span').text(data.comment);
            cloned_item.find('.edit-comment-input').attr('value',data.comment);
            cloned_item.find('.timeline-body-time span').text(data.time);
            cloned_item.find('.delete-comment').attr('data-id',data.id);

            if(data.user.id != '{{ isset(Auth::user()->id) ? Auth::user()->id : 0 }}'){
                cloned_item.find('.timeline-body-head-actions').remove();
            }

            $('#dynamic-timeline-item-append').append('<div class="timeline-item">'+cloned_item.html()+'</div>');
        });

        //for edit comment
        
        var editChannel = pusher.subscribe('page-{{ $data->id }}-edit-comment');
        editChannel.bind('edit-comment-notification', function(data) {
            var cloned_item = $('.timeline-item-template').clone();


            var timeline_item = $('#comment-'+data.id)
            timeline_item.find('')
            timeline_item.find('.timeline-body-content span').text(data.comment);
            timeline_item.find('.edit-comment-input').attr('value',data.comment);

            if(data.user.id != '{{ isset(Auth::user()->id) ? Auth::user()->id : 0 }}'){

            }
        });

    </script>
    <script src="{{ asset('js/site/page.js') }}" type="text/javascript"></script>
</body>
</html>