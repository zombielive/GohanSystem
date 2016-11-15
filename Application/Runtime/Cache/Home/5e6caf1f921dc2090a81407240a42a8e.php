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
					<li class="active"><a href="/GohanSystem/index.php/Home/Student">点菜</a></li>
					<li><a href="/GohanSystem/index.php/Home/Student/record">消费记录</a></li>
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
		<table class="table table-bordered">
			<thead>
				<th>菜品名称</th><th>单价</th><th>数量</th>
			</thead>
			<tbody>
				<form id="fform">
				<?php if(is_array($fList)): $i = 0; $__LIST__ = $fList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?><tr class="foodLine">
					<td><?php echo ($f["name"]); ?></td><td class="priceTd"><?php echo ($f["price"]); ?></td><td class="col-sm-2"><input type="number" class="form-control input-sm numInput" value="0"></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</form>
			</tbody>
		</table>
		<p>总价： <span id="amount"></span></p>
		<button class="btn btn-info" id="payBtn">付款</button>
	</div>
<script type="text/javascript">
$(function () {
	calculate();
	$('.numInput').bind('input',function(){
		calculate();
	});
	function calculate(){
		var amount = 0;
		var foodLine = $('.foodLine');
		var priceTd = $('.priceTd');
		var numInput = $('.numInput');
		for (var i = 0; i < foodLine.length; i++) {
			amount += $(priceTd[i]).text() * $(numInput[i]).val();
		}
		$('#amount').text(Math.round(amount*100)/100);
	}
	var lock = 1;
	$('#payBtn').click(function(){
		if(lock == 1){
			lock = 0;
			var amount = $('#amount').text();
			if(amount == 0){
				alert('请选择菜品');
				lock = 1;
				return;
			}
			$.ajax({
				url:'/GohanSystem/index.php/Home/Student/pay',
				type:'POST',
				data:{amount:amount},
				success:function(data,status){
					if(data.status == 0){
						alert(data.info);
						lock = 1;
					}else{
						alert(data.info);
						window.location.href = '/GohanSystem/index.php/Home/Student';
					}
				}
			});
		}
	});
})
</script>
</body>
</html>