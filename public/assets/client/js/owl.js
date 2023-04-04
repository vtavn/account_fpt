$(document).ready(function () {
	//slide account home
	$("#listAccounts").owlCarousel({
		loop: true,
		margin: 10,
		nav: true,
		navText: [
			"<i class='fas fa-chevron-left'></i>",
			"<i class='fas fa-chevron-right'></i>",
		],
		dots: false,
		responsive: {
			0: {
				items: 1,
			},
			600: {
				items: 3,
			},
			1000: {
				items: 4,
			},
		},
	});

	$("#listAccounts2").owlCarousel({
		loop: true,
		margin: 10,
		nav: true,
		navText: [
			"<i class='fas fa-chevron-left'></i>",
			"<i class='fas fa-chevron-right'></i>",
		],
		dots: false,
		responsive: {
			0: {
				items: 1,
			},
			600: {
				items: 3,
			},
			1000: {
				items: 4,
			},
		},
	});

	// logo footer loop
	$("#logo-foot-slide").owlCarousel({
		loop: true,
		center: false,
		items: 3,
		margin: 0,
		autoplay: false,
		dots: true,
		nav: true,
		autoplayTimeout: 9500, //8500
		smartSpeed: 250, //450
		navText: [
			"<i class='fas fa-chevron-left'></i>",
			"<i class='fas fa-chevron-right'></i>",
		],
		responsive: {
			0: {
				items: 2,
			},
			768: {
				items: 4,
			},
			1024: {
				items: 5,
			},
			1200: {
				items: 7,
			},
			1400: {
				items: 7,
			},
			1600: {
				items: 7,
			},
		},
	});
});
