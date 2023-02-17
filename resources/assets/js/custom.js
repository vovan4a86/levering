function changeQuantityUp() {
    let price = $('.p-actions__price').text();
    if(price != 0) price = price.split(' ')[0];
    let count = $('input[name=count]').val();
    let summary = $('.p-actions__summary');
    let totalCount = $('.p-actions__total span');
    let measure = totalCount.text().split(' ')[2];

    if(price) {
        let res = ++count * price;
        summary.empty();
        summary.text(res.toFixed(2) + ' ₽');
        totalCount.text(`за ${count} ${measure}`);
    }
}

function changeQuantityDown() {
    let price = $('.p-actions__price').text();
    if(price != 0) price = price.split(' ')[0];
    let count = $('input[name=count]').val();
    let summary = $('.p-actions__summary');
    let totalCount = $('.p-actions__total span');
    let measure = totalCount.text().split(' ')[2];

    if(price) {
        if(count > 1) {
            let res = --count * price;
            summary.empty();
            summary.text(res.toFixed(2) + ' ₽');
            totalCount.text(`за ${count} ${measure}`);
        }
    }
}

function cartUpdateCount(elem, id, price) {
    let count = $(elem).val();
    let cardSum = $('[data-id=' + id + ']');
    // cardSum.text(count * price);
    console.log(count);
}

function purgeCart() {
    Cart.purge(function (res) {
        $('.basket').replaceWith(res.header_cart);
        $('.cart__aside').replaceWith(res.order_total);
        $('.cart-table__row--body').remove();
        // location.reload();
    }.bind(this));
}

function addToCart(id) {
    Cart.add(id, 1, 1, function (res) {
        $('.basket').replaceWith(res.header_cart);
    }.bind(this));
}

function ajaxRequest(elem, e) {
    e.preventDefault();

    const url = $(elem).attr('href');

    $.ajax({
        url: url,
        success: function (json) {
            if (typeof json.items !== 'undefined') {
                $('.b-cards__grid').html(json.items);
            }
            if (typeof json.paginate !== 'undefined') {
                $('.section__pagination').html(json.paginate);
            }
        }
    });
}
