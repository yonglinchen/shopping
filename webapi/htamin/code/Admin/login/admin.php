<?php
session_start();
if (isset($_SESSION['userid'])) {
    
} else {
    //未登录跳转至登录页
    header("Location:login.php");
}
include '../temple/admin_header.php';
?>
  <h1 class="page-header">
                用户管理<button class="btn btn-primary addnew" type="submit" style=" float: right;margin-right: 0px;">添加用户</button>
            </h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>用户ID</th>
                            <th>登录名</th>
                            <th>密码</th>
                            <th>角色</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>admin</td>
                            <td>123456</td>
                            <td>系统管理员</td>
                            <td><a href="#">修改</a>
                                <a href="#">删除</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>lbh</td>
                            <td>lbh</td>
                            <td>业务管理员</td>
                            <td><a href="#">修改</a>
                                <a href="#">删除</a></td>
                        </tr>

                    </tbody>
                </table>
            </div>
<?php include '../temple/footer.php'; ?>