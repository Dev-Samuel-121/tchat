let formCreateUser = document.querySelector('#formCreateUser');
let bntPasswordPreview = document.querySelector('#passwordPreview');
let inputPassword = document.querySelector('#password');

let btnAutoUser = document.querySelector('#autoUser');
let inputResults = document.querySelector('#results');

bntPasswordPreview.addEventListener('click', () => {
    let icon = bntPasswordPreview.querySelector('i');
    if (icon.classList.contains('bi-eye')) {
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
        inputPassword.type = 'text';
    } else {
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
        inputPassword.type = 'password';
    }
});

formCreateUser.addEventListener('submit', (e) => {
    e.preventDefault();

    if (!formCreateUser.checkValidity()) {
        formCreateUser.classList.add('was-validated');
        return;
    }

    let formData = new FormData(e.target);

    fetch("assets/php/salvar_usuario.php", {
        method: "POST",
        body: formData
    })
        .then(r => r.text())
        .then(resposta => {
            console.log(resposta);
            alert("Usuário salvo!");
        })
        .catch(err => {
            console.error(err);
            alert("Erro ao enviar.");
        });
});

btnAutoUser.addEventListener('click', (e) => {
    e.preventDefault();

    let fd = new FormData();
    fd.append('results', inputResults.value);
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

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()