<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->include("layouts/import") ?>
    <link rel="stylesheet" href="<?= base_url('public/css/notyf.min.css') ?>">

    <title>smartBarber | Login</title>
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
                                    <h5>Welcome to <strong style="color : #096afb">Smart Barber</strong></h5>
                                    <p class="lead text-dark">
                                        Sign in to your account to continue
                                    </p>
                                </div>
                                <div class="m-sm 4">
                                    <div id="show-response">
                                        <form id="login">
                                            <div class="form-group mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" name="username" id="username"
                                                    placeholder="Insert your username">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="******">
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="showPassword" name="showPassword"
                                                    class="form-check-input" onclick="show_password()">
                                                <label for="showpassword" class="form-label">Show Password</label>
                                            </div>

                                            <div id="loadingSaving"></div>
                                            <div class="text-end mt-3">
                                                <button id="submitBtn" type="submit" class="btn btn-primary"
                                                    style="border-radius: 5px">Sign In</button>
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

    <script src="<?= base_url('public/js/jquery.js') ?>"></script>
    <script src="<?= base_url('public/js/notyf.min.js') ?>"></script>
    <script>
        const notyf = new Notyf({
            position: {
                x: "right",
                y: "top"
            },
            dismissible: false,
            duration: 3000,
            ripple: true
        });


        function show_password() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        }


        $('#submitBtn').on('click', function(e) {
            e.preventDefault();
            const username = $('#username').val()
            const password = $('#password').val()
            const loading = $('#loadingSaving');

            if (!username && !password) {
                notyf.error("Silahkan isi username dan password anda.")
            } else if (!username) {
                notyf.error("Username tidak boleh kosong.")
            } else if (!password) {
                notyf.error("Password tidak boleh kosong.")
            } else {
                $.ajax({
                    url: '<?= base_url("auth") ?>',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        username: username,
                        password: password
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            notyf.success(response.message)
                            setTimeout(() => {
                                window.location.href = response.redirect
                            }, 500);
                        } else {
                            notyf.error(response.message)
                        }
                    },
                    error: function() {
                        notyf.error("Terjadi kesalahan pada saat memproses login, Silahkan Coba Lagi")
                    }
                });

            }
        })
    </script>


</body>

</html>