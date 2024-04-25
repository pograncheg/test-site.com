<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /');
    }
    require "header.php";
    $title = "Профиль";
?>

<main class="main py-3">

<div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <h2 class="my-3 text-center">Профиль пользователя</h2>
                <div class="mb-3">
                        <p>Hello<span class="field"><?php echo " " . $_SESSION['user']['login'];?></span></p>
                        <p>Ваше имя:<span class="field"><?php echo " " . $_SESSION['user']['name'];?></span></p>
                        <p>Ваш email:<span class="field"><?php echo " " . $_SESSION['user']['email'];?></span></p>
                </div>
                <a href="../handlers/logout-handler.php" class="btn btn-primary">Выйти</a>
                <div id="result"></div>
            </div>
        </div>
    </div>
</main>

<?php  
    require "footer.php"; 
?>

</div>
</body>

</html>