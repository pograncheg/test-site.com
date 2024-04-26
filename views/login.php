<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header('Location: /');
    }
    $title = "Авторизация";
    require "header.php";
?>

<main class="main py-3">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <noscript>
                    <p style="color:brown;">Вы не авторизируетесь. У вас отключен Javascript! Вкючите js и повторите попытку авторизации!</p>
                </noscript> 
                <h2 class="my-3 text-center">Форма авторизации</h2>
                <form id="auth">
                    <div class="mb-3">
                        <label for="login" class="form-label">Логин</label>
                        <input type="text" class="form-control" id="login" name="login">
                        <div class="error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="error"></div>
                    </div> 
                    <button type="submit" class="btn btn-primary" id="login-btn">Войти</button>
                </form>
                <div id="result"></div>
            </div>
        </div>

    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/login.js"></script>

</main>

<?php  
    require "footer.php"; 
?>