fetch('backend/controlers/products/ver-favoritosDelAdmin.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' }
})
.then(response => response.json())
.then(data => { 
    console.log(data);
    
    if (data.productos && Array.isArray(data.productos)) {  
        const productos_destacados_contenido = document.getElementById("productos_destacados_contenido");

        data.productos.forEach(producto => {
            // Crear elementos
            const card = document.createElement("div");
            const card_link_producto = document.createElement("a");
            const card_contenedor_imagen = document.createElement("div");
            const card_contenedor_info = document.createElement("div");
            const card_extras = document.createElement("div"); // Cambiado de <id> a <div>

            const imagen = document.createElement("img");
            const nombre = document.createElement("h3");
            const precio = document.createElement("span");
            const botonAgregar = document.createElement("button");
            const mensaje_carrito = document.createElement("p");

            // Atributos
            card.setAttribute("data-id", producto.id_producto); // ✅ Se añade el ID a la card
            imagen.setAttribute("src", producto.src_producto);

            // Contenido
            nombre.innerHTML = producto.nombre_producto;
            precio.innerHTML = `$ ${producto.precio_producto.toLocaleString('es-ES')}`;
            botonAgregar.textContent = "Agregar al carrito";

            // Clases
            card.classList.add("card");
            card_contenedor_imagen.classList.add("card_contenedor_imagen");
            card_contenedor_info.classList.add("card_contenedor_info");
            imagen.classList.add("imagen_card");
            botonAgregar.classList.add("card_button");
            card_extras.classList.add("card_extras");
            card_link_producto.classList.add("card_link_producto");
            mensaje_carrito.classList.add("mensajeCarrito");

            // Ocultar el mensaje al inicio
            mensaje_carrito.style.display = "none";

            // Agregar elementos a la estructura
            card_contenedor_imagen.append(imagen);
            card_contenedor_info.append(nombre, precio);
            card_extras.append(botonAgregar, mensaje_carrito);
            card_link_producto.append(card_contenedor_imagen, card_contenedor_info, card_extras);
            card.append(card_link_producto);
            productos_destacados_contenido.appendChild(card);

            // Función para mostrar mensaje en la card correcta
            function mostrarMensajeEnCard(idProducto, mensaje, tipo = "success") {
                let card = document.querySelector(`.card[data-id="${idProducto}"]`);
                if (!card) return;

                let mensajeElemento = card.querySelector(".mensajeCarrito");
                if (!mensajeElemento) return;

                mensajeElemento.textContent = mensaje;
                mensajeElemento.className = `mensajeCarrito ${tipo === "success" ? "mensaje-exito" : "mensaje-error"}`;
                mensajeElemento.style.display = "block";

                setTimeout(() => {
                    mensajeElemento.style.display = "none";
                }, 3000);
            }

            // Eventos
            botonAgregar.addEventListener("click", function () {
                fetch("backend/controlers/cart/agregar-itemCarrito-back.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ id_producto: producto.id_producto })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        mostrarMensajeEnCard(producto.id_producto, "Agregado al carrito", "success");
                    } else {
                        mostrarMensajeEnCard(producto.id_producto, "No disponible", "error");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    } else {
        console.error("La estructura de la respuesta no es la esperada:", data);
    }
})
.catch(error => {
    console.error('Error:', error);
});
