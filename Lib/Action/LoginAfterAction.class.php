<?php
import("@.Model.UserDao");
import("@.Model.RoleDao");
import("@.Model.RoleOperationDao");
import("@.Model.OperationDao");
class LoginAfterAction extends Action {
  protected $userDao;
  protected $roleDao;
  protected $roleOperationDao;
  protected $operationDao;

  public function _initialize(){
    $isLogin = false;
    tag('behavior_logincheck',$isLogin);
    if($isLogin == false){
      $this->redirect('Login/login');
      return;
    }
    $this->userDao=new UserDao();
    $this->roleDao=new RoleDao();
    $this->roleOperationDao=new RoleOperationDao();
    $this->operationDao=new OperationDao();
    //全局操作
    $my_username = $_SESSION['my_username'];
    $this->assign('my_username',$my_username);
    $userRow = $this->userDao->findByUsername($my_username);
    $roleid = $userRow['roleid'];
    $roleRow = $this->roleDao->findById($roleid);
    $my_role = $roleRow['rolename'];
    $this->assign('myRole',$myRole);
    //查找role对应的功能
    $myOperationRowArray = array();
    $roleOperationArray = $this->roleOperationDao->findByRoleid($roleid);
    foreach ($roleOperationArray as $key => $value){
      $operationRow = $this->operationDao->findById($value['operationid']);
      array_push($myOperationRowArray,$operationRow);
    }
    $this->assign('myOperationRowArray',$myOperationRowArray);
    //读取时间，生成欢迎语
    $nowArray = getdate();
    //$this->assign('now_hour',$nowArray['hours']);
    $greetingWords = "";
    if($nowArray['hours']>=5 && $nowArray['hours']<11)$greetingWords = "早上好，来一杯清茶开始今天的工作吧";
    if($nowArray['hours']>=11 && $nowArray['hours']<13)$greetingWords = "中午了，丰富的午餐给自己加些油吧";
    if($nowArray['hours']>=13 && $nowArray['hours']<18)$greetingWords = "下午好，午后的阳光有没有让你心情变得愉悦呢";
    if($nowArray['hours']>=18 && $nowArray['hours']<22)$greetingWords = "晚上好，加班辛苦了";
    if($nowArray['hours']>=22 || $nowArray['hours']<5)$greetingWords = "夜深了，要注意休息啊";
    $this->assign('greetingWords',$greetingWords);
  }
}

?>
