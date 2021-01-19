<?php
    $title = 'Barato | Register';
    include 'assets/includes/top.php';
    include 'assets/includes/header.php';
?>

    <!-- body -->

    <section class="form">
        <div class="container">
            <form action="controller.php" method="POST">
                <h3>Welcome to <span class="gold">Barato</span>!</h3>
                <h5>Create an account</h5>
                <input type="text" name="firstname" placeholder="First name" required><br>
                <input type="text" name="middlename" placeholder="Middle name" required><br>
                <input type="text" name="lastname" placeholder="Lastname" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="number" name="phone_number" placeholder="Phone Number" required><br>
                <input type="text" name="address" placeholder="Complete Address" required><br>
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit" name="register_btn">Register</button>
                <p class="al_acc">Already have an account? <a href="index.php"><i>Log in</i></a></p>
            </form>
        </div>
    </section>

    <!-- /body -->

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>