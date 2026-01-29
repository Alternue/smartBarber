<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?= $this->include("layouts/import") ?>

    <title><?= $title ?></title>

    <style>
        body {
            background-color: #e7eaeb;
        }

        .header-card {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .content-wrapper {
            display: flex;
            gap: 20px;
        }

        .menu-card,
        .cart-card {
            background-color: #2a3f7f;
            color: white;
            border-radius: 16px;
            padding: 20px;
            height: 420px;
        }

        .menu-list,
        .cart-list {
            max-height: 260px;
            overflow-y: auto;
        }

        .menu-item {
            background-color: #1f3b75;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }

        .btn-switch {
            background-color: #1f3b75;
            color: white;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="container mt-4">

        <!-- HEADER -->
        <div class="header-card">
            <h3>Welcome <span style="color:#ff4d4d"><?= esc($username) ?></span></h3>
            <small style="letter-spacing: 2px;">STYLE WITH DISCIPLINE</small>
            <div class="align-items-end">
                <button class="btn btn-danger mt-2" onclick="logout_modal()">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout</button>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content-wrapper">

            <!-- MENU -->
            <div class="menu-card col-md-6">
                <h4 class="text-center mb-3">MENU</h4>

                <div class="d-flex justify-content-center gap-2 mb-3">
                    <button class="btn btn-switch btn-sm">Services</button>
                    <button class="btn btn-switch btn-sm">Staff</button>
                </div>

                <div class="menu-list">
                    <div class="menu-item">
                        <span>Cukur Fade</span>
                        <span>Rp 10.000</span>
                    </div>
                    <div class="menu-item">
                        <span>Cukur Biasa</span>
                        <span>Rp 8.000</span>
                    </div>
                    <div class="menu-item">
                        <span>Keramas</span>
                        <span>Rp 5.000</span>
                    </div>
                </div>
            </div>

            <!-- CART -->
            <div class="cart-card col-md-6">
                <h4 class="text-center mb-3">CART</h4>

                <div class="cart-list">
                    <p>1. Cukur Fade</p>
                    <p>2. Keramas</p>
                    <p>3. Pijat</p>
                </div>

                <hr>
                <p><strong>Total :</strong> Rp 20.000</p>
                <p><strong>Staff :</strong> Mas Rusdi</p>
            </div>

        </div>
    </div>

    <script src="<?= base_url('public/js/jquery.js') ?>"></script>
    <script src="<?= base_url('public/js/notyf.min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            console.log("Dashboard User Ready");
        });

        function logout_modal() {
            Swal.fire({
                icon: 'question',
                title: 'Apakah anda yakin?',
                text: 'Konfirmasi sebelum anda ingin keluar dari akun anda',
                showCancelButton: true,
                confirmButtonColor: '#68b451',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('logout') ?>",
                        type: "POST",
                        dataType: "json",
                        success: function(res) {
                            if (res.status === 'success') {
                                window.location.href = res.redirect;
                            }
                        }
                    });
                }
            });
        }
    </script>

</body>

</html>