document.addEventListener('DOMContentLoaded', function() {
    // Add to cart functionality
    const cartButtons = document.querySelectorAll('.btn-cart');
    cartButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const item = e.target.closest('.vinyl-item');
            const coverPath = item.querySelector('img').getAttribute('src');
            
            const itemData = {
                id: item.dataset.src,
                title: item.querySelector('h3').textContent,
                artist: item.querySelector('.artist').textContent,
                price: parseFloat(item.querySelector('.price').textContent.replace('$', '')),
                cover: coverPath
            };

            // Determine the correct path to cart_handler.php
            const currentPath = window.location.pathname;
            const handlerPath = currentPath.includes('/pages/') ? '../includes/cart_handler.php' : 'includes/cart_handler.php';

            fetch(handlerPath, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(itemData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Added to cart!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add to cart. Please try again.');
            });
        });
    });

    // Remove from cart functionality
    const removeButtons = document.querySelectorAll('.remove-item');
    removeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const itemId = e.target.dataset.id;
            const currentPath = window.location.pathname;
            const handlerPath = currentPath.includes('/pages/') ? '../includes/cart_handler.php' : 'includes/cart_handler.php';
            
            fetch(`${handlerPath}?action=remove&id=${itemId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cartItem = e.target.closest('.cart-item');
                        cartItem.remove();
                        location.reload(); // Reload to update totals
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
}); 