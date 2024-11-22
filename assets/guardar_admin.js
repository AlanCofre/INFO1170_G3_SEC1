document.getElementById("form-emergencia").addEventListener("submit", async function (event) {
    event.preventDefault(); // Evita el envío tradicional del formulario

    const formData = new FormData(this); // Recoge todos los datos del formulario

    try {
        // Enviar los datos al servidor usando fetch
        const response = await fetch("../models/guardar_admin.php", {
            method: "POST",
            body: formData
        });

        const result = await response.text(); // Leer la respuesta del servidor como texto
        alert(result); // Mostrar la respuesta en un alert
    } catch (error) {
        console.error("Error al enviar el formulario:", error);
        alert("Hubo un error al enviar el formulario. Inténtalo de nuevo.");
    }
});
