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
  'staff_id' => 
  array (
    'field' => 'staff_id',
    'label' => '配送员ID',
    'pk' => true,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'int',
    'comment' => '配送员ID',
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
    'list' => false,
    'type' => 'int',
    'comment' => '城市ID',
    'default' => '',
    'SO' => '=',
  ),
  'from' => 
  array (
    'field' => 'from',
    'label' => '服务类型',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => 'weixiu:维修, paotui:跑腿,house:家政',
    'default' => '',
    'SO' => '=',
  ),
  'name' => 
  array (
    'field' => 'name',
    'label' => '姓名',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => '姓名',
    'default' => '',
    'SO' => '=',
  ),
  'mobile' => 
  array (
    'field' => 'mobile',
    'label' => '手机号',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => '手机号',
    'default' => '',
    'SO' => '=',
  ),
  'passwd' => 
  array (
    'field' => 'passwd',
    'label' => '登录密码',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => '登录密码',
    'default' => '',
    'SO' => false,
  ),
  'face' => 
  array (
    'field' => 'face',
    'label' => '头像',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => '头像',
    'default' => '',
    'SO' => false,
  ),
  'money' => 
  array (
    'field' => 'money',
    'label' => '余额',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => '余额',
    'default' => '0.00',
    'SO' => false,
  ),
  'total_money' => 
  array (
    'field' => 'total_money',
    'label' => '总收益',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'number',
    'comment' => '总收益',
    'default' => '0.00',
    'SO' => false,
  ),
  'tixian_percent' => 
  array (
    'field' => 'tixian_percent',
    'label' => '配送员提现比例',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'number',
    'comment' => '配送员提现比例 0~100',
    'default' => '100',
    'SO' => false,
  ),
  'tixian_money' => 
  array (
    'field' => 'tixian_money',
    'label' => '体现总额',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => '体现总额',
    'default' => '0.00',
    'SO' => false,
  ),
  'orders' => 
  array (
    'field' => 'orders',
    'label' => '订单数',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'number',
    'comment' => '订单数',
    'default' => '',
    'SO' => false,
  ),
  'score' => 
  array (
    'field' => 'score',
    'label' => '总评分',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'number',
    'comment' => '总评分',
    'default' => '',
    'SO' => '=',
  ),
  'comments' => 
  array (
    'field' => 'comments',
    'label' => '评论数',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'number',
    'comment' => '评论数',
    'default' => '',
    'SO' => false,
  ),
  'lat' => 
  array (
    'field' => 'lat',
    'label' => '经度',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'number',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'lng' => 
  array (
    'field' => 'lng',
    'label' => '纬度',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'number',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'lastlogin' => 
  array (
    'field' => 'lastlogin',
    'label' => '最近登录',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'loginip' => 
  array (
    'field' => 'loginip',
    'label' => '登录IP',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'clientip',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'verify_name' => 
  array (
    'field' => 'verify_name',
    'label' => '身份认证状态',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => '身份认证状态 0:待审核，1:通过认证, 2:认证被拒绝',
    'default' => '',
    'SO' => '=',
  ),
  'status' => 
  array (
    'field' => 'status',
    'label' => '工作状态',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'int',
    'comment' => '工作状态 0在线 1离线',
    'default' => '',
    'SO' => '=',
  ),
  'sex'=>array(
    'field' => 'sex',
    'label' => '性别',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'int',
    'comment' => '性别,1:男,2:女',
    'default' => '',
    'SO' => '=',
  ),
  'audit' => 
  array (
    'field' => 'audit',
    'label' => '审核状态',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'int',
    'comment' => '审核状态   0:待审核，1:审核通过, 2:审核失败',
    'default' => '',
    'SO' => '=',
  ),
  'closed' => 
  array (
    'field' => 'closed',
    'label' => 'closed',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'text',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'clientip' => 
  array (
    'field' => 'clientip',
    'label' => '创建ip',
    'pk' => false,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'clientip',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
  'dateline' => 
  array (
    'field' => 'dateline',
    'label' => '创建时间',
    'pk' => false,
    'add' => true,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'dateline',
    'comment' => '',
    'default' => '',
    'SO' => false,
  ),
    'intro' => 
  array (
    'field' => 'intro',
    'label' => '简介',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => false,
    'type' => 'textarea',
    'comment' => '简介',
    'default' => '',
    'SO' => '=',
  ),
);