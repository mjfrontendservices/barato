<?php
    $title = 'Barato | Log in';
    include 'assets/includes/top.php';
    include 'assets/includes/header.php';
?>

    <!-- body -->

    <section class="form">
        <div class="container">
            <form action="controller.php" method="POST">
                <h3>Welcome back to <span class="gold">Barato</span></h3>
                <h5>Log in</h5>
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <a class="forgot_password_link" href="link_forgot_password.php">
                    <p class="forgot_password">Forgot Password?</p>
                </a>
                <button type="submit" name="login_btn">Login</button>
                <p class="no_acc">Don't have an account? <a href="register.php"><i>Register</i></a></p>
            </form>
        </div>
    </section>

    <!-- /body -->

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>