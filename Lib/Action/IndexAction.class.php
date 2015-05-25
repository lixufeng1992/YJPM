<?php
import("@.Model.ContractDao");
import("@.Model.ProjectResourceDao");
import("@.Model.ContractDocumentDao");
import("@.Model.MaterialPurchasePlanOrderDao");
import("@.Model.MaterialcontractDao");
import("@.Model.MaterialcontractDocumentDao");
import("@.Model.SubcontractDao");
import("@.Model.SubcontractDocumentDao");
class IndexAction extends LoginAfterAction {
  private $contractDao;
  private $projectResourceDao;
  private $contractDocumentDao;
  private $materialPurchasePlanOrderDao;
  private $materialcontractDao;
  private $materialcontractDocumentDao;
  private $subcontractDao;
  private $subcontractDocumentDao;

  public function _initialize(){
    parent::_initialize();
    $this->contractDao = new ContractDao();    
    $this->projectResourceDao = new ProjectResourceDao();
    $this->contractDocumentDao = new ContractDocumentDao();
    $this->materialPurchasePlanOrderDao = new MaterialPurchasePlanOrderDao();
    $this->materialcontractDao = new MaterialcontractDao(); 
    $this->materialcontractDocumentDao = new MaterialcontractDocumentDao();
    $this->subcontractDao = new SubcontractDao();
    $this->subcontractDocumentDao = new SubcontractDocumentDao();
  }

  public function index(){
    $resourceInfoArray = array();
    $resourceRowArray = $this->projectResourceDao->findAll();
    $myOperationRowArray = $this->myOperationRowArray;
    $myOperationidArray = arrayColumn($myOperationRowArray,'operationid');
    foreach($resourceRowArray as $key=>$value){
      $resourceInfo = array();
      if(in_array(PROJECT_CONTRACT,$myOperationidArray)){
        //承包合同
        $contractRowArray = $this->contractDao->findByResourceid($value['resource_id']);
        $uncheckNum=0;
        $unFinalcostNum=0;
        $uncheckDocumentNum=0;

        foreach($contractRowArray as $key1=>$value1){
          if($value1['check_userid'] == 0)$uncheckNum++;
          if($value1['finalcost_userid'] == 0)$unFinalcostNum++;
          $contractDocumentArray = $this->contractDocumentDao->findByContractid($value1['contractid']);
          foreach($contractDocumentArray as $key2=>$value2){
            if($value2['checked_userid'] == 0){
              $uncheckDocumentNum++;
              break;
            }   
          }
        }
        if($uncheckNum>0 || $unFinalcostNum>0 || $uncheckDocumentNum>0){
          $resourceInfo['resource_id'] = $value['resource_id'];
          $resourceInfo['name'] = $value['resource_name'];

          $resourceInfo['contract'] = 1;
          $resourceInfo['materialPlan'] = 0;
          $resourceInfo['materialcontract'] = 0;
          $resourceInfo['subcontract'] = 0;

          $resourceInfo['contract_uncheckNum'] = $uncheckNum;
          $resourceInfo['contract_unFinalcostNum'] = $unFinalcostNum;
          $resourceInfo['contract_uncheckDocumentNum'] = $uncheckDocumentNum;
        }
      }
      //材料采购计划
      if(in_array(PROJECT_CONTRACT,$myOperationidArray)){
        $materialPlanRowArray = $this->materialPurchasePlanOrderDao->findByResourceid($value['resource_id']);
        $uncheckNum = 0;
        $unfinishNum = 0;
        foreach($materialPlanRowArray as $key1=>$value1){
          if($value1['verify'] == 0)$uncheckNum++;
          if($value1['finish'] == 0)$unfinishNum++;
        }
        if($uncheckNum>0 || $unfinishNum>0){
          if(isset($resourceInfo['resource_id']) == false){
            $resourceInfo['resource_id'] = $value['resource_id'];
            $resourceInfo['name'] = $value['resource_name'];
            $resourceInfo['contract'] = 0;
            $resourceInfo['materialcontract'] = 0;
            $resourceInfo['subcontract'] = 0;
          }

          $resourceInfo['materialPlan'] = 1;
          $resourceInfo['materialPlan_uncheckNum'] = $uncheckNum;
          $resourceInfo['materialPlan_unfinishNum'] = $unfinishNum;
        }
      }
      //材料采购合同
      if(in_array(PROJECT_CONTRACT,$myOperationidArray)){
        $materialcontractRowArray = $this->materialcontractDao->findByResourceid($value['resource_id']);
        $uncheckNum = 0;
        $unfinalcostNum = 0;
        $uncheckDocumentNum = 0;
        foreach($materialcontractRowArray as $key1=>$value1){
          if($value1['check_userid'] == 0)$uncheckNum++;
          if($value1['finalcost_userid'] == 0)$unfinalcostNum++;
          $materialcontractDocumentRowArray = $this->materialcontractDocumentDao->findByContractid($value1['contractid']);
          foreach($materialcontractDocumentRowArray as $key2=>$value2){
            if($value2['checked_userid'] == 0){
              $uncheckDocumentNum++;
              break;
            }
          } 
        }
        if($uncheckNum>0 || $unfinalcostNum>0 || $uncheckDocumentNum>0){
          if(isset($resourceInfo['resource_id']) == false){
            $resourceInfo['resource_id'] = $value['resource_id'];
            $resourceInfo['name'] = $value['resource_name'];
            $resourceInfo['contract'] = 0;
            $resourceInfo['materialPlan'] = 0;
            $resourceInfo['subcontract'] = 0;
          }
          $resourceInfo['materialcontract'] = 1;
          $resourceInfo['materialcontract_uncheckNum'] = $uncheckNum;
          $resourceInfo['materialcontract_unfinalcostNum'] = $unfinalcostNum;
          $resourceInfo['materialcontract_uncheckDocumentNum'] = $uncheckDocumentNum;
        }
      }
      //分包合同
      if(in_array(PROJECT_CONTRACT,$myOperationidArray)){
        $subcontractRowArray = $this->subcontractDao->findByResourceid($value['resource_id']);
        $uncheckNum = 0;
        $unfinalcostNum = 0;
        $uncheckDocumentNum = 0;
        foreach($subcontractRowArray as $key1=>$value1){
          if($value1['check_userid'] == 0)$uncheckNum++;
          if($value1['finalcost_userid'] == 0)$unfinalcostNum++;
          $subcontractDocumentRowArray = $this->subcontractDocumentDao->findByContractid($value1['contractid']);
          foreach($subcontractDocumentRowArray as $key2=>$value2){
            if($value2['checked_userid'] == 0){
              $uncheckDocumentNum++;
              break;
            }
          } 
        }
        if($uncheckNum>0 || $unfinalcostNum>0 || $uncheckDocumentNum>0){
          if(isset($resourceInfo['resource_id']) == false){
            $resourceInfo['resource_id'] = $value['resource_id'];
            $resourceInfo['name'] = $value['resource_name'];
            $resourceInfo['contract'] = 0;
            $resourceInfo['materialPlan'] = 0;
            $resourceInfo['materialcontract'] = 0;
          }
          $resourceInfo['subcontract'] = 1;
          $resourceInfo['subcontract_uncheckNum'] = $uncheckNum;
          $resourceInfo['subcontract_unfinalcostNum'] = $unfinalcostNum;
          $resourceInfo['subcontract_uncheckDocumentNum'] = $uncheckDocumentNum;
        }
      }
      //存储
      if(isset($resourceInfo['resource_id']) == true){
        $resourceInfoArray[] = $resourceInfo;
      }
    }

    $this->assign('resourceInfoArray',$resourceInfoArray);
    $this->display('Index/index');
  }
}


?>
