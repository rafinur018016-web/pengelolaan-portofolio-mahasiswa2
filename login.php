<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <title>Login | PortoCampus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {

            margin: 0;

            padding: 0;

            box-sizing: border-box;

            font-family: 'Poppins', sans-serif;

        }

        body {

            height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            background: linear-gradient(135deg, #2563eb, #4f46e5, #7c3aed);

            overflow: hidden;

        }

        body::before {

            content: "";

            position: absolute;

            width: 450px;

            height: 450px;

            background: rgba(255, 255, 255, .08);

            border-radius: 50%;

            top: -120px;

            left: -120px;

        }

        body::after {

            content: "";

            position: absolute;

            width: 350px;

            height: 350px;

            background: rgba(255, 255, 255, .08);

            border-radius: 50%;

            bottom: -120px;

            right: -100px;

        }

        .login-card {

            width: 100%;

            max-width: 430px;

            background: rgba(255, 255, 255, .97);

            backdrop-filter: blur(20px);

            border-radius: 24px;

            padding: 40px;

            box-shadow: 0 25px 60px rgba(0, 0, 0, .25);

            z-index: 10;

            animation: fadeUp .8s;

        }

        @keyframes fadeUp {

            from {

                opacity: 0;

                transform: translateY(40px);

            }

            to {

                opacity: 1;

                transform: translateY(0);

            }

        }

        .logo {

            width: 90px;

            height: 90px;

            border-radius: 50%;

            background: linear-gradient(135deg, #2563eb, #4f46e5);

            display: flex;

            align-items: center;

            justify-content: center;

            margin: auto;

            margin-bottom: 20px;

            color: #fff;

            font-size: 40px;

        }

        .login-card h2 {

            font-weight: 700;

            text-align: center;

            margin-bottom: 8px;

        }

        .login-card p {

            text-align: center;

            color: #666;

            margin-bottom: 30px;

        }

        .form-control {

            height: 52px;

            border-radius: 14px;

            padding-left: 45px;

        }

        .input-group {

            position: relative;

            margin-bottom: 20px;

        }

        .input-group i {

            position: absolute;

            left: 15px;

            top: 16px;

            color: #6b7280;

            z-index: 100;

        }

        .btn-login {

            height: 52px;

            border-radius: 14px;

            background: linear-gradient(135deg, #2563eb, #4f46e5);

            border: none;

            font-weight: 600;

            font-size: 16px;

            transition: .3s;

        }

        .btn-login:hover {

            transform: translateY(-2px);

            box-shadow: 0 12px 25px rgba(37, 99, 235, .35);

        }

        .footer {

            text-align: center;

            margin-top: 25px;

            color: #777;

            font-size: 14px;

        }

        /* ===========================
   Responsive Mobile
=========================== */

        @media (max-width: 576px) {

            body {

                padding: 20px;

                overflow-y: auto;

            }

            .login-card {

                max-width: 100%;

                padding: 28px 22px;

                border-radius: 18px;

            }

            .logo {

                width: 70px;
                height: 70px;
                font-size: 30px;

            }

            .login-card h2 {

                font-size: 24px;

            }

            .login-card p {

                font-size: 14px;

            }

            .form-control {

                height: 48px;

            }

            .btn-login {

                height: 48px;

            }

        }
    </style>

</head>

<body>

    <div class="login-card">

        <div class="logo">

            <i class="bi bi-mortarboard-fill"></i>

        </div>

        <h2>

            PortoCampus

        </h2>

        <p>

            Silakan login untuk melanjutkan

        </p>

        <?php if (isset($_GET['error'])) { ?>

            <div class="alert alert-danger text-center">

                <i class="bi bi-exclamation-triangle-fill"></i>

                <?php

                if ($_GET['error'] == "notfound") {
                    echo "Akun belum terdaftar. Silakan daftar terlebih dahulu.";
                } elseif ($_GET['error'] == "password") {
                    echo "Password yang Anda masukkan salah.";
                } elseif ($_GET['error'] == "role") {
                    echo "Role yang dipilih tidak sesuai dengan akun.";
                } elseif ($_GET['error'] == "blokir") {
                    echo "Akun Anda diblokir karena data tidak valid. Silakan hubungi admin.";
                } else {
                    echo "Login gagal.";
                }

                ?>

            </div>

        <?php } ?>

        <form
            method="POST"
            action="../controllers/LoginController.php">

            <div class="input-group">

                <i class="bi bi-envelope-fill"></i>

                <input

                    type="email"

                    name="email"

                    class="form-control"

                    placeholder="Masukkan Email"

                    required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">

                    Login Sebagai

                </label>

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="radio"
                        name="role"
                        value="user"
                        checked>

                    <label class="form-check-label">

                        👨‍🎓 Mahasiswa / User

                    </label>

                </div>

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="radio"
                        name="role"
                        value="admin">

                    <label class="form-check-label">

                        🛡️ Administrator

                    </label>

                </div>

            </div>

            <div class="input-group position-relative">

                <i class="bi bi-lock-fill"></i>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control pe-5"
                    placeholder="Masukkan Password"
                    required>

                <span
                    onclick="togglePassword()"
                    style="
        position:absolute;
        right:15px;
        top:15px;
        cursor:pointer;
        z-index:999;">

                    <i
                        class="bi bi-eye-fill"
                        id="eyeIcon"></i>

                </span>

            </div>
            <button
                id="btnLogin"
                type="submit"
                class="btn btn-primary btn-login w-100">

                <i class="bi bi-box-arrow-in-right"></i>

                <span id="textLogin">

                    Login

                </span>

            </button>

            <div class="text-end mt-2">

                <a
                    href="forgot_password.php"
                    class="text-decoration-none">

                    Lupa Password?

                </a>

            </div>

        </form>

        <div class="text-center mt-3">

            Belum punya akun?

            <a
                href="register.php"
                class="text-decoration-none fw-bold">

                Daftar Sekarang

            </a>

        </div>

        <div class="text-center mt-4">

            <a
                href="../index.php"
                class="text-decoration-none">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Beranda

            </a>

        </div>

        <div class="footer">

            © <?= date('Y'); ?> PortoCampus

            <br>

            Sistem Portofolio Digital Mahasiswa

        </div>

    </div>

    <script>
        function togglePassword() {

            let pass = document.getElementById("password");
            let icon = document.getElementById("eyeIcon");

            if (pass.type == "password") {

                pass.type = "text";
                icon.className = "bi bi-eye-slash-fill";

            } else {

                pass.type = "password";
                icon.className = "bi bi-eye-fill";

            }

        }

        // Loading Login
        document.querySelector("form").addEventListener("submit", function() {

            document.getElementById("btnLogin").disabled = true;

            document.getElementById("textLogin").innerHTML =

                '<span class="spinner-border spinner-border-sm"></span> Sedang Login...';

        });
    </script>

</body>

</html>