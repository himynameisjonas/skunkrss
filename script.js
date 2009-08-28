String.prototype.isdigits=function(){
return (/\D/.test(this)==false);
}

$(document).ready(function () {
	$form = $('#skunkid');
	var formvalue = $form.val();
	
	$form.focus(function(){
		if ($form.val() == formvalue) {
			$form.val("");
		};
	});
	$form.blur(function(){
		if ($form.val() == "") {
			$form.val(formvalue);
		};
	})
	
	$form.keypress( function(){
		if (!$form.val().isdigits()) {
			$('#noDigits').fadeIn()
		} else (
			$('#noDigits').fadeOut()
		)
	});
});
