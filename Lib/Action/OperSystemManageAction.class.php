<?php
require_once dirname(__FILE__).'/../auto_load.php';

header('Content-Type:text/html;charset=utf-8');

class OperSystemManageAction extends LoginAfterAction{
  private $companyDao;
  private $employerDao;
  private $departmentDao;
  private $enterpriseDao;
  private $processClassifyDao;
  private $processDao;

  public function _initialize(){
    parent::_initialize();
    $this->companyDao=new CompanyDao();
    $this->employerDao=new EmployerDao();
    $this->departmentDao=new DepartmentDao();
    $this->enterpriseDao=new EnterpriseDao();
    $this->processClassifyDao = new ProcessClassifyDao();
    $this->processDao = new ProcessDao();
    $this->managerDao = new ManagerDao();
    $this->module = substr(__CLASS__, 0,strlen(__CLASS__)-6);//6:sizeof(Action)
  }

  //角色管理--------------------------------------------------------------------
  public function listRole(){
    //权限检查
    $operationname="用户类型维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $roleRowArray = $this->roleDao->findAll();
    //不允许修改超级用户
    foreach($roleRowArray as $key=>$value){
      if($value['roleid']==ROOT_ROLEID)unset($roleRowArray[$key]);
    }
    $this->assign('roleRowArray',$roleRowArray);
    $this->display('OperSystemManage/listRole');
  }
  public function addRole(){
    //权限检查
    $operationname="用户类型维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    //列出所有功能项
    $operationRowArray = $this->operationDao->findAll();
    $this->assign('operationRowArray',$operationRowArray);
    $this->display('OperSystemManage/addRole');
  }
  public function addRoleSubmit(){
    //权限检查
    $operationname="用户类型维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $rolename=$_POST['rolename'];
    if($this->roleDao->is_rolename_exist($rolename)){
      $message="该角色名已存在，如需改变请进入角色编辑页";
      $this->assign('message',$message);
      $this->addRole();
      return;
    }

    $roleid = $this->roleDao->add($rolename);

    $operationRowArray = $this->operationDao->findAll();
    foreach($operationRowArray as $value){
      $operationid = $value['operationid'];
      $operationKey = "operation_".$operationid;
      if(isset($_POST[$operationKey])&&$_POST["operation_$operationid"]==9){
        $this->roleOperationDao->add($roleid,$operationid);
      }

    }
    $this->redirect('Operation/oneoperation',array(operationid=>ROLE_MAINTAIN),3,'添加角色成功...');
  }


  public function editRole(){
    //权限检查
    $operationname="用户类型维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    //求出该角色对应功能数组
    $roleid = $_GET['roleid'];
    $roleRow = $this->roleDao->findById($roleid);
    $rolename = $roleRow['rolename'];
    $this->assign('rolename',$rolename);
    $operationidArray = array();
    $roleOperationArray = $this->roleOperationDao->findByRoleid($roleid);
    foreach($roleOperationArray as $value){
      array_push($operationidArray,$value[operationid]);
    }

    $this->assign('roleid',$roleid);
    //列出所有功能项
    $operationRowArray = $this->operationDao->findAll();
    $this->assign('operationRowArray',$operationRowArray);

    $this->assign('operationidArray',$operationidArray);
    $this->display('OperSystemManage/editRole');

  }
  public function editRoleSubmit(){
    //权限检查
    $operationname="用户类型维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    //更改名字
    $rolename_new = $_POST['rolename'];
    $roleid = $_POST['roleid'];
    $this->roleDao->update($roleid,$rolename_new);

    $operationRowArray = $this->operationDao->findAll();
    foreach($operationRowArray as $value){
      $operationid = $value['operationid'];
      $operationKey = "operation_".$operationid;
      if(isset($_POST[$operationKey])&&$_POST["operation_$operationid"]==9){//添加新增项
        if($this->roleOperationDao->is_roleidOperationid_exist($roleid,$operationid) == false)
          $this->roleOperationDao->add($roleid,$operationid);
      }
      else{//删除不存在项
        if($this->roleOperationDao->is_roleidOperationid_exist($roleid,$operationid))
          $this->roleOperationDao->deleteByRoleidOperationid($roleid,$operationid);
      }

    }
    $this->redirect('OperSystemManage/editRole',array(roleid=>$roleid),3,'角色修改成功...');

  }

  public function deleteRole(){
    //权限检查
    $operationname="用户类型维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $roleid = $_GET['roleid'];
    //所有 role对应的用户的roleid值置为-1；
    $userRowArray = $this->userDao->findByRoleid($roleid);
    foreach($userRowArray as $value){
      $userid = $value['userid'];
      $userRow = $this->userDao->findById($userid);
      $this->userDao->updateRoleidById($userid,-1);
    }

    //删除role相关权限
    $this->roleOperationDao->deleteByRoleid($roleid);

    //删除role项
    $this->roleDao->deleteById($roleid);

    //返回
    $this->redirect('Operation/oneoperation',array(operationid=>ROLE_MAINTAIN),3,'角色删除成功...');
  }
  //角色管理====================================================================

  //用户管理--------------------------------------------------------------------
  public function listUser(){
    //权限检查
    $operationname="用户维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $userRowArray = $this->userDao->findAll();
    foreach($userRowArray as $key=>$value){
      if($value['userid']==ROOT_USERID)unset($userRowArray[$key]);
    }
    $this->assign('userRowArray',$userRowArray);
    $this->display('OperSystemManage/listUser');
  }
  public function addUser(){
    //权限检查
    $operationname="用户维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    //列出所有角色
    $roleRowArray = $this->roleDao->findAll();
    foreach($roleRowArray as $key => $value){
      if($value['roleid']==ROOT_ROLEID)unset($roleRowArray[$key]);
    }
    $this->assign('roleRowArray',$roleRowArray);

    //列出所有非用户员工信息（id+name）
    $employerBriefArray = $this->employerDao->findAll_idEmployernumberName();
    // $userRowArray = $this->userDao->findAll();
    // $rootUserRow = $this->userDao->findById(ROOT_USERID);
    // $rootEmployerRow = $this->employerDao->findById($rootUserRow['employerid']);
    // foreach($employerBriefArray as $key => $value){
    //   if($value['employerid'] == $rootEmployerRow['employerid'])unset($employerBriefArray[$key]);
    //   else foreach($userRowArray as $key1 => $value1){
    //     if($value['employerid'] == $value1['employerid'])unset($employerBriefArray[$key]);
    //   }
    // }
    $this->assign('employerBriefArray',$employerBriefArray);
    //分公司、部门信息
    $companyRowArray = $this->companyDao->findAll();
    $departmentRowArray = $this->departmentDao->findAll();
    $this->assign('companyRowArray',$companyRowArray);
    $this->assign('departmentRowArray',$departmentRowArray);

    $this->display('OperSystemManage/addUser');
  }

  public function addUserSubmit(){
    //权限检查
    $operationname="用户维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = substr(md5($password),0,30);
    $verify_password = $_POST['verify_password'];
    $verify_password = substr(md5($verify_password),0,30);
    $companyid = $_POST['companyid'];
    $departmentid = $_POST['departmentid'];
    $phone_number = $_POST['phone_number'];
    $is_admin = 0;if(isset($_POST['is_admin']))$is_admin = 1;
    $is_leader = 0;if(isset($_POST['is_leader']))$is_leader = 1;
    $is_salary_forbidden = 0;if(isset($_POST['is_salary_forbidden']))$is_salary_forbidden = 1;
    $is_materialprice_forbidden = 0;if(isset($_POST['is_materialprice_forbidden']))$is_materialprice_forbidden = 1;
    $remark = $_POST['remark'];
    $project_authority_mode = $_POST['project_authority_mode'];
    $roleid = $_POST['roleid'];
    $employerid = $_POST['employerid'];

    if($this->userDao->is_username_exist($username)==true){
      $this->assign('message','用户名已存在！');
      $this->addUser();
      return;
    }
    if(isset($_POST['roleid']) == false){
      $this->assign('message','必须选择一个角色！');
      $this->addUser();
      return;
    }
    //存储user表
    $userid = $this->userDao->add($username,$password,$verify_password,$companyid,$departmentid,$phone_number,$is_admin,$is_leader,
      $is_salary_forbidden,$is_materialprice_forbidden,$remark,$project_authority_mode,$roleid,$employerid);
    if($userid<=0){
      $this->display('Staticpage/wrongalert');
      return;
    }
    //更新employer表
    $employerRow = $this->employerDao->findById($employerid);
    $result = $this->employerDao->updateById($employerid,$employerRow['employer_number'],$employerRow['name'],$employerRow['entrytime'],$employerRow['company_entrytime'],$employerRow['birthday'],$employerRow['companyid'],$employerRow['departmentid'],$employerRow['gender'],$employerRow['deploma'],$employerRow['political_state'],
      $employerRow['positionid'],$employerRow['salaryid'],$employerRow['id_number'],$employerRow['phone_number'],$employerRow['address'],$employerRow['zip_number'],$employerRow['hometown'],$employerRow['email'],$employerRow['qq_number'],$employerRow['contact_employerid'],
      $employerRow['is_atposition'],1);
    if($result==false){
      $this->display('Staticpage/wrongalert');
      return;
    }
    //返回结果
    $this->redirect('OperSystemManage/listUser',array(),3,'新增用户成功...');
  }

  public function editUser(){
    //权限检查
    $operationname="用户维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $userid = $_GET['userid'];
    if($userid == ROOT_USERID){
      $this->display('Staticpage/wrongalert');
      return;
    }

    $userRow = $this->userDao->findById($userid);
    $this->assign('userid',$userRow['userid']);
    $this->assign('username',$userRow['username']);
    $this->assign('password',$userRow['password']);
    $this->assign('verify_password',$userRow['verify_password']);
    $this->assign('companyid',$userRow['companyid']);
    $this->assign('departmentid',$userRow['departmentid']);
    $this->assign('phone_number',$userRow['phone_number']);
    $this->assign('is_admin',$userRow['is_admin']);
    $this->assign('is_leader',$userRow['is_leader']);
    $this->assign('is_salary_forbidden',$userRow['is_salary_forbidden']);
    $this->assign('is_materialprice_forbidden',$userRow['is_materialprice_forbidden']);
    $this->assign('remark',$userRow['remark']);
    $this->assign('project_authority_mode',$userRow['project_authority_mode']);
    $this->assign('roleid',$userRow['roleid']);
    $this->assign('employerid',$userRow['employerid']);

    //获取用户的角色
    $myRoleid = $userRow['roleid'];
    $this->assign('myRoleid',$myRoleid);
    //列出所有角色
    $roleRowArray = $this->roleDao->findAll();
    foreach($roleRowArray as $key=>$value){
      if($value['roleid']==ROOT_ROLEID&&$value['rolename']=="超级用户")unset($roleRowArray[$key]);
    }
    $this->assign('roleRowArray',$roleRowArray);

    //列出所有非用户员工信息（id+name）,包含已选择的那个员工
    $employerBriefArray = $this->employerDao->findAll_idEmployernumberName();
    $this->assign('employerBriefArray',$employerBriefArray);
    //分公司、部门信息
    $companyRowArray = $this->companyDao->findAll();
    $departmentRowArray = $this->departmentDao->findAll();
    $this->assign('companyRowArray',$companyRowArray);
    $this->assign('departmentRowArray',$departmentRowArray);

    $this->display('OperSystemManage/editUser');

  }
  public function editUserSubmit(){
    //权限检查
    $operationname="用户维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $userid = $_POST['userid'];
    if($userid == ROOT_USERID){
      $this->display('Staticpage/wrongalert');
      return;
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = substr(md5($password),0,30);
    $verify_password = $_POST['verify_password'];
    $verify_password = substr(md5($verify_password),0,30);
    $companyid = $_POST['companyid'];
    $departmentid = $_POST['departmentid'];
    $phone_number = $_POST['phone_number'];
    $is_admin = 0;if(isset($_POST['is_admin']))$is_admin = 1;
    $is_leader = 0;if(isset($_POST['is_leader']))$is_leader = 1;
    $is_salary_forbidden = 0;if(isset($_POST['is_salary_forbidden']))$is_salary_forbidden = 1;
    $is_materialprice_forbidden = 0;if(isset($_POST['is_materialprice_forbidden']))$is_materialprice_forbidden = 1;
    $remark = $_POST['remark'];
    $project_authority_mode = $_POST['project_authority_mode'];
    $roleid = $_POST['roleid'];
    $employerid = $_POST['employerid'];
    $employerRow = $this->employerDao->findById($employerid);

    $userRow = $this->userDao->findById($userid);
    $employerid_old = $userRow['employerid'];
    $employerRow_old = $this->employerDao->findById($employerid_old);
    //update用户表
    //$userRow = $this->userDao->findById($userid);
    $this->userDao->updateById($userid,$username,$password,$verify_password,$companyid,$departmentid,$phone_number,$is_admin,$is_leader,
      $is_salary_forbidden,$is_materialprice_forbidden,$remark,$project_authority_mode,$roleid,$employerid);

    //update员工表
    $result = $this->employerDao->updateById($employerid,$employerRow['employer_number'],$employerRow['name'],$employerRow['entrytime'],$employerRow['company_entrytime'],$employerRow['birthday'],$employerRow['companyid'],$employerRow['departmentid'],$employerRow['gender'],$employerRow['deploma'],$employerRow['political_state'],
      $employerRow['positionid'],$employerRow['salaryid'],$employerRow['id_number'],$employerRow['phone_number'],$employerRow['address'],$employerRow['zip_number'],$employerRow['hometown'],$employerRow['email'],$employerRow['qq_number'],$employerRow['contact_employerid'],
      $employerRow['is_atposition'],1);
    if($result==false){
      $this->display('Staticpage/wrongalert');
      return;
    }
    $result = $this->employerDao->updateById($employerid_old,$employerRow_old['employer_number'],$employerRow_old['name'],$employerRow_old['entrytime'],$employerRow_old['company_entrytime'],$employerRow_old['birthday'],$employerRow_old['companyid'],$employerRow_old['departmentid'],$employerRow_old['gender'],$employerRow_old['deploma'],$employerRow_old['political_state'],
      $employerRow_old['positionid'],$employerRow_old['salaryid'],$employerRow_old['id_number'],$employerRow_old['phone_number'],$employerRow_old['address'],$employerRow_old['zip_number'],$employerRow_old['hometown'],$employerRow_old['email'],$employerRow_old['qq_number'],$employerRow_old['contact_employerid'],
      $employerRow_old['is_atposition'],0);
    if($result==false){
      $this->display('Staticpage/wrongalert');
      return;
    }
    //返回
    $this->redirect('OperSystemManage/listUser',array(),3,"修改用户信息成功...");

  }

  public function deleteUser(){
    //权限检查
    $operationname="用户维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $userid = $_GET['userid'];
    if($userid == ROOT_USERID){
      $this->display('Staticpage/wrongalert');
      return;
    }

    $userRow = $this->userDao->findById($userid);
    $employerid = $userRow['employerid'];
    $employerRow = $this->employerDao->findById($employerid);
    //删除用户表
    $this->userDao->deleteById($userid);
    //更新员工表
    $result = $this->employerDao->updateById($employerid,$employerRow['employer_number'],$employerRow['name'],$employerRow['entrytime'],$employerRow['company_entrytime'],$employerRow['birthday'],$employerRow['companyid'],$employerRow['departmentid'],$employerRow['gender'],$employerRow['deploma'],$employerRow['political_state'],
      $employerRow['positionid'],$employerRow['salaryid'],$employerRow['id_number'],$employerRow['phone_number'],$employerRow['address'],$employerRow['zip_number'],$employerRow['hometown'],$employerRow['email'],$employerRow['qq_number'],$employerRow['contact_employerid'],
      $employerRow['is_atposition'],0);
    //返回
    $this->redirect('Operation/oneoperation',array('operationid'=>USER_MAINTAIN),3,'删除用户成功...');
  }
  //用户管理====================================================================

  //用户中心（管理个人信息）--------------------------------------------------------------------
  public function userCenter(){
    $username = $_SESSION['my_username'];
    $userRow = $this->userDao->findByUsername($username);
    $companyRow = $this->companyDao->findById($userRow['companyid']);
    $departmentRow = $this->departmentDao->findById($userRow['departmentid']);
    $roleRow = $this->roleDao->findById($userRow['roleid']);
    //基本信息（可看不可改）
    $this->assign('userRow',$userRow);
    $this->assign('companyName',$companyRow['name']);
    $this->assign('departmentName',$departmentRow['name']);
    $this->assign('roleName',$roleRow['rolename']);
    //修改登录信息（需要原密码）

    //$userid = $userRow['userid'];
    //$this->assign('userid',$userid);
    $this->display('OperSystemManage/userCenter');

  }

  public function userPassword(){
    $username = $_SESSION['my_username'];
    $userRow = $this->userDao->findByUsername($username);
    $userid = $userRow['userid'];
    $this->assign('userid',$userid);
    $this->display('OperSystemManage/userPassword');
  }

  public function userVerifyPassword(){
    $username = $_SESSION['my_username'];
    $userRow = $this->userDao->findByUsername($username);
    $userid = $userRow['userid'];
    $this->assign('userid',$userid);
    $this->display('OperSystemManage/userVerifyPassword');
  }

  public function changeLoginPasswordSubmit(){
    $username = $_SESSION['my_username'];
    $userRow = $this->userDao->findByUsername($username);
    $userid = $userRow['userid'];
    if($userid != $_POST['userid']){
      $this->display('Staticpage/wrongAlert');
      return;
    }
    $login_password_old = $_POST['login_password_old'];
    $login_password_old = substr(md5($login_password_old),0,30);
    $login_password_new = $_POST['login_password_new'];
    $login_password_new = substr(md5($login_password_new),0,30);

    if($login_password_old != $userRow['password']){
      $this->assign('message','原密码错误！');
      $this->userPassword();
      return;
    }

    $this->userDao->updatePasswordById($userid,$login_password_new);
    $this->redirect('OperSystemManage/userPassword',array(),3,'密码修改成功...');

  }

  public function changeVerifyPasswordSubmit(){
    $username = $_SESSION['my_username'];
    $userRow = $this->userDao->findByUsername($username);
    $userid = $userRow['userid'];
    if($userid != $_POST['userid']){
      $this->display('Staticpage/wrongAlert');
      return;
    }
    $verify_password_old = $_POST['verify_password_old'];
    $verify_password_old = substr(md5($verify_password_old),0,30);
    $verify_password_new = $_POST['verify_password_new'];
    $verify_password_new = substr(md5($verify_password_new),0,30);

    if($verify_password_old != $userRow['verify_password']){
      $this->assign('message','原密码错误！');
      $this->userVerifyPassword();
      return;
    }

    $this->userDao->updateVerifyPasswordById($userid,$verify_password_new);
    $this->redirect('OperSystemManage/userVerifyPassword',array(),3,'密码修改成功...');

  }
  //用户中心（管理个人信息）====================================================================

  //项目经理管理--------------------------------------------------------------------
  public function listManager(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MANAGER_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $managerRowArray = $this->managerDao->findAll();
//     foreach($userRowArray as $key=>$value){
//       if($value['userid']==ROOT_USERID)unset($userRowArray[$key]);
//     }
    $this->assign('managerRowArray',$managerRowArray);
    $this->display('OperSystemManage/listManager');
  }
  public function addManager(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MANAGER_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $this->display('OperSystemManage/addManager');
  }

  public function addManagerFromEmployer(){
		//权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = EMPLOYER_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
     $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
     return;
   }

   $companyRowArray = $this->companyDao->findAll();
   $departmentRowArray = $this->departmentDao->findAll();

   $employerRowArray = $this->employerDao->findAll();
   $userRow_root = $this->userDao->findById(ROOT_USERID);
   $employerRow_root = $this->employerDao->findById($userRow_root['employerid']);
   foreach($employerRowArray as $key => $value){
     if($value['employerid'] == $employerRow_root['employerid'])unset($employerRowArray[$key]);
   }

   $this->assign('companyRowArray',$companyRowArray);
   $this->assign('departmentRowArray',$departmentRowArray);

   $this->assign('employerRowArray',$employerRowArray);
   $this->display('OperSystemManage/addManagerFromEmployer');
 }

 public function addManagerFromEmployerSubmit(){
  $id=$_GET['employerid'];
  $employerRow = $this->employerDao->findById($id);
  $e_num=$employerRow['employer_number'];
  $e_name=$employerRow['name'];

  $this->assign('managername',$e_name);
  $this->assign('employer_number',$e_num);
  $this->display('OperSystemManage/addManager');
}
public function addManagerSubmit(){
  $managername=$_POST['managername'];
  $e_name=$_POST['employer_number'];
  $comments=$_POST['comments'];
  if($this->managerDao->is_managername_exist($managername)){
    $message="该经理已存在，如需改变请进入编辑页";
    $this->assign('message',$message);
    $this->addManager();
    return;
  }

  $managerid = $this->managerDao->add($managername,$e_name,$comments);

  $operationRowArray = $this->operationDao->findAll();
  foreach($operationRowArray as $value){
    $operationid = $value['operationid'];
    $operationKey = "operation_".$operationid;
    if(isset($_POST[$operationKey])&&$_POST["operation_$operationid"]==9){
      $this->managerOperationDao->add($managerid,$operationid);
    }

  }
  $this->redirect('Operation/oneoperation',array(operationid=>MANAGER_MAINTAIN),3,'添加角色成功...');
}


public function editManager(){
    //权限检查
  $params = array();
  $params['result'] = false;
  $params['operationid'] = MANAGER_MAINTAIN;
  tag('behavior_authoritycheck',$params);
  if($params['result'] == false){
    $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
    return;
  }

  $managerid = $_GET['managerid'];
  $managerRow = $this->managerDao->findById($managerid);
  $this->assign('managerid',$managerid);
  $this->assign('managername',$managerRow['managername']);
  $this->assign('comments',$managerRow['comments']);
  $this->display('OperSystemManage/editManager');

}
public function editManagerSubmit(){
    //更改名字
	$managerid=$_POST['managerid'];
  $managername_new = $_POST['managername'];
  $comments_new = $_POST['comments'];
  $this->managerDao->update($managerid,$managername_new,$comments_new);

  $this->redirect('OperSystemManage/listManager',array(managerid=>$managerid),3,"经理信息修改成功");

}

public function deleteManager(){
  //权限检查
  $params = array();
  $params['result'] = false;
  $params['operationid'] = MANAGER_MAINTAIN;
  tag('behavior_authoritycheck',$params);
  if($params['result'] == false){
    $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
    return;
  }

  $managerid = $_GET['managerid'];

    //删除manager项
  $this->managerDao->deleteById($managerid);

    //返回
  $this->redirect('OperSystemManage/listManager',array(operationid=>MANAGER_MAINTAIN),3,'经理删除成功...');
}
  //项目经理管理====================================================================
}

?>
