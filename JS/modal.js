const openModal = document.querySelector('#btn-usuario');

const modal = document.querySelector('.modal');

const closeButtons = document.querySelectorAll('.modal__close');

openModal.addEventListener('click', (e) => {
    e.preventDefault();
    modal.classList.add('modal--show');
});

closeButtons.forEach((button) => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        modal.classList.remove('modal--show');
    });
});