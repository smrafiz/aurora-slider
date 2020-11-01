import AuroraSlider from './frontend/AuroraSlider';
import AuroraHelpers from './frontend/Helpers';

let auroraSlider = {};

auroraSlider = {
	run: () => {
		new AuroraSlider();
	}
};

AuroraHelpers.ready(auroraSlider.run());
