class Slider {
	constructor(currentSlide, slides, opacity) {
		this.currentSlide = currentSlide;
        this.slides = slides;
        this.slides[this.currentSlide].style.opacity = opacity;

		this.autoSlideImages = document.getElementById('autoSlideImages');
        this.playPauseBtn = $('#playPauseBtn');
        this.playBtn = $('.fa-play-circle');
        this.pauseBtn = $('.fa-pause-circle');

        this.prevBtn = document.getElementsByClassName('prev-btn');
        this.nextBtn = document.getElementsByClassName('next-btn');
   
		this.sliderAutoAnimation();	
		this.sliderKeyControl();
		this.sliderClick();	
	}

//Automatic slider scrolling
	sliderAutoAnimation() {

        let playbackState = 0;
        this.playPauseBtn.on('click', () => {
            if (playbackState === 0) {
                playbackState = 1;
                    this.autoSlideImages.style.animationPlayState = 'paused';
                    this.pauseBtn.addClass('visibility');
                    this.playBtn.removeClass("visibility");
            
            } else {
                playbackState = 0;
                    this.autoSlideImages.style.animation = 'slideMapImagesAnimation 60s linear infinite';
                    this.playBtn.addClass('visibility');
                    this.pauseBtn.removeClass('visibility');    
            }
        });
	}

//Slider control with the left and right arrows on the keyboard
	sliderKeyControl() {
		document.addEventListener("keydown", e => {
			if (e.key === "ArrowRight") {
				this.nextImage();	
			}
		});

		document.addEventListener("keydown", e => {
			if (e.key === "ArrowLeft") {
				this.prevImage();	
			}
		});
	}

//Slider control at the click of the mouse on the left, right, play and stop buttons
	sliderClick() {

		for (let i = 0; i < this.nextBtn.length; i++) {
			this.nextBtn[i].addEventListener('click', e => {
	            this.nextImage();	
	        });
	    }

		for (let i = 0; i < this.prevBtn.length; i++) {
	        this.prevBtn[i].addEventListener('click', e => {
	            this.prevImage();	
	        });
	    }
	}

//Slide scroll from left to right
	nextImage() {
		this.slides[this.currentSlide].style.opacity = '0';
		this.currentSlide = (this.currentSlide + 1) % this.slides.length;
		this.slides[this.currentSlide].style.opacity = '1';
	}

//Slide scroll from right to left
	prevImage() {
		this.slides[this.currentSlide].style.opacity = '0';
		this.currentSlide = (this.currentSlide - 1) % this.slides.length;
		if (this.currentSlide === -1) {
			this.currentSlide = this.slides.length - 1;
			this.slides[this.currentSlide].style.opacity = '1';

		} else {
		      this.slides[this.currentSlide].style.opacity = '1';
		}
	}		
}






