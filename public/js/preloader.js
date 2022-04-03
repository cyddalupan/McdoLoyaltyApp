var loading = 1;

$(document).ready(function(){
	console.log('PreLoader Loading Start!');

	loadmotion();
});

$(window).bind("load", function() {
	loading = 0;
   $('.cyd_loading').fadeOut(1);

   $('#home').css('height','1200px');
   $('#home').hide(1);
   $('#home').fadeIn('slow');
   
   $('#Profile').css('min-height','1200px');
   $('#Profile').css('height','1200px');
   $('#Profile').hide(1);
   $('#Profile').fadeIn('slow');
   
	console.log('PreLoader Done Loading!');
});

function loadmotion(){
	$('.cyd_lo1').animate({
		"font-size": 85
	}, 200, function() {
		$('.cyd_lo1').animate({
			"font-size": 70
		}, 200);

		$('.cyd_lo2').animate({
			"font-size": 85
		}, 200, function() {
			$('.cyd_lo2').animate({
				"font-size": 70
			}, 200);

			$('.cyd_lo3').animate({
				"font-size": 85
			}, 200, function() {
				$('.cyd_lo3').animate({
					"font-size": 70
				}, 200);

				$('.cyd_lo4').animate({
					"font-size": 85
				}, 200, function() {
					$('.cyd_lo4').animate({
						"font-size": 70
					}, 200);

					$('.cyd_lo5').animate({
						"font-size": 85
					}, 200, function() {
						$('.cyd_lo5').animate({
							"font-size": 70
						}, 200);

						$('.cyd_lo6').animate({
							"font-size": 85
						}, 200, function() {
							$('.cyd_lo6').animate({
								"font-size": 70
							}, 200);

							$('.cyd_lo7').animate({
								"font-size": 85
							}, 200, function() {
								$('.cyd_lo7').animate({
									"font-size": 70
								}, 200);
								if(loading == 1)
									loadmotion();
							});
						});
					});
				});
			});
		});
	});
}