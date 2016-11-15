<?php
namespace Home\Controller;
use Think\Controller;
class TeacherController extends Controller {
	public function index()
    {
        if(session('group')==1){
            $Tfood = M('food');
            $count = $Tfood->count();
            $Page = new \Think\Page($count,20);
            $show = $Page->show();
            $foodList = $Tfood->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('fList',$foodList);
            $this->assign('page',$show);
            $this->display();
        }else{
            $this->redirect('Index/index');
        }
    }
    public function logout(){
        session('[destroy]');
        $this->redirect('Index/index');
    }
    public function addfood(){
        $this->display();
    }
    public function insertfood(){
        $name = I('post.name');
        $price = I('post.price');
        $Tfood = M('food');
        $dataF['name'] = $name;
        $dataF['price'] = round($price,2);
        $Tfood->add($dataF);
        $this->success('新增成功');
    }
    public function delfood(){
        $Tfood = M('food');
        $id = I('post.id');
        $Fmap['id'] = array('in',$id);
        $Tfood->where($Fmap)->delete();
    }
    public function editfood(){
        $Tfood = M('food');
        $eid = I('get.id');
        $mapF['id'] = $eid;
        $name = $Tfood->where($mapF)->getField('name');
        $price = $Tfood->where($mapF)->getField('price');
        $this->assign('name',$name);
        $this->assign('price',$price);
        $this->display();
    }
    public function updatefood(){
        $Tfood = M('food');
        $id = I('post.id');
        $name = I('post.name');
        $price = I('post.price');
        $mapF['id'] = $id;
        $dataF['name'] = $name;
        $dataF['price'] = round($price,2);
        $Tfood->where($mapF)->save($dataF);
        $this->success('修改成功');
    }







}