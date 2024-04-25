<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header('Location: /');
    }
    $title = "Регистрация";
    require "header.php";
?>

<main class="main py-3">
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-6">
                <noscript>
                    <p style="color:brown;">Вы не зарегистрируетесь. У вас отключен Javascript! Вкючите js и повторите попытку регистрации!</p>
                </noscript> 
                <h2 class="my-3 text-center">Форма регистрации</h2>
                <form id="reg">
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
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Повтор пароля</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        <div class="error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <div class="error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <div class="error"></div>
                    </div>
                    <!-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <button type="submit" class="btn btn-primary" id="reg-btn">Зарегистрироваться</button>
                    <!-- <a href="login.tpl.php" class="btn btn-secondary">Войти</a> -->
                </form>
                <div id="result"></div>
            </div>
        </div>

    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/register.js"></script>

</main>


<?php  
    require "footer.php"; 
?>
</div>
</body>

</html>