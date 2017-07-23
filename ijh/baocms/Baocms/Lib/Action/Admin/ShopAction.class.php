<?php

/*
 * 软件为合肥生活宝网络公司出品，未经授权许可不得使用！
 * 作者：baocms团队
 * 官网：www.baocms.com
 * 邮件: youge@baocms.com  QQ 800026911
 */

class ShopAction extends CommonAction {

    private $create_fields = array('user_id', 'cate_id','city_id', 'area_id', 'business_id', 'shop_name', 'logo', 'mobile', 'photo', 'addr', 'tel', 'extension', 'contact', 'tags', 'near', 'is_pei', 'business_time','delivery_time', 'orderby', 'lng', 'lat', 'price');
    private $edit_fields = array('user_id', 'cate_id','city_id', 'area_id', 'business_id', 'shop_name', 'mobile', 'logo', 'photo', 'addr', 'tel', 'extension', 'contact', 'tags', 'near', 'business_time','delivery_time', 'is_pei', 'orderby', 'lng', 'lat', 'price','is_ding');

    public function index() {
        $Shop = D('Shop');
        import('ORG.Util.Page'); // 导入分页类
        $map = array( 'audit' => 1);
        if ($keyword = $this->_param('keyword', 'htmlspecialchars')) {
            $map['shop_name|tel'] = array('LIKE', '%' . $keyword . '%');
            $this->assign('keyword', $keyword);
        }
        if ($city_id = (int) $this->_param('city_id')) {
            $map['city_id'] = $city_id;
            $this->assign('city_id', $city_id);
        }
        if ($area_id = (int) $this->_param('area_id')) {
            $map['area_id'] = $area_id;
            $this->assign('area_id', $area_id);
        }
        if ($cate_id = (int) $this->_param('cate_id')) {
            $map['cate_id'] = array('IN', D('Shopcate')->getChildren($cate_id));
            $this->assign('cate_id', $cate_id);
        }

        $count = $Shop->where($map)->count(); // 查询满足要求的总记录数 
        $Page = new Page($count, 25); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
        $list = $Shop->order(array('orderby' => 'asc'))->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $ids = array();
        foreach ($list as $k => $val) {
            if ($val['user_id']) {
                $ids[$val['user_id']] = $val['user_id'];
            }
        }
        $this->assign('users', D('Users')->itemsByIds($ids));
        $this->assign('citys', D('City')->fetchAll());
        $this->assign('areas', D('Area')->fetchAll());
        $this->assign('cates', D('Shopcate')->fetchAll());
        $this->assign('business', D('Business')->fetchAll());
        $this->assign('list', $list); // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出
        $this->display(); // 输出模板
    }

    public function apply() {
        $Shop = D('Shop');
        import('ORG.Util.Page'); // 导入分页类
        $map = array('closed' => 0, 'audit' => 0);
        if ($keyword = $this->_param('keyword', 'htmlspecialchars')) {
            $map['shop_name|tel'] = array('LIKE', '%' . $keyword . '%');
            $this->assign('keyword', $keyword);
        }
        if ($city_id = (int) $this->_param('city_id')) {
            $map['city_id'] = $city_id;
            $this->assign('city_id', $city_id);
        }
        if ($area_id = (int) $this->_param('area_id')) {
            $map['area_id'] = $area_id;
            $this->assign('area_id', $area_id);
        }
        if ($cate_id = (int) $this->_param('cate_id')) {
            $map['cate_id'] = array('IN', D('Shopcate')->getChildren($cate_id));
            $this->assign('cate_id', $cate_id);
        }

        $count = $Shop->where($map)->count(); // 查询满足要求的总记录数 
        $Page = new Page($count, 25); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
        $list = $Shop->order(array('shop_id' => 'asc'))->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $ids = array();
        foreach ($list as $k => $val) {

            if ($val['user_id']) {
                $ids[$val['user_id']] = $val['user_id'];
            }
        }
        $this->assign('users', D('Users')->itemsByIds($ids));
        $this->assign('citys', D('City')->fetchAll());
        $this->assign('areas', D('Area')->fetchAll());
        $this->assign('cates', D('Shopcate')->fetchAll());
        $this->assign('business', D('Business')->fetchAll());
        $this->assign('list', $list); // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出
        $this->display(); // 输出模板
    }

    public function create() {
        if ($this->isPost()) {
            $data2=$data = $this->createCheck();
            $obj = D('Shop');
            $details = $this->_post('details', 'SecurityEditorHtml');
            if ($words = D('Sensitive')->checkWords($details)) {
                $this->baoError('商家介绍含有敏感词：' . $words);
            }
            $bank = $this->_post('bank', 'htmlspecialchars');
            unset($data['near'], $data['price'], $data['business_time'],$data['delivery_time']);
            if ($shop_id = $obj->add($data)) {
                $wei_pic = D('Weixin')->getCode($shop_id, 1);
                $ex = array(
                    'wei_pic' => $wei_pic,
                    'details' => $details,
                    'bank' => $bank,
                    'near' => $data2['near'],
                    'price' => $data2['price'],
                    'business_time' => $data2['business_time'],
                    'delivery_time' => $data2['delivery_time'],
                );
                D('Shopdetails')->upDetails($shop_id, $ex);
                $this->baoSuccess('添加成功', U('shop/apply'));
            }
            $this->baoError('操作失败！');
        } else {
            $this->assign('cates', D('Shopcate')->fetchAll());
            $this->assign('business', D('Business')->fetchAll());
            $this->display();
        }
    }

    public function select() {
        $Shop = D('Shop');
        import('ORG.Util.Page'); // 导入分页类
        $map = array('closed' => 0, 'audit' => 1);
        if ($keyword = $this->_param('keyword', 'htmlspecialchars')) {
            $map['shop_name|tel'] = array('LIKE', '%' . $keyword . '%');
            $this->assign('keyword', $keyword);
        }
        if ($city_id = (int) $this->_param('city_id')) {
            $map['city_id'] = $city_id;
            $this->assign('city_id', $city_id);
        }
        if ($area_id = (int) $this->_param('area_id')) {
            $map['area_id'] = $area_id;
            $this->assign('area_id', $area_id);
        }

        if ($cate_id = (int) $this->_param('cate_id')) {
            $map['cate_id'] = array('IN', D('Shopcate')->getChildren($cate_id));
            $this->assign('cate_id', $cate_id);
        }
        $count = $Shop->where($map)->count(); // 查询满足要求的总记录数 
        $Page = new Page($count, 10); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
        $list = $Shop->where($map)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $ids = array();
        foreach ($list as $k => $val) {

            if ($val['user_id']) {
                $ids[$val['user_id']] = $val['user_id'];
            }
        }
        $this->assign('users', D('Users')->itemsByIds($ids));
        $this->assign('citys', D('City')->fetchAll());
        $this->assign('areas', D('Area')->fetchAll());
        $this->assign('cates', D('Shopcate')->fetchAll());
        $this->assign('business', D('Business')->fetchAll());
        $this->assign('list', $list); // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出
        $this->display(); // 输出模板
    }

    private function createCheck() {
        $data = $this->checkFields($this->_post('data', false), $this->create_fields);
        $data['user_id'] = (int) $data['user_id'];
        if (empty($data['user_id'])) {
            $this->baoError('管理者不能为空');
        }
        $shop = D('Shop')->find(array('where' => array('user_id' => $data['user_id'])));
        if (!empty($shop)) {
            $this->baoError('该管理者已经拥有商铺了');
        }

        $data['cate_id'] = (int) $data['cate_id'];
        if (empty($data['cate_id'])) {
            $this->baoError('分类不能为空');
        } 
        $data['city_id'] = (int) $data['city_id'];
        $data['area_id'] = (int) $data['area_id'];
        if (empty($data['area_id'])) {
            $this->baoError('所在区域不能为空');
        } $data['business_id'] = (int) $data['business_id'];
        if (empty($data['business_id'])) {
            $this->baoError('所在商圈不能为空');
        } $data['shop_name'] = htmlspecialchars($data['shop_name']);
        if (empty($data['shop_name'])) {
            $this->baoError('商铺名称不能为空');
        } $data['logo'] = htmlspecialchars($data['logo']);
        if (empty($data['logo'])) {
            $this->baoError('请上传商铺LOGO');
        }
        if (!isImage($data['logo'])) {
            $this->baoError('商铺LOGO格式不正确');
        } $data['photo'] = htmlspecialchars($data['photo']);
        if (empty($data['photo'])) {
            $this->baoError('请上传店铺缩略图');
        }
        if (!isImage($data['photo'])) {
            $this->baoError('店铺缩略图格式不正确');
        }
        $data['addr'] = htmlspecialchars($data['addr']);
        if (empty($data['addr'])) {
            $this->baoError('店铺地址不能为空');
        }
        $data['tel'] = htmlspecialchars($data['tel']);
        $data['mobile'] = htmlspecialchars($data['mobile']);
        if (empty($data['tel']) && empty($data['mobile'])) {
            $this->baoError('店铺电话不能为空');
        }
        $data['contact'] = htmlspecialchars($data['contact']);
        $data['tags'] = str_replace(',', '，', htmlspecialchars($data['tags']));
        $data['near'] = htmlspecialchars($data['near']);
        $data['business_time'] = htmlspecialchars($data['business_time']);
        $data['orderby'] = (int) $data['orderby'];
        $data['price'] = (int) $data['price'];
        $data['is_pei'] = (int) $data['is_pei'];
        $data['lng'] = htmlspecialchars($data['lng']);
        $data['lat'] = htmlspecialchars($data['lat']);
        $data['create_time'] = NOW_TIME;
        $data['create_ip'] = get_client_ip();
        return $data;
    }

    public function edit($shop_id = 0) {

        if ($shop_id = (int) $shop_id) {
            $obj = D('Shop');
            if (!$detail = $obj->find($shop_id)) {
                $this->baoError('请选择要编辑的商家');
            }
            if ($this->isPost()) {
                $data = $this->editCheck($shop_id);
                $data['shop_id'] = $shop_id;
                $details = $this->_post('details', 'SecurityEditorHtml');
                if ($words = D('Sensitive')->checkWords($details)) {
                    $this->baoError('商家介绍含有敏感词：' . $words);
                }
                $bank = $this->_post('bank', 'htmlspecialchars');
                $shopdetails = D('Shopdetails')->find($shop_id);

                $ex = array(
                    'details' => $details,
                    'bank' => $bank,
                    'near' => $data['near'],
                    'price' => $data['price'],
                    'business_time' => $data['business_time'],
                );
                if (!empty($shopdetails['wei_pic'])) {
                    if (true !== strpos($shopdetails['wei_pic'], "https://mp.weixin.qq.com/")) {
                        $wei_pic = D('Weixin')->getCode($shop_id, 1);
                        $ex['wei_pic'] = $wei_pic;
                    }
                } else {
                    $wei_pic = D('Weixin')->getCode($shop_id, 1);
                    $ex['wei_pic'] = $wei_pic;
                }
                unset($data['near'], $data['price'], $data['business_time']);
                if (false !== $obj->save($data)) {
                    D('Shopdetails')->upDetails($shop_id, $ex);
                    $this->baoSuccess('操作成功', U('shop/index'));
                }
                $this->baoError('操作失败');
            } else {
                $this->assign('areas', D('Area')->fetchAll());
                $this->assign('cates', D('Shopcate')->fetchAll());
                $this->assign('business', D('Business')->fetchAll());
                $this->assign('ex', D('Shopdetails')->find($shop_id));
                $this->assign('user', D('Users')->find($detail['user_id']));
                $this->assign('detail', $detail);
                $this->display();
            }
        } else {
            $this->baoError('请选择要编辑的商家');
        }
    }

    private function editCheck($shop_id) {
        $data = $this->checkFields($this->_post('data', false), $this->edit_fields);
        $data['user_id'] = (int) $data['user_id'];
        if (empty($data['user_id'])) {
            $this->baoError('管理者不能为空');
        }
        $shop = D('Shop')->find(array('where' => array('user_id' => $data['user_id'])));
        if (!empty($shop) && $shop['shop_id'] != $shop_id) {
            $this->baoError('该管理者已经拥有商铺了');
        }
        $data['cate_id'] = (int) $data['cate_id'];
        if (empty($data['cate_id'])) {
            $this->baoError('分类不能为空');
        } 
        $data['city_id'] = (int) $data['city_id'];
        $data['area_id'] = (int) $data['area_id'];
        if (empty($data['area_id'])) {
            $this->baoError('所在区域不能为空');
        } $data['business_id'] = (int) $data['business_id'];
        if (empty($data['business_id'])) {
            $this->baoError('所在商圈不能为空');
        } $data['shop_name'] = htmlspecialchars($data['shop_name']);
        if (empty($data['shop_name'])) {
            $this->baoError('商铺名称不能为空');
        } $data['logo'] = htmlspecialchars($data['logo']);
        if (empty($data['logo'])) {
            $this->baoError('请上传商铺LOGO');
        }
        if (!isImage($data['logo'])) {
            $this->baoError('商铺LOGO格式不正确');
        }
        $data['photo'] = htmlspecialchars($data['photo']);
        if (empty($data['photo'])) {
            $this->baoError('请上传店铺缩略图');
        }
        if (!isImage($data['photo'])) {
            $this->baoError('店铺缩略图格式不正确');
        } $data['addr'] = htmlspecialchars($data['addr']);
        if (empty($data['addr'])) {
            $this->baoError('店铺地址不能为空');
        } $data['tel'] = htmlspecialchars($data['tel']);
        $data['mobile'] = htmlspecialchars($data['mobile']);
        if (empty($data['tel']) && empty($data['mobile'])) {
            $this->baoError('店铺电话不能为空');
        }

        $data['contact'] = htmlspecialchars($data['contact']);
        $data['tags'] = htmlspecialchars($data['tags']);
        $data['near'] = htmlspecialchars($data['near']);
        $data['business_time'] = htmlspecialchars($data['business_time']);
        $data['orderby'] = (int) $data['orderby'];
        $data['lng'] = htmlspecialchars($data['lng']);
        $data['lat'] = htmlspecialchars($data['lat']);
        $data['price'] = (int) $data['price'];
        $data['is_pei'] = (int) $data['is_pei'];
        return $data;
    }

    public function delete($shop_id = 0) {
		/*$a = array(
			'bao_activity',
			'bao_activity',
		);
		foreach($a as $v){
			$sql = "UPDATE ` " . $v ."` SET `closed`=1 where `shop_id`= " . $shop_id;
			$activity->execute($sql);
		}*/
		
        if (is_numeric($shop_id) && ($shop_id = (int) $shop_id)) {
			$shop = D('Shop');
			$shop->save(array('shop_id' => $shop_id, 'closed' => 1));
			$user_id = $shop->where('shop_id='.$shop_id)->getField('user_id');
			$life = D('Life');
			$life->where('user_id='.$user_id)->save(array('audit' => 0));
			
			$activity = D('Activity');
			$sql = "UPDATE `bao_activity` SET `closed`=1 where `shop_id`= " . $shop_id;
			$activity->execute($sql);
			//var_dump($activity->getLastSql());die;
			
			$billshop = D('Billshop');
			$sql1 = "UPDATE bao_bill_shop SET `closed`=1 where `shop_id`= " . $shop_id;
			$billshop->execute($sql1);
			
			$cloudgoods = D('Cloudgoods');
			$sql2 = "UPDATE bao_cloud_goods SET `closed`=1 where `shop_id` =" . $shop_id;
			$cloudgoods->execute($sql2);
			
			$ele = D('Ele');
			$sql3 = "UPDATE bao_ele SET `closed`=1 where `shop_id` =" . $shop_id;
			$ele->execute($sql3);
			
			$elecate = D('Elecate');
			$sql4 = "UPDATE bao_ele_cate SET `closed`=1 where `shop_id` = " . $shop_id;
			$elecate->execute($sql4);
			
			$Tuan = D('Tuan');
			$sql5 = "UPDATE bao_tuan SET `closed`=1 where `shop_id` =" . $shop_id;
			$Tuan->execute($sql5);
			
			$Goods = D('Goods');
			$sql6 = "UPDATE bao_goods SET `closed`=1 where`shop_id`=" . $shop_id;
			$Goods->execute($sql6);
			
			$Hotel = D('Hotel');
			$sql7 = "UPDATE bao_hotel SET `closed`=1 where `shop_id` =" . $shop_id;
			$Hotel->execute($sql7);
			
			$Farm = D('Farm');
			$sql8 = "UPDATE bao_farm SET `closed`=1 where `shop_id` =" . $shop_id;
			$Farm->execute($sql8);
			
			$Weidiandetails = D('Weidiandetails');
			$sql9 = "UPDATE bao_weidian_details SET `closed`=1 where `shop_id` =" . $shop_id;
			$Weidiandetails->execute($sql9);
			
			$Eleorder = D('Eleorder');
			$sql10 = "UPDATE bao_ele_order SET `closed`=1 where `shop_id` =" . $shop_id;
			$Eleorder->execute($sql10);
			
			$Eleproduct = D('Eleproduct');
			$sql11 = "UPDATE bao_ele_product SET `closed`=1 where `shop_id` =" . $shop_id;
			$Eleproduct->execute($sql11);
			
			$Shopding = D('Shopding');
			$sql12 = "UPDATE bao_shop_ding SET `closed`=1 where `shop_id` =" . $shop_id;
			$Shopding->execute($sql12);
			$this->baoSuccess('关闭成功！', U('shop/index'));
        } else {
            $shop_id = $this->_post('shop_id', false);
            if (is_array($shop_id)) {
                $obj = D('Shop');
                foreach ($shop_id as $id) {
                    $obj->save(array('shop_id' => $id, 'closed' => 1));
                }
                $this->baoSuccess('关闭成功！', U('shop/index'));
            }
            $this->baoError('请选择要关闭的商家');
        }
    }
    
    public function open($shop_id = 0) {
        if (is_numeric($shop_id) && ($shop_id = (int) $shop_id)) {
			$shop = D('Shop');
            $shop->save(array('shop_id' => $shop_id, 'closed' => 0));
			$user_id = $shop->where('shop_id='.$shop_id)->getField('user_id');
			$life = D('Life');
			$life->where('user_id='.$user_id)->save(array('audit' => 1));
			
			$activity = D('Activity');
			$sql = "UPDATE bao_activity SET `closed`=0 where `shop_id` =" . $shop_id;
			$activity->execute($sql);
			
			$billshop = D('Billshop');
			$sql1 = "UPDATE bao_bill_shop SET `closed`=0 where `shop_id` =" . $shop_id;
			$billshop->execute($sql1);
            
			$cloudgoods = D('Cloudgoods');
			$sql2 = "UPDATE bao_cloud_goods SET `closed`=0 where `shop_id` =" . $shop_id;
			$cloudgoods->execute($sql2);
			
			$ele = D('Ele');
            $sql3 = "UPDATE bao_ele SET `closed`=0 where `shop_id` =" . $shop_id;
			$ele->execute($sql3);
			
			$elecate = D('Elecate');
			$sql4 = "UPDATE bao_ele_cate SET `closed`=0 where `shop_id` =" . $shop_id;
			$elecate->execute($sql4);
			
			$Tuan = D('Tuan');
			$sql5 = "UPDATE bao_tuan SET `closed`=0 where `shop_id` =" . $shop_id;
			$Tuan->execute($sql5);
            
			$Goods = D('Goods');
			$sql6 = "UPDATE bao_goods SET `closed`=0 where `shop_id` =" . $shop_id;
			$Goods->execute($sql6);
            
			$Hotel = D('Hotel');
            $sql7 = "UPDATE bao_hotel SET `closed`=0 where `shop_id` =" . $shop_id;
			$Hotel->execute($sql7);
			
			$Farm = D('Farm');
            $sql8 = "UPDATE bao_farm SET `closed`=0 where `shop_id` =" . $shop_id;
			$Farm->execute($sql8);
			
			$Weidiandetails = D('Weidiandetails');
            $sql9 = "UPDATE bao_weidian_details SET `closed`=0 where `shop_id` =" . $shop_id;
			$Weidiandetails->execute($sql9);
			
			$Eleorder = D('Eleorder');
            $sql10 = "UPDATE bao_ele_order SET `closed`=0 where `shop_id` =" . $shop_id;
			$Eleorder->execute($sql10);
			
			$Eleproduct = D('Eleproduct');
            $sql11 = "UPDATE bao_ele_product SET `closed`=0 where `shop_id` =" . $shop_id;
			$Eleproduct->execute($sql11);
			
			$Shopding = D('Shopding');
            $sql12 = "UPDATE bao_shop_ding SET `closed`=0 where `shop_id` =" . $shop_id;
			$Shopding->execute($sql12); 
            $this->baoSuccess('开启成功！', U('shop/index'));
        } else {
            $shop_id = $this->_post('shop_id', false);
            if (is_array($shop_id)) {
                $obj = D('Shop');
                foreach ($shop_id as $id) {
                    $obj->save(array('shop_id' => $id, 'closed' => 0));
                }
                $this->baoSuccess('开启成功！', U('shop/index'));
            }
            $this->baoError('请选择要开启的商家');
        }
    }

    public function audit($shop_id = 0) {
        if (is_numeric($shop_id) && ($shop_id = (int) $shop_id)) {
            $obj = D('Shop');
            $obj->save(array('shop_id' => $shop_id, 'audit' => 1));
            $this->baoSuccess('审核成功！', U('shop/apply'));
        } else {
            $shop_id = $this->_post('shop_id', false);
            if (is_array($shop_id)) {
                $obj = D('Shop');
                foreach ($shop_id as $id) {
                    $obj->save(array('shop_id' => $id, 'audit' => 1));
                }
                $this->baoSuccess('审核成功！', U('shop/apply'));
            }
            $this->baoError('请选择要审核的商家');
        }
    }

    public function login($shop_id) {
        $obj = D('Shop');
        if (!$detail = $obj->find($shop_id)) {
            $this->error('请选择要编辑的商家');
        }
        if (empty($detail['user_id'])) {
            $this->error('该用户没有绑定管理者');
        }
        setUid($detail['user_id']);
        header("Location:" . U('shangjia/index/index'));
        die;
    }
    
    
    public function ding($shop_id){
        $obj = D('Shop');
        if (!$detail = $obj->find($shop_id)) {
            $this->error('请选择要编辑的商家');
        }
        $data = array('is_ding'=>0,'shop_id'=>$shop_id);
        if($detail['is_ding'] == 0){
            $data['is_ding'] = 1;
        }
        $obj->save($data);
        $this->baoSuccess('操作成功',U('shop/index'));
    }
    
    public function pei($shop_id){
        $obj = D('Shop');
        if (!$detail = $obj->find($shop_id)) {
            $this->error('请选择要编辑的商家');
        }
        $data = array('is_pei'=>0,'shop_id'=>$shop_id);
        if($detail['is_pei'] == 0){
            $data['is_pei'] = 1;
        }
        $obj->save($data);
        $this->baoSuccess('操作成功',U('shop/index'));
    }
  

}