<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}
Import::C('weixin/weixin');
class Ctl_Weixin_Goldegg extends Ctl_Weixin
{

    public function index($page=1)
    {
		$pager = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['page'] = $limit = 30;
        $pager['page'] = $count = 0;
        if($items = K::M('weixin/goldegg')->items(array('shop_id'=>$this->shop_id), null, $page, $limit, $count)){
            $pgaer['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->tmpl = 'merchant:weixin/goldegg/index.html';
    }

	public function create()
	{
		if($data = $this->checksubmit('data')){
            if(!$data['keyword']) {
                $this->msgbox->add('请填写关键词',210)->response();
            }else if(!$data['title']){
                $this->msgbox->add('请填写活动名称',211)->response();
            }else if(!$data['stime']) {
                $this->msgbox->add('请填写发布时间',212)->response();
            }else if(!$data['ltime']) {
                $this->msgbox->add('请填写结束时间',212)->response();
            }
            if($_FILES['data']){
				foreach($_FILES['data'] as $k=>$v){
					foreach($v as $kk=>$vv){
						$attachs[$kk][$k] = $vv;
					}
				}
				$upload = K::M('magic/upload');
				foreach($attachs as $k=>$attach){
					if($attach['error'] == UPLOAD_ERR_OK){
						if($a = $upload->upload($attach, 'weixin')){
							$data[$k] = $a['photo'];
						}
					}
				}
			}
            if($data['stime']){
                    $data['stime'] = strtotime($data['stime']);
                }
            if($data['ltime']){
                $data['ltime'] = strtotime($data['ltime']);
            }
			$data['shop_id'] = $this->shop_id;
			if(!$items = K::M('weixin/keyword')->items(array('keyword'=>$data['keyword'],'shop_id'=>$this->shop_id))){
				if($goldegg_id = K::M('weixin/goldegg')->create($data)){
					$keyword = array();
					$keyword['shop_id'] = $this->shop_id;
					$keyword['keyword'] = $data['keyword'];
					$keyword['plugin'] = 'goldegg:'.$goldegg_id;
					K::M('weixin/keyword')->create($keyword);
					$this->msgbox->add('添加内容成功');
					$this->msgbox->set_data('forward',$this->mklink('merchant/weixin/goldegg/index'));
				} 
			}else{
				$this->msgbox->add('该关键字已经被使用，请修改关键字', 212);
			}
           
        }else{
           $this->tmpl = 'merchant:weixin/goldegg/create.html';
        }
	}

	public function preview($goldegg_id=null)
	{
        $site = $this->system->config->get('site');
		$url = $site['siteurl'].'/weixin/goldegg-show-'.$goldegg_id.'.html';
		echo '<img alt="模式一扫码支付" src="/qrcode?data='.urlencode($url).'&size=13"/>';
		exit;
	}

	public function edit($goldegg_id=null)
    {
        if(!($goldegg_id = (int)$goldegg_id) && !($goldegg_id = $this->GP('goldegg_id'))){
            $this->msgbox->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('weixin/goldegg')->detail($goldegg_id)){
            $this->msgbox->add('您要修改的内容不存在或已经删除', 212);
        }else if($data = $this->checksubmit('data')){
            if(!$data['keyword']) {
                $this->msgbox->add('请填写关键词',210)->response();
            }else if(!$data['title']){
                $this->msgbox->add('请填写活动名称',211)->response();
            }else if(!$data['stime']) {
                $this->msgbox->add('请填写发布时间',212)->response();
            }else if(!$data['ltime']) {
                $this->msgbox->add('请填写结束时间',212)->response();
            }
			if($_FILES['data']){
				foreach($_FILES['data'] as $k=>$v){
					foreach($v as $kk=>$vv){
						$attachs[$kk][$k] = $vv;
					}
				}
				$upload = K::M('magic/upload');
				foreach($attachs as $k=>$attach){
					if($attach['error'] == UPLOAD_ERR_OK){
						if($a = $upload->upload($attach, 'weixin')){
							$data[$k] = $a['photo'];
						}
					}
				}
			}
            if($data['stime']){
                    $data['stime'] = strtotime($data['stime']);
                }
            if($data['ltime']){
                $data['ltime'] = strtotime($data['ltime']);
            }
            if(K::M('weixin/goldegg')->update($goldegg_id, $data)){
                $this->msgbox->add('修改内容成功');
            }  
        }else{
        	$this->pagedata['detail'] = $detail;
        	 $this->tmpl = 'merchant:weixin/goldegg/edit.html';
        }
	}

	 public function delete($goldegg_id=null)
    {
        if($goldegg_id = (int)$goldegg_id){
            if(!$detail = K::M('weixin/goldegg')->detail($goldegg_id)){
                $this->msgbox->add('你要删除的内容不存在或已经删除', 211);
            }else{
				if($items = K::M('weixin/keyword')->items(array('keyword'=>$detail['keyword'],'shop_id'=>$this->shop_id))){
					if(K::M('weixin/goldegg')->delete($goldegg_id)){
						foreach($items as $k => $v){
							K::M('weixin/keyword')->delete($v['kw_id']);
						}
						$this->msgbox->add('删除内容成功');
					}
				}else{
					$this->msgbox->add('非法操作');
				}
            }
        }
    }  

	

	public function sn($goldegg_id,$page_id)
	{
		if(!($goldegg_id = (int)$goldegg_id) && !($goldegg_id = $this->GP('goldegg_id'))){
            $this->msgbox->add('没有指定优惠券ID', 211);
        }else if(!$detail = K::M('weixin/goldegg')->detail($goldegg_id)){
            $this->msgbox->add('该优惠券不存在或已经删除', 212);
        }else{
			$filter = $pager = array();
			$pager['page'] = max(intval($page), 1);
			$pager['limit'] = $limit = 10;
			$filter['goldegg'] = $goldegg_id;
			$filter['prize'] = '<:6';
			if($items = K::M('weixin/goldeggsn')->items($filter, null, $page, $limit, $count)){
				$uids = array();
				foreach($items as $k => $v){
					$uids[$v['uid']] = $v['uid'];
				}
				$this->pagedata['member_list'] = K::M('member/member')->items_by_ids($uids);
				$pager['count'] = $count;
				$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($goldegg_id,'{page}')), array('SO'=>$SO));
			}
			$this->pagedata['items'] = $items;
			$this->pagedata['detail'] = $detail;
			$this->pagedata['pager'] = $pager;
			$this->tmpl = 'merchant:weixin/goldegg/sn.html';
		}
	} 

	
	public function sndelete($sn_id=null)
    {
        if($sn_id = (int)$sn_id){
            if(!$detail = K::M('weixin/goldeggsn')->detail($sn_id)){
                $this->msgbox->add('你要删除的内容不存在或已经删除', 211);
            }else{
                if(K::M('weixin/goldeggsn')->delete($sn_id)){
                    $this->msgbox->add('删除内容成功');
                }
            }
        }else if($ids = $this->GP('sn_id')){
            if(K::M('weixin/goldeggsn')->delete($ids)){
                $this->msgbox->add('批量删除内容成功');
            }
        }else{
            $this->msgbox->add('未指定要删除的内容ID', 401);
        }
    }  

	public function snedit($sn_id=null)
    {
		$weixin = $this->ucenter_weixin();
        if($sn_id = (int)$sn_id){
            if(!$detail = K::M('weixin/goldeggsn')->detail($sn_id)){
                $this->msgbox->add('你要修改的内容不存在或已经删除', 211);
            }else{
				if($detail['is_use'] == '1'){
					$data['is_use'] = 0;
					$data['use_time'] = '';
				}else{
					$data['is_use'] = 1;
					$data['use_time'] = __TIME;
				}
                if(K::M('weixin/goldeggsn')->update($sn_id, $data)){
                    $this->msgbox->add('改变状态成功');
                }
            }
        }
    }  

	protected function wechat_client()
    {
        static $client = null;
        if($client === null){
            if(!$client = K::M('weixin/weixin')->admin_wechat_client()){
                exit('网站公众号设置错误');
            }
        }
        return $client;
    }

    protected function access_openid($force = false)
    {
        static $openid = null;
        if($force || $openid === null){
            if($code = $this->GP('code')){
                $client = $this->wechat_client();
                $ret = $client->getAccessTokenByCode($code);
                $openid = $ret['openid'];
            }else{
                if(!$openid = $this->cookie->get('wx_openid')){
                    $client = $this->wechat_client();
                    $url = $this->request['url'].'/'.$this->request['uri'];
                    $authurl = $client->getOAuthConnectUri($url, $state, 'snsapi_userinfo');
                    header('Location:'.$authurl);
                    exit();
                }
            }
            $this->cookie->set('wx_openid', $openid);
        }
        if(empty($openid)){
            exit('获取授权失败');
        }
        return $openid;
    }
}