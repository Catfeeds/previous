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
  'order_id' => 
  array (
    'field' => 'order_id',
    'label' => '订单ID',
    'pk' => true,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '订单ID',
    'default' => '',
    'SO' => '=',
  ),
  'product_price' => 
  array (
    'field' => 'product_price',
    'label' => '商品总价',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '商品总价',
    'default' => '',
    'SO' => '=',
  ),
  'product_number' => 
  array (
    'field' => 'product_number',
    'label' => '商品数量',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '商品数量',
    'default' => '',
    'SO' => '',
  ),
  'freight' => 
  array (
    'field' => 'freight',
    'label' => '运费',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'number',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'spend_number' => 
  array (
    'field' => 'spend_number',
    'label' => '自提码',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => false,
    'list' => true,
    'type' => 'text',
    'comment' => '自提码',
    'default' => '',
    'SO' => false,
  ),
  'spend_status' => 
  array (
    'field' => 'spend_status',
    'label' => '自提状态',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '自提状态',
    'default' => '0',
    'SO' => '=',
  ),
  'type' => 
  array (
    'field' => 'type',
    'label' => '订单类型',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '订单类型',
    'default' => 'default',
    'SO' => '=',
  ),
   'sid' => 
  array (
    'field' => 'sid',
    'label' => '分销店铺sid',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '分销店铺sid',
    'default' => '',
    'SO' => '=',
  ),
    'invite1' => 
  array (
    'field' => 'invite1',
    'label' => '上级id',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '上级id',
    'default' => '',
    'SO' => '=',
  ),
    'invite2' => 
  array (
    'field' => 'invite2',
    'label' => '上级id',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '上级id',
    'default' => '',
    'SO' => '=',
  ),
    'invite3' => 
  array (
    'field' => 'invite3',
    'label' => '上级id',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '上级id',
    'default' => '',
    'SO' => '=',
  ),
    'shop_amount' => 
  array (
    'field' => 'shop_amount',
    'label' => '商家应得金额',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '商家应得金额',
    'default' => '',
    'SO' => '=',
  ),
    'amount_1' => 
  array (
    'field' => 'amount_1',
    'label' => '一级分销所得',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '一级分销所得',
    'default' => '',
    'SO' => '=',
  ),
     'amount_2' => 
  array (
    'field' => 'amount_2',
    'label' => '二级分销所得',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '二级分销所得',
    'default' => '',
    'SO' => '=',
  ),
     'amount_3' => 
  array (
    'field' => 'amount_3',
    'label' => '三级分销所得',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'number',
    'comment' => '三级分销所得',
    'default' => '',
    'SO' => '=',
  ),
);