document.addEventListener("DOMContentLoaded", () => {
    // Llamamos la función para cargar los productos favoritos
    obtenerProductos('backend/controlers/products/ver-favoritosDelAdmin-back.php', 'productos_destacados_contenido');

    // Llamamos la función para cargar los productos nuevos
    obtenerProductos('backend/controlers/products/ver-productosNuevos-back.php', 'productos_nuevos_contenido');
});

// Función para obtener productos desde una URL y mostrarlos en un contenedor específico
function obtenerProductos(url, contenedorID) {
    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(data => { 
        if (data.productos && Array.isArray(data.productos)) {  
            mostrarProductos(data.productos, contenedorID);
        } else {
            console.error("La estructura de la respuesta no es la esperada:", data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Función para crear una card de producto
function crearCardProducto(producto) {
    const card = document.createElement("div");
    const card_link_producto = document.createElement("a");
    const card_contenedor_imagen = document.createElement("div");
    const card_contenedor_info = document.createElement("div");
    const card_extras = document.createElement("div"); 
    const etiqueta_oferta = document.createElement("span");
    const imagen = document.createElement("img");
    
    const nombre = document.createElement("h3");
    const precio = document.createElement("span");
    const botonAgregar = document.createElement("button");
    const mensaje_carrito = document.createElement("p");

    // Atributos
    card.setAttribute("data-id", producto.id_producto); 
    imagen.setAttribute("src", producto.src_producto);

    // Contenido
    etiqueta_oferta.innerHTML = "Oferta";
    nombre.innerHTML = producto.nombre_producto;
    // precio.innerHTML = `$ ${producto.precio_producto.toLocaleString('es-ES') . if (producto.oferta_producto) ?  producto.producto_oferta : ""}`;
    precio.innerHTML = `$ ${producto.precio_producto.toLocaleString('es-ES')}` + 
    (producto.oferta_producto ? ` <span style="color: red; margin-left: 1rem"> -${producto.porcentaje_oferta_producto}%</span>` : "");



    botonAgregar.textContent = "Agregar al carrito";

    // Clases
    card.classList.add("card");
    card_contenedor_imagen.classList.add("card_contenedor_imagen");
    card_contenedor_info.classList.add("card_contenedor_info");
    precio.classList.add("card_precio");
    imagen.classList.add("imagen_card");
    botonAgregar.classList.add("card_button");
    card_extras.classList.add("card_extras");
    card_link_producto.classList.add("card_link_producto");
    etiqueta_oferta.classList.add("etiqueta_oferta");
    mensaje_carrito.classList.add("mensajeCarrito");

    // Ocultar el mensaje al inicio
    mensaje_carrito.style.display = "none";

    // Agregar elementos a la estructura
    card_contenedor_imagen.append(imagen);
    card_contenedor_info.append(nombre, precio);
    card_extras.append(botonAgregar, mensaje_carrito);
    card_link_producto.append(card_contenedor_imagen, card_contenedor_info, card_extras, etiqueta_oferta);
    card.append(card_link_producto);

    // Evento de agregar al carrito
    botonAgregar.addEventListener("click", () => agregarAlCarrito(producto.id_producto));

    return card;
}

// 3️⃣ Función para mostrar los productos en el contenedor especificado
function mostrarProductos(productos, contenedorID) {
    const contenedor = document.getElementById(contenedorID);
    if (!contenedor) {
        console.error(`No se encontró el contenedor con ID: ${contenedorID}`);
        return;
    }

    contenedor.innerHTML = ""; // Limpiar contenido previo

    productos.forEach(producto => {
        const card = crearCardProducto(producto);
        contenedor.appendChild(card);
    
        const etiqueta = card.querySelector(".etiqueta_oferta");
        
        // Asegurar que el producto tiene oferta
        if (etiqueta) {
            if (producto.oferta_producto === 1) {
                etiqueta.style.display = "block";  // Mostrar si tiene oferta
            } else {
                etiqueta.style.display = "none";   // Ocultar si no tiene oferta
            }
        }
    });
    
}

// 4️⃣ Función para manejar el botón "Agregar al carrito"
function agregarAlCarrito(idProducto) {

    const redirect_to = document.getElementById("sesion").dataset.id;

    if (redirect_to) {
        window.location.href = "login-cliente.php";
    }

    fetch("backend/controlers/cart/agregar-itemCarrito-back.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id_producto: idProducto })
    })
    .then(response => response.json())
    .then(data => {
        

        if (data.status === "success") {
            mostrarMensajeEnCard(idProducto, "Agregado al carrito", "success");
        } else {
            mostrarMensajeEnCard(idProducto, "No disponible", "error");
        }
    })
    .catch(error => console.error("Error:", error));
}

// 5️⃣ Función para mostrar mensaje en la card correcta
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
