<?php
require_once dirname(__FILE__).'/../auto_load.php';
// import("@.Model.CompanyDao");
// import("@.Model.PositionDao");
// import("@.Model.DepartmentDao");

class OperationAction extends LoginAfterAction{
  private $companyDao;
  private $positionDao;
  private $departmentDao;

  public function _initialize(){
    parent::_initialize();
    $this->companyDao=new CompanyDao();
    $this->positionDao=new PositionDao();
    $this->departmentDao=new DepartmentDao();
}

public function oneoperation(){
    $operationid = $_GET['operationid'];
    switch($operationid){

    // 项目管理
    case PROJECT_EXPLORE://项目开拓
    $this->redirect('OperProjectManage/listProject');
    break;
    case PROJECT_MAINTAIN://项目维护
    $this->redirect('OperProjectManage/projectResource');
    break;
    case PROJECT_CONTRACT://承包合同
    $this->redirect('OperProjectManage/listContract');
    break;
    case PROJECT_SCHEDULE_INPUT://项目进度填报
    $this->redirect('OperProjectManage/resourceProcess');
    break;
    case PROJECT_SCHEDULE_SHOW://项目形象进度
    $this->redirect('OperProjectManage/chartsProcess');
    break;
      // case MISSION_PLAN://任务进度计划
      // 	$this->display('missionPlan');
      // 	break;

    // 材料管理
    case MATERIAL_MAINTAIN://材料维护
    $this->redirect('OperMaterialManage/materialMaintain');
    break;
    case MATERIAL_ENQUIRY://材料询价
    $this->redirect('OperMaterialManage/materialEnquiry');
    break;
    case MATERIAL_PURCHASE_ORDER://材料采购单
    $this->redirect('OperMaterialManage/listPurchaseOrder');
    break;
    case PURCHASE_PLAN_ORDER: //材料采购计划单
    $this->redirect('OperMaterialManage/listPurchasePlanOrder');
    break;
    case MATERIAL_CONTRACT://材料合同
    $this->redirect('OperMaterialManage/listContract');
    break;
    case MATERIAL_OUTBOUND_ORDER: //材料出库
    $this->redirect('OperMaterialManage/listOutboundOrder');
    break;
    case MATERIAL_INVENTORY: //库存情况
    $this->redirect('OperMaterialManage/listInventory');
    break;

    // 分包管理
    case SUBCONTRACT_MAINTAIN://分包维护
    $this->redirect('OperSubcontractManage/listSubcontract');
    break;

    // 租赁管理
    case RENT_MAINTAIN: //租赁维护
    $this->redirect('OperRentManage/rentMaterialMaintain');
    break;
    case RENT_ENQUIRY: //租赁询价
    $this->redirect('OperRentManage/rentMaterialEnquiry');
    break;
    case RENT_CONTRACT: //租赁合同
    $this->redirect('OperRentManage/listRentContract');
    break;
    case RENT_IN_ORDER: //租赁租入单
    $this->redirect('OperRentManage/listRentInOrder');
    break;
    case RENT_OUT_ORDER: //租赁还租单
    $this->redirect('OperRentManage/listRentOutOrder');
    break;

    // 人力资源
    case EMPLOYER_MAINTAIN://员工维护
    $this->redirect('OperHumanResource/listEmployer');
    break;
    case DEPARTMENT_MAINTAIN://部门维护
    $this->redirect('OperHumanResource/listDepartment');
    break;
    case POSITION_MAINTAIN://职务维护
    $this->redirect('OperHumanResource/listPosition');
    break;
    case COMPANY_MAINTAIN://分公司维护
    $this->redirect('OperHumanResource/listCompany');
    break;

    //基础信息
    case PROCESS_MAINTAIN: //项目部位维护
    $this->redirect('OperBasicInfoManage/listProcess');
    break;
    case ENTERPRISE_MAINTAIN://往来单位维护
    $this->redirect('OperBasicInfoManage/listEnterprise');
    break;

    //财务管理
    case OTHER_BUDGET://财务预算单
    $this->redirect('OperFinanceManage/listOtherBudget');
    break;
    case OTHER_EXACCT_CLASSIFY:
    $this->redirect('OperFinanceManage/classifyOtherExpense');
    break;
    case OTHER_EXACCT_MAINTAIN:
    $this->redirect('OperFinanceManage/maintainOtherExpense');
    break;

    // 系统管理
    case ROLE_MAINTAIN://角色维护
    $this->redirect('OperSystemManage/listRole');
    break;
    case USER_MAINTAIN://用户维护
    $this->redirect('OperSystemManage/listUser');
    break;
  //   case ENTERPRISE_MAINTAIN://往来单位维护
  //     $this->redirect('OperSystemManage/listEnterprise');
  //     break;
  //   case COMPANY_MAINTAIN: //子公司维护
  //     $this->redirect('OperHumanResource/listCompany');
  //     break;
	// case MANAGER_MAINTAIN://项目经理维护
	//   $this->redirect('OperSystemManage/listManager');
	//   break;
  //   case PROCESS_MAINTAIN: //项目部位维护
  //     $this->redirect('OperSystemManage/listProcess');
  //     break;

    // case SYSTEM_SETTING://系统设置
    //   $this->display('systemSetting');
    //   break;
    //   

    //设备管理
    case DEVICE_CLASS_MAINTAIN://设备工种维护
    $this->redirect('OperDeviceManager/deviceClassMaintain');
    break;
    case DEVICE_MAINTAIN://设备维护
    $this->redirect('OperDeviceManager/deviceMaintain');
    case DEVICE_PURCHASING://设备采购
    $this->redirect('OperDeviceManager/devicePurchase');
    break;

    default:
    $this->display('Staticpage/wrongalert');
    break;
}
}



}

?>
