document.addEventListener("DOMContentLoaded", () => {
    manejarMenuMovil();
    manejarMenuDatosUsuario();

});


function manejarMenuMovil() {
    const menu = document.getElementById("nav");
    const btnAbrir = document.getElementById("icono_menu");
    const btnCerrar = document.getElementById("icono_cerrar_menu");

    btnAbrir.addEventListener("click", () => {
        menu.classList.add("active");
    });

    btnCerrar.addEventListener("click", () => {
        menu.classList.remove("active");
    });

    // Cierra el menú si se hace clic fuera de él
    document.addEventListener("click", (event) => {
        if (!menu.contains(event.target) && event.target !== btnAbrir) {
            menu.classList.remove("active");
        }
    });
}


function manejarMenuDatosUsuario() {
    const menu = document.getElementById("header_menu_datosUsuario");
    const btnAbrir = document.getElementById("header_usuario");

    if (!menu || !btnAbrir) return; // Evita errores si los elementos no existen

    btnAbrir.addEventListener("mouseenter", () => {
        menu.classList.add("active");
    });

    menu.addEventListener("mouseleave", () => {
        menu.classList.remove("active");
    });
}

