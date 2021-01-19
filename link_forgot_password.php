<?php
    $title = 'Barato | Log in';
    include 'assets/includes/top.php';
    include 'assets/includes/header.php';
?>

    <!-- body -->

    <section class="form">
        <div class="container">
            <form action="controller.php" method="POST">
                <h5>Forgot Password</h5>
                <input type="text" name="firstname" placeholder="First name" required><br>
                <input type="text" name="middlename" placeholder="Middle name" required><br>
                <input type="text" name="lastname" placeholder="Last name" required><br>
                <input type="number" name="forgot_password_rescue_number" placeholder="Enter Your Phone Number..." required><br>
                <button type="submit" name="forgot_pass_btn">Submit</button>
            </form>
        </div>
    </section>

    <!-- /body -->

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>