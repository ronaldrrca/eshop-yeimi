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
    mensajeElemento.style.display = "flex";

    setTimeout(() => {
        mensajeElemento.style.display = "none";
    }, 3000);
}



document.querySelectorAll(".card_button").forEach(button => {
    button.addEventListener("click", function(event) {
        event.preventDefault();//Evitamos que se active el link que contiene todo, incluso el botón
        let id = event.target.id;
        agregarAlCarrito(id);
    });
});


document.getElementById("formulario_newsletter").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);
    
    fetch("./backend/controlers/clients/registrar-enNewsLetter-back.php", {
        method: "POST",
        headers: {
                    "X-Requested-With": "XMLHttpRequest" 
                },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Error en la respuesta del servidor");
        }
        return response.json();
    })
    .then(data => {
        if (data.status == "success") {
            document.getElementById("nombre_newsLetter").value = "";
            document.getElementById("email_newsLetter").value = "";
        } 
        alert(data.mensaje);
    })
    .catch(error => {
        alert(data.mensaje)
    });
});



