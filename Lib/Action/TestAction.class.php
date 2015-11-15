<?php
require_once dirname(__FILE__).'/../auto_load.php';
class TestAction extends LoginAfterAction{
	private $projectDao;
	private $testDao;

	public function _initialize(){
		$this->projectDao = new ProjectDao();
		$this->testDao=new TestDao();
	}


	public function test(){
		// $result = $this->projectDao->add(
  //       	'双龙戏珠从', 
  //       	1, 
  //       	10, 
  //       	1, 
  //       	1, 
  //       	1, 
  //       	1, 
  //       	'zxcasasd', 
  //       	'对方是否', 
  //       	'xcvxcv', 
  //       	'电饭锅电饭锅', 
  //       	10, 
  //       	10, 
  //       	10, 
  //       	'法规和法国', 
  //       	123123, 
  //       	'下层V型从v', 
  //       	123.1, 
  //       	'持续持续', 
  //       	'三东方闪电', 
  //       	'销售发送到', 
  //       	0, 
  //       	0, 
  //       	0, 
  //       	0, 
  //       	0, 
  //       	'三代人放水电费', 
  //       	'持续持续'
		// 	);


		$result = $this->projectDao->updateById(
			10,
        	'双龙戏珠从1', 
        	1, 
        	10, 
        	1, 
        	1, 
        	1, 
        	1, 
        	'zxcasasd', 
        	'对方是否', 
        	'xcvxcv', 
        	'电饭锅电饭锅', 
        	10, 
        	10, 
        	10, 
        	'法规和法国', 
        	123123, 
        	'下层V型从v', 
        	123.1, 
        	'持续持续', 
        	'三东方闪电', 
        	'销售发送到', 
        	0, 
        	0, 
        	0, 
        	0, 
        	0, 
        	'三代人放水电费', 
        	'持续持续'
			);


		// $result = $this->testDao->updateById(
		// 	4,
		// 	'xcvq',
		// 	0,
		// 	'asdasd'
		// 	);
		if($result==false)echo "fail";
		else echo "succ";



	}
	public function md5transfer(){
	  $plainText = $_POST['plaintext'];
    $md5Text = substr(md5($plainText),0,30);
    echo $md5Text;    
	}

}

?>
