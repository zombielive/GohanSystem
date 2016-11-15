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
	.page{
		text-align: center;
	}
	.page span,.num,.prev,.next{
		margin:0 10px;
		font-size: 20px;
	}
	a:hover{
		text-decoration: none;
	}
</style>
<script src="/GohanSystem/Public/js/echarts.min.js"></script>
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
		<div class="page"><?php echo ($page); ?></div>
		<div id="main" style="height:500px;"></div>
	</div>
<script>
$(function(){
	var myChart = echarts.init(document.getElementById('main'));
	$.ajax({
		url:'/GohanSystem/index.php/Home/Student/draw',
		success:function(data,status){
			dataArr = data;
			option = {
				title: {
					text: '收支记录图',
				},
				tooltip : {
					trigger: 'axis',
        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
        },
        formatter: function (params) {
        	var tar;
        	if (params[1].value != '-') {
        		tar = params[1];
        	}
        	else {
        		tar = params[0];
        	}
        	return tar.name + '<br/>' + tar.seriesName + ' : ' + tar.value;
        }
    },
    legend: {
    	data:['支出','收入']
    },
    grid: {
    	left: '3%',
    	right: '4%',
    	bottom: '3%',
    	containLabel: true
    },
    xAxis: {
    	type : 'category',
    	splitLine: {show:false},
    	data :  function (){
    		var list = dataArr.list;
    		return list;
    	}()
    },
    yAxis: {
    	type : 'value'
    },
    series: [
    {
    	name: '余额',
    	type: 'bar',
    	stack: '总量',
    	itemStyle: {
    		normal: {
    			barBorderColor: 'rgba(0,0,0,0)',
    			color: 'rgba(0,0,0,0)'
    		},
    		emphasis: {
    			barBorderColor: 'rgba(0,0,0,0)',
    			color: 'rgba(0,0,0,0)'
    		}
    	},
    	data: dataArr.baseline
    },
    {
    	name: '收入',
    	type: 'bar',
    	stack: '总量',
    	label: {
    		normal: {
    			show: true,
    			position: 'top'
    		}
    	},
    	data: dataArr.up
    },
    {
    	name: '支出',
    	type: 'bar',
    	stack: '总量',
    	label: {
    		normal: {
    			show: true,
    			position: 'bottom'
    		}
    	},
    	data: dataArr.down
    }
    ]
};
myChart.setOption(option);
		}
	});
});
	
</script>
</body>
</html>