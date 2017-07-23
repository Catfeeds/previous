<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * $Id$
 */
if(!defined('__CORE_DIR')){
    exit("Access Denied");
}
class Mdl_Waimai_Productspec extends Mdl_Table
{   
  
    protected $_table = 'waimai_product_spec';
    protected $_pk = 'spec_id';
    protected $_cols = 'spec_id,product_id,price,package_price,spec_name,spec_photo,sale_sku,sale_count';    
    
}