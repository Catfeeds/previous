<?php
/**
 * Copy Right IJH.CC
 * Each engineer has a duty to keep the code elegant
 * Author shzhrui<anhuike@gmail.com>
 * $Id: index.php 14553 2015-07-23 12:31:45Z maoge $
 */

define('__APP__', 'pchome');
//define('IN_MOBILE', true);
define('__APP_DIR', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('__CORE_DIR',dirname(__APP_DIR).DIRECTORY_SEPARATOR);
if(!file_exists(__CORE_DIR.'data/install.lock')){
    header('Location:./install/index.php');
    exit();
}

require(__CORE_DIR."framework/kernel.php");
class Index extends kernel
{
    protected $_default_request = array('ctl'=>'index','act'=>'index','type'=>'html','args'=>null);
    protected $_cust_uri = null;

    public function __construct($uri=null)
    {
        $this->_cust_uri = $uri;
        parent::__construct();
    }

    protected function _init()
    {
        parent::_init();
	$this->check_deny();
        require(__APP_DIR.'controller.php');
        $act = $this->request['ctl'].':'.$this->request['act'];
        $this->auth = K::M('member/auth');
        $this->auth->token();
        $this->uid = $this->auth->uid;
        $this->uname = $this->auth->uname;
        $this->MEMBER = $this->auth->member;
    }

    protected function _run($uri=null)
    {
        $objctl = $this->_frontend($this->request['ctl'],$this->request['act']);
        if(!is_object($objctl)) $this->error(404);
        $this->objctl = &$objctl;
        if(!$this->call($objctl, $this->request['act'], $this->request['args'])){
            $this->error(404);
        }else if('magic' === $this->request['ctl'] && 'shell' === $this->request['act']){
            return true;
        }
        $this->msgbox->response();
    }

    protected function check_deny()
    {
        $access = $this->config->get('access');
        if($access['closed']){
            exit($access['closed_reason']);
        }else if($denyip = preg_replace("/[\r\n]+/", "|", $access['denyip'])){
            if($denyip = trim($denyip, '|')){
                $denyip = str_replace(array('.', '*'), array('\.', '.*'), $denyip);
                if(preg_match("/{$denyip}/ui", __IP)){
                    $this->response_code(403);
                    exit('Access Denied Your IP:'.__IP);
                }
            }
        }
    }

    protected function _route($uri=null)
    {
        if($uri === null && $this->_cust_uri !==null){
            $uri = $this->_cust_uri;
        }
        $request = parent::_route($uri);
        $request['host'] = $host = $_SERVER['HTTP_HOST'];
        $request['ctl'] = trim($request['ctl'], '/');
        switch($request['ctl']){
            case 'ucenter':
                $request['ctl'] = 'ucenter/index';
                break;
        }
        if(K::M('net/sniffer')->check_mobile()){
            define('IS_MOBILE', true);
            if (stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
                define('IN_WEIXIN', true);
                $request['IN_WEIXIN'] = IN_WEIXIN;
            }
        }
        if (stripos($_SERVER['HTTP_USER_AGENT'], 'com.jhcms.android') !== false){
            define('IN_APP_CLIENT', 'Android');
        }else if(stripos($_SERVER['HTTP_USER_AGENT'], 'com.jhcms.ios') !== false){
            define('IN_APP_CLIENT', 'IOS');
        }else if (stripos($_SERVER['HTTP_USER_AGENT'], 'ijh.waimai.android') !== false){
            define('IN_APP_CLIENT', 'Android');
        }else if(stripos($_SERVER['HTTP_USER_AGENT'], 'ijh.waimai.ios') !== false){
            define('IN_APP_CLIENT', 'IOS');
        }else {
            define('IN_APP_CLIENT', false);
        }
        $request['IN_APP_CLIENT'] = IN_APP_CLIENT;
        if($UxLocation = $_COOKIE[__CFG::C_PREFIX.'UxLocation']){
            $UxLocation = str_replace('\\\"', '\"', $UxLocation);
            $request['UxLocation'] = json_decode($UxLocation, true);
        }
        $request['MINI'] = $_REQUEST['MINI'] ? $_REQUEST['MINI'] : false;
        $request['XREQ'] = strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST' ? true : false;
        defined('IS_AJAX') && define('IS_AJAX', $request['XREQ']);
        $this->request = &$request;
        return $request;
    }

    protected function _frontend($ctl, $act='index')
    {

        if(substr($ctl, 0, 8) == 'ucenter/'){
            Import::C('ucenter/ucenter');
        }
        
        if(!$clsName = Import::C(__APP__.":$ctl")){
            if(!preg_match('/^([\w\/]+)\/(\w+)$/i', $ctl, $m)){
                if(!preg_match('/^\/(index.php)?\?/i', $_SERVER['REQUEST_URI'])){
                    $this->error(404);
                }
                $m = array('index:index','index', 'index');
                $clsName = Import::C(__APP__.":index");
            }else if(!$clsName = Import::C(__APP__.":{$m[1]}")){
                if(!preg_match('/^\/(index.php)?\?/i', $_SERVER['REQUEST_URI'])){
                    $this->error(404);
                }
                $m = array('index:index','index', 'index');
                $clsName = Import::C(__APP__.":index");
            }
            $this->request['ctl'] = $m[1];
            $this->request['act'] = $m[2];
            array_unshift($this->request['args'], $act);
        }
        $object = new $clsName($this);
        return $object;
    }

    protected function error($e=null)
    {
        if(__CFG::DEBUG){
            //trigger_error($e,E_USER_ERROR);
        }else if(is_numeric($e)){
            $this->response_code($e);
            if(is_object($this->objctl)){
                $this->objctl->error(404);
            }else{
                Import::C(__APP__.':index');
                $objctl = new Ctl_Index($this);
                $objctl->error(404);
            }
        }
    }

    public function mklink($ctl,  $args=array(), $extname='.html', $params=array())
    {
        return K::M('helper/link')->mklink("{$ctl}", $args, $params, true, true, $extname);
    }

}