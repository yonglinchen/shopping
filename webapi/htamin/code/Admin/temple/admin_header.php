<?php include 'header.php'; ?>
<style>
    /*
   * Base structure
   */

    /* Move down content because we have a fixed navbar that is 50px tall */
    body {
        padding-top: 50px;
    }


    /*
     * Global add-ons
     */

    .sub-header {
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    /*
     * Top navigation
     * Hide default border to remove 1px line.
     */
    .navbar-fixed-top {
        border: 0;
    }

    /*
     * Sidebar
     */

    /* Hide for mobile, show later */
    .sidebar {
        display: none;
    }
    @media (min-width: 768px) {
        .sidebar {
            position: fixed;
            top: 51px;
            bottom: 0;
            left: 0;
            z-index: 1000;
            display: block;
            padding: 20px;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
            background-color: #f5f5f5;
            border-right: 1px solid #eee;
        }
    }

    /* Sidebar navigation */
    .nav-sidebar {
        margin-right: -21px; /* 20px padding + 1px border */
        margin-bottom: 20px;
        margin-left: -20px;
    }
    .nav-sidebar > li > a {
        padding-right: 20px;
        padding-left: 20px;
    }
    .nav-sidebar > .active > a,
    .nav-sidebar > .active > a:hover,
    .nav-sidebar > .active > a:focus {
        color: #fff;
        background-color: #428bca;
    }


    /*
     * Main content
     */

    .main {
        padding: 20px;
    }
    @media (min-width: 768px) {
        .main {
            padding-right: 40px;
            padding-left: 40px;
        }
    }
    .main .page-header {
        margin-top: 0;
    }


    /*
     * Placeholder dashboard ideas
     */

    .placeholders {
        margin-bottom: 30px;
        text-align: center;
    }
    .placeholders h4 {
        margin-bottom: 0;
    }
    .placeholder {
        margin-bottom: 20px;
    }
    .placeholder img {
        display: inline-block;
        border-radius: 50%;
    }
    .user-menu {
        border-color: #ddd;
        background-color: #fff;
    }
    .user-menu {
        position: absolute;
        top: 37px;
        right: -21px;
        width: 140px;
        border: 1px solid #ddd;
        background-color: #fff;height: 40px;display: none;
    }
    ul{list-style: none;}
    #userimg{position: absolute;top:15px;right:30px;width:20px;height: 20px;background: url(../source/img/bg_icon.png) no-repeat -150px 0;}
</style>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">骑士团管理后台</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><div id="userimg" >
                        <ul class="nav-list user-menu">
                            <li style=" line-height: 40px;"><a href="../login/login.php">退出</a></li>
                        </ul>
                    </div></li>

            </ul>

        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li <?php if( $_SESSION['menu']=="userManage"){echo " class='active'";} ?> ><a href="../user/userManage.php">用户管理 </a>
                </li>
                <li <?php if( $_SESSION['menu']=="roleManage"){echo " class='active'";} ?> ><a href="../role/roleManage.php">角色管理</a></li>
                <li><a href="#">权限管理</a></li>
                <li ><a href="#">商品管理</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<script>
    $(function () {
        $("#userimg").click(function () {
            $(".user-menu").toggle();
        });
    });
</script>