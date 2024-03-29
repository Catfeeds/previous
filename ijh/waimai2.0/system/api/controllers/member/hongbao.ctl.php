<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}
class Ctl_Member_Hongbao extends Ctl
{

    public function index($params)
    {
        $this->items($params);
    }
	
	public function info_link(){
		$cfg = $this->system->config->get('attach');

		//各种链接返回
		$link=$this->mklink('ucenter/hongbao/info/',null,null,'www');
		$this->msgbox->set_data('data', array('link'=>$link));
	}

    public function items($params)
    { //status 0:全部，1:可用,2:不可用;
        $this->check_login();
        $filter = array();
        if(!$params['status']){
            $params['status'] = 0;
        }
        if(in_array($params['status'], array(0,1,2))){
            if($params['status'] == 1){ //未使用
                $filter['order_id'] = 0;
                $filter['ltime'] = '>=:'.time();
            }else if($params['status'] == 2){ //已使用或过期
                 $filter[':OR'] = array('order_id'=>'>:0','ltime'=>'<:'.time());
            }
        }
        if($params['price']){
            $filter['min_amount'] = '<=:'.$params['price'];
        }

        $filter['uid'] = $this->uid;
        $page = max((int)$params['page'], 1);
        if(($page <= 100) && $items = K::M('hongbao/hongbao')->items($filter, array('hongbao_id'=>'desc'), 1, $limit,$count)){
            foreach($items as $k=>$v){
                $items[$k] = $this->filter_fields('hongbao_id,title,min_amount,amount,uid,ltime,order_id,used_time,from', $v);
            }
            $items = array_slice($items, ($page-1)*10, 10, true);
        }else{
            $items = array();
        }
        $this->msgbox->add('success');
        $this->msgbox->set_data('data', array('items'=>array_values($items),'total_count'=>$count,'sql'=>$this->system->db->SQLLOG()));
    }


    public function exchange($params)
    {
        $this->check_login();
        K::M('system/logs')->log("api_hongbao", $params);
        if(!$sn = $params['sn']){
            $this->msgbox->add(L('兑换码不能为空'),202);
        }else if(!$result = K::M('hongbao/hongbao')->find(array('hongbao_sn'=>$sn,'ltime'=>'>:'.time()))){
            $this->msgbox->add(L('兑换码不存在或红包已过期'),203);
        }else if($result['uid']>0){
            K::M('system/logs')->log("api_hongbao", $result);
            $this->msgbox->add(L('该兑换码已被兑换'),204);
        }else if($result['order_id']>0){
            $this->msgbox->add(L('该兑换码已使用过'),205);
        }else{
            if(K::M('hongbao/hongbao')->update($result['hongbao_id'],array('uid'=>$this->uid))){
                $this->msgbox->add('success');
            }
        }

    }

}
