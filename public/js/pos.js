$(document).ready(function() {
    const cart = {};
    let lastTransactionId = null;

    $('.product-card').on('click', function() {
        const productData = $(this).find('.product-data');
        const productId = productData.data('id');
        const productName = productData.data('name');
        const productPrice = productData.data('price');
        const productStock = productData.data('stock');

        addToCart(productId, productName, productPrice, productStock);
    });

    function addToCart(id, name, price, stock) {
        if (cart[id]) {
            if (cart[id].quantity < stock) {
                cart[id].quantity++;
                updateCartItemDisplay(id);
            } else {
                alert('Stok tidak mencukupi!');
            }
        } else {
            cart[id] = {
                name: name,
                price: price,
                quantity: 1,
                stock: stock
            };
            addCartItemToDOM(id);
        }
        updateCartTotal();
    }

    function addCartItemToDOM(productId) {
        const item = cart[productId];
        const template = document.getElementById('cartItemTemplate');
        const clone = document.importNode(template.content, true);

        const cartItem = $(clone).find('.cart-item');
        cartItem.attr('data-id', productId);
        cartItem.find('.product-name').text(item.name);
        cartItem.find('.product-price').text(`Rp ${item.price.toLocaleString()}`);
        cartItem.find('.quantity-display').text(item.quantity);

        $('#cartItems').append(cartItem);
        
        // Bind quantity change events
        cartItem.find('.decrease-qty').on('click', function() {
            updateQuantity(productId, -1);
        });
        
        cartItem.find('.increase-qty').on('click', function() {
            updateQuantity(productId, 1);
        });
    }

    function updateQuantity(productId, change) {
        const item = cart[productId];
        const newQuantity = item.quantity + change;
        
        if (newQuantity > 0 && newQuantity <= item.stock) {
            item.quantity = newQuantity;
            updateCartItemDisplay(productId);
            updateCartTotal();
        } else if (newQuantity === 0) {
            delete cart[productId];
            $(`.cart-item[data-id="${productId}"]`).remove();
            updateCartTotal();
        }
    }

    function updateCartItemDisplay(productId) {
        const item = cart[productId];
        const cartItem = $(`.cart-item[data-id="${productId}"]`);
        cartItem.find('.quantity-display').text(item.quantity);
    }

    function updateCartTotal() {
        const total = Object.values(cart).reduce((sum, item) => {
            return sum + (item.price * item.quantity);
        }, 0);
        $('#cartTotal').text(`Rp ${total.toLocaleString()}`);
 
        updateChangeAmount();
    }

    $('#paymentAmount').on('input', updateChangeAmount);

    function updateChangeAmount() {
        const total = calculateTotal();
        const payment = parseFloat($('#paymentAmount').val()) || 0;
        const change = payment - total;
        
        $('#changeAmount').text(`Rp ${change >= 0 ? change.toLocaleString() : 0}`);
    }

    function calculateTotal() {
        return Object.values(cart).reduce((sum, item) => {
            return sum + (item.price * item.quantity);
        }, 0);
    }

    $('.category-btn').on('click', function() {
        $('.category-btn').removeClass('active bg-blue-600 text-white').addClass('bg-white');
        $(this).addClass('active bg-blue-600 text-white').removeClass('bg-white');
        
        const categoryId = $(this).data('category');
        
        if (categoryId === 'all') {
            $('.product-card').show();
        } else {
            $('.product-card').hide();
            $(`.product-card[data-category="${categoryId}"]`).show();
        }
    });

    $('#searchProduct').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        
        $('.product-card').each(function() {
            const productName = $(this).find('h3').text().toLowerCase();
            $(this).toggle(productName.includes(searchTerm));
        });
    });

    $('#checkoutBtn').on('click', function() {
        const customerName = $('#customerName').val();
        const paymentAmount = parseFloat($('#paymentAmount').val());
        const total = calculateTotal();

        if (!customerName) {
            alert('Mohon isi nama pelanggan!');
            return;
        }

        if (!paymentAmount || paymentAmount < total) {
            alert('Jumlah pembayaran tidak mencukupi!');
            return;
        }

        const items = Object.entries(cart).map(([id, item]) => ({
            product_id: id,
            quantity: item.quantity,
            price: item.price
        }));

        $.ajax({
            url: '/kasir/transactions',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                nama_pelanggan: customerName,
                uang_bayar: paymentAmount,
                items: items
            },
            success: function(response) {
                alert('Transaksi berhasil!');
                lastTransactionId = response.transaction.id;
                $('#printBtn').prop('disabled', false);
                resetCart();
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseJSON.message);
            }
        });
    });

    $('#printBtn').on('click', function() {
        if (lastTransactionId) {
            window.open(`/kasir/transaction/${lastTransactionId}/print`, '_blank');
        }
    });

    function resetCart() {
        cart = {};
        $('#cartItems').empty();
        $('#cartTotal').text('Rp 0');
        $('#customerName').val('');
        $('#paymentAmount').val('');
        $('#changeAmount').text('Rp 0');
    }
});