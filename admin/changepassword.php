<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $oldpw = ($_POST['oldpw']);
    $newpw = ($_POST['newpw']);
    $repw = ($_POST['repw']);
    if($newpw == $repw){
        include_once '../classes/admin.php';
        $class = new admin();
        $admin_update = $class->update_admin($oldpw,$newpw);
    }else{
        $admin_update ="<span class='error'>Xác nhận mật khẩu không đúng</span>";
    }
    
     
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thay đổi mật khẩu</h2>
        <div class="block">               
         <form action="" method="post">
            <table class="form">	
                <?php
                if(isset($admin_update)){
                    echo $admin_update;
                }?>			
                <tr>
                    <td>
                        <label>Mậy khẩu cũ</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Nhập mật khẩu cũ..." required name="oldpw" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Mật khẩu mới</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Nhập mật khẩu mới..." required name="newpw" class="medium" />
                    </td>
                </tr><tr>
                    <td>
                        <label>Xác nhận mật khẩu</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Xác nhận mật khẩu..." required name="repw" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Cập nhật" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>