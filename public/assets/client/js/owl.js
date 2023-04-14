$(document).ready(function () {
	//slide account home
	function initCarousel(carouselID) {
		$(carouselID).owlCarousel({
			loop: true,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			margin: 10,
			nav: false,
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
	}

	initCarousel("#listAccounts");
	initCarousel("#listAccounts2");
	initCarousel("#listAccounts3");

	$("#listPackageHome").owlCarousel({
		loop: true,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		margin: 10,
		nav: false,
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
				items: 2,
			},
			1000: {
				items: 4,
			},
		},
	});

	$("#listPosts").owlCarousel({
		loop: true,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		margin: 10,
		nav: false,
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
				items: 3,
			},
		},
	});
	// logo footer loop
	$("#logo-foot-slide").owlCarousel({
		loop: true,
		autoplay: true,
		autoplayTimeout: 2000,
		autoplayHoverPause: true,
		center: false,
		items: 3,
		margin: 0,
		autoplay: false,
		dots: true,
		nav: false,
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
