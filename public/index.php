<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Create User & Chat</title>
</head>

<body data-bs-theme="dark">

    <!-- BOTÕES -->
    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasChat" role="button"
        aria-controls="offcanvasChat">Chat Offcanvas</a>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateUser">
        Create User Modal
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSelectUser"
        id="btnSelectUser">
        Select User Modal
    </button>

    <!-- OFFCANVAS CHAT -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasChat" aria-labelledby="offcanvasChatLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasChatLabel">Nome do chamado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div id="containerMsg" class="flex-grow-1 py-3 d-flex flex-column gap-3 overflow-auto">
                <!-- Mensagens -->
            </div>
            <div class="d-flex border border-3 rounded-pill mt-2">
                <button id="clip" class="btn rounded-start-pill"><i class="bi bi-paperclip fs-4"></i></button>
                <button id="emoji" class="btn"><i class="bi bi-emoji-smile fs-4"></i></button>
                <textarea id="msg" class="form-control border-0 fs-5 py-3" style="resize: none;" rows="1"
                    placeholder="Mensagem"></textarea>
                <button id="microfone" class="btn rounded-end-pill"><i class="bi bi-mic fs-4"></i></button>
            </div>
        </div>
    </div>

    <!-- MODAL CREATE USER -->
    <div class="modal fade" id="modalCreateUser" tabindex="-1" aria-labelledby="modalCreateUserLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalCreateUserLabel">Create User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCreateUser" class="needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="modal-body">
                        <!-- Avatar -->
                        <div class="mb-3">
                            <div
                                class="d-flex justify-content-center align-items-center m-auto border rounded-circle position-relative avatarPreview">
                                <input type="file" name="inputAvatar" id="avatar" class="form-control rounded-circle">
                                <label for="avatar" class="fs-4 position-absolute edit"><i
                                        class="bi bi-pen"></i></label>
                            </div>
                        </div>
                        <!-- Username -->
                        <div class="form-floating mb-3">
                            <input type="text" name="inputUsername" id="username" class="form-control"
                                placeholder="Username" required>
                            <label for="username">Username</label>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Insert the username</div>
                        </div>
                        <!-- Password -->
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" name="inputPassword" id="password" class="form-control pe-5"
                                placeholder="Password" required>
                            <label for="password">Password</label>
                            <button type="button" class="btn btn-outline-secondary position-absolute top-0 end-0 h-100"
                                id="passwordPreview"><i class="bi bi-eye"></i></button>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Insert the password</div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-primary" data-bs-target="#modalAutoUser"
                            data-bs-toggle="modal">Auto user</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL AUTO USER -->
    <div class="modal fade" id="modalAutoUser" tabindex="-1" aria-labelledby="modalAutoUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAutoUserLabel">Auto User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAutoUser" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <!-- Nationality -->
                        <div class="mb-3">
                            <label for="nationality" class="form-label">Nationality</label>
                            <select class="form-select form-select-lg" id="nationality" required>
                                <option value="" selected>Select the nationality</option>
                                <option value="all">All</option>
                                <option value="au">Australia</option>
                                <option value="br">Brazil</option>
                                <option value="ca">Canada</option>
                                <option value="ch">Switzerland</option>
                                <option value="de">Germany</option>
                                <option value="dk">Denmark</option>
                                <option value="es">Spain</option>
                                <option value="fi">Finland</option>
                                <option value="fr">France</option>
                                <option value="gb">United Kingdom</option>
                                <option value="ie">Ireland</option>
                                <option value="in">India</option>
                                <option value="ir">Iran</option>
                                <option value="mx">Mexico</option>
                                <option value="nl">Netherlands</option>
                                <option value="no">Norway</option>
                                <option value="nz">New Zealand</option>
                                <option value="rs">Serbia</option>
                                <option value="tr">Türkiye / Turkey</option>
                                <option value="ua">Ukraine</option>
                                <option value="us">United States</option>
                            </select>
                            <div class="invalid-feedback">Select the nationality.</div>
                        </div>
                        <!-- Gender -->
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select form-select-lg" id="gender" required>
                                <option value="" selected>Select the gender</option>
                                <option value="all">All</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                            </select>
                            <div class="invalid-feedback">Select the gender.</div>
                        </div>
                        <!-- Users -->
                        <div>
                            <label for="users" class="form-label">
                                Users:
                            </label>
                            <div class="d-flex justify-content-center align-items-center gap-3">
                                <span>
                                    <input type="number" class="form-control col" id="numberUsers" min="1" max="1000"
                                        value="1">
                                </span>

                                <input type="range" class="form-range" id="users" min="1" max="1000" step="1" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-primary" data-bs-target="#modalCreateUser"
                            data-bs-toggle="modal">Back</button>
                        <button type="submit" class="btn btn-primary" id="autoUser">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL SELECT USER -->
    <div class="modal fade" id="modalSelectUser" tabindex="-1" aria-labelledby="modalSelectUserLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalSelectUserLabel">Select User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="users list-group">
                        <button
                            class="list-group-item list-group-item-action user d-flex flex-row justify-content-center align-items-center px-0 overflow-hidden">
                            <div class="avatar mx-3 d-flex justify-content-center align-items-center">
                                <div class="avatar rounded-circle"
                                    style="background-image: url('https://randomuser.me/api/portraits/men/15.jpg');">
                                </div>
                            </div>
                            <div class="info d-flex justify-content-start align-items-center w-100 fs-5">
                                <div class="d-flex flex-column w-100">
                                    <span class="name">Elói Vieira</span>
                                    <span
                                        class="id fs-6 text-secondary"><small>019ac6a4-f435-7156-bec7-fb9d9afafe15</small></span>
                                </div>
                                <div class="d-flex me-1">
                                    <a class="btn fs-3" tabindex="-1" role="button" id="remove"><i
                                            class="bi bi-x"></i></a>
                                </div>
                            </div>
                        </button>

                        <button
                            class="list-group-item list-group-item-action user d-flex flex-row justify-content-center align-items-center px-0 overflow-hidden">
                            <div class="avatar mx-3 d-flex justify-content-center align-items-center">
                                <div class="avatar rounded-circle"
                                    style="background-image: url('https://randomuser.me/api/portraits/men/15.jpg');">
                                </div>
                            </div>
                            <div class="info d-flex justify-content-start align-items-center w-100 fs-5">
                                <div class="d-flex flex-column w-100">
                                    <span class="name">Elói Vieira</span>
                                    <span
                                        class="id fs-6 text-secondary"><small>019ac6a4-f435-7156-bec7-fb9d9afafe15</small></span>
                                </div>
                                <div class="d-flex me-1">
                                    <a class="btn fs-3" tabindex="-1" role="button" id="remove"><i
                                            class="bi bi-x"></i></a>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="assets/js/index.js"></script>
</body>

</html>