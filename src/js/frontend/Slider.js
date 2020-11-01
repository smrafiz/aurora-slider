import AuroraHelpers from './Helpers';

class Slider {
	constructor(el, args) {
		this.slidersEl = AuroraHelpers.toArray(el);
		this.options = {};
		this.args = args;

		if (this.slidersEl.length < 1) {
			return false;
		}

		if (AuroraHelpers.isEmptyObj(this.args)) {
			return false;
		}

		this.run();
	}

	run() {
		this.slidersEl.forEach((sliderEl, index) => {
			this.buildOptions(sliderEl);

			const pagEl = sliderEl.querySelectorAll(this.options.pagination.el),
				navNextEl = sliderEl.querySelectorAll(this.options.navigation.nextEl),
				navPrevEl = sliderEl.querySelectorAll(this.options.navigation.prevEl);

			if (pagEl.length > 0) {
				pagEl[0].classList.add('instance-' + index);
			}

			if (navNextEl.length > 0) {
				navNextEl[0].classList.add('instance-' + index);
				navPrevEl[0].classList.add('instance-' + index);
			}

			if (AuroraHelpers.isEmptyObj(this.options)) {
				return false;
			}

			this.options.pagination.el += '.instance-' + index;
			this.options.navigation.nextEl += '.instance-' + index;
			this.options.navigation.prevEl += '.instance-' + index;

			console.log(this.options);

			new Swiper(sliderEl, this.options);
		});
	}

	buildOptions(el) {
		this.options.loop = el.dataset.loop === 'true' ? true : false;
		this.options.navigation = {
			nextEl: this.args.arrowNext,
			prevEl: this.args.arrowPrev
		};
		this.options.pagination = {
			el: this.args.dot,
			clickable: true,
			type: el.dataset.pagtype,
			dynamicBullets: el.dataset.dynbull === 'true' ? true : false
		};
		this.options.effect = el.dataset.effect;

		return this.options;
	}
}

export default Slider;
