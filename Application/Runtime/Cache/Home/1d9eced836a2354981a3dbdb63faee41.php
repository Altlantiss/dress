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

        <!-- 新增租赁 -->
        <div class="mainbox">
            <table class="main-table" id="rent-list-container">
                <tr>
                    <th>oid</th>
                    <th>
                        <input type="text" id="r-oid">
                    </th>
                </tr>
                <tr>
                    <th>用户名</th>
                    <th>
                        <input type="text" id="r-name">
                    </th>
                </tr>
                <tr>
                    <th>电话</th>
                    <th>
                        <input type="text" id="r-tel">
                    </th>
                </tr>
                <tr>
                    <th>QQ</th>
                    <th>
                        <input type="text" id="r-qq">
                    </th>
                </tr>
                <tr>
                    <th>礼服名称</th>
                    <th>
                        <input type="text" id="r-dress_name">
                    </th>
                </tr>
                <tr>
                    <th>数量</th>
                    <th>
                        <input type="number" id="r-number">
                    </th>
                </tr>
                <tr>
                    <th>计划领取日期</th>
                    <th>
                        <input type="text" id="r-dress_ma">
                    </th>
                </tr>
                <tr>
                    <th>实际领取日期</th>
                    <th>
                        <input type="text" id="r-dress_receive">
                    </th>
                </tr>
                <tr>
                    <th>计划归还日期</th>
                    <th>
                        <input type="text" id="r-plan_return">
                    </th>
                </tr>
                <tr>
                    <th>实际归还日期</th>
                    <th>
                        <input type="text" id="r-actual_return">
                    </th>
                </tr>
                <tr>
                    <th>逾期归还数量</th>
                    <th>
                        <input type="text" id="r-overdue_return">
                    </th>
                </tr>
                <tr>
                    <th>押金</th>
                    <th>
                        <input type="text" id="r-deposit">
                    </th>
                </tr>
                <tr>
                    <th>收据编号</th>
                    <th>
                        <input type="text" id="r-receipt_number">
                    </th>
                </tr>
                <tr>
                    <th>经手人</th>
                    <th>
                        <input type="text" id="r-handler">
                    </th>
                </tr>
                <tr>
                    <th>日期</th>
                    <th>
                        <input type="text" id="r-date">
                    </th>
                </tr>
                <tr>
                    <th>订单状态(1:未开始 2:进行中 3:已结束 4:逾期)</th>
                    <th>
                        <input type="text" id="r-state">
                    </th>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <span class="ctl" onclick="addRent()">增加</span>
                    </td>
                </tr>

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

  });
  function addRent() {
    $.ajax({
      type: 'post',
      url: 'http://www.dress.com/index.php/Home/Rent/add',
      dataType: 'json',
      data: {
        oid: $('#r-oid').val(),
        name: $('#r-name').val(),
        tel: $('#r-tel').val(),
        qq: $('#r-qq').val(),
        'dress_name': $('#r-dress_name').val(),
        number: $('#r-number').val(),
        dress_ma: $('#r-dress_ma').val(),
        dress_receive: $('#r-dress_receive').val(),
        plan_return: $('#r-plan_return').val(),
        actual_return: $('#r-actual_return').val(),
        overdue_return: $('#r-overdue_return').val(),
        deposit: $('#r-deposit').val(),
        receipt_number: $('#r-tereceipt_numberl').val(),
        handler: $('#r-handler').val(),
        date: $('#r-date').val(),
        state: $('#r-state').val(),
      },
      success: function(data) {
        console.log(data);
        if (data.status == 1) {
          location.href = 'http://www.dress.com/index.php/Home/index/rent';
        } else if (data.status == 0) {
          alert(data.message);
        }
      },
      error: function (xhr, err) {

      }
    })
  }

</script>

</body>
</html>