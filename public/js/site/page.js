$(function(){
	$(document).ready(function(){
		Comment.init();
	});

	Comment = {
		init : function(){
			this.initializePostComment();
			this.initializeDeleteComment();
			this.initializeEditComment();
		},

		initializePostComment : function(){
			$('#comment-input').keyup(function(e){
				if(e.keyCode === 13){
					var formData = {
			            '_token'	: $('meta[name="_token"]').attr('content'),
			            'comment'      : $(this).val(),
			        };
			        var page_id = $('#page_id').val();

			        // process the form
			        $.ajax({
			            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
			            url         : $('meta[name="site-url"]').attr('content')+'/store-comment/'+page_id, // the url where we want to POST
			            data        : formData, // our data object
			            dataType    : 'json', // what type of data do we expect back from the server
			            success		: function(data){
			            	$('#comment-input').val('');

			            	var cloned_item = $('.timeline-item-template').clone();

			            	cloned_item.find('.timeline-body-title').text(data.user.name);
			            	cloned_item.find('.timeline-body-content span').text(data.comment);
			            	cloned_item.find('.edit-comment-input').attr('value',data.comment);
			            	cloned_item.find('.timeline-body-time span').text(data.time);
			            	cloned_item.find('.delete-comment').attr('data-id',data.id);

			            	$('#dynamic-timeline-item-append').append('<div class="timeline-item">'+cloned_item.html()+'</div>');

			            	toastr['success']('Comment sucessfully saved!');
			            },
			            error		: function(data){
			            	console.log(data)
			            	toastr['error'](data.responseText);
			            }
			        });
				}
			});
		},

		initializeDeleteComment : function(){
			$('.timeline').on('click', '.delete-comment',function(){
				var data_id = $(this).attr('data-id');
				var timeline_item = $(this).closest('.timeline-item');
				var formData = {
		            '_token'	: $('meta[name="_token"]').attr('content')
		        };
				bootbox.confirm('Are you sure you want to delete this comment ?',function(data){

					if(data){
						$.ajax({
				            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
				            url         : $('meta[name="site-url"]').attr('content')+'/delete-comment/'+data_id, // the url where we want to POST
				            data        : formData, // our data object
				            dataType    : 'json', // what type of data do we expect back from the server
				            success		: function(data){
				            	$('#comment-input').val('');
				            	timeline_item.remove();
				            	toastr['success']('Comment sucessfully deleted!');
				            },
				            error		: function(data){
				            	console.log(data)
				            	toastr['error'](data.responseText);
				            }
				        })
					}
				});
				
			});
		},

		initializeEditComment : function(){
			$('.timeline').on('click','.edit-comment', function(){

				$(this).closest('.timeline-item').find('.edit-comment-input').show();
				$(this).closest('.timeline-item').find('.timeline-body-content span').hide();

			});

			$('.timeline').on('keyup', '.edit-comment-input', function(e){
				var timeline_item = $(this).closest('.timeline-item');
				if(e.which == 13){
					var formData = {
			            '_token'	: $('meta[name="_token"]').attr('content'),
			            'comment'      : $(this).val(),
			            'id'      : $(this).attr('data-id'),
			        };
			        var page_id = $('#page_id').val();

			        // process the form
			        $.ajax({
			            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
			            url         : $('meta[name="site-url"]').attr('content')+'/store-comment/'+page_id, // the url where we want to POST
			            data        : formData, // our data object
			            dataType    : 'json', // what type of data do we expect back from the server
			            success		: function(data){
			            	$('#comment-input').val('');
			            	timeline_item.find('')
			            	timeline_item.find('.timeline-body-content span').text(data.comment);
			            	timeline_item.find('.edit-comment-input').attr('value',data.comment);

			            	timeline_item.find('.edit-comment-input').hide();
							timeline_item.find('.timeline-body-content span').show();
			            	toastr['success']('Comment sucessfully saved!');
			            },
			            error		: function(data){
			            	console.log(data)
			            	toastr['error'](data.responseText);
			            }
			        });
				}
			});
		}
	}
});