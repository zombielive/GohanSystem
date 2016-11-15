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
	textarea{
		resize: none;
	}
	#onemore{
		margin: 20px 0;
	}
	.input-group{
		margin-bottom: 20px;
	}
	.star{
		cursor: pointer;
	}
	#msg{
		display: none;
	}
</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header"><a href="/GohanSystem/index.php/Home/Teacher" class="navbar-brand">食堂售饭系统&nbsp;<span class="label label-primary">管理员版</span></a></div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="/GohanSystem/index.php/Home/Teacher">管理菜品</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/GohanSystem/index.php/Home/Teacher/logout">注销</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="col-sm-8 col-sm-offset-2">
			<h1>新增菜品</h1>
			<label><h3>菜品名称</h3></label>
			<input type="text" class="form-control" id="nameInput">
			<label><h3>单价</h3></label>
			<input type="number" class="form-control" id="priceInput">
			<br>
			<div class="alert alert-danger" role="alert" id="msg"></div>
			<button class="btn btn-primary" id="saveBtn">保存</button>
			<a class="btn btn-default" href="/GohanSystem/index.php/Home/Teacher">取消</a>
		</div>
	</div>
<script type="text/javascript">
	$(function(){
		var lock = 1;
		$('#saveBtn').click(function(){
			if(lock == 1){
				lock = 0;
				var name = $('#nameInput').val();
				if(!name.length){msgout('名称不能为空');lock = 1;return;}
				var price = $('#priceInput').val();
				if(!price.length){msgout('单价不能为空');lock = 1;return;}
				$.ajax({
					url:"/GohanSystem/index.php/Home/Teacher/insertfood",
					type:"POST",
					data:{name:name,price:price},
					success:function(data,status){
						lock = 1;
						if(data.status == 0){
							msgout(data.info);
						}else if(data.status == 1){
							window.location.href = '/GohanSystem/index.php/Home/Teacher';
						}
					}
				});
			}
		});
		function msgout(text){
			$('#msg').text(text).show();
				setTimeout(function(){
					$('#msg').hide();
				},2000);
		}







	});
</script>
</body>
</html>