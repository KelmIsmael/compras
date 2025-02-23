<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../vista_carrito/get_producto.php" defer></script>
    <style>
        .card-product {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .card-img-top {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 8px;
        }
        .card-body {
            flex-grow: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-body div {
            margin-left: 10px;
            margin-right: 10px;
        }
        .card-body h5 {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        .card-body p {
            margin: 5px 0;
            font-size: 12px;
            color: #555;
        }
        .btn-remove {
            font-size: 12px;
            padding: 6px 12px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            transition: background-color 0.3s ease;
        }
        .btn-remove:hover {
            background-color: #f44336;
            color: white;
        }
        .quantity-controls {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        .quantity-controls button {
            font-size: 16px;
            margin: 5px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }
        .quantity-controls button:hover {
            background-color: #0056b3;
        }
        .cart-footer {
            background-color: #f8f9fa;
            padding: 20px;
            margin-top: 30px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }
        .btn-success, .btn-primary {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #28a745;
            color: white;
        }
        .btn-primary:hover {
            background-color: #007bff;
            color: white;
        }
        .back-btn {
            margin-top: 15px;
            margin-bottom: 15px;
            font-size: 18px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <a href="../vista_carrito/carritox.php" class="btn btn-secondary back-btn" onclick="reloadPageAndUpdateCart('index.html');">Volver atrás</a>
        <h2 class="text-center mb-4">Carrito de Compras</h2>
        
        <div id="cart-items">
            <!-- Los productos del carrito se agregarán aquí -->
        </div>

        <div class="cart-footer">
            <p id="cart-total">Total: $0.00</p>
            <a href="../vista_carrito/carritox.php" class="btn btn-primary" onclick="reloadPageAndUpdateCart('index.html');">Volver a la tienda</a>
            <a href="javascript:void(0);" class="btn btn-success">Proceder al pago</a>
        </div>
    </div>

    <script>
        // Recuperar carrito desde sessionStorage
        const cart = JSON.parse(sessionStorage.getItem('cart')) || [];

        // Verificar si el carrito está vacío
        if (cart.length === 0) {
            document.getElementById('cart-items').innerHTML = "<p class='text-center'>El carrito está vacío.</p>";
            document.getElementById('cart-total').innerText = "Total: $0.00";
        } else {
            let total = 0;
            let cartHTML = ''; // Variable para almacenar el HTML de los productos

            // Mostrar los productos en el carrito
            cart.forEach(item => {
                const productHTML = `
                    <div class="card-product">
                        <img src="../media/${item.imagen}" class="card-img-top" alt="${item.nombre}">
                        <div class="card-body">
                            <div>
                                <h5 class="card-title">${item.nombre}</h5>
                                <p class="card-text">Precio: $${item.precio}</p>
                                <p class="card-text">Cantidad: ${item.quantity}</p>
                                <p class="card-text">Subtotal: $${(item.precio * item.quantity).toFixed(2)}</p>
                            </div>
                            <div class="quantity-controls">
                                <button onclick="changeQuantity(${item.id}, 1)">+</button>
                                <button onclick="changeQuantity(${item.id}, -1)">-</button>
                            </div>
                            <button class="btn btn-remove" onclick="removeFromCart(${item.id})">Eliminar</button>
                        </div>
                    </div>
                `;
                cartHTML += productHTML; // Agregar el HTML del producto
                total += item.precio * item.quantity; // Calcular el total
            });

            // Agregar los productos al carrito en la página
            document.getElementById('cart-items').innerHTML = cartHTML;

            // Actualizar el total del carrito
            document.getElementById('cart-total').innerText = `Total: $${total.toFixed(2)}`;
        }

        // Elimina un producto del carrito
        function removeFromCart(productId) {
            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            cart = cart.filter(item => item.id !== productId);
            sessionStorage.setItem('cart', JSON.stringify(cart));
            location.reload(); // Recargar la página para actualizar el carrito
        }

        // Cambia la cantidad del producto
        function changeQuantity(productId, change) {
            let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            const product = cart.find(item => item.id === productId);
            if (product) {
                product.quantity += change;
                if (product.quantity <= 0) product.quantity = 1; // No permitir que la cantidad sea menor a 1
                sessionStorage.setItem('cart', JSON.stringify(cart));
                location.reload(); // Recargar la página para actualizar la cantidad
            }
        }
    </script>
    
</body>
</html>
