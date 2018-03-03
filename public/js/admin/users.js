$(function(){
	$(document).ready(function(){
		User.init()
	});

	User = {

		init : function(){
			this.initializeModal();
			this.saveUser();
			this.initializeChangePassword();
			this.initializeDeleteUser();
		},

		initializeModal : function(){
			var self = this;
			var action;
			$('.user-modal').click(function(){
			    $('input:not([name="_token"]), select').val('');
			    action = $(this).attr('action');
			    $('#user-modal-action').text($(this).attr('action'))
			    $('#change-password-container').hide();
			    $('#password-field-container').hide();
			    $('#change-password').prop('checked', false);


			    // perform here different action between edit and create
			    
			    switch(action){
			    	case 'Create' : 
			    		$('#change-password-container').hide();
			    		break;
			    	case 'Edit' :
			    		$('#change-password-container').show();
			    		break
			    }

			    self.populateDataModal($(this));
			    $('#user-modal').modal();
			});
		},

		populateDataModal : function($obj){
			var userData = $obj.attr('data');
			if(userData != undefined){
				userData = JSON.parse(userData);
				$('#name').val(userData.name)
				$('#email').val(userData.email)
				$('#role').val(userData.role_id)
				$('#id').val(userData.id)
			}
		},

		saveUser : function(){
			$('#save-user').click(function(){
				$('#user-modal-form').submit();				
			});

			$('#user-modal-form').submit(function(event){
				
				var formData = {
					'id'    	: $('input[name="id"]').val(),
		            '_token'	: $('input[name="_token"]').val(),
		            'name'      : $('input[name="name"]').val(),
		            'email'     : $('input[name="email"]').val(),
		            'role_id'	: $('select[name="role_id"]').val()
		        };

		        if($('#change-password').prop('checked')){
		        	formData['password'] = $('input[name="password"]').val();
		        }

		        // process the form
		        $.ajax({
		            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		            url         : $('#site-url').val()+'/users/store', // the url where we want to POST
		            data        : formData, // our data object
		            dataType    : 'json', // what type of data do we expect back from the server
		            success		: function(){
		            	toastr['success']('User sucessfully saved!');
						$('#user-modal').modal('hide');

						setTimeout(function(){
							window.location.reload(true);
						}, 1000)
		            }
		        });
				event.preventDefault();
			});
		},

		initializeChangePassword : function(){
			$('#change-password').change(function(){

				switch($(this).prop('checked')){
					case true : 
						$('#password-field-container').show();
						break
					default :
						$('#password-field-container').hide();
				}
			});
		},

		initializeDeleteUser : function(){
			var user_id;
			$('.portlet-body').on('click', '.user-delete', function(){
				user_id = $(this).attr('data-id');
				bootbox.confirm('Are you sure you want to delete this user?',function(result){

					if(result){
						$.ajax({
				            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
				            url         : $('#site-url').val()+'/users/delete/'+user_id, // the url where we want to POST
				            data 		: {
				            	'_token' : $('meta[name="_token"]').attr('content')
				            },
				            success		: function(){

				            	toastr['success']('User sucessfully deleted!');
				            	
				            	setTimeout(function(){
									window.location.reload(true);
								}, 1000)
				            }
				        })
					}
				});
			});
		}
	}
})