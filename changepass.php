<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $newpass = $_POST['newpass'];
    $repass = $_POST['repass'];
    if($newpass==$repass){
        $id = Session::get('customer_id');
        $oldpass= $_POST['oldpass'];
        $changepass = $cs->change_pass($id, $oldpass, $newpass);
    }else{
        $changepass = "<span class='error'>Xác nhận mật khẩu không đúng</span>";
    }
}


?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Đổi mật khẩu</h3>
                </div>
                <div class="clear"></div>
            </div>
                <?php
                if(isset($changepass)){
                    echo $changepass;
                }
                ?>

            <form action="" method="Post">
                <table class="tblone">
                    <tr>
                        <td>Mật khẩu cũ</td>
                        <td>:</td>
                        <td><input class="form-control" type="password" name="oldpass" required></td>
                    </tr>
                    <tr>
                        <td>Mật khẩu mới</td>
                        <td>:</td>
                        <td><input class="form-control" type="password" name="newpass" required></td>

                    </tr>
                    <tr>
                        <td>Xác nhận mật khẩu</td>
                        <td>:</td>
                        <td><input class="form-control" type="password" name="repass" required></td>

                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" name="save">Lưu</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php
    include 'inc/footer.php';

    ?>