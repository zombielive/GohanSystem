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
	.content{
		display: flex;
		justify-content: center;
		align-items: center;
	}
	#msg{
		display: none;
	}
</style>
</head>
<body>
	<div class="content">
		<div class="form-group">
			<h1>食堂售饭系统登录</h1>
			<form>
				<label for="nameInput">卡号</label><input type="text" name="cardnum" class="form-control">
				<label for="pswInput">密码</label><input type="password" name="psw" class="form-control">
				<label>身份</label><br>
				<div class="row">
				<label class="col-sm-6"><input type="radio" name="group" checked="checked" value="2">学生</label>
				<label class="col-sm-6"><input type="radio" name="group" value="1">管理员</label>
				</div>
				<div class="alert alert-danger" role="alert" id="msg"></div>
				<button type="button" class="btn btn-primary" id="loginBtn">登录</button>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
			var lock = 1;
			$('#loginBtn').click(function(){
				if(lock==1){
					lock = 0;
					$.ajax({
						url:"/GohanSystem/index.php/Home/Index/login",
						type:"POST",
						data:$('form').serialize(),
						success:function(data,status){
							lock = 1;
							if(data.status){
								if(data.group==1){
									window.location.href = '/GohanSystem/index.php/Home/Teacher';
								}else if(data.group==2){
									window.location.href = '/GohanSystem/index.php/Home/Student';
								}
							}else{
								$('#msg').text(data.msg).show();
							}
						}
					});
				}
			});




		});
	</script>
</body>
</html>