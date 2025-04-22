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



