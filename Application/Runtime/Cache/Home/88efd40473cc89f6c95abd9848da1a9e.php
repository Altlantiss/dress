<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link href="/Public/index_files/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/index_files/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="/Public/index_files/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/Public/index_files/jquery.gritter.css" rel="stylesheet">

    <link href="/Public/index_files/animate.css" rel="stylesheet">
    <link href="/Public/index_files/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/css/global.css">
    <link rel="stylesheet" href="/Public/css/userlist.css">

    <!--模板引擎-->
    <script src="/Public/js/template.js"></script>

    <style type="text/css">
        .jqstooltip {
            position: absolute;
            left: 0px;
            top: 0px;
            visibility: hidden;
            background: rgb(0, 0, 0) transparent;
            background-color: rgba(0, 0, 0, 0.6);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
            -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
            color: white;
            font: 10px arial, san serif;
            text-align: left;
            white-space: nowrap;
            padding: 5px;
            border: 1px solid white;
            z-index: 10000;
        }

        .jqsfield {
            color: white;
            font: 10px arial, san serif;
            text-align: left;
        }
    </style>
</head>

<body class="pace-done">
<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99"
         style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>
<div id="wrapper">
    <!-- 引入侧边菜单 -->
    <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"><span> <img alt="image" class="img-circle"
                                                                  src="/Public/index_files/profile_small.jpg"> </span> <a
                        data-toggle="dropdown" class="dropdown-toggle" href="http://121.43.176.181:81/index/index#">
                        <span class="clear"> <span class="block m-t-xs"> <strong
                                class="font-bold"></strong> </span> <span class="text-muted text-xs block"><b
                                class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">个人信息</a></li>
                        <li><a href="#">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a onclick="logout()">退出登录</a></li>
                    </ul>
                </div>
                <div class="logo-element"><img src="/Public/index_files/logoS.png"></div>
            </li>


            <li class=""><a href="#">
                <span class="nav-label">会员管理</span>
            </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/index.php/Home/Index/home">会员信息</a></li>
                    <li><a href="/index.php/Home/Index/adduser">增加会员</a></li>
                </ul>
            </li>
            <li class=""><a href="#">
                <span class="nav-label">存储情况</span>
            </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/index.php/Home/Index/storage">存储详情</a></li>
                </ul>
            </li>
            <li class=""><a href="#">
                <span class="nav-label">进货情况</span>
            </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/index.php/Home/Index/purchaselist">礼服展示</a></li>
                    <!--<li><a href="#">礼服新增</a></li>-->
                </ul>
            </li>
            <li class=""><a href="#">
                <span class="nav-label">礼服租赁</span>
            </a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="/index.php/Home/Index/rent">查看租赁</a></li>
                    <li><a href="/index.php/Home/Index/addrent">添加租赁</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

    <div id="page-wrapper" class="gray-bg dashbard-1" style="min-height: 371px;">
        <div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <div class="pagetitle">礼服管理系统</div>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li><span class="m-r-sm text-muted welcome-message">欢迎</span></li>
            <li><a onclick="logout()"> 退出 </a></li>
        </ul>
    </nav>
</div>

<script>
function logout() {
  location.href = 'http://www.dress.com/index.php/Home/Index/index';
}
</script>

        <!-- 修改会员 -->
        <div class="mainbox">
            <table class="main-table" id="edit-user-container">
                <script id="edit-user" type="text/html">
                <tr>
                    <th>id</th>
                    <th>用户名</th>
                    <th>电话</th>
                    <th>QQ</th>
                    <th>总消费金额</th>
                    <th>总积分</th>
                    <th>剩余积分</th>
                    <th>会员卡号</th>
                    <th>折扣</th>
                    <th>操作</th>
                </tr>

                <tr>
                    <td>{{data.id}}</td>
                    <td>
                        <input type="text" class="edit" id="up-name" value="{{data.name}}">
                    </td>
                    <td>
                        <input type="text" class="edit" id="up-tel" value="{{data.tel}}">
                    </td>
                    <td>
                        <input type="text" class="edit" id="up-qq" value="{{data.qq}}">
                    </td>
                    <td>
                        <input type="text" class="edit" id="up-total_consumption" value="{{data.total_consumption}}">
                    </td>
                    <td>
                        <input type="text" class="edit" id="up-total_integral" value="{{data.total_integral}}">
                    </td>
                    <td>
                        <input type="text" class="edit" id="up-esidual_integral" value="{{data.esidual_integral}}">
                    </td>
                    <td>
                        <input type="text" class="edit" id="up-card_number" value="{{data.card_number}}">
                    </td>
                    <td>
                        <input type="text" class="edit" id="up-discount" value="{{data.discount}}">
                    </td>
                    <td>
                        <span class="ctl ctl-edit" onclick="editUser({{data.id}})">保存修改</span>
                    </td>
                </tr>
                </script>
            </table>
        </div>

        <!-- 引入底部 -->
        <div class="footer">
    <div class="pull-right">
        <strong>XXX</strong> 版权所有 © 2017
    </div>
</div>
    </div>
</div>



<!-- Mainly scripts -->
<script src="/Public/index_files/jquery-2.1.1.js"></script>
<script src="/Public/index_files/bootstrap.min.js"></script>
<script src="/Public/index_files/jquery.metisMenu.js"></script>
<script src="/Public/index_files/jquery.slimscroll.min.js"></script>

<!-- Flot -->
<script src="/Public/index_files/jquery.flot.js"></script>
<script src="/Public/index_files/jquery.flot.tooltip.min.js"></script>
<script src="/Public/index_files/jquery.flot.spline.js"></script>
<script src="/Public/index_files/jquery.flot.resize.js"></script>
<script src="/Public/index_files/jquery.flot.pie.js"></script>

<!-- Peity -->
<script src="/Public/index_files/jquery.peity.min.js"></script>
<script src="/Public/index_files/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="/Public/index_files/inspinia.js"></script>
<script src="/Public/index_files/pace.min.js"></script>

<!-- jQuery UI -->
<script src="/Public/index_files/jquery-ui.min.js"></script>

<!-- GITTER -->
<script src="/Public/index_files/jquery.gritter.min.js"></script>

<!-- EayPIE -->
<script src="/Public/index_files/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="/Public/index_files/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="/Public/index_files/sparkline-demo.js"></script>

<!-- ChartJS-->
<script src="/Public/index_files/Chart.min.js"></script>
<script type="text/javascript">
  $(function () {
    var query = location.search.slice(1);
    var id = query.split('=')[1];
    getUser(id);
  });
  function getUser(id) {
    $.ajax({
      type: 'get',
      url: 'http://www.dress.com/index.php/Home/User/selectId?id=' + id,
      dataType: 'json',
      success: function(data) {
        console.log(data);
        var userInfo = template('edit-user', {
          data: data.data
        });
        $('#edit-user-container').html(userInfo);
      },
      error: function (xhr, err) {

      }
    })
  }

  function editUser(id) {
    $.ajax({
      type: 'post',
      url: 'http://www.dress.com/index.php/Home/User/update',
      dataType: 'json',
      data: {
        id: id,
        name: $('#up-name').val(),
        tel: $('#up-tel').val(),
        qq: $('#up-qq').val(),
        total_consumption: $('#up-total_consumption').val(),
        total_integral: $('#up-total_integral').val(),
        esidual_integral: $('#up-esidual_integral').val(),
        discount: $('#up-discount').val()
      },
      success: function (data) {
        console.log(data);
        if (data.status == 1) {
          location.href = 'http://www.dress.com/index.php/Home/Index/home';
        } else {
          console.error('修改失败');
        }
      },
      error: function (xhr, err) {

      }
    })
  }

</script>

</body>
</html>