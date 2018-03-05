$(function(){
	$(document).ready(function(){
		Page.init()
	});

	Page = {

		init : function(){
			this.initializeSubmit();
			this.initializeSummernote();
			this.initializeDeletePage();
		},

		initializeSubmit : function(){
			var self = this;
			var action;

			$('#page-form').submit(function(e){
				
				var formData = {
		            '_token'	: $('input[name="_token"]').val(),
		            'name'      : $('input[name="name"]').val(),
		            'title'      : $('input[name="title"]').val(),
		            'slug'     : $('input[name="slug"]').val(),
		            'description'     : $('textarea[name="description"]').val(),
		            'content'     : $('textarea[name="content"]').code(),
		        };

		        if($('#change-password').prop('checked')){
		        	formData['password'] = $('input[name="password"]').val();
		        }

		        // process the form
		        $.ajax({
		            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		            url         : $('#page-form').attr('action'), // the url where we want to POST
		            data        : formData, // our data object
		            dataType    : 'json', // what type of data do we expect back from the server
		            success		: function(data){
		            	toastr['success']('Page sucessfully saved!');

						if($('#page-form').attr('type') == 1){
							setTimeout(function(){
								window.location = $('#site-url').val()+'/pages/edit/'+data.id
							}, 1000);
						}
		            },
		            error		: function(data){
		            	console.log(data)
		            	toastr['error'](data.responseText);
		            }
		        });

				e.preventDefault();

				
			});
		},

		initializeDeletePage : function(){
			var page_id;
			$('.portlet-body').on('click', '.page-delete', function(){
				page_id = $(this).attr('data-id');
				bootbox.confirm('Are you sure you want to delete this page?',function(result){

					if(result){
						$.ajax({
				            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
				            url         : $('#site-url').val()+'/pages/delete/'+page_id, // the url where we want to POST
				            data 		: {
				            	'_token' : $('meta[name="_token"]').attr('content')
				            },
				            success		: function(){

				            	toastr['success']('Page sucessfully deleted!');
				            	
				            	setTimeout(function(){
									window.location.reload(true);
								}, 1000)
				            }
				        })
					}
				});
			});
		},

		initializeSummernote : function(){
			$('#content').summernote({height: 500});
		}
	}
})