// Ajusta la cantidad de un producto en el carrito
function adjustQuantity(id, change) {
    const display = document.getElementById(`${id}-display`);
    let quantity = parseInt(display.innerText);
    quantity = Math.max(1, quantity + change); // No permite que la cantidad sea menor que 1
    display.innerText = quantity;
}

// Agrega el producto al carrito usando fetch
function addToCart(productId) {
    // Recuperar información del producto desde el servidor
    fetch(`get_producto.php?id=${productId}`)
        .then(response => response.json())
        .then(product => {
            // Verificar si el producto ya está en el carrito
            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            const existingProduct = cart.find(item => item.id === product.id_accesorios_y_componentes);

            if (existingProduct) {
                existingProduct.quantity += 1; // Incrementar cantidad si ya está
            } else {
                cart.push({
                    id: product.id_accesorios_y_componentes,
                    nombre: product.nombre,
                    precio: product.precio,
                    imagen: product.imagen,
                    quantity: 1
                }); // Añadir nuevo producto
            }

            // Guardar carrito en sessionStorage
            sessionStorage.setItem('cart', JSON.stringify(cart));

            // Actualizar el contador en el ícono
            updateCartCount();

            // Mostrar el mensaje de éxito
            showAddToCartMessage();
        })
        .catch(error => {
            console.error('Error al obtener el producto:', error);
        });
}

// Muestra un mensaje de éxito cuando un producto es agregado al carrito
function showAddToCartMessage() {
    const message = document.createElement('div');
    message.className = 'alert alert-success position-fixed top-0 start-50 translate-middle-x mt-3';
    message.innerText = 'Producto agregado al carrito';

    // Añadir el mensaje al body
    document.body.appendChild(message);

    // Eliminar el mensaje después de 1 segundo
    setTimeout(() => {
        message.remove();
    }, 1000);
}

// Actualiza el contador de productos en el carrito
function updateCartCount() {
    const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    const totalItems = cart.reduce((total, item) => total + (item.quantity || 0), 0);
    
    const cartCountElement = document.getElementById('cart-count');
    
    if (cartCountElement) {
        if (totalItems === 0) {
            cartCountElement.style.display = 'none';
        } else {
            cartCountElement.style.display = 'block';
            cartCountElement.textContent = totalItems;
        }
    }
}

// Función para actualizar la página cada vez que se ingresa o se sale de la página
function refreshPageOnExit() {
    window.addEventListener('beforeunload', function() {
        // Llamar a la función que actualiza el carrito
        updateCartCount();
    });
}

// Ejecutar la función cuando la página se carga
window.addEventListener('DOMContentLoaded', function() {
    updateCartCount();  // Actualiza el carrito al cargar
    refreshPageOnExit(); // Asegura que se actualice al salir o recargar
});
window.addEventListener('DOMContentLoaded', updateCartCount);

// Carga el contador de carrito al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    fetch('../agregar_al_carrito.php')
        .then(response => response.json())
        .then(data => updateCartCount(data.cartCount))
        .catch(error => console.error('Error al obtener el contador del carrito:', error));
});

// Función para cargar los productos del carrito al cargar la página del carrito
document.addEventListener('DOMContentLoaded', loadCart);

function loadCart() {
    const cart = JSON.parse(localStorage.getItem('carrito')) || [];
    const cartContainer = document.getElementById('cart-items');
    const totalContainer = document.getElementById('cart-total');
    let total = 0;

    if (cart.length === 0) {
        cartContainer.innerHTML = '<p class="text-center">El carrito está vacío.</p>';
        return;
    }

    cartContainer.innerHTML = '';

    cart.forEach(item => {
        fetch(`../get_producto.php?id=${item.id}`)
            .then(response => response.json())
            .then(product => {
                const subtotal = product.precio * item.cantidad;
                total += subtotal;

                const productHTML = `
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="../media/${product.imagen}" class="card-img-top" alt="${product.nombre}">
                            <div class="card-body">
                                <h5 class="card-title">${product.nombre}</h5>
                                <p class="card-text">Precio: $${product.precio.toFixed(2)}</p>
                                <p class="card-text">Cantidad: ${item.cantidad}</p>
                                <p class="card-text">Subtotal: $${subtotal.toFixed(2)}</p>
                                <button class="btn btn-danger" onclick="removeFromCart(${item.id})">Eliminar</button>
                            </div>
                        </div>
                    </div>
                `;

                cartContainer.innerHTML += productHTML;
                totalContainer.innerText = total.toFixed(2);
            });
    });
}

// Elimina un producto del carrito
function removeFromCart(productId) {
    let cart = JSON.parse(localStorage.getItem('carrito')) || [];
    cart = cart.filter(item => item.id !== productId);
    localStorage.setItem('carrito', JSON.stringify(cart));
    loadCart(); // Recargar el carrito
    updateCartCount(cart.length); // Actualizar contador de productos
}
