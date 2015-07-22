<?php
import("@.Model.UserDao");

class LoginAction extends Action{
	private $userDao;

	public function _initialize(){
		$this->userDao=new UserDao();
	}

	public function loginsubmit(){
		$username=$_POST['username'];
        $password = $_POST['password'];
        $password = substr(md5($password),0,30);
		if($username==""||$password==""){
			$this->assign(message,'用户名或密码不可为空！');
			$this->display('Login/login');
			return;
		}
		$userrow = $this->userDao->findByUsername($username);
		//用户不存在
		if($userrow == -1){
			$this->assign('message','用户不存在');
			$this->display('Login/login');
			return;
		}
		//登录成功
		if($userrow['password'] == $password){
			$myRole = "";
			$this->assign('message','登录成功');
			$_SESSION['my_username']=$username;

			$this->redirect('Index/index');
		}

		//密码错误
		else {
      $this->assign(message,'密码错误');
			$this->display('Login/login');
		}


	}


	public function check(){
		return isset($_SESSION['my_username']);		
	}
	public function login(){
		
		$this->display('login');
	}
	public function logout(){
		unset($_SESSION['my_username']);
		$this->redirect('Index/index');
	}

}

?>
