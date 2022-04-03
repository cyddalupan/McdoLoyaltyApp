function terms_and_condition_effects(){
	//show terms and conditions
	$('.termsC').click(function(){
		console.log('show tnc');
		$('.yellow-bg').fadeIn('slow');
		$('#Terms').slideDown('slow');
	});
	$('.yellow-bg').click(function(){
		console.log('hide tnc');
		$('.yellow-bg').fadeOut('slow');
		$('#Terms').slideUp('slow');
	});
}