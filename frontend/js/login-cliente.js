/*Gestiona el envío del formulario y maneja los mensajes según la respuesta del backend */
document.addEventListener("DOMContentLoaded", function() {
    let loginForm = document.getElementById("formulario-login-cliente");

    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            event.preventDefault();
            console.log("Formulario enviado desde login-cliente.php");

            let formData = new FormData(this);

            fetch("./backend/controlers/authentications/login-clientes-back.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                let mensaje = document.getElementById("resultado-login");

                function mostrarMensaje() {
                    document.getElementById("password").value = "";
                    document.getElementById("email").value = "";
                    mensaje.innerHTML = data.mensaje; 
                    mensaje.style.display = "block";
                }
                
                if (data.status === "success") {
                    sessionStorage.setItem("loginMessage", data.message); // Guardar mensaje
                    sessionStorage.setItem("loginStatus", "success");
                    // Redireccionar a la página correcta
                    window.location.href = data.redirect_to;
                                       
                } else {
                    mostrarMensaje();    
                }
            })
            .catch(error => console.error("Error en fetch:", error));
        });
    }

    /*Gestiona los botones de ocultar el campo de contraseña/ */
    document.getElementById("togglePassword").addEventListener("click", function() {
        let passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            this.textContent = "🔒"; // Cambia el ícono
        } else {
            passwordInput.type = "password";
            this.textContent = "👁️";
        }
    });
});



