let oldSize = window.innerWidth;

document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
})

function darkMode() {
    // Comprueba si estaba habilidado dark mode
    let darkLocal = window.localStorage.getItem('dark');
    if (darkLocal === 'true') {
        document.body.classList.add('dark-mode');
    }
    // Añadimos el evento de click al botón de dark mode
    document.querySelector('.dark-mode-boton').addEventListener('click', darkChange);
}

function darkChange() {
    let darkLocal = window.localStorage.getItem('dark');

    if (darkLocal === null || darkLocal === 'false') {
        // No está inicializado darkLocal o es falso
        window.localStorage.setItem('dark', true);
        document.body.classList.toggle('dark-mode');
    } else {
        // Está activado darkMode, por lo que se desactiva
        window.localStorage.setItem('dark', false);
        document.body.classList.remove('dark-mode');
    }
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive)
    window.addEventListener('resize', cambioTamano);

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
}

function navegacionResponsive() {
    const navegacionMobile = document.querySelector('.navegacion-mobile');
    if (navegacionMobile.classList.contains('mostrar')) {
        navegacionMobile.classList.remove('mostrar');
        temporaryClass(navegacionMobile, 'alturaTemporal', 300);
    } else {
        navegacionMobile.classList.add('mostrar');
    }
}

function temporaryClass(element, className, time) {
    element.classList.add(className);
    setTimeout(() => {
        element.classList.remove(className);
    }, time);
}

function cambioTamano() {
    const navegacionMobile = document.querySelector('.navegacion-mobile');
    let newSize = window.innerWidth;
    if (newSize <= 768 && newSize < oldSize && !navegacionMobile.classList.contains('mostrar')) {
        temporaryClass(navegacionMobile, 'visibilidadTemporal', 300);
    }
    oldSize = newSize;
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <input type="tel" placeholder="Tu teléfono" id="telefono" name="contacto[telefono]">
            <p>Elija fecha y hora para ser contactado</p>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">
            <label for="hora">Hora</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <input type="email" placeholder="Tu correo" id="email" name="contacto[email]" required>
        `;
    }
}