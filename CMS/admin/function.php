<!-- @import jquery & sweet alert  -->
<script src="assets/js/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
    session_start();
    //Connection to DB
    function connection_db() {
        $con = new mysqli('localhost','root','','cms');
        return $con;
    }

    //Move File Upload
    function upload_file($file) {
        $file_name   = rand(1,999).'-'.$_FILES[$file]['name'];
        $file_source = $_FILES[$file]['tmp_name'];
        $path = 'assets/image/' . $file_name;
        move_uploaded_file($file_source, $path);
        return $file_name;
    }

    //Register User
    function register() {
        if(isset($_POST['btn_register'])) {

            $name       = $_POST['name'];
            $email      = $_POST['email'];
            $password   = md5($_POST['password']);
            $profile    = upload_file('profile');
            $created_at = date('Y-m-d H:i:s');

            $sql = " INSERT INTO `tbl_user`(`name`, `email`, `password`, `profile`, `created_at`) 
                    VALUES ('$name', '$email', '$password', '$profile', '$created_at') ";
            $rs = connection_db()->query($sql);
            if($rs == true) {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Your account have been create",
                                icon: "success",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
            else {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Ohh Error!",
                                text: "Something went wrong",
                                icon: "warning",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
        }
    }   
    register();
    
    //Login User
    function login() {
        if(isset($_POST['btn_login'])) {

            $name_email = $_POST['name_email'];
            $password = md5($_POST['password']);
            $sql = " SELECT * FROM `tbl_user` WHERE (name = '$name_email' OR email = '$name_email') AND password = '$password' ";
            $rs = connection_db()->query($sql);
            $row = mysqli_fetch_assoc($rs);
            if(!empty($row)){
                $user_id = $row['id'];
                $_SESSION['id'] = $user_id;
                header('Location: index.php');
            }
            else {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Invalid User!",
                                text: "Something went wrong",
                                icon: "warning",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
        }
    }
    login();

    //logout user
    function logout(){
        if(isset($_POST['accept'])){
            unset($_SESSION['user']);
            header('location: login.php');
        }
    }
    if(isset($_POST['cancel'])){
        header('location: index.php');
    }
    logout();

    //Get User Profile
    function get_user_profile($user_id) {
        $sql = " SELECT * FROM `tbl_user` WHERE `id` = $user_id ";
        $rs = connection_db()->query($sql);
        $row = mysqli_fetch_assoc($rs);
        echo '
            <img src="assets/image/'.$row['profile'].'" style="width:40px ;height:40px ;object-fit: cover;" >
            <h6>Welcome Admin '.$row['name'].'</h6>
        ';
    }


    //Add website Logo
    function add_website_logo() {
        if(isset($_POST['add_website_logo'])) {
            $type = $_POST['type'];
            $thumbnail = upload_file('thumbnail');
            $created_at = date('Y-m-d H:i:s');

            $sql = " INSERT INTO `tbl_website_logo`(`thumbnail`, `status`, `created_at`) 
                    VALUES ('$thumbnail', '$type', '$created_at') ";
            $rs  = connection_db()->query($sql);
            if($rs == true) {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Post Created",
                                icon: "success",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
            else {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Ohh Error!",
                                text: "Something went wrong",
                                icon: "warning",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }

        }
    }
    add_website_logo();

    //View website Logo
    function view_website_logo() {
        $sql = " SELECT * FROM `tbl_website_logo` ORDER BY id DESC ";
        $rs  = connection_db()->query($sql);
        while($row = mysqli_fetch_assoc($rs)) {
            echo '
                <tr>
                    <td><img src="assets/image/'.$row['thumbnail'].'"/></td>
                    <td>'.$row['status'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td width="150px">
                        <a href="website-logo-update-post.php?id='.$row['id'].'"class="btn btn-primary">Update</a>
                        <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Remove
                        </button>
                    </td>
                </tr>
            ';
        }
    }

    //Update website Logo
    function update_website_logo() {
        if(isset($_POST['update_website_logo'])) {
            $id = $_POST['id'];
            $type = $_POST['type'];
            $old_thumbnail = $_POST['old_thumbnail'];

            if(!empty($_FILES['thumbnail']['name'])) {
                $thumbnail = upload_file('thumbnail');
            }
            else {
                $thumbnail = $old_thumbnail;
            }

            $sql = " UPDATE `tbl_website_logo` SET `thumbnail`='$thumbnail',`status`='$type' WHERE id = $id ";
            $rs  = connection_db()->query($sql);
            if($rs == true) {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Post Updated",
                                icon: "success",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
            else {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Ohh Error!",
                                text: "Something went wrong",
                                icon: "warning",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
            
        }
    }
    update_website_logo();

    //Remove website Logo
    function remove_website_logo() {
        if(isset($_POST['remove_website_logo'])) {
            $id = $_POST['remove_id'];
            $sql = " DELETE FROM `tbl_website_logo` WHERE id = $id ";
            $rs  = connection_db()->query($sql);
            if($rs == true) {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Post Removed",
                                icon: "success",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
            else {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Ohh Error!",
                                text: "Something went wrong",
                                icon: "warning",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }

        }
    }
    remove_website_logo();

    //Add News Post
    function add_news() {
        if(isset($_POST['btn_add_news'])) {
            $title       = $_POST['title'];
            $news_type   = $_POST['news_type'];
            $category    = $_POST['category'];
            $thumbnail   = upload_file('thumbnail');
            $description = $_POST['description'];
            $author      = $_SESSION['id'];
            $created_at  = date('Y-m-d H:i:s');
            
            $sql = "INSERT INTO `tbl_news`(`title`, `thumbnail`, `news_type`, `category`, `description`, `viewer`, `author`, `created_at`)
             VALUES ('$title','$thumbnail','$news_type','$category','$description','0','$author','$created_at') ";
            $rs = connection_db()->query($sql);
            if ($rs == true) {
                echo '
                    <script>    
                         $(document).ready(function(){
                             swal({
                                 title: "Success",
                                 text: "Post Inserted",
                                 icon: "success",
                                 button: "Okay",
                             });
                         });
                    </script>
                ';
            }
            else {
                echo '
                    <script>    
                         $(document).ready(function(){
                             swal({
                                 title: "Ohh Error!",
                                 text: "Something went wrong",
                                 icon: "warning",
                                 button: "Okay",
                             });
                         });
                    </script>
                ';
                    
            }
        }
    }
    add_news();

    //Views News 
    function view_news() {
        $sql = " SELECT news.*, user.name FROM tbl_news news JOIN tbl_user user ON news.author = user.id ORDER BY news.id DESC ";
        $rs  = connection_db()->query($sql);
        while($row = mysqli_fetch_assoc($rs)) {
            echo '
            <tr>
                <td width="400px">'.$row['title'].'</td>
                <td>'.$row['news_type'].'</td>
                <td>'.$row['category'].'</td>
                <td><img src="assets/image/'.$row['thumbnail'].'" width="100px"></td>
                <td>'.$row['viewer'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['created_at'].'</td>
                <td width="150px">
                    <a href="news-update-post.php?id='.$row['id'].'"class="btn btn-primary">Update</a>
                    <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
                </td>
            </tr>
            ';
        }
    }

    //Preview before update
    function preview_before_update($id) {
        $sql = " SELECT * FROM `tbl_news` WHERE id = $id ";
        $rs  = connection_db()->query($sql);
        $row = mysqli_fetch_assoc($rs);
        return $row;
    }

    //Update News Post
    function update_news() {
        if(isset($_POST['btn_update_news'])) {
            $id            = $_POST['id'];
            $old_thumbnail = $_POST['old_thumbnail'];
            $title         = $_POST['title'];
            $news_type     = $_POST['news_type'];
            $category      = $_POST['category'];
            $description   = $_POST['description'];

            if(!empty($_FILES['thumbnail']['name']))
                $thumbnail = upload_file('thumbnail');
            else 
                $thumbnail = $old_thumbnail;

            $sql = " UPDATE `tbl_news` SET `title`='$title',`thumbnail`='$thumbnail',`news_type`='$news_type',`category`='$category',`description`='$description' WHERE id = $id ";
            $rs = connection_db()->query($sql);
            if($rs == true) {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Post Updated",
                                icon: "success",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
            else {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Ohh Error!",
                                text: "Something went wrong",
                                icon: "warning",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
        }
    }
    update_news();

    //Remove News Post
    function remove_news_post() {
        if(isset($_POST['btn_remove_news'])) {
            $id  = $_POST['remove_id'];
            $sql = " DELETE FROM `tbl_news` WHERE id = $id ";
            $rs  = connection_db()->query($sql);
            if($rs == true) {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Success",
                                text: "Post Remove",
                                icon: "success",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
            else {
                echo '
                    <script>    
                        $(document).ready(function(){
                            swal({
                                title: "Ohh Error!",
                                text: "Something went wrong",
                                icon: "warning",
                                button: "Okay",
                            });
                        });
                    </script>
                ';
            }
        }
    }
    remove_news_post();