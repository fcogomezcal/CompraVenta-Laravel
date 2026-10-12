
// Obtener el campo de contraseña
const passwordInput = document.getElementById("password");

// Obtener el botón del ojo
const passwordAddon = document.getElementById("password-addon");

// Verificar que ambos elementos existan
if (passwordInput && passwordAddon) {

    passwordAddon.addEventListener("click", function () {

        // Cambiar entre password y text
        if (passwordInput.type === "password") {

            passwordInput.type = "text";

            // Cambiar el icono
            passwordAddon.querySelector("i").classList.remove("ri-eye-fill");
            passwordAddon.querySelector("i").classList.add("ri-eye-off-fill");

        } else {

            passwordInput.type = "password";

            // Regresar al icono de ojo
            passwordAddon.querySelector("i").classList.remove("ri-eye-off-fill");
            passwordAddon.querySelector("i").classList.add("ri-eye-fill");

        }

    });

}

