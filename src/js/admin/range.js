export let range = () => {
	window.onload = () => {
		let main = document.querySelector('.aurora-slider-metabox-settings'),
			range = document.querySelectorAll(".aurora-slider-metabox-settings input[type='range']");

		for (let index = 0; index < range.length; index++) {
			let el = document.createElement('div');

			rangeValueEl(el, range[index], index);

			main.addEventListener('click', function(e) {
				let sibling = document.querySelector('.range-value.range-field-' + index);
				let render = range[index].getAttribute('data-value');

				if (sibling === null) {
					let range = document.querySelectorAll(".aurora-slider-metabox-settings input[type='range']"),
						newEl = document.createElement('div');

					rangeValueEl(newEl, range[index], index);
					rangeValueUpdate(range[index], index);
				}
			});

			rangeValueUpdate(range[index], index);
		}
	};

	let rangeValueUpdate = (el, index) => {
		el.addEventListener('input', function(e) {
			document.querySelector('.range-value.range-field-' + index).innerHTML = 'Value: ' + e.target.value;
			el.setAttribute('data-range', 'rendered');
		});
	};

	let rangeValueEl = (el, input, index) => {
		el.classList.add('range-value', 'range-field-' + index);
		el.innerHTML = 'Value: ' + input.value;
		input.parentNode.insertBefore(el, input.nextSibling);
	};
};
