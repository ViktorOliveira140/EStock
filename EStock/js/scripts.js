// Design dinamico entre formularios de login e registro
function toggleForms() {
  const loginForm = document.getElementById('login-form');
  const registerForm = document.getElementById('register-form');
  loginForm.classList.toggle('is-hidden');
  registerForm.classList.toggle('is-hidden');
}

//Navbar burger
document.addEventListener('DOMContentLoaded', () => {
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  if ($navbarBurgers.length > 0) {
    $navbarBurgers.forEach(el => {
      el.addEventListener('click', () => {
        const target = el.dataset.target;
        const $target = document.getElementById(target);
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');
      });
    });
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const notification = document.getElementById('notification');

  // Mostrar a notificação com um efeito de fade-in
  if (notification) {
      notification.classList.add('show');

      // Remover a notificação após 3 segundos (3000 ms)
      setTimeout(() => {
          notification.classList.remove('show');
          notification.style.transition = 'opacity 0.5s ease-in-out';
          notification.style.opacity = '0';
          
          // Remover o elemento do DOM após a transição
          setTimeout(() => {
              notification.remove();
          }, 500);
      }, 3000);

      // Remover a notificação ao clicar no botão 'delete'
      const deleteButton = notification.querySelector('.delete');
      deleteButton.addEventListener('click', () => {
          notification.remove();
      });
  }
});


