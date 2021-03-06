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
					<li><a href="/GohanSystem/index.php/Home/Student/record">消费记录</a></li>
					<li class="active"><a href="/GohanSystem/index.php/Home/Student/recharge">饭卡充值</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="navbar-text">欢迎，<?php echo (session('cardnum')); ?></li>
					<li><a href="/GohanSystem/index.php/Home/Student/logout">注销</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="col-sm-8 col-sm-offset-2">
			<h1>饭卡充值</h1>
			<h2>余额：<?php echo ($rest); ?></h2>
			<label><h3>充值金额</h3></label>
			<div class="input-group">
				<div class="input-group-addon">￥</div>
				<input class="form-control" type="number" id="money">
			</div>
			<br>
			<button class="btn btn-primary" id="saveBtn">充值</button>
		</div>
	</div>
<script type="text/javascript">
	$(function(){
		var lock = 1;
		$('#saveBtn').click(function(){
			if(lock == 1){
			lock = 0;
			var money = $('#money').val();
			if(money == 0){
				alert('金额不能为0');
				lock = 1;
				return;
			}
			$.ajax({
				url:'/GohanSystem/index.php/Home/Student/moneyup',
				type:'POST',
				data:{money:money},
				success:function(data,status){
					if(data.status == 0){
						alert(data.info);
						lock = 1;
					}else{
						alert(data.info);
						lock = 1;
						window.location.href = '/GohanSystem/index.php/Home/Student/record';
					}
				}
			});
			}
		});
	});
</script>
</body>
</html>