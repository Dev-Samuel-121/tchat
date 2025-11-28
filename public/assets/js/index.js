// === SELECTORES ===
const formCreateUser = document.querySelector('#formCreateUser');
const btnPasswordPreview = document.querySelector('#passwordPreview');
const inputPassword = document.querySelector('#password');

const btnAutoUser = document.querySelector('#autoUser');
const inputNationality = document.querySelector('#nationality');
const inputGender = document.querySelector('#gender');
const inputUsers = document.querySelector('#users');
const numberUsers = document.querySelector('#numberUsers');

let selectUsers = document.querySelector('.users');
let btnSelectUsers = document.querySelector('#btnSelectUser');

btnSelectUsers.addEventListener('click', async () => {
    let users = await getUsers();
    selectUsers.innerHTML = '';
    users.forEach(montarUsers);
    registerRemoveButtons();
});

function montarUsers(user) {
    let containerUser = document.createElement('button');
    let containerAvatar = document.createElement('div');
    let avatar = document.createElement('div');
    let containerInfo = document.createElement('div');
    let info = document.createElement('div');
    let name = document.createElement('span');
    let id = document.createElement('small');
    let containerRemove = document.createElement('div');
    let remove = document.createElement('a');
    let removeIcon = document.createElement('i');

    containerUser.classList.add('list-group-item', 'list-group-item-action', 'user', 'd-flex', 'flex-row', 'justify-content-center', 'align-items-center', 'px-0', 'overflow-hidden');

    containerAvatar.classList.add('mx-3', 'd-flex', 'justify-content-center', 'align-items-center');

    avatar.classList.add('avatar', 'rounded-circle');
    avatar.style.backgroundImage = `url(${user.avatar})`;

    containerInfo.classList.add('info', 'd-flex', 'justify-content-start', 'align-items-center', 'w-100', 'fs-5');

    info.classList.add('d-flex', 'flex-column', 'w-100');

    name.classList.add('name');
    name.innerText = user.username;

    id.classList.add('id', 'fs-6', 'text-secondary');
    id.innerText = user.id;

    containerRemove.classList.add('d-flex', 'me-1');

    remove.classList.add('remove', 'btn', 'fs-3');
    remove.setAttribute('tabindex', '-1');
    remove.setAttribute('role', 'button');

    removeIcon.classList.add('bi', 'bi-x');

    remove.appendChild(removeIcon);

    containerRemove.appendChild(remove);

    containerAvatar.appendChild(avatar);

    info.appendChild(name);
    info.appendChild(id);

    containerInfo.appendChild(info);
    containerInfo.appendChild(containerRemove);

    containerUser.appendChild(containerAvatar);
    containerUser.appendChild(containerInfo);
    selectUsers.appendChild(containerUser);
}

function registerRemoveButtons() {
    const removeButtons = document.querySelectorAll('.remove');

    removeButtons.forEach(btn => {
        btn.addEventListener('click', async () => {

            const containerUser = btn.closest('.user'); // elemento do botão
            const id = containerUser.querySelector('.id').innerText;

            const fd = new FormData();
            fd.append('id', id);

            const success = await removeUser(fd);

            if (success) containerUser.remove();
        });
    });
}

async function removeUser(fd) {
    try {
        const response = await fetch('assets/php/remover_usuario.php', {
            method: 'POST',
            body: fd
        });

        const text = await response.text();
        console.log("SERVER:", text);

        return true;
    } catch (e) {
        console.log("Erro ao remover usuário:", e);
        return false;
    }
}

async function remove(fd) {
    try {
        response = await fetch('assets/php/remover_usuario.php', { method: 'POST', body: fd });
        data = await response.text();

        console.log('Usuario removido com sucesso!');
    } catch (e) {
        console.log(`Erro na remoção do usuário: ${e}`);
    }
}

async function getUsers() {
    try {
        let response = await fetch('assets/php/pegar_usuarios.php');
        let data = await response.json();

        return data;
    } catch (error) {
        console.error(`Erro na coleta de usuários: ${error}`);
    }
}

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
