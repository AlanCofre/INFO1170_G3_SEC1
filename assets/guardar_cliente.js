document.getElementById("form-reporte").addEventListener("submit", async function (e) {
    e.preventDefault(); // Evitar el envío tradicional del formulario

    // Obtener los datos del formulario
    const formData = new FormData(this);

    try {
        // Enviar datos al servidor usando fetch
        const response = await fetch("../models/guardar_cliente.php", {
            method: "POST",
            body: formData,
        });

        // Procesar la respuesta del servidor
        const result = await response.text();
        console.log(result); // Puedes mostrarlo en consola para pruebas
        alert("Reporte enviado correctamente: " + result);
    } catch (error) {
        console.error("Error al enviar el formulario:", error);
        alert("Hubo un error al enviar el reporte.");
    }
});
