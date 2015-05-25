<?php
import("@.Model.CompanyDao");
import("@.Model.PositionDao");
import("@.Model.DepartmentDao");

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
    case SUBCONTRACT_MAINTAIN://分包维护
      $this->redirect('OperSubcontractManage/listSubcontract');
      break;

    case ROLE_MAINTAIN://角色维护
      $this->redirect('OperSystemManage/listRole');
      break;
    case USER_MAINTAIN://用户维护
      $this->redirect('OperSystemManage/listUser');
      break;
    case EMPLOYER_MAINTAIN://员工维护
      $this->redirect('OperHumanResource/listEmployer');
      break;
    case ENTERPRISE_MAINTAIN://往来单位维护
      $this->redirect('OperSystemManage/listEnterprise');
      break;
    case DEPARTMENT_MAINTAIN://部门维护
      $this->redirect('OperHumanResource/listDepartment');
      break;
    case POSITION_MAINTAIN://职务维护
      $this->redirect('OperHumanResource/listPosition');
      break;	
    case COMPANY_MAINTAIN://分公司维护
      $this->redirect('OperHumanResource/listCompany');
    case SYSTEM_SETTING://系统设置
      $this->display('systemSetting');
      break;
    case PROCESS_MAINTAIN: //项目部位维护
      $this->redirect('OperBasicInfoManage/listProcess');
      break;
    default:
      $this->display('Staticpage/wrongalert');
      break;
    }
  }



}

?>
