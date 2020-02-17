class Slider {
	constructor(currentSlide, slides, opacity) {
		this.currentSlide = currentSlide;
        this.slides = slides;
        this.slides[this.currentSlide].style.opacity = opacity;

		this.autoSlideMapImages = document.getElementsByClassName('autoSlideImagesFigure');
        this.playPauseBtn = $('#playPauseBtn');
        this.playBtn = $('.fa-play-circle');
        this.pauseBtn = $('.fa-pause-circle');

        this.prevBtn = document.getElementsByClassName('prev-btn');
        this.nextBtn = document.getElementsByClassName('next-btn');
   
		this.sliderAutoAnimation();	
		this.sliderKeyControl();
		this.sliderClick();	
	}

// ********Slider Automatique tous les 5s********
	sliderAutoAnimation() {
		$(document).ready( () => {
            for (let i = 0; i < this.autoSlideMapImages.length; i++) {

                this.autoSlideMapImages[i].style.animation = 'slideMapImagesAnimation 10s linear infinite';
            }
        });

        let playbackState = 0;
        this.playPauseBtn.on('click', () => {
            if (playbackState === 0) {
                playbackState = 1;
                for (let i = 0; i < this.autoSlideMapImages.length; i++) {
                    
                    this.autoSlideMapImages[i].style.animationPlayState = 'paused';
                    this.pauseBtn.addClass('visibility');
                    this.playBtn.removeClass("visibility");
                }
            } else {
                playbackState = 0;
                for (let i = 0; i < this.autoSlideMapImages.length; i++) {

                    this.autoSlideMapImages[i].style.animation = 'slideMapImagesAnimation 10s linear infinite';
                    this.playBtn.addClass('visibility');
                    this.pauseBtn.removeClass('visibility');
                }
            }
        });

	}

// ********Contrôle du Slider avec les flèches gauche et droite du clavier********
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

// ********Contrôle du Slider au clic de la souris sur les boutons gauche, droit, play et stop********
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

// ********Défilement des slides de gauche à droite********
	nextImage() {
		this.slides[this.currentSlide].style.opacity = '0';
		this.currentSlide = (this.currentSlide + 1) % this.slides.length;
		this.slides[this.currentSlide].style.opacity = '1';
	}

// ********Défilement des slides de droite à gauche********
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






