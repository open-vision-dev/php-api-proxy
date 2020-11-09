<?php
require_once __DIR__."/vendor/autoload.php";
use Intervention\HttpAuth\HttpAuth;
class Scripty
{
	public $target_url , $data_var , $data_var_raw ,$method  ,$response ;
	
	private $G , $P ,$secrect;
	
	public function __construct($G,$P,$sec = array("user"=>"admin","pwd"=>"admin") ){
	    $this->G=$G;
	    $this->P=$P;
	    $this->secret=$sec;
	    $this->auth();
	    $this->init();
	}
	public function auth(){
		$auth = HttpAuth::make(
		[
		   'type' => 'basic' , 
		   'realm' => 'Secure Resource GTFO' ,
		   'username' => 'admin',
		   'password' => 'admin'
		]
		);
		$auth->secure();
	}
 	public function check_destination()
	{
	    if( isset($this->G['dest'])  )
            {
                $this->target_url=$this->G['dest'];
		        unset($this->data_var_raw['dest']);
	    }
	    elseif(  isset($this->P['dest'])  )
		{
	        $this->target_url=$this->P['dest'];
		        unset($this->data_var_raw['dest']);
	    }
		else
	    {
	        die("no destination provided");
	    }
	    
	}
	public function get_method()
	{
	   if(   count($this->G)  > 0 )
            {
	       $this->method = "GET";
	       $this->data_var_raw=$_GET;
	    }
         elseif(  count($this->P)   >  0  ) 
		{
	       $this->method = "POST";
	       $this->data_var_raw=$_POST;
	    }
            else
            {
	       die("no post/get  variables recived");
	    }
      }
	function init()
	{
	     $this->get_method();
	     $this->check_destination();
		 $this->process_data();
         $this->send();
		 $this->show_result();
	}

	public function process_data()
	{
	     if($this->method=="GET")
	     {
                 $data = "?";
		foreach($this->G as $NAME => $VALUE ) 
                {
                    $segment = $NAME . "=" . urlencode($VALUE)  .  "&";
                    $data =   $data . ""  .  $segment;
                }
                $this->data_var=$data;
         }
         else
	     {
                $this->data_var =  $this->data_var_raw;
         }
	}
	public function send()
	{
		$response = ($this->method == "GET" )  ?    $this->send_get_request($this->target_url,$this->data_var)   :  $this->send_post_request($this->target_url  , $this->data_var  );
		//echo "the response is ".var_export($response,true);
		$this->response = $response ;
		
	}
	public function send_get_request($dest,$data)
	{
		$curl_connection = curl_init();

		curl_setopt($curl_connection,CURLOPT_URL,$dest);
		curl_setopt($curl_connection,CURLOPT_RETURNTRANSFER,true);

		$response = curl_exec($curl_connection);
		curl_close($curl_connection);
		
		return $response;		
	}
	public function send_post_request($dest,$data)
	{
		$curl_connection = curl_init($dest);
	 
		curl_setopt($curl_connection,CURLOPT_POSTFIELDS,$data);
		curl_setopt($curl_connection,CURLOPT_RETURNTRANSFER,true);

		$response = curl_exec($curl_connection);
		
		curl_close($curl_connection);

		return $response;

	}
	public function show_result()
	{
			$result = array (
			"date : " => date("Y-m-d h:i:s") ,
			"method " => $this->method ,
			"data-submitted" => var_export($this->data_var_raw,true),
			"result" => json_encode($this->response)
			);
			echo json_encode ($result);
	}
	public function log($method ){
		
	}
	

	

}




$scripty = new Scripty($_GET,$_POST);
?>
