<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

return array (
  'group_id' => 
  array (
    'field' => 'group_id',
    'label' => '组团ID',
    'pk' => true,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '组团ID',
    'default' => '',
    'SO' => '=',
  ),
    'city_id' => 
  array (
    'field' => 'city_id',
    'label' => '城市ID',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '城市id',
    'default' => '',
    'SO' => '=',
  ),
   'shop_id' => 
  array (
    'field' => 'shop_id',
    'label' => '商家ID',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '商家ID',
    'default' => '',
    'SO' => '=',
  ), 
    
  'group_title' => 
  array (
    'field' => 'group_title',
    'label' => '拼团标题',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '拼团标题',
    'default' => '',
    'SO' => '=',
  ),
    'user_num' => 
  array (
    'field' => 'user_num',
    'label' => '成团人数',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '成团人数',
    'default' => '',
    'SO' => '=',
  ),
   'master_id' => 
  array (
    'field' => 'master_id',
    'label' => '团长用户id',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '团长用户id',
    'default' => '',
    'SO' => '=',
  ),  
      'start_time' => 
  array (
    'field' => 'start_time',
    'label' => '开团时间',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '开团时间',
    'default' => '',
    'SO' => '=',
  ),  
     'end_time' => 
  array (
    'field' => 'end_time',
    'label' => '结束时间',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '结束时间',
    'default' => '',
    'SO' => '=',
  ),  
  'order_count' => 
  array (
    'field' => 'order_count',
    'label' => '订单数量',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '订单数量',
    'default' => '',
    'SO' => '=',
  ), 
 'order_success_count' => 
  array (
    'field' => 'order_success_count',
    'label' => '成功订单数量',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '成功订单数量',
    'default' => '',
    'SO' => '=',
  ),
    'order_yongjin_count' => 
  array (
    'field' => 'order_yongjin_count',
    'label' => '支付佣金人数',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '支付佣金人数',
    'default' => '',
    'SO' => '=',
  ),
  'product_id' => 
  array (
    'field' => 'product_id',
    'label' => '拼团产品id',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '拼团产品id',
    'default' => '',
    'SO' => '=',
  ),
   'status' => 
  array (
    'field' => 'status',
    'label' => '组团状态',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '0: 组团中  1:组团成功  2: 组团失败 3:团完成(商家点结束))',
    'default' => '',
    'SO' => false,
  ),  
    'is_update_price' => 
  array (
    'field' => 'is_update_price',
    'label' => '阶梯团成功,更新订单的价格 ',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '0:未更新,1已更新',
    'default' => '',
    'SO' => false,
  ),
     'confirm_time' => 
  array (
    'field' => 'confirm_time',
    'label' => '商户确认时间',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '商户确认时间',
    'default' => '',
    'SO' => false,
  ),
     'confirm_reason' => 
  array (
    'field' => 'confirm_reason',
    'label' => '商户确认原因',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '商户确认原因',
    'default' => '',
    'SO' => false,
  ),
      'money_pre' => 
  array (
    'field' => 'money_pre',
    'label' => '预付款',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '预付款',
    'default' => '',
    'SO' => false,
  ),
  'tuan_type' => 
  array (
    'field' => 'tuan_type',
    'label' => '团类型',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '团类型',
    'default' => '',
    'SO' => false,
  ),
      'closed' => 
  array (
    'field' => 'closed',
    'label' => '是否删除',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '是否删除',
    'default' => '',
    'SO' => false,
  ),
  'dateline' => 
  array (
    'field' => 'dateline',
    'label' => '创建时间',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'dateline',
    'comment' => '创建时间',
    'default' => '',
    'SO' => '=',
  ),  
    'clientip' => 
  array (
    'field' => 'clientip',
    'label' => '客户IP',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '客户IP',
    'default' => '',
    'SO' => '=',
  ),    
);