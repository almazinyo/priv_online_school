$(document).ready(function() {

	/* Close modal by click outside */
	closeField('.---modal .---wrapper', function() {

		$('#---modal-video')
			.find('.---video')
			.html('');

		$('html')
			.removeClass('---is-hidden')
			.find('.---modal')
			.removeClass('---is-visible');

	});



	/* Open/close block */
	$('.---js-open').click(function(event) {

		event.preventDefault();

		var $block = $(this).data('open-block');
		
		if ($(this).data('open-block-type') && $(this).data('open-block-type') === '---modal') {

			if ($block === '---modal-video') {
				$($block)
					.find('.---video-wrapper')
					.html('<iframe width=100% height=100% src="https://www.youtube.com/embed/'+ $(this).data('video-url') +'" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
			}
			else if ($block === '---modal-image') {
				$($block)
					.find('.---img-view-wrapper')
					.html('<img src="'+ $(this).data('img-src') +'" style="width: 100%;">');
			}

			$('html')
				.addClass('---is-hidden')
				.find('.---modal')
				.removeClass('---is-visible');

		}

		if ($(this).data('html-hidden')) {

			$('html')
				.addClass('---is-hidden');

		}
		
		$($block)
			.addClass('---is-visible');

	});
	$('.---js-close').click(function(event) {

		event.preventDefault();

		var $block = $(this).data('close-block');

		$('#---modal-video').find('.---video').html('');
		
		$('html')
			.removeClass('---is-hidden')
			.find($block)
			.removeClass('---is-visible');

	});



	/* Input masks */
	$('input[type="tel"]').mask('+7 (000) 000-00-00');
	$('input[type="tel"]').on('focus', function(e) {
		
		e.preventDefault();

		if ($(this).val().length === 0) {
			$(this).val('+7 ');
		}

	});
	$('input[type="tel"]').keyup(function(e) {
		
		e.preventDefault();

		if ($(this).val().length === 0) {
			$(this).val('+7 ');
		}

	});



	/* Smooth scroll to element */
	$('.---js-goto-anchor').click(function(e) {

		e.preventDefault();

		var $anchor = $(this).data('anchor');

		$('html').removeClass('---is-hidden');
		$('html, body').animate({scrollTop: $($anchor).offset().top - 30}, 400);

	});



	/* Открытие/закрытие предметов */
	$('.---layout-header .---subject .---button').click(function(event) {

		event.preventDefault();

		$(this)
			.siblings('.---subject-list')
			.toggleClass('---is-visible');

	});



	/* Слайдер отзывов */
	$('.---block-reviews .---owl-carousel').owlCarousel({
		loop: false,
		dots: false,
		nav: true,
		margin: 20,
		responsive: {
			0: {
				items: 1
			},
			991: {
				items: 2
			}
		}
	});



	/* Переключение табов */
	$('.---tab-switcher').click(function(event) {

		event.preventDefault();

		var $tabIndex = $(this).index();

		$('.---tab-switcher')
			.removeClass('---is-active');

		$(this)
			.addClass('---is-active')

		$(this)
			.closest('.---tabs')
			.find('.---tab')
			.eq($tabIndex)
			.addClass('---is-visible')
			.siblings('.---tab')
			.removeClass('---is-visible');

	});

});