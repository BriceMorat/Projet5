// navbar management

$(function(){
	$('.nav-link').filter(function() {
		return this.href == location.href}).addClass('active').siblings().removeClass('active');

	$('.nav-link').click(function() {
		$(this).addClass('active').siblings().removeClass('active');
	})
})

// success and error messages management

let flashSuccessMessage = $('#success');

let flashErrorMessage = $('#error'); 

if (flashSuccessMessage !== null) {
	flashSuccessMessage.delay(5000).fadeTo('slow', 0);
}

if (flashErrorMessage !== null) {
	flashErrorMessage.delay(5000).fadeTo('slow', 0);
}

// paging management

$(function(){
	$('.pageNb').filter(function() {
		return this.href == location.href}).parent().addClass('active').siblings().removeClass('active');

	$('.pageNb').click(function() {
		$(this).parent().addClass('active').siblings().removeClass('active');
	})
});

// Keep Pseudo, email in the localStorage to display it inside the form

$('.loginSubmit').click(function() {
	let pseudo = $('#pseudo').val();
	localStorage.setItem('Pseudo', pseudo);   
})

if (localStorage.getItem('Pseudo') !== null) {
	$('#pseudo').val(function () {
        return localStorage.getItem('Pseudo');
    });
}

// Button management

$('.sliderBtn').click(() => {
	$('.autoSlideImagesContainer').hide();
	$('.sliderMapImages').show();
})

$('.sliderReturnBtn').click(() => {
	$('.autoSlideImagesContainer').show();
	$('.sliderMapImages').hide();
})

$('.imagesBtn').click(() => {
	$('.mapContainer').hide();
	$('.imagesContainer').show();
})

$('.imagesReturnBtn').click(() => {
	$('.mapContainer').show();
	$('.imagesContainer').hide();
})


// Zoom Images management
$(function() {
	$('.markerImagesFigure').on('click', function() {
    	if($('.markerImagesFigure').hasClass('zoomed')) {
        	$('.markerImagesFigure').removeClass('zoomed');
    	} else {
    		$('.markerImagesFigure').addClass('zoomed');
    	}
    })
});

$(function() { 
	
	if($(window).width() < 992){
		$('.markerImagesFigure').on('click', function() {
    		if($('.markerImagesFigure').hasClass('zoomed2')) {
        		$('.markerImagesFigure').removeClass('zoomed2');
    		} else {
    			$('.markerImagesFigure').addClass('zoomed2');
    		}
    	})
	};
   
});

