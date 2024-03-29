<?php

/*
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 */

class WeixinhelpAction extends CommonAction 
{
	//砸金蛋
    public function index($page=1)
    {
		$obj = M('weixin_help');
		import('ORG.Util.Page'); // 导入分页类
		$map = array();
		$map['shop_id'] = array('in',D('Shop')->getCityShop($this->_fenzhan['city_id']));
		$count = $obj->where($map)->count();
		$Page = new Page($count, 15); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
		$list = $obj->where($map)->order(array('help_id' => 'desc'))->limit($Page->firstRow . ',' . $Page->listRows)->select();
		foreach($list as $k=>$v){
		    $shop = D('Shop')->find($v['shop_id']);
		    $list[$k]['shop_name'] = $shop['shop_name'];
		}
		$this->assign('list', $list);
		$this->assign('page', $show); // 赋值分页输出
        $this->display(); // 输出模板
    }
	
    public function detail($id = 0) {
        if ($id = (int) $id) {
            $obj = D('Weixin_help');
            if (!$detail = $obj->find($id)) {
                $this->baoError('内容不存在或已删除');
            }
            $shop = D('Shop')->find($detail['shop_id']);
            if ($shop['city_id'] != $this->_fenzhan['city_id']) {
                $this->baoError('商家不属于当前城市');
            }
            $detail['shop_name'] = $shop['shop_name'];
            $this->assign('detail', $detail);
            $this->display();
        }
    }
    
	public function delete($id=null)
    {
		$obj = M('weixin_help');
        if($id = (int)$id){
			if(!$detail = $obj->find($id)){
				$this->baoError('你要删除的内容不存在');
			}else{
			    $shop = D('Shop')->find($detail['shop_id']);
                if ($shop['city_id'] != $this->_fenzhan['city_id']) {
                    $this->baoError('商家不属于当前城市');
                }
			    if($obj->delete($id)){
			        $this->baoSuccess('删除成功！',U('weixinscratch/index'));
			    }   
			}
        }
    } 

}   
