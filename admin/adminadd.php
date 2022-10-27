<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/admin.php' ?>
 <?php
    $admin = new admin();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $adminName = $_POST['adminName'];
        $adminEmail = $_POST['adminEmail'];
        $adminUser = $_POST['adminUser'];
        $adminPass = md5($_POST['adminPass']);
        if(isset($_POST['level'])){
            $level = $_POST['level'];
        }else{
            $level = 1;

        }

        $insertAdmin = $admin->insert_admin($adminName,  $adminEmail, $adminUser, $adminPass, $level);
        
    }
?> 
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm Quản Trị Viên</h2>

               <div class="block copyblock"> 
                <?php
                if(isset($insertAdmin)){
                    echo $insertAdmin;
                }
                ?> 
                 <form action="adminadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="adminName" placeholder="Nhập tên Quản trị viên..." class="medium" />
                            </td>
                        </tr><tr>
                            <td>
                                <input type="text" name="adminEmail" placeholder="Nhập email..." class="medium" />
                            </td>
                        </tr><tr>
                            <td>
                                <input type="text" name="adminUser" placeholder="Nhập tài khoản..." required class="medium" />
                            </td>
                        </tr><tr>
                            <td>
                                <input type="password" name="adminPass" placeholder="Nhập mật khẩuu..." required class="medium" />
                            </td>
                        </tr><tr>
                            <td>
                            Quyền Admin<input type="checkbox" name="level" value="0">
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Thêm" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>