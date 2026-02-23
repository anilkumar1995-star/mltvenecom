$(document).ready(function () {

    // Helper to update cart UI
    function updateCartUI(response) {
        if (response.html) {
            $('.cartmini__inner').html($(response.html).find('.cartmini__inner').html());
            $('.cartmini__checkout').html($(response.html).find('.cartmini__checkout').html());
        }
        // Update counts
        $('.cart-count').text(response.count);
        $('[data-bb-value="cart-count"]').text(response.count);

        // Open the drawer
        $('.cartmini__area').addClass('cartmini-opened');
        $('.body-overlay').addClass('opened');
    }

    // 1. Handle Form Submissions (Product Details Page & Grid)
    $(document).on('submit', 'form[action*="cart/add"], form[action*="cart/buy-now"]', function (e) {

        // If it's a Buy Now action (either form action or button formaction), let it proceed naturally
        let form = $(this);
        let submitter = e.originalEvent && e.originalEvent.submitter;
        let isBuyNow = form.attr('action').includes('buy-now') ||
            (submitter && submitter.getAttribute('formaction') && submitter.getAttribute('formaction').includes('buy-now'));

        if (isBuyNow) {
            return; // Allow default submission (redirect)
        }

        e.preventDefault();

        let url = form.attr('action');
        let data = form.serialize();
        let btn = form.find('button[type="submit"]');
        let originalText = btn.html();

        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Adding...');

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                btn.prop('disabled', false).html(originalText);
                updateCartUI(response);
                toastr.success(response.message || 'Product added to cart');
            },
            error: function (xhr) {
                btn.prop('disabled', false).html(originalText);
                if (xhr.status === 401) {
                    window.location.href = xhr.responseJSON.url || '/login';
                } else {
                    toastr.error('Something went wrong. Please try again.');
                }
            }
        });
    });

    // 2. Handle Button Clicks (Product Cards / Quick Add)
    $(document).on('click', '.tp-product-add-cart-btn', function (e) {
        e.preventDefault();

        let btn = $(this);
        let productId = btn.data('id');
        let quantity = 1; // Default for grid items
        let originalHtml = btn.html();

        // Visual feedback
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: '/cart/add', // Assuming this route exists
            type: 'POST',
            data: {
                product_id: productId,
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                btn.prop('disabled', false).html(originalHtml);
                updateCartUI(response);
                toastr.success(response.message || 'Product added to cart');
            },
            error: function (xhr) {
                btn.prop('disabled', false).html(originalHtml);
                if (xhr.status === 401) {
                    window.location.href = xhr.responseJSON.url || '/login';
                } else {
                    toastr.error('Something went wrong. Please try again.');
                }
            }
        });
    });

    // 3. Close Side Cart
    $(document).on('click', '.cartmini__close-btn, .body-overlay', function () {
        $('.cartmini__area').removeClass('cartmini-opened');
        $('.body-overlay').removeClass('opened');
    });

    // 4. Remove Item from Side Cart
    $(document).on('click', '.cartmini__del', function (e) {
        e.preventDefault();
        let btn = $(this);
        let url = btn.attr('href');

        // Optimistic removal or wait for server? Let's wait for server to sync state
        $.ajax({
            url: url,
            type: 'POST', // Laravel DELETE method usually spoofed via POST
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                _method: 'DELETE'
            },
            success: function (response) {
                updateCartUI(response);
                toastr.success(response.message || 'Item removed');
            },
            error: function (xhr) {
                toastr.error('Failed to remove item');
            }
        });
    });

});

// 5. Open Side Cart from Header Icon
$(document).on('click', '.tp-header-action-item-cart a', function (e) {
    e.preventDefault();
    $('.cartmini__area').addClass('cartmini-opened');
    $('.body-overlay').addClass('opened');
});
