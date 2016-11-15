<?php
namespace Home\Controller;
use Think\Controller;
class StudentController extends Controller {
	public function index()
    {
        if(session('group')==2){
        	$Tfood = M('food');
            $foodList = $Tfood->order('id desc')->select();
            $this->assign('fList',$foodList);
            $this->display();
        }else{
            $this->redirect('Index/index');
        }
    }
	public function logout(){
        session('[destroy]');
        $this->redirect('Index/index');
    }
    public function pay(){
    	$amount = I('post.amount');
    	$cardnum = session('cardnum');
    	$user = M('user');
    	$record = M('record');
    	$afterPay = $user->where('cardnum='.$cardnum)->getField('rest') - $amount;
    	if($afterPay < 0){
    		$this->error('余额不足');
    	}else{
    		$dataU['rest'] = $afterPay;
    		$user->where('cardnum='.$cardnum)->save($dataU);
    		$dataR['uid'] = session('id');
    		$dataR['money'] = -$amount;
    		$dataR['rest'] = $afterPay;
    		$dataR['time'] = date('Y-m-d H:i:s',time());
    		$record->add($dataR);
    		$this->success('付款成功');

    	}
    }
    public function recharge(){
    	$rest = M('user')->where('cardnum='.session('cardnum'))->getField('rest');
    	$this->assign('rest',$rest);
    	$this->display();
    }
    public function moneyup(){
    	$money = I('post.money');
    	$user = M('user');
    	$record = M('record');
    	$cardnum = session('cardnum');
    	$Up = $user->where('cardnum='.$cardnum)->getField('rest') + $money;
    	$dataU['rest'] = $Up;
		$user->where('cardnum='.$cardnum)->save($dataU);
		$dataR['uid'] = session('id');
		$dataR['money'] = $money;
		$dataR['rest'] = $Up;
		$dataR['time'] = date('Y-m-d H:i:s',time());
		$record->add($dataR);
		$this->success('充值成功');
    }
    public function record(){
    	$record = M('record');
    	$mapR['uid'] = session('id');
    	$count = $record->where($mapR)->count();
        $Page = new \Think\Page($count,5);
        $show = $Page->show();
    	$rList = $record->where($mapR)->order('time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('page',$show);
    	$this->assign('rList',$rList);
    	$this->display();
    }
    public function draw(){
    	$record = M('record');
    	$mapR['uid'] = session('id');
    	$rList = $record->where($mapR)->order('time')->select();
    	$dataArr = [];
    	for ($i=0; $i < count($rList); $i++) { 
    		$dataArr['list'][$i] = $rList[$i]['time'];
    		if($rList[$i]['money'] > 0){
    			$dataArr['up'][$i] = $rList[$i]['money'];
    			$dataArr['down'][$i] = '-';
    			$dataArr['baseline'][$i] = $rList[$i-1]['rest']?$rList[$i-1]['rest']:0;
    		}else{
    			$dataArr['up'][$i] = '-';
    			$dataArr['down'][$i] = -$rList[$i]['money'];
    			$dataArr['baseline'][$i] = $rList[$i]['rest'];
    		}
    	}
    	$this->ajaxReturn($dataArr);
    }








}