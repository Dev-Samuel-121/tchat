// === SELECTORES ===
const formCreateUser = document.querySelector('#formCreateUser');
const btnPasswordPreview = document.querySelector('#passwordPreview');
const inputPassword = document.querySelector('#password');

const btnAutoUser = document.querySelector('#autoUser');
const inputNationality = document.querySelector('#nationality');
const inputGender = document.querySelector('#gender');
const inputUsers = document.querySelector('#users');
const numberUsers = document.querySelector('#numberUsers');

// === PASSWORD SHOW/HIDE ===
btnPasswordPreview.addEventListener('click', () => {
    const icon = btnPasswordPreview.querySelector('i');
    if (icon.classList.contains('bi-eye')) {
        icon.classList.replace('bi-eye', 'bi-eye-slash');
        inputPassword.type = 'text';
    } else {
        icon.classList.replace('bi-eye-slash', 'bi-eye');
        inputPassword.type = 'password';
    }
});

// === FORM CREATE USER ===
formCreateUser.addEventListener('submit', (e) => {
    e.preventDefault();

    if (!formCreateUser.checkValidity()) {
        formCreateUser.classList.add('was-validated');
        return;
    }

    const formData = new FormData(formCreateUser);

    fetch("assets/php/salvar_usuario.php", {
        method: "POST",
        body: formData
    })
        .then(r => r.text())
        .then(resposta => {
            console.log(resposta);
            alert("Usuário salvo!");
            formCreateUser.reset();
            formCreateUser.classList.remove('was-validated');
        })
        .catch(err => {
            console.error(err);
            alert("Erro ao enviar.");
        });
});

// === AUTO USER ===
btnAutoUser.addEventListener('click', (e) => {
    e.preventDefault();

    const fd = new FormData();
    fd.append('nationality', inputNationality.value);
    fd.append('gender', inputGender.value);
    fd.append('users', numberUsers.value);

    fetch("assets/php/auto_user.php", {
        method: "POST",
        body: fd
    })
        .then(r => r.text())
        .then(resposta => {
            console.log(resposta);
            alert("Usuário(s) salvo(s)!");
        })
        .catch(err => {
            console.error(err);
            alert("Erro ao enviar.");
        });
});

// === RANGE NUMBER USERS UPDATE ===
numberUsers.addEventListener('input', () => {
    inputUsers.value = numberUsers.value;
});

// === RANGE USERS UPDATE ===
inputUsers.addEventListener('input', () => {
    numberUsers.value = inputUsers.value;
});

// === Bootstrap Form Validation ===
(() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
