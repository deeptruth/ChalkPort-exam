function copy(button, textbox){
	$(button).click(function(){
		$(textbox).select();
		document.execCommand("copy");
		toastr['info']("Copied!", "Information");
	})
}