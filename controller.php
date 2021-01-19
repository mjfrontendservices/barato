<?php
$title = 'Barato | 404';
include 'assets/includes/top.php';
include 'assets/includes/header.php';
    // user
    class User{
        protected static $id;
        protected static $firstname;
        protected static $middlename;
        protected static $lastname;
        protected static $username;
        protected static $password;
        protected static $email;
        protected static $address;
        protected static $phone_number;
        protected static $profile_picture;
        protected static $date;
    }
    class Register_User extends User{
        private static function register_process(){
            $data = json_decode(file_get_contents('assets/db/users.json'), true);
            self::$id = uniqid('', true);
            self::$firstname = $_REQUEST['firstname'];
            self::$middlename = $_REQUEST['middlename'];
            self::$lastname = $_REQUEST['lastname'];
            self::$username = $_REQUEST['username'];
            self::$password = hash('sha512', $_REQUEST['password']);
            self::$email = $_REQUEST['email'];
            self::$address = $_REQUEST['address'];
            self::$phone_number = $_REQUEST['phone_number'];
            self::$profile_picture = 'default.png';
            self::$date = date('F j, Y');
            $user = array(
                'id' => self::$id,
                'firstname' => self::$firstname,
                'middlename' => self::$middlename,
                'lastname' => self::$lastname,
                'username' => self::$username,
                'password' => self::$password,
                'email' => self::$email,
                'address'  => self::$address,
                'phone_number'  => self::$phone_number,
                'profile_picture'  => self::$profile_picture,
                'date' => self::$date
            );
            include 'assets/includes/data.php';
            // if username is already registered
            if(in_array(self::$username, $data_uniq_usernames)){
                ?>
                    <div class="container">
                        <p class="alert alert-danger error">
                            <b>'<?php echo self::$username;?>' username is already taken.</b><br>
                            Please change your username and try again.
                        </p>
                        <a href="register.php">
                            <button class="btn btn-info"><i class="fa fa-arrow-left"></i> Register Again</button>
                        </a>
                    </div>
                <?php
            } else {
                // insert to username file
                // $uniq_username = array(
                //     self::$username => self::$username
                // );
                $data_uniq_usernames[] = self::$username;
                $data_username_insert = json_encode($data_uniq_usernames);
                file_put_contents('assets/db/uniq_usernames.json', $data_username_insert);
                // insert to users file
                $data_users[] = $user;
                $data_insert = json_encode($data_users);
                if(file_put_contents('assets/db/users.json', $data_insert)){
                    session_start();
                    foreach ($data_users as $index => $property) {
                        if($property['username'] = self::$username){
                            $_SESSION['user'] = $property['id'];
                        }
                    }
                    header ('Location: welcome.php');
                }
            }
        }
        public static function register_event(){
            if(isset($_REQUEST['register_btn'])){
                self::register_process();
            }
        }
    } Register_User::register_event();
    // login
    class Login_User extends User{
        private static function login_process(){
            include 'assets/includes/data.php';
            self::$username = $_REQUEST['username'];
            self::$password = hash('sha512', $_REQUEST['password']);
            session_start();
            foreach ($data_users as $index => $property) {
                if($property['username'] == self::$username && $property['password'] == self::$password){
                    $_SESSION['user'] = $property['id'];
                    header ('Location: welcome.php');
                }
            }
            ?>
                <div class="container">
                    <p class="alert alert-danger error">
                        <b>Incorrect Username or Password</b><br>
                    </p>
                    <a href="index.php">
                        <button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Try Again</button>
                    </a>
                </div>
            <?php
        }
        public static function login_event(){
            if(isset($_REQUEST['login_btn'])){
                self::login_process();
            }
        }
    } Login_User::login_event();
    // upload profile picture
    class Upload_Profile_Picture extends User{
        private static function upload_profile_pic_process(){
            include 'assets/includes/data.php';
            session_start();
            self::$profile_picture = $_FILES['file'];
            $_name = self::$profile_picture['name'];
            $_tmp = self::$profile_picture['tmp_name'];
            $_error = self::$profile_picture['error'];
            // file extension
            $_div = explode('.', $_name);
            $_actual_ext = strtolower(end($_div));
            // allowed
            $_allowed_ext = array('jpg', 'png', 'jpeg', 'svg');
            // uniq name
            $_uniqname = uniqid('', true).'.'.$_actual_ext;
            $_dir = 'https://sanaolbarato.herokuapp.com/assets/img/profile_pictures/'.$_uniqname;
            if(!in_array($_actual_ext, $_allowed_ext)){  
                ?>
                <div class="container">
                    <p class="alert alert-danger error">
                        <b>Invalid File Extension</b><br>
                        Allowed file extension: .jpg, .png, .jpeg, .svg
                    </p>
                    <a href="link_edit_profile_picture.php">
                        <button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Try Again</button>
                    </a>
                </div>
                <?php
            } else {
                if($_error === 0){
                    foreach ($data_users as $key => $value) {
                        if($value['id'] == $_SESSION['user']){
                            if($value['profile_picture'] != 'default.png'){
                                unlink('https://sanaolbarato.herokuapp.com/assets/img/profile_pictures/'.$value['profile_picture'].'');
                            }
                            $data_users[$key]['profile_picture'] = $_uniqname;
                            move_uploaded_file($_tmp, $_dir);
                            $data_insert = json_encode($data_users);
                            file_put_contents('assets/db/users.json', $data_insert);
                            header ('Location: link_edit_profile_info.php');
                        }
                    }
                } else {
                    ?>
                    <div class="container">
                        <p class="alert alert-danger error">
                            <b>There was an error uploading the file</b><br>
                        </p>
                        <a href="link_edit_profile_picture.php">
                            <button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Try Again</button>
                        </a>
                    </div>
                    <?php
                }
            }
        }
        public static function upload_profile_pic_event(){
            if(isset($_REQUEST['update_profile_pic_btn'])){
                self::upload_profile_pic_process();
            }
        }
    } Upload_Profile_Picture::upload_profile_pic_event();
    // update profile picure
    class Update_Profile_Info extends User{
        private static function update_profile_info_process(){
            include 'assets/includes/data.php';
            session_start();
            self::$firstname = $_REQUEST['firstname'];
            self::$middlename = $_REQUEST['middlename'];
            self::$lastname = $_REQUEST['lastname'];
            self::$email = $_REQUEST['email'];
            self::$phone_number = $_REQUEST['phone_number'];
            self::$address = $_REQUEST['address'];
            self::$password = hash('sha512', $_REQUEST['password']);
            foreach ($data_users as $key => $value) {
                if($value['id'] == $_SESSION['user']){
                    if($value['password'] == self::$password){
                        $data_users[$key]['firstname']= self::$firstname;
                        $data_users[$key]['middlename'] = self::$middlename;
                        $data_users[$key]['lastname'] = self::$lastname;
                        $data_users[$key]['email'] = self::$email;
                        $data_users[$key]['address'] = self::$address;
                        $data_users[$key]['phone_number'] = self::$phone_number;
                        $data_insert = json_encode($data_users);
                        if(file_put_contents('assets/db/users.json', $data_insert)){  
                            ?>
                            <div class="container">
                                <p class="alert alert-info error">
                                    <b>Profile Updated Successfully.</b><br>
                                </p>
                                <a href="user_account.php">
                                    <button class="btn btn-info"><i class="fa fa-arrow-left"></i> Return</button>
                                </a>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="container">
                            <p class="alert alert-danger error">
                                <b>Incorrect Password</b><br>
                                Unable to update profile.
                            </p>
                            <a href="link_edit_profile_info.php">
                                <button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Try Again</button>
                            </a>
                        </div>
                        <?php
                    }
                }
            }
        }
        public static function update_profile_info_event(){
            if(isset($_REQUEST['update_profile_btn'])){
                self::update_profile_info_process();
            }
        }
    } Update_Profile_Info::update_profile_info_event();
    // product
    class Product{
        protected static $id;
        protected static $product_image;
        protected static $product_name;
        protected static $product_price;
        protected static $product_description;
        protected static $product_seller;
        protected static $product_contact_info;
        protected static $date;
    }
    class Upload_Product_Image extends Product{
        private static function upload_product_img_process(){
            include 'assets/includes/data.php';
            session_start();
            self::$product_image = $_FILES['product_picture'];
            $_name = self::$product_image['name'];
            $_tmp_name = self::$product_image['tmp_name'];
            $_error = self::$product_image['error'];
            $_ext = explode('.', $_name);
            $_needed_ext = strtolower(end($_ext));
            $_uniqname = uniqid('', true).".".$_needed_ext;
            $_dir = 'https://sanaolbarato.herokuapp.com/assets/img/uploads/'.$_uniqname;
            $_allowed_file_extension = array('jpg', 'jpeg', 'png', 'svg');
            if(!in_array($_needed_ext, $_allowed_file_extension)){
                echo "Invalid file extension";
            } else {
                if($_error === 0){
                    // if the user reupload an image of the product
                    foreach ($data_product_img as $key => $value) {
                        if($value['product_pic'] == $_SESSION['product_image']){
                            array_splice($data_product_img, $key, 1);
                            unlink('https://sanaolbarato.herokuapp.com/assets/img/uploads/'.$value['product_pic'].'');
                        }
                    }
                    $_SESSION['product_image'] = $_uniqname;
                    if(move_uploaded_file($_tmp_name, $_dir)){
                        $product_img_obj = array(
                            'product_pic_id' => uniqid('', true),
                            'product_pic' => $_uniqname
                        );
                        $data_product_img[] = $product_img_obj;
                        $data_product_img_insert = json_encode($data_product_img);
                        file_put_contents('assets/db/product_images.json', $data_product_img_insert);
                        header ('Location: link_sell_something.php');
                    }
                } else {
                    echo "There was an error uploading the file";
                }
            }
        }
        public static function upload_product_img_event(){
            if(isset($_REQUEST['upload_product_img_btn'])){
                self::upload_product_img_process();
            }
        }
    } Upload_Product_Image::upload_product_img_event();
    class Sell_Products extends Product{
        private static function sell_product_process(){
            include 'assets/includes/data.php';
            session_start();
            self::$id = uniqid('', true);
            self::$product_image = $_SESSION['product_image'];
            self::$product_name = $_REQUEST['product_name'];
            self::$product_price = $_REQUEST['product_price'];
            self::$product_description = $_REQUEST['product_description'];
            self::$product_seller = $_REQUEST['product_seller_name'];
            self::$product_contact_info = $_REQUEST['product_seller_contact_info'];
            self::$date = date ('F j, Y');
            $product = array(
                'id' => 'product_'.sha1(self::$id),
                'image' => self::$product_image,
                'name' => self::$product_name,
                'price' => self::$product_price,
                'description' => self::$product_description,
                'seller' => self::$product_seller,
                'seller_id' => $_SESSION['user'],
                'contact info' => self::$product_contact_info,
                'date' => self::$date
            );
            // $data_products[] = $product;
            array_unshift($data_products, $product);
            $data_insert = json_encode($data_products);
            if(file_put_contents('assets/db/products.json', $data_insert)){
                foreach ($data_product_img as $key => $value) {
                    if($value['product_pic'] == $_SESSION['product_image']){
                        array_splice($data_product_img, $key, 1);
                        $_data_product_img_insert = json_encode($data_product_img);
                        file_put_contents('assets/db/product_images.json', $_data_product_img_insert);
                        header ('Location: sell_something.php');
                    }
                }
            }
        }
        public static function sell_product_event(){
            if(isset($_REQUEST['sell_product_btn'])){
                self::sell_product_process();
            }
        }
    } Sell_Products::sell_product_event();
    class Forgot_Password extends User{
        private static function forgot_password_process(){
            include 'assets/includes/data.php';
            self::$firstname = $_REQUEST['firstname'];
            self::$middlename = $_REQUEST['middlename'];
            self::$lastname = $_REQUEST['lastname'];
            self::$phone_number = $_REQUEST['forgot_password_rescue_number'];
            $user_forgot_password = array(
                'fullname' => self::$firstname." ".self::$middlename." ".self::$lastname,
                'phone_number' => self::$phone_number
            );
            $data_forgot_password_users[] = $user_forgot_password;
            $data_forgot_password_users_insert = json_encode($data_forgot_password_users);
            if(file_put_contents('assets/db/forgot_password_users.json', $data_forgot_password_users_insert)){
                ?>
                    <div class="container">
                        <h4 class="alert alert-info success">Thank you! we will respond in a minute.</h4>
                    </div>
                <?php
            }
        }
        public static function forgot_password_event(){
            if(isset($_REQUEST['forgot_pass_btn'])){
                self::forgot_password_process();
            }
        }
    } Forgot_Password::forgot_password_event();
include 'assets/includes/bottom.php';
?>