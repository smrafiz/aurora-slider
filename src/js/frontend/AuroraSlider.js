import Slider from './Slider';

class AuroraSlider {
	constructor() {
		this.sliders = document.querySelectorAll('.as-slideshow');
		this.args = {
			arrowNext: '.swiper-button-next',
			arrowPrev: '.swiper-button-prev',
			dot: '.swiper-pagination'
		};

		this.run();
	}

	run() {
		new Slider(this.sliders, this.args);
	}
}

export default AuroraSlider;
