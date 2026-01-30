<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->include("layouts/import") ?>
    <link rel="stylesheet" href="<?= base_url('public/css/notyf.min.css') ?>">

    <title>smartBarber | Register</title>
</head>

<body style="background-color: #e7eaeb;">
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mt-4">
                                    <h5>Create Account <strong style="color : #096afb">Smart Barber</strong></h5>
                                    <p class="lead text-dark">
                                        Register to create your new account
                                    </p>
                                </div>

                                <div class="m-sm-4">
                                    <div id="show-response">
                                        <form id="registerForm">

                                            <div class="form-group mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username"
                                                    placeholder="Insert your username">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Insert your email">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="******">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                                    placeholder="******">
                                            </div>

                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" onclick="show_password()">
                                                <label class="form-label">Show Password</label>
                                            </div>

                                            <div class="mt-2">
                                                <span class="text-muted">Already have an account?</span>
                                                <a href="<?= base_url('login') ?>" class="text-primary fw-semibold">
                                                    Sign In
                                                </a>
                                            </div>

                                            <div id="loadingSaving"></div>

                                            <div class="text-end mt-3">
                                                <button id="submitBtn" type="submit" class="btn btn-primary"
                                                    style="border-radius: 5px">
                                                    Sign Up
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="<?= base_url('public/js/main.js') ?>"></script>
    <script src="<?= base_url('public/js/jquery.js') ?>"></script>
    <script src="<?= base_url('public/js/notyf.min.js') ?>"></script>

    <script>
        const notyf = new Notyf({
            position: { x: "right", y: "top" },
            duration: 3000,
            ripple: true
        });

        function show_password() {
            const password = document.getElementById('password');
            const confirm = document.getElementById('confirm_password');

            password.type = password.type === 'password' ? 'text' : 'password';
            confirm.type = confirm.type === 'password' ? 'text' : 'password';
        }

        $('#submitBtn').on('click', function (e) {
            e.preventDefault();

            const username = $('#username').val();
            const email = $('#email').val();
            const password = $('#password').val();
            const confirm = $('#confirm_password').val();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!username || !email || !password || !confirm) {
                notyf.error("Semua field wajib diisi.");
                return;
            }

            if (password !== confirm) {
                notyf.error("Password dan konfirmasi password tidak sama.");
                return;
            }
            if (!emailPattern.test(email)) {
                notyf.error("Email tidak valid. Gunakan format email yang benar.");
                return;
            }

            $.ajax({
                url: '<?= base_url("register/process") ?>',
                type: "POST",
                dataType: "json",
                data: {
                    username: username,
                    email: email,
                    password: password,
                    confirm_password: confirm
                },
                success: function (response) {
                    if (response.status === 'success') {
                        notyf.success(response.message);
                        setTimeout(() => {
                            window.location.href = response.redirect;
                        }, 500);
                    } else {
                        notyf.error(response.message);
                    }
                },
                error: function () {
                    notyf.error("Terjadi kesalahan saat registrasi.");
                }
            });
        });
    </script>

</body>
</html>
