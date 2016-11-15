<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>食堂售饭系统</title>
	<link rel="stylesheet" href="/GohanSystem/Public/css/bootstrap.min.css">
	<link rel="stylesheet" href="/GohanSystem/Public/css/bootstrap-theme.min.css">
	<script src="/GohanSystem/Public/js/jquery-3.1.1.min.js"></script>
	<script src="/GohanSystem/Public/js/bootstrap.min.js"></script>

<style>
	html,body,.content{
		height:100%
	}
</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header"><a href="/GohanSystem/index.php/Home/Student" class="navbar-brand">食堂售饭系统&nbsp;<span class="label label-info">学生版</span></a></div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="/GohanSystem/index.php/Home/Student">点菜</a></li>
					<li class="active"><a href="/GohanSystem/index.php/Home/Student/record">消费记录</a></li>
					<li><a href="/GohanSystem/index.php/Home/Student/recharge">饭卡充值</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="navbar-text">欢迎，<?php echo (session('cardnum')); ?></li>
					<li><a href="/GohanSystem/index.php/Home/Student/logout">注销</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<h1>消费记录</h1>
		<table class="table table-bordered">
			<thead>
				<th>时间</th><th>金额</th>
			</thead>
			<tbody>
				<?php if(is_array($rList)): $i = 0; $__LIST__ = $rList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($r["time"]); ?></td><td><?php echo ($r["money"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
</body>
</html>