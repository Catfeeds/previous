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
  'goods_id' => 
  array (
    'field' => 'goods_id',
    'label' => '商品ID',
    'pk' => true,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '商品ID',
    'default' => '',
    'SO' => '=',
  ),
  'cate_id' => 
  array (
    'field' => 'cate_id',
    'label' => '分类ID',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '分类ID',
    'default' => '',
    'SO' => '=',
  ),
  'title' => 
  array (
    'field' => 'title',
    'label' => '商品名称',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '商品名称',
    'default' => '',
    'SO' => 'like',
  ),
    'intro' => 
  array (
    'field' => 'intro',
    'label' => '简介',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '简介',
    'default' => '',
    'SO' => 'like',
  ),
  'photo' => 
  array (
    'field' => 'photo',
    'label' => '图片',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'photo',
    'comment' => '图片',
    'default' => '',
    'SO' => false,
  ),
  'details' => 
  array (
    'field' => 'details',
    'label' => '图文详情',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => true,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'text',
    'comment' => '图文详情',
    'default' => '',
    'SO' => '=',
  ),
  'orderby' => 
  array (
    'field' => 'orderby',
    'label' => '排序',
    'pk' => false,
    'add' => true,
    'edit' => true,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '排序',
    'default' => '100',
    'SO' => '=',
  ),
  'closed' => 
  array (
    'field' => 'closed',
    'label' => '删除标识',
    'pk' => false,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => true,
    'show' => true,
    'list' => true,
    'type' => 'int',
    'comment' => '删除标识',
    'default' => '',
    'SO' => false,
  ),  
  'clientip' => 
  array (
    'field' => 'clientip',
    'label' => '创建IP',
    'pk' => false,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'clientip',
    'comment' => '创建IP',
    'default' => '',
    'SO' => 'betweendate',
  ),
  'dateline' => 
  array (
    'field' => 'dateline',
    'label' => '创建时间',
    'pk' => false,
    'add' => false,
    'edit' => false,
    'html' => false,
    'empty' => false,
    'show' => true,
    'list' => true,
    'type' => 'dateline',
    'comment' => '创建时间',
    'default' => '',
    'SO' => false,
  ),
);