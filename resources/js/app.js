import './bootstrap';

window.togglePassword = function (fieldId, toggleIcon) {
    const field = document.getElementById(fieldId); // pega o input
    const icon = toggleIcon.querySelector('i');

    if (field.type === "password") {
        field.type = "text"; // aqui realmente muda o type
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        field.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
