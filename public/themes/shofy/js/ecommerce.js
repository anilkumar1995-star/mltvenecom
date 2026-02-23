/******/ (() => { // webpackBootstrap
/*!******************************************************!*\
  !*** ./platform/themes/shofy/assets/js/ecommerce.js ***!
  \******************************************************/
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
$(function () {
  'use strict';

  var loadAjaxCart = function loadAjaxCart(data) {
    $('.cartmini__area').html(data.cart_mini);
    $('[data-bb-value="cart-count"]').text(data.count);
    var $cartArea = $('.tp-cart-area');
    if ($cartArea.length) {
      $cartArea.replaceWith(data.cart_content);
    }
    if (data.additional_cart_data) {
      Object.keys(data.additional_cart_data).forEach(function (key) {
        $("[data-bb-value=\"".concat(key, "\"]")).text(data.additional_cart_data[key]);
      });
    }
    if (typeof Theme.lazyLoadInstance !== 'undefined') {
      Theme.lazyLoadInstance.update();
    }
  };
  var handleUpdateCart = function handleUpdateCart(element) {
    var form;
    if (element) {
      form = $(element).closest('form');
    } else {
      form = $('form.cart-form');
    }
    $.ajax({
      type: 'POST',
      url: form.prop('action'),
      data: form.serialize(),
      success: function success(_ref) {
        var error = _ref.error,
          message = _ref.message,
          data = _ref.data;
        if (error) {
          Theme.showError(message);
        }
        loadAjaxCart(data);
      },
      error: function error(_error) {
        return Theme.handleError(_error);
      }
    });
  };

  /**
   * @param {Array<Number>} data
   * @param {jQuery} element
   */
  window.onBeforeChangeSwatches = function (data, element) {
    var form = element.closest('form');
    if (data) {
      form.find('button[type="submit"]').prop('disabled', true);
      form.find('button[data-bb-toggle="add-to-cart"]').prop('disabled', true);
    }
  };
  $(document).on('click', '[data-bb-toggle="remove-coupon"]', function (e) {
    e.preventDefault();
    var currentTarget = $(e.currentTarget);
    $.ajax({
      url: currentTarget.prop('href'),
      type: 'POST',
      success: function success(_ref2) {
        var error = _ref2.error,
          message = _ref2.message;
        if (error) {
          Theme.showError(message);
          return;
        }
        Theme.showSuccess(message);
        handleUpdateCart();
      },
      error: function error(_error2) {
        return Theme.handleError(_error2);
      }
    });
  }).on('click', '[data-bb-toggle="decrease-qty"]', function (e) {
    var $input = $(e.currentTarget).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.trigger('change');
  }).on('click', '[data-bb-toggle="increase-qty"]', function (e) {
    var $input = $(e.currentTarget).parent().find('input');
    var max = $input.prop('max');
    if (max && parseInt($input.val()) >= parseInt(max)) {
      return;
    }
    $input.val(parseInt($input.val()) + 1);
    $input.trigger('change');
  }).on('change', '[data-bb-toggle="update-cart"]', function (e) {
    handleUpdateCart(e.currentTarget);
  }).on('click', '[data-bb-toggle="change-product-filter-layout"]', function (e) {
    e.preventDefault();
    var currentTarget = $(e.currentTarget);
    currentTarget.addClass('active');
    currentTarget.closest('li').siblings().find('button').removeClass('active');
    $('.bb-product-form-filter').find('[name="layout"]').val(currentTarget.data('value')).trigger('change');
  }).on('click', '[data-bb-toggle="copy-coupon"]', /*#__PURE__*/function () {
    var _ref3 = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(e) {
      var currentTarget, value, previousText, tempInput;
      return _regenerator().w(function (_context) {
        while (1) switch (_context.n) {
          case 0:
            e.preventDefault();
            currentTarget = $(e.currentTarget);
            value = currentTarget.data('value');
            previousText = currentTarget.find('span').text();
            if (!navigator.clipboard) {
              _context.n = 2;
              break;
            }
            _context.n = 1;
            return navigator.clipboard.writeText(value);
          case 1:
            _context.n = 3;
            break;
          case 2:
            tempInput = document.createElement('input');
            tempInput.value = value;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
          case 3:
            currentTarget.find('span').text(currentTarget.data('copied-message'));
            setTimeout(function () {
              return currentTarget.find('span').text(previousText);
            }, 2000);
          case 4:
            return _context.a(2);
        }
      }, _callee);
    }));
    return function (_x) {
      return _ref3.apply(this, arguments);
    };
  }()).on('click', '[data-bb-toggle="scroll-to-review"]', function (e) {
    if ($('.nav-tabs button#nav-review-tab').length) {
      e.preventDefault();
      var $tab = $('.nav-tabs button#nav-review-tab');
      var $container = $('.product-review-container');
      if ($tab.length && $container.length) {
        $tab.tab('show');
        $('html, body').animate({
          scrollTop: $container.offset().top - 100
        });
      }
    }
  }).on('show.bs.modal', '#product-quick-view-modal', function (e) {
    var modal = $(e.currentTarget);
    var trigger = $(e.relatedTarget);
    $.ajax({
      url: trigger.data('url') || trigger.prop('href'),
      type: 'GET',
      beforeSend: function beforeSend() {
        trigger.addClass('btn-loading');
        modal.find('.modal-content').css('min-height', '40rem').html('<div class="loading-spinner"></div>');
      },
      success: function success(_ref4) {
        var error = _ref4.error,
          data = _ref4.data;
        if (error) {
          return;
        }
        modal.find('.modal-content').css('min-height', '0').html(data);
        if (typeof Theme.lazyLoadInstance !== 'undefined') {
          Theme.lazyLoadInstance.update();
        }
        setTimeout(function () {
          EcommerceApp.initProductGallery(true);
        }, 100);
        document.dispatchEvent(new CustomEvent('ecommerce.quick-view.initialized'));
      },
      complete: function complete() {
        return trigger.removeClass('btn-loading');
      }
    });
  }).on('submit', 'form#coupon-form', function (e) {
    e.preventDefault();
    var currentTarget = $(e.currentTarget);
    var button = currentTarget.find('button[type="submit"]');
    $.ajax({
      url: currentTarget.prop('action'),
      type: 'POST',
      data: currentTarget.serialize(),
      beforeSend: function beforeSend() {
        return button.prop('disabled', true).addClass('btn-loading');
      },
      success: function success(_ref5) {
        var error = _ref5.error,
          message = _ref5.message;
        if (error) {
          Theme.showError(message);
          return;
        }
        Theme.showSuccess(message);
        handleUpdateCart();
      },
      error: function error(_error3) {
        return Theme.handleError(_error3);
      },
      complete: function complete() {
        return button.prop('disabled', false).removeClass('btn-loading');
      }
    });
  }).on('keyup', 'form#coupon-form input', function (e) {
    var currentTarget = $(e.currentTarget);
    currentTarget.closest('form').find('button[type="submit"]').prop('disabled', !currentTarget.val());
  }).on('click', '.product-form button[type="submit"]', function (e) {
    e.preventDefault();
    var currentTarget = $(e.currentTarget);

    // Prevent multiple submissions
    if (currentTarget.prop('disabled') || currentTarget.hasClass('btn-loading')) {
      return;
    }
    var form = currentTarget.closest('form');
    var data = form.serializeArray();
    if (form.find('input[name="id"]').val() === '') {
      return;
    }
    data.push({
      name: 'checkout',
      value: currentTarget.prop('name') === 'checkout' ? 1 : 0
    });
    $.ajax({
      type: 'POST',
      url: form.prop('action'),
      data: data,
      beforeSend: function beforeSend() {
        // Only disable and add loading to the clicked button
        currentTarget.prop('disabled', true).addClass('btn-loading');
        // Disable other submit buttons without loading animation
        form.find('button[type="submit"]').not(currentTarget).prop('disabled', true);
      },
      success: function success(_ref6) {
        var error = _ref6.error,
          message = _ref6.message,
          data = _ref6.data;
        if (error) {
          Theme.showError(message);
          if ((data === null || data === void 0 ? void 0 : data.next_url) !== undefined) {
            setTimeout(function () {
              window.location.href = data.next_url;
            }, 500);
          }
          return;
        }
        form.find('input[name="qty"]').val(1);
        if ((data === null || data === void 0 ? void 0 : data.next_url) !== undefined) {
          window.location.href = data.next_url;
        } else {
          loadAjaxCart(data);

          // Close quick shop modal if it's open
          var quickShopModal = $('#quick-shop-modal');
          if (quickShopModal.length && quickShopModal.hasClass('show')) {
            var modalInstance = bootstrap.Modal.getInstance(quickShopModal[0]);
            if (modalInstance) {
              modalInstance.hide();
            }
          }

          // Check if auto open mini cart is enabled
          if (window.themeOptions && window.themeOptions.ecommerce_auto_open_mini_cart === 'yes') {
            $('.cartmini__area').addClass('cartmini-opened');
            $('.body-overlay').addClass('opened');
          }
        }
      },
      error: function error(_error4) {
        return Theme.handleError(_error4);
      },
      complete: function complete() {
        // Re-enable all submit buttons in the form
        form.find('button[type="submit"]').prop('disabled', false).removeClass('btn-loading');
      }
    });
  }).on('click', '.js-sale-popup-quick-view-button', function (e) {
    e.preventDefault();
    $('#product-quick-view-modal').modal('show', e.currentTarget);
  }).on('change', '.tp-shop-top-select select', function (e) {
    var currentTarget = $(e.currentTarget);
    var form = $('.bb-product-form-filter');
    form.find("input[name=\"".concat(currentTarget.prop('name'), "\"]")).val(currentTarget.val()).trigger('submit');
  }).on('click', '.bb-product-items-wrapper .pagination a', function (e) {
    e.preventDefault();
    var currentTarget = $(e.currentTarget);
    var url = new URL(currentTarget.prop('href'));
    var page = url.searchParams.get('page');
    $('.bb-product-form-filter').find('[name="page"]').val(page).trigger('change');
  }).on('submit', 'form.subscribe-form', function (e) {
    e.preventDefault();
    var $form = $(e.currentTarget);
    var $button = $form.find('button[type=submit]');
    $.ajax({
      type: 'POST',
      cache: false,
      url: $form.prop('action'),
      data: new FormData($form[0]),
      contentType: false,
      processData: false,
      beforeSend: function beforeSend() {
        return $button.prop('disabled', true).addClass('btn-loading');
      },
      success: function success(_ref7) {
        var error = _ref7.error,
          message = _ref7.message;
        if (error) {
          Theme.showError(message);
          return;
        }
        var email = $form.find('input[name="email"]').val();
        $form.find('input').val('');
        Theme.showSuccess(message);
        document.dispatchEvent(new CustomEvent('newsletter.subscribed', {
          detail: {
            email: email
          }
        }));
      },
      error: function error(_error5) {
        if (typeof refreshRecaptcha !== 'undefined') {
          refreshRecaptcha();
        }
        Theme.handleError(_error5);
      },
      complete: function complete() {
        if (typeof refreshRecaptcha !== 'undefined') {
          refreshRecaptcha();
        }
        $button.prop('disabled', false).removeClass('btn-loading');
      }
    });
  }).on('click', '[data-bb-toggle="product-tab"]', function (e) {
    e.preventDefault();
    var currentTarget = $(e.currentTarget);
    var tabPane = currentTarget.closest('.tp-product-area').find('#productTabContent .tab-pane');
    var wrapper = tabPane.closest('.tp-product-area');
    var tooltip = currentTarget.find('span.tp-product-tab-tooltip');

    // Assuming currentTarget, tooltip, wrapper, and tabPane are already defined
    var url = "".concat(currentTarget.closest('#productTab').data('ajax-url'), "&type=").concat(currentTarget.data('bb-value'));
    fetch(url, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        // Requesting JSON response
        'Accept': 'application/json' // Requesting JSON response
      }
    }).then(function (response) {
      // Check if the response is okay and parse it as JSON
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    }).then(function (_ref8) {
      var data = _ref8.data;
      // Update tooltip text and tabPane with the fetched data
      tooltip.text(data.count);
      tabPane.html(data.html);

      // Update lazyLoadInstance if it exists
      if (typeof Theme.lazyLoadInstance !== 'undefined') {
        Theme.lazyLoadInstance.update();
      }
    })["catch"](function (error) {
      // Handle any errors during the fetch
      Theme.handleError(error);
    })["finally"](function () {
      // Remove the loading spinner
      $('.loading-spinner').remove();
    });

    // Before sending the request, update the tooltip and show a loading spinner
    tooltip.text('...');
    wrapper.append('<div class="loading-spinner"></div>');
  }).on('submit', '.contact-form', function (e) {
    e.preventDefault();
    var $form = $(e.currentTarget);
    var $button = $form.find('button[type=submit]');
    $.ajax({
      type: 'POST',
      cache: false,
      url: $form.prop('action'),
      data: new FormData($form[0]),
      contentType: false,
      processData: false,
      beforeSend: function beforeSend() {
        return $button.addClass('button-loading');
      },
      success: function success(_ref9) {
        var error = _ref9.error,
          message = _ref9.message;
        if (!error) {
          $form[0].reset();
          Theme.showSuccess(message);
        } else {
          Theme.showError(message);
        }
      },
      error: function error(_error6) {
        return Theme.handleError(_error6);
      },
      complete: function complete() {
        if (typeof refreshRecaptcha !== 'undefined') {
          refreshRecaptcha();
        }
        $button.removeClass('button-loading');
      }
    });
  }).on('click', '.sticky-actions-button button', function (e) {
    e.preventDefault();
    var currentTarget = $(e.currentTarget);
    var form = $('form.product-form');
    if (currentTarget.prop('name') === 'add-to-cart') {
      form.find('button[type="submit"][name="add-to-cart"]').trigger('click');
    }
    if (currentTarget.prop('name') === 'checkout') {
      form.find('button[type="submit"][name="checkout"]').trigger('click');
    }
  }).on('click', '[data-bb-toggle="open-mini-cart"]', function (e) {
    $('[data-bb-toggle="mini-cart-content-slot"]').html('<div class="loading-spinner"></div>');
    $.ajax({
      url: $(e.currentTarget).data('url'),
      type: 'GET',
      success: function success(_ref0) {
        var data = _ref0.data;
        $('[data-bb-toggle="mini-cart-content-slot"]').html(data.content);
        $('[data-bb-toggle="mini-cart-footer-slot"]').html(data.footer);
        if (typeof Theme.lazyLoadInstance !== 'undefined') {
          Theme.lazyLoadInstance.update();
        }
      },
      error: function error(_error7) {
        return Theme.handleError(_error7);
      }
    });
  });
  document.addEventListener('ecommerce.quick-view.initialized', function () {
    var $countDown = $(document).find('[data-countdown]');
    if (!$($countDown).length || !$.fn.countdown) {
      return;
    }
    $countDown.countdown();
  });
  document.addEventListener('ecommerce.cart.added', function (e) {
    var _e$detail = e.detail,
      data = _e$detail.data,
      element = _e$detail.element,
      message = _e$detail.message;
    loadAjaxCart(data);

    // Check if auto open mini cart is enabled
    if (window.themeOptions && window.themeOptions.ecommerce_auto_open_mini_cart === 'yes') {
      $('.cartmini__area').addClass('cartmini-opened');
      $('.body-overlay').addClass('opened');
    } else {
      Theme.showSuccess(message);
    }
  });
  document.addEventListener('ecommerce.cart.removed', function (e) {
    var data = e.detail.data;
    if (data.count === 0) {
      $('.cartmini__area').removeClass('cartmini-opened');
      $('.body-overlay').removeClass('opened');
    }
    loadAjaxCart(data);
  });
  document.addEventListener('ecommerce.wishlist.removed', function (e) {
    var _e$detail2 = e.detail,
      data = _e$detail2.data,
      element = _e$detail2.element;
    element.closest('tr').remove();
    if (data.count === 0) {
      window.location.reload();
    }
  });
  document.addEventListener('ecommerce.compare.added', function (e) {
    var element = e.detail.element;
    if (element.find('span')) {
      element.find('span').text(element.hasClass('active') ? element.data('remove-text') : element.data('add-text'));
    }
  });
  document.addEventListener('ecommerce.wishlist.added', function (e) {
    var _e$detail3 = e.detail,
      data = _e$detail3.data,
      element = _e$detail3.element;
    data.added ? element.addClass('active') : element.removeClass('active');
    if (element.find('span')) {
      element.find('span').text(data.added ? element.data('remove-text') : element.data('add-text'));
    }
  });
  document.addEventListener('ecommerce.compare.removed', function (e) {
    var element = e.detail.element;
    if (element.find('span')) {
      element.find('span').text(element.hasClass('active') ? element.data('remove-text') : element.data('add-text'));
    }
  });
  document.addEventListener('ecommerce.product-filter.before', function () {
    $('.tp-shop-area > .container, .bb-shop-detail > .container > .bb-shop-tab-content').append('<div class="loading-spinner"></div>');
  });
  document.addEventListener('ecommerce.product-filter.success', function (e) {
    var data = e.detail.data;
    $('.bb-product-items-wrapper').html(data.data);
    if (data.additional) {
      $('.bb-shop-sidebar').replaceWith(data.additional.filters_html);
    }
    $('.tp-shop-top-result p').text(data.message);
    $('html, body').animate({
      scrollTop: $('.tp-shop-main-wrapper').offset().top - 120
    });
  });
  document.addEventListener('ecommerce.product-filter.completed', function () {
    $('.tp-shop-area > .container, .bb-shop-detail > .container > .bb-shop-tab-content').find('.loading-spinner').remove();
  });
  document.addEventListener('ecommerce.quick-shop.before-send', function (e) {
    var _e$detail4 = e.detail,
      element = _e$detail4.element,
      modal = _e$detail4.modal;
    element.addClass('btn-loading');
    modal.find('.modal-body').css('min-height', '16rem').html('<div class="loading-spinner"></div>');
  });
  document.addEventListener('ecommerce.quick-shop.completed', function (e) {
    var _e$detail5 = e.detail,
      element = _e$detail5.element,
      modal = _e$detail5.modal;
    element.removeClass('btn-loading');
    modal.find('.modal-body').css('min-height', '0');
  });
  if (window.location.hash === '#product-review') {
    $(document).find('[data-bb-toggle="scroll-to-review"]').trigger('click');
  }
  document.addEventListener('shortcode.loaded', function () {
    var $countDown = $(document).find('[data-countdown]');
    if (!$($countDown).length || !$.fn.countdown) {
      return;
    }
    $countDown.countdown();
  });
});
/******/ })()
;