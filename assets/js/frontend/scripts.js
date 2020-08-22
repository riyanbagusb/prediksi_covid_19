$('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
	if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		if (target.length) {
			$('html, body').animate({
				scrollTop: (target.offset().top)
			}, 1000, "easeInOutExpo");
			return false;
		}
	}
});

// Activate scrollspy to add active class to navbar items on scroll
$('body').scrollspy({
target: '#mainNav',
offset: 75
});

function CounterUp() {
	
	jQuery(function ($) {
		"use strict";
		var counterUp = window.counterUp["default"];
	
		var $counters = $(".counter");
	
		$counters.each(function (ignore, counter) {
			var waypoint = new Waypoint( {
				element: $(this),
				handler: function() { 
					counterUp(counter, {
						duration: 3000,
					}); 
					this.destroy();
				},
				offset: 'bottom-in-view',
			} );
		});

	});
};

// $.ajax({
// 	method: 'GET',
// 	url: 'http://127.0.0.1:5000/negara',
// 	dataType: 'json',
// 	success:function(response){
// 		$('#nama_negara').append('<option value="Dunia">Dunia</option')
// 		for (let i = 0; i < response.length; i++) {
// 			$('#nama_negara').append('<option value="'+response[i]['Country/Region']+'">'+response[i]['Country/Region']+'</option')
// 		}
// 	}
// })

function angkaSeparator(angka) {
    return angka.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")
}

$(document).ready(function() {
    $('.select2').select2()
});