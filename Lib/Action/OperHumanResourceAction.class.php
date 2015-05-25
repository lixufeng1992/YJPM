<?php
import("@.Model.CompanyDao");
import("@.Model.PositionDao");
import("@.Model.EmployerDao");
import("@.Model.DepartmentDao");

header('Content-Type:text/html;charset=utf-8');

class OperHumanResourceAction extends LoginAfterAction{
	private $companyDao;
	private $positionDao;
	private $employerDao;
	private $departmentDao;

  public function _initialize(){
    parent::_initialize();
    $this->companyDao = new CompanyDao();
    $this->positionDao = new PositionDao();
    $this->employerDao = new EmployerDao();
    $this->departmentDao = new DepartmentDao();

  }
	//员工管理------------------------------------------------------------------------------------
	public function listEmployer(){
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
		$this->display('OperHumanResource/listEmployer');
	}
	
	public function searchEmployer(){
		//权限检查
		$params = array();
		$params['result'] = false;
		$params['operationid'] = EMPLOYER_MAINTAIN;
		tag('behavior_authoritycheck',$params);
		if($params['result'] == false){
			$this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
			return;
		}

		$employerRowArray = $this->employerDao->findAll();
		$this->assign('employerRowArray',$employerRowArray);
		
		$companyRowArray = $this->companyDao->findAll();
		$departmentRowArray = $this->departmentDao->findAll();
		$positionRowArray = $this->positionDao->findAll();
		
		$this->assign('companyRowArray',$companyRowArray);
		$this->assign('departmentRowArray',$departmentRowArray);
		$this->assign('positionRowArray',$positionRowArray);
		$this->display('OperHumanResource/searchEmployer');
	}
	
	public function addEmployer(){
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
		$positionRowArray = $this->positionDao->findAll();
		$employer_idName_array = $this->employerDao->findAll_idName();

		
		$this->assign('companyRowArray',$companyRowArray);
		$this->assign('departmentRowArray',$departmentRowArray);
		$this->assign('positionRowArray',$positionRowArray);
		$this->assign('employer_idName_array',$employer_idName_array);

		$this->display('OperHumanResource/addEmployer');
	}

	public function addEmployerSubmit(){
		$employer_number = $_POST['employer_number'];
		$name = $_POST['name'];
		$entrytime = date("Y-m-d",strtotime($_POST['entrytime']));
		$company_entrytime = date("Y-m-d",strtotime($_POST['company_entrytime']));
		$birthday = date("Y-m-d",strtotime($_POST['birthday']));
		$companyid = $_POST['companyid'];
		$departmentid = $_POST['departmentid'];
		$gender = $_POST['gender'];
		$deploma = $_POST['deploma'];
		$political_state = $_POST['political_state'];
		$positionid = $_POST['positionid'];
		$salaryid=0;
		$id_number = $_POST['id_number'];
		$phone_number = $_POST['phone_number'];
		$address = $_POST['address'];
		$zip_number = $_POST['zip_number'];
		$hometown = $_POST['hometown'];
		$email = $_POST['email'];
		$qq_number = $_POST['qq_number'];
		$contact_employerid = $_POST['contact_employerid'];
		$is_atposition = $_POST['is_atposition'];
		$is_user = 0;

		$result = $this->employerDao->add($employer_number,$name,$entrytime,$company_entrytime,$birthday,$companyid,$departmentid,$gender,$deploma,$political_state,$positionid,
								$salaryid,$id_number,$phone_number,$address,$zip_number,$hometown,$email,$qq_number,$contact_employerid,$is_atposition,
								$is_user);
		if($result == -1)$this->display('Staticpage/wrongalert');
		else $this->redirect('Operation/oneoperation',array('operationid'=>EMPLOYER_MAINTAIN),3,'添加员工成功...');
	}

	public function editEmployer(){
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
		$positionRowArray = $this->positionDao->findAll();
		$employer_idName_array = $this->employerDao->findAll_idName();
		
		$this->assign('companyRowArray',$companyRowArray);
		$this->assign('departmentRowArray',$departmentRowArray);
		$this->assign('positionRowArray',$positionRowArray);
		$this->assign('employer_idName_array',$employer_idName_array);

		$employerid = $_GET['employerid'];
		$userRow_root = $this->userDao->findById(ROOT_USERID);
		if($employerid == $userRow_root['employerid']){$this->display('Staticpage/wrongalert');return;}

		$employerRow = $this->employerDao->findById($employerid);
		$this->assign('employerRow',$employerRow);
		$this->display('OperHumanResource/editEmployer');
	}

	public function editEmployerSubmit(){
		$employer_number = $_POST['employer_number'];
		$employerid = $_POST['employerid'];
		$userRow_root = $this->userDao->findById(ROOT_USERID);
		if($employerid == $userRow_root['employerid']){$this->display('Staticpage/wrongalert');return;}
		$name = $_POST['name'];
		$entrytime = date("Y-m-d",strtotime($_POST['entrytime']));
		$company_entrytime = date("Y-m-d",strtotime($_POST['company_entrytime']));
		$birthday = date("Y-m-d",strtotime($_POST['birthday']));
		$companyid = $_POST['companyid'];
		$departmentid = $_POST['departmentid'];
		$gender = $_POST['gender'];
		$deploma = $_POST['deploma'];
		$political_state = $_POST['political_state'];
		$positionid = $_POST['positionid'];
		$salaryid=0;
		$id_number = $_POST['id_number'];
		$phone_number = $_POST['phone_number'];
		$address = $_POST['address'];
		$zip_number = $_POST['zip_number'];
		$hometown = $_POST['hometown'];
		$email = $_POST['email'];
		$qq_number = $_POST['qq_number'];
		$contact_employerid = $_POST['contact_employerid'];
		$is_atposition = $_POST['is_atposition'];
		$is_user = 0;

		$result = $this->employerDao->updateById($employerid,$employer_number,$name,$entrytime,$company_entrytime,$birthday,$companyid,$departmentid,$gender,$deploma,$political_state,
									$positionid,$salaryid,$id_number,$phone_number,$address,$zip_number,$hometown,$email,$qq_number,$contact_employerid,
									$is_atposition,$is_user);

		if($result == true)$this->redirect('Operation/oneoperation',array('operationid'=>EMPLOYER_MAINTAIN),3,'编辑员工信息成功...');
		else $this->display('Staticpage/wrongalert');

	}

	public function deleteEmployer(){
		//权限检查
		$params = array();
		$params['result'] = false;
		$params['operationid'] = EMPLOYER_MAINTAIN;
		tag('behavior_authoritycheck',$params);
		if($params['result'] == false){
			$this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
			return;
		}

		$employerid = $_GET['employerid'];
		$userRow_root = $this->userDao->findById(ROOT_USERID);
		if($employerid == $userRow_root['employerid']){$this->display('Staticpage/wrongalert');return;}
		$result = $this->employerDao->deleteById($employerid);
		if($result == true)$this->redirect('Operation/oneoperation',array('operationid'=>EMPLOYER_MAINTAIN),3,'删除员工成功...');
		else $this->display('Staticpage/wrongalert');
	}
	//员工管理====================================================================================

	//部门维护--------------------------------------------------------------------------------
	public function listDepartment(){
		//权限检查
		$params = array();
		$params['result'] = false;
		$params['operationid'] = DEPARTMENT_MAINTAIN;
		tag('behavior_authoritycheck',$params);
		if($params['result'] == false){
			$this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
			return;
		}

		$departmentRowArray = $this->departmentDao->findAll();
		$this->assign('departmentRowArray',$departmentRowArray);
		$this->display('OperHumanResource/editDepartment');
	}

	public function addDepartmentSubmit(){
		$name = $_POST['name'];
		$this->departmentDao->add($name);
		$this->redirect('OperHumanResource/listDepartment',array(),3,"添加部门成功...");
	}

	public function editDepartmentSubmit(){
		$departmentid = $_POST['departmentid'];
		$name = $_POST['name'];
		$result = $this->departmentDao->updateById($departmentid,$name);
		if($result == true)$this->redirect('OperHumanResource/listDepartment',array(),3,"修改部门名称成功...");
		else $this->display('Staticpage/wrongalert');
	}

	public function deleteDepartment(){
		//权限检查
		$params = array();
		$params['result'] = false;
		$params['operationid'] = DEPARTMENT_MAINTAIN;
		tag('behavior_authoritycheck',$params);
		if($params['result'] == false){
			$this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
			return;
		}

		$departmentid = $_GET['departmentid'];
		$result = $this->departmentDao->deleteById($departmentid);
		if($result == true)$this->redirect('OperHumanResource/listDepartment',array(),3,"删除部门成功...");
		else $this->display('Staticpage/wrongalert');
	}
	//部门维护================================================================================
	//分公司维护--------------------------------------------------------------------------------
	public function listCompany(){
		//权限检查
		$params = array();
		$params['result'] = false;
		$params['operationid'] = COMPANY_MAINTAIN;
		tag('behavior_authoritycheck',$params);
		if($params['result'] == false){
			$this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
			return;
		}

		$companyRowArray = $this->companyDao->findAll();
		$this->assign('companyRowArray',$companyRowArray);
		$this->display('OperHumanResource/editCompany');
	}

	public function addCompanySubmit(){
		$name = $_POST['name'];
		$this->companyDao->add($name);
		$this->redirect('OperHumanResource/listCompany',array(),3,"添加分公司成功...");
	}

	public function editCompanySubmit(){
		$companyid = $_POST['companyid'];
		$name = $_POST['name'];
		$result = $this->companyDao->updateById($companyid,$name);
		if($result == true)$this->redirect('OperHumanResource/listCompany',array(),3,"修改分公司名称成功...");
		else $this->display('Staticpage/wrongalert');
	}

	public function deleteCompany(){
		//权限检查
		$params = array();
		$params['result'] = false;
		$params['operationid'] = COMPANY_MAINTAIN;
		tag('behavior_authoritycheck',$params);
		if($params['result'] == false){
			$this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
			return;
		}

		$companyid = $_GET['companyid'];
		$result = $this->companyDao->deleteById($companyid);
		if($result == true)$this->redirect('OperHumanResource/listCompany',array(),3,"删除分公司成功...");
		else $this->display('Staticpage/wrongalert');
	}
	//分公司维护================================================================================

	//职务维护--------------------------------------------------------------------------------
	public function listPosition(){
		//权限检查
		$params = array();
		$params['result'] = false;
		$params['operationid'] = POSITION_MAINTAIN;
		tag('behavior_authoritycheck',$params);
		if($params['result'] == false){
			$this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
			return;
		}

		$positionRowArray = $this->positionDao->findAll();
		$this->assign('positionRowArray',$positionRowArray);
		$this->display('OperHumanResource/editPosition');
	}

	public function addPositionSubmit(){
		$name = $_POST['name'];
		$this->positionDao->add($name);
		$this->redirect('OperHumanResource/listPosition',array(),3,"添加职务成功...");
	}

	public function editPositionSubmit(){
		$positionid = $_POST['positionid'];
		$name = $_POST['name'];
		$result = $this->positionDao->updateById($positionid,$name);
		if($result == true)$this->redirect('OperHumanResource/listPosition',array(),3,"修改职务名称成功...");
		else $this->display('Staticpage/wrongalert');
	}

	public function deletePosition(){
		//权限检查
		$params = array();
		$params['result'] = false;
		$params['operationid'] = POSITION_MAINTAIN;
		tag('behavior_authoritycheck',$params);
		if($params['result'] == false){
			$this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
			return;
		}
		
		$positionid = $_GET['positionid'];
		$result = $this->positionDao->deleteById($positionid);
		if($result == true)$this->redirect('OperHumanResource/listPosition',array(),3,"删除职务成功...");
		else $this->display('Staticpage/wrongalert');
	}

	//职务维护================================================================================

}

?>
