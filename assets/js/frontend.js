/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// CONCATENATED MODULE: ./src/js/frontend/Helpers.js
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var AuroraHelpers = /*#__PURE__*/function () {
  function AuroraHelpers() {
    _classCallCheck(this, AuroraHelpers);
  }

  _createClass(AuroraHelpers, null, [{
    key: "ready",
    value: function ready(fn) {
      if (document.readyState !== 'loading') {
        fn();
      } else if (document.addEventListener) {
        document.addEventListener('DOMContentLoaded', fn);
      } else {
        document.attachEvent('onreadystatechange', function () {
          if (document.readyState !== 'loading') {
            fn();
          }
        });
      }
    }
  }, {
    key: "toArray",
    value: function toArray(nodelist) {
      return !nodelist.length || _typeof(nodelist) !== 'object' ? nodelist : [].slice.call(nodelist);
    }
  }, {
    key: "isEmptyObj",
    value: function isEmptyObj(obj) {
      return Object.keys(obj).length === 0 && obj.constructor === Object;
    }
  }]);

  return AuroraHelpers;
}();

/* harmony default export */ var Helpers = (AuroraHelpers);
// CONCATENATED MODULE: ./src/js/frontend/Slider.js
function Slider_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function Slider_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function Slider_createClass(Constructor, protoProps, staticProps) { if (protoProps) Slider_defineProperties(Constructor.prototype, protoProps); if (staticProps) Slider_defineProperties(Constructor, staticProps); return Constructor; }



var Slider_Slider = /*#__PURE__*/function () {
  function Slider(el, args) {
    Slider_classCallCheck(this, Slider);

    this.slidersEl = Helpers.toArray(el);
    this.options = {};
    this.args = args;

    if (this.slidersEl.length < 1) {
      return false;
    }

    if (Helpers.isEmptyObj(this.args)) {
      return false;
    }

    this.run();
  }

  Slider_createClass(Slider, [{
    key: "run",
    value: function run() {
      var _this = this;

      this.slidersEl.forEach(function (sliderEl, index) {
        _this.buildOptions(sliderEl);

        var pagEl = sliderEl.querySelectorAll(_this.options.pagination.el),
            navNextEl = sliderEl.querySelectorAll(_this.options.navigation.nextEl),
            navPrevEl = sliderEl.querySelectorAll(_this.options.navigation.prevEl);

        if (pagEl.length > 0) {
          pagEl[0].classList.add('instance-' + index);
        }

        if (navNextEl.length > 0) {
          navNextEl[0].classList.add('instance-' + index);
          navPrevEl[0].classList.add('instance-' + index);
        }

        if (Helpers.isEmptyObj(_this.options)) {
          return false;
        }

        _this.options.pagination.el += '.instance-' + index;
        _this.options.navigation.nextEl += '.instance-' + index;
        _this.options.navigation.prevEl += '.instance-' + index;
        console.log(_this.options);
        new Swiper(sliderEl, _this.options);
      });
    }
  }, {
    key: "buildOptions",
    value: function buildOptions(el) {
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
  }]);

  return Slider;
}();

/* harmony default export */ var frontend_Slider = (Slider_Slider);
// CONCATENATED MODULE: ./src/js/frontend/AuroraSlider.js
function AuroraSlider_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function AuroraSlider_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function AuroraSlider_createClass(Constructor, protoProps, staticProps) { if (protoProps) AuroraSlider_defineProperties(Constructor.prototype, protoProps); if (staticProps) AuroraSlider_defineProperties(Constructor, staticProps); return Constructor; }



var AuroraSlider_AuroraSlider = /*#__PURE__*/function () {
  function AuroraSlider() {
    AuroraSlider_classCallCheck(this, AuroraSlider);

    this.sliders = document.querySelectorAll('.as-slideshow');
    this.args = {
      arrowNext: '.swiper-button-next',
      arrowPrev: '.swiper-button-prev',
      dot: '.swiper-pagination'
    };
    this.run();
  }

  AuroraSlider_createClass(AuroraSlider, [{
    key: "run",
    value: function run() {
      new frontend_Slider(this.sliders, this.args);
    }
  }]);

  return AuroraSlider;
}();

/* harmony default export */ var frontend_AuroraSlider = (AuroraSlider_AuroraSlider);
// CONCATENATED MODULE: ./src/js/frontend.js


var auroraSlider = {};
auroraSlider = {
  run: function run() {
    new frontend_AuroraSlider();
  }
};
Helpers.ready(auroraSlider.run());

/***/ })
/******/ ]);