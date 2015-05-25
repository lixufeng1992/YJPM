<?php
import("@.Model.ProjectResourceDao");
import("@.Model.EnterpriseDao");
import("@.Model.SubcontractDao");
import("@.Model.EmployerDao");
import("@.Model.DepartmentDao");
import("@.Model.CompanyDao");
import("@.Model.SubcontractContentDao");
import("@.Model.SubcontractDocumentDao");
import("@.Model.SubcontractDocumentOriginDao");

header('Content-Type:text/html;charset=utf-8');
class OperSubcontractManageAction extends LoginAfterAction{
  private $projectResourceDao;
  private $enterpriseDao;
  private $subcontractDao;
  private $employerDao;
  private $departmentDao;
  private $companyDao;
  private $subcontractContentDao;
  private $subcontractDocumentDao;
  private $subcontractDocumentOriginDao;

  public function _initialize(){
    parent::_initialize();
    $this->projectResourceDao=new ProjectResourceDao();
    $this->enterpriseDao=new EnterpriseDao();
    $this->subcontractDao=new SubcontractDao();
    $this->employerDao=new EmployerDao();
    $this->departmentDao=new DepartmentDao();
    $this->companyDao=new CompanyDao();
    $this->subcontractContentDao=new SubcontractContentDao();
    $this->subcontractDocumentDao=new SubcontractDocumentDao();
    $this->subcontractDocumentOriginDao=new SubcontractDocumentOriginDao();

  }

  //分包合同
  public function listSubcontract(){
    $params = array();
    $params['result'] = false;
    $params['operationid'] = SUBCONTRACT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resourceRowArray = $this->projectResourceDao->findAll();
    $this->assign('resourceRowArray',$resourceRowArray);
    $resource_id = $_GET['resource_id'];
    $resourceRow = $this->projectResourceDao->findById($resource_id);
    $this->assign('resourceRow',$resourceRow);
    if(isset($_GET['resource_id']) == false){
      $this->assign('treeExist',true);
      $this->display('OperSubcontractManage/listSubcontract');
      return;
    }
    $this->assign('treeExist',false);
    $resourceRow = $this->projectResourceDao->findById($_GET['resource_id']);
    $this->assign('resource_name',$resourceRow['resource_name']);
    $subcontractRowArray = $this->subcontractDao->findByResourceid($_GET['resource_id']);
    foreach($subcontractRowArray as $key=>$value){
      $userid = $value['create_userid'];
      $userInfoArray = $this->userInfoByUserid($userid);
      $subcontractRowArray[$key]['create_userInfo'] = $userInfoArray['name']."[".$userInfoArray['employer_number']."]";
      if($value['finalcost_userid'] == 0)$subcontractRowArray[$key]['finalcost'] = "未结算";
      else $subcontractRowArray[$key]['finalcost'] = "已结算";
      if($value['check_userid'] == 0)$subcontractRowArray[$key]['check'] = "未审核";
      else $subcontractRowArray[$key]['check'] = "已审核";
    }
    $this->assign('subcontractRowArray',$subcontractRowArray);
    $this->display('OperSubcontractManage/listSubcontract');
  }

  public function checkSubcontract(){
    $contractid = $_POST['contractid'];
    $returnData = array();
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $check_userid = $userRow['userid'];
    $result = $this->subcontractDao->updateCheckstatusById($contractid,$check_userid);
    if($result){
      $returnData['check_userid'] = $check_userid;
      echo json_encode($returnData);
    }
  }

  public function cancelcheckSubcontract(){
    $contractid = $_POST['contractid'];
    $returnData = array();

    $result = $this->subcontractDao->updateCheckstatusById($contractid,0);
    if($result){
      $check_userid = 0;
      $returnData['check_userid'] = $check_userid;
      echo json_encode($returnData);
    }
  }

  public function finalcostSubcontract(){
    $contractid = $_POST['contractid'];
    $returnData = array();
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $finalcost_userid = $userRow['userid'];
    $result = $this->subcontractDao->updateFinalcoststatusById($contractid,$finalcost_userid);
    if($result){
      $returnData['finalcost_userid'] = $finalcost_userid;
      echo json_encode($returnData);
    }
  }

  public function cancelfinalcostSubcontract(){
    $contractid = $_POST['contractid'];
    $returnData = array();

    $result = $this->subcontractDao->updateFinalcoststatusById($contractid,0);
    if($result){
      $finalcost_userid = 0;
      $returnData['finalcost_userid'] = $finalcost_userid;
      echo json_encode($returnData);
    }
  }




  public function addSubcontract(){
    $params = array();
    $params['result'] = false;
    $params['operationid'] = SUBCONTRACT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resourceRowArray = $this->projectResourceDao->findAll();
    $this->assign('resourceRowArray',$resourceRowArray);
    $enterpriseRowArray = $this->enterpriseDao->findAll();
    $this->assign('enterpriseRowArray',$enterpriseRowArray);

    if(isset($_GET['resource_id']) == false){
      $this->assign('treeExist',1);
      //$this->assign('formReadOnly',true);
      $this->display('OperSubcontractManage/addSubcontract');
      return;
    }
    $this->assign('treeExist',0);

    $resourceRow = $this->projectResourceDao->findById($_GET['resource_id']);
    $this->assign('resourceRow',$resourceRow);
    $this->display('OperSubcontractManage/addSubcontract');

  }

  public function addSubcontractSubmit(){
    //$contractid,
    $resource_id=$_POST['resource_id'];
    $contract_number=$_POST['contract_number'];
    $name=$_POST['name'];
    $contract_type=$_POST['contract_type'];
    $a_part_enterpriseid=$_POST['a_part_enterpriseid'];
    $b_part_enterpriseid=$_POST['b_part_enterpriseid'];
    $build_pattern=$_POST['build_pattern'];
    $contract_status=$_POST['contract_status'];
    $construction_start_date=$_POST['construction_start_date'];
    $construction_finish_date=$_POST['construction_finish_date'];
    $sign_date=$_POST['sign_date'];
    $report_price=$_POST['report_price'];
    $pay_baseprice_according=$_POST['pay_baseprice_according'];
    $margin_amount=$_POST['margin_amount'];
    $pay_limit=$_POST['pay_limit'];
    if(isset($_POST['check_grossamount_control']) == true)$check_grossamount_control = 1;
    else $check_grossamount_control = 0;

    $main_content=$_POST['main_content'];
    $other_limit_condition=$_POST['other_limit_condition'];

    $create_date = date("Y-m-d",time());
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $create_userid = $userRow['userid'];
    $finalcost_userid=0;
    $check_userid=0;
    $contractid = $this->subcontractDao->add($resource_id,$contract_number,$name,$contract_type,$a_part_enterpriseid,
      $b_part_enterpriseid,$build_pattern,$contract_status,$construction_start_date,$construction_finish_date,
      $sign_date,$report_price,$pay_baseprice_according,$margin_amount,$pay_limit,
      $check_grossamount_control,$main_content,$other_limit_condition,$create_userid,$create_date,
      $finalcost_userid,$check_userid,"");
    if($contractid <= 0){
      $this->display('Staticpage/wrongalert');
      return;
    }
    $this->redirect('OperSubcontractManage/listSubcontract',array('resource_id'=>$resource_id),3,"添加分包合同成功...");

  }

  public function editSubcontract(){
    $params = array();
    $params['result'] = false;
    $params['operationid'] = SUBCONTRACT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    if(isset($_POST['contract_id'])==false){
      $this->display('Staticpage/wrongalert');
      return;
    }
    $contractRow = $this->subcontractDao->findById($_POST['contract_id']);
    $this->assign('contractRow',$contractRow);
    $a_part_enterpriseRow = $this->enterpriseDao->findById($contractRow['a_part_enterpriseid']);
    $this->assign('a_part_enterpriseRow',$a_part_enterpriseRow);
    $b_part_enterpriseRow = $this->enterpriseDao->findById($contractRow['b_part_enterpriseid']);
    $this->assign('b_part_enterpriseRow',$b_part_enterpriseRow);

    $enterpriseRowArray = $this->enterpriseDao->findAll();
    $this->assign('enterpriseRowArray',$enterpriseRowArray);

    $subcontractcontenRowArray = $this->subcontractContentDao->findByContractid($_POST['contract_id']);
    $this->assign('contractcontenRowArray',$subcontractcontenRowArray);

    $contrcatdocumentRowArray = $this->subcontractDocumentDao->findByContractid($_POST['contract_id']);
    foreach($contrcatdocumentRowArray as $key=>$value){
      //后缀
      $path = $value['path'];
      $suffix = substr($path,strrpos($path,'.')+1);
      $contrcatdocumentRowArray[$key]['suffix'] = $suffix;
      //创建用户
      $create_userid = $value['create_userid'];
      $createuserInfoArray = $this->userInfoByUserid($create_userid);
      $contrcatdocumentRowArray[$key]['create_userInfo'] = $createuserInfoArray['name']."[".$createuserInfoArray['employer_number']."]";
      //最后修改用户
      $lastupdate_userid = $value['lastupdate_userid'];
      $lastupdateuserInfoArray = $this->userInfoByUserid($lastupdate_userid);
      $contrcatdocumentRowArray[$key]['lastupdate_userInfo'] = $lastupdateuserInfoArray['name']."[".$lastupdateuserInfoArray['employer_number']."]";

    }
    $this->assign('contrcatdocumentRowArray',$contrcatdocumentRowArray);
    $contractdocument_originRowArray = $this->subcontractDocumentOriginDao->findByContractid($_POST['contract_id']);
    foreach($contractdocument_originRowArray as $key=>$value){
      $path = $value['path'];
      $suffix = substr($path,strrpos($path,'.')+1);
      $contractdocument_originRowArray[$key]['suffix'] = $suffix;
    }

    $this->assign('contractdocument_originRowArray',$contractdocument_originRowArray);

    $this->display('OperSubcontractManage/editSubcontract');
  }

  // public function editSubcontract_uploadfile(){

  // }

  // public function editSubcontract_checkDocument(){

  // }

  // public function editSubcontract_deletefile(){

  // }

  //---------------------------------------
  public function editSubcontract_uploadfile(){
    $returnData = array();
    //$returnData['documentid'] = -1;
    //echo json_encode($returnData);
    //return;

    $doc_name = $_POST['name'];
    $doc_remark = $_POST['remark'];
    $contractid = $_POST['contractid'];
    $result = 0;
    $contractRow = $this->subcontractDao->findById($contractid);

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $userInfoArray = $this->userInfoByUserid($userRow['userid']);

    //存储数据库信息
    $insertId = $this->subcontractDocumentDao->add($contractid,$doc_name,"",$doc_remark,$userRow['userid'],$userRow['userid'],0);
    if($insertId <= 0){$returnData['documentid'] = $insertId;echo json_encode($returnData);return;}

    //存储文件
    $dirPath = "Data/resource_".$contractRow['resource_id']."/subcontract_".$contractid."/doc_e";
    $suffix="";

    $result = func_createFile($dirPath,$insertId,$_FILES['documentFile1'],$suffix);

    //if($result <= 0){$returnData['documentid'] = $result;echo json_encode($returnData);return;}
    //更新数据库信息
    $contractDocumentRow = $this->subcontractDocumentDao->findById($insertId);
    $path = $dirPath."/".$insertId.".".$suffix;
    $result = $this->subcontractDocumentDao->updateById($insertId,$contractDocumentRow['contractid'],$contractDocumentRow['name'],$path,$contractDocumentRow['remark'],$contractDocumentRow['create_userid'],$contractDocumentRow['lastupdate_userid'],$contractDocumentRow['checked_userid']);
    if($result == false){$returnData['documentid'] = -5;echo json_encode($returnData);return;}

    //返回
    $returnData['documentid'] = $insertId;
    $returnData['doc_name'] = $doc_name;
    $returnData['doc_remark'] = $doc_remark;
    $returnData['suffix'] = $suffix;
    $returnData['create_userInfo'] = $userInfoArray['name']."[".$userInfoArray['employer_number']."]";
    $returnData['lastupdate_userInfo'] = $userInfoArray['name']."[".$userInfoArray['employer_number']."]";
    $returnData['download_url'] = U('OperSubcontractManage/editSubcontract_downloadDocument',array('documentid'=>$returnData['documentid']));

    echo json_encode($returnData);

  }

  public function editSubcontract_uploadfileOrigin(){
    $doc_name = $_POST['name'];
    $doc_remark = $_POST['remark'];
    $contractid = $_POST['contractid'];
    $result = 0;
    $contractRow = $this->subcontractDao->findById($contractid);
    $returnData = array();

    //存储数据库信息
    $insertId = $this->subcontractDocumentOriginDao->add($contractid,$doc_name,"",$doc_remark);
    if($insertId <= 0){$returnData['documentid'] = $insertId;echo json_encode($returnData);return;}

    //存储文件
    $dirPath = "Data/resource_".$contractRow['resourceid']."/subcontract_".$contractid."/doc_origin/";
    $suffix="";
    $result = func_createFile($dirPath,$insertId,$_FILES['documentFile'],$suffix);
    if($result <= 0){$returnData['documentid'] = $result;echo json_encode($returnData);return;}
    //更新数据库信息
    $contractDocumentOriginRow = $this->subcontractDocumentOriginDao->findById($insertId);
    $path = $dirPath.$insertId.".".$suffix;
    $result = $this->subcontractDocumentOriginDao->updateById($insertId,$contractDocumentOriginRow['contractid'],$contractDocumentOriginRow['name'],$path,$contractDocumentOriginRow['remark']);
    if($result == false){$returnData['documentid'] = -5;echo json_encode($returnData);return;}

    //返回
    $returnData['documentid'] = $insertId;
    $returnData['doc_name'] = $doc_name;
    $returnData['doc_remark'] = $doc_remark;
    $returnData['suffix'] = $suffix;
    $returnData['download_url'] = U('OperSubcontractManage/editSubcontract_downloadDocumentOrigin',array('documentid'=>$returnData['documentid']));
    //$resultData['contractid'] = $contractid;
    echo json_encode($returnData);
  }

  public function editSubcontract_deletefile(){
    $data = false;
    $documentid = $_POST['documentid'];
    if($documentid <= 0){$data=false;return;}
    $documentRow = $this->subcontractDocumentDao->findById($documentid);
    $filepath = $documentRow['path'];

    //删除文件
    //$filepath = iconv("utf-8", "gbk", $filepath);
    $result = unlink($filepath);
    if($result == false){echo json_encode($data);return;}
    //删除数据库信息
    $result = $this->subcontractDocumentDao->deleteById($documentid);
    $data = $result;
    echo json_encode($data);
    //$this->ajaxReturn($data,"JSON");
  }

  public function editSubcontract_downloadDocument(){
    $documentid = $_GET['documentid'];
    $documentRow = $this->subcontractDocumentDao->findById($documentid);
    $filepath = $documentRow['path'];
    //$downloadFilename = preg_replace('/^.+[\\\\\\/]/','',$filepath );

    //$filepath = iconv("utf-8", "gbk", $filepath);
    if(is_file($filepath)){
      func_downloadFile($filepath);
    }else{
      echo "文件不存在！";
      exit;
    }
  }

  public function editSubcontract_downloadDocumentOrigin(){
    $documentid = $_GET['documentid'];
    $documentRow = $this->subcontractDocumentOriginDao->findById($documentid);
    $filepath = $documentRow['path'];

    if(is_file($filepath)){
      func_downloadFile($filepath);

    }else{
      echo "文件不存在！";
      exit;
    }
  }

  public function editSubcontract_deletefileOrigin(){
    $data = false;
    $documentid = $_POST['documentid'];
    if($documentid <= 0){$data=false;return;}
    $documentRow = $this->subcontractDocumentOriginDao->findById($documentid);
    $filepath = $documentRow['path'];
    //echo json_encode($filepath);
    //return;
    //删除文件
    //$filepath = iconv("utf-8", "gbk", $filepath);
    $result = unlink($filepath);
    if($result == false){echo json_encode($data);return;}
    //删除数据库信息
    $result = $this->subcontractDocumentOriginDao->deleteById($documentid);
    $data = $result;
    echo json_encode($data);
  }

  public function editSubcontract_editDocument(){
    $returnData = array();
    $doc_name = $_POST['doc_name'];
    $doc_remark = $_POST['doc_remark'];
    $documentid = $_POST['documentid'];
    if($documentid <=0){$returnData['documentid'] = 0;echo json_encode($returnData);return;}

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $contractDocumentRow = $this->subcontractDocumentDao->findById($documentid);
    $result = $this->subcontractDocumentDao->updateById($documentid,$contractDocumentRow['contractid'],$doc_name,$contractDocumentRow['path'],$doc_remark,$contractDocumentRow['create_userid'],$userRow['userid'],$contractDocumentRow['checked_userid']);
    if($result == false){$returnData['documentid'] = 0;echo json_encode($returnData);return;}

    //最后修改人
    $userInfoRow = $this->userInfoByUserid($userRow['userid']);
    $lastupdate_user_info = $userInfoRow['name']."[".$userInfoRow['employer_number']."]";

    $returnData['documentid'] = $documentid;
    $returnData['doc_name'] = $doc_name;
    $returnData['doc_remark'] = $doc_remark;

    $returnData['lastupdate_user_info'] = $lastupdate_user_info;
    echo json_encode($returnData);
  }

  public function editSubcontract_editDocumentOrigin(){
    $returnData = array();
    $doc_name = $_POST['doc_name'];
    $doc_remark = $_POST['doc_remark'];
    $documentid = $_POST['documentid'];
    if($documentid <=0){$returnData['documentid'] = 0;echo json_encode($returnData);return;}

    $contractDocumentRow = $this->subcontractDocumentOriginDao->findById($documentid);
    $result = $this->subcontractDocumentOriginDao->updateById($documentid,$contractDocumentRow['contractid'],$doc_name,$contractDocumentRow['path'],$doc_remark);
    if($result == false){$returnData['documentid'] = 0;echo json_encode($returnData);return;}

    $returnData['documentid'] = $documentid;
    $returnData['doc_name'] = $doc_name;
    $returnData['doc_remark'] = $doc_remark;

    echo json_encode($returnData);

  }

  public function editSubcontract_checkDocument(){
    $documentid = $_POST['documentid'];
    $operation = $_POST['operation'];
    $returnData = array();
    $returnData['result'] = false;
    $contractDocumentRow = $this->subcontractDocumentDao->findById($documentid);
    if($operation == "check"){
      $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
      $result = $this->subcontractDocumentDao->updateById($documentid,$contractDocumentRow['contractid'],$contractDocumentRow['name'],$contractDocumentRow['path'],$contractDocumentRow['remark'],$contractDocumentRow['create_userid'],$contractDocumentRow['lastupdate_userid'],$userRow['userid']);
      $returnData['result'] = $result;
    }
    else if($operation == "uncheck"){

      $result = $this->subcontractDocumentDao->updateById($documentid,$contractDocumentRow['contractid'],$contractDocumentRow['name'],$contractDocumentRow['path'],$contractDocumentRow['remark'],$contractDocumentRow['create_userid'],$contractDocumentRow['lastupdate_userid'],0);
      $returnData['result'] = $result;
    }


    //$returnData['operation'] = $operation;
    //$returnData['result'] = $operation;
    echo json_encode($returnData);
  }

  //========================================











  public function editSubcontract_addContent(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = SUBCONTRACT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    //$aa = 0;
    //echo json_encode($aa);
    //return;
    $contractid = $_POST['contractid'];
    $category = $_POST['contractcontent_category'];
    $name = $_POST['contractcontent_name'];
    $unit = $_POST['contractcontent_unit'];
    $price_perunit = $_POST['contractcontent_price_perunit'];
    $amount = $_POST['contractcontent_amount'];
    $remark = $_POST['contractcontent_remark'];
    $contentid=0;
    $contentid = $this->subcontractContentDao->add($contractid,$category,$name,$unit,$price_perunit,$amount,$remark);

    $resultArray = array();
    $resultArray['contentid'] = $contentid;
    $resultArray['contractid'] = $contractid;
    $resultArray['category'] = $category;
    $resultArray['name'] = $name;
    $resultArray['unit'] = $unit;
    $resultArray['price_perunit'] = $price_perunit;
    $resultArray['amount'] = $amount;
    $resultArray['remark'] = $remark;
    echo json_encode($resultArray);
    //$this->ajaxReturn($resultArray,'JSON');
  }

  public function editSubcontract_editContent(){
    $contentid = $_POST['contentid'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $amount = $_POST['amount'];
    $price_perunit = $_POST['price_perunit'];
    $remark = $_POST['remark'];

    $contentRow = $this->subcontractContentDao->findById($contentid);
    $result = $this->subcontractContentDao->updateById($contentid,$contentRow['contractid'],$category,$name,$unit,$price_perunit,$amount,$remark);
    echo json_encode($contentid);
  }

  public function editSubcontract_deleteContent(){
    $contentid = $_POST['contentid'];
    $result = $this->subcontractContentDao->deleteById($contentid);
    echo json_encode($result);

  }

  public function editSubcontractSubmit(){
    $contractid = $_POST['contractid'];
    $resource_id = $_POST['resource_id'];
    $contract_number = $_POST['contract_number'];
    $name = $_POST['name'];
    $contract_type = $_POST['contract_type'];
    $a_part_enterpriseid = $_POST['a_part_enterpriseid'];
    $b_part_enterpriseid = $_POST['b_part_enterpriseid'];
    $build_pattern = $_POST['build_pattern'];
    $contract_status = $_POST['contract_status'];
    $construction_start_date = $_POST['construction_start_date'];
    $construction_finish_date = $_POST['construction_finish_date'];
    $sign_date = $_POST['sign_date'];
    $report_price = $_POST['report_price'];
    $pay_baseprice_according = $_POST['pay_baseprice_according'];
    $margin_amount = $_POST['margin_amount'];
    $pay_limit = $_POST['pay_limit'];
    if(isset($_POST['check_grossamount_control']))$check_grossamount_control = 1;
    else $check_grossamount_control = 0;
    //$check_grossamount_control = $_POST['check_grossamount_control'];
    $main_content = $_POST['main_content'];
    $other_limit_condition = $_POST['other_limit_condition'];

    $remark = $_POST['remark'];
    $subcontractRow = $this->subcontractDao->findById($contractid);

    $result = $this->subcontractDao->updateById($contractid,
      $resource_id,$contract_number,$name,$contract_type,$a_part_enterpriseid,
      $b_part_enterpriseid,$build_pattern,$contract_status,$construction_start_date,$construction_finish_date,
      $sign_date,$report_price,$pay_baseprice_according,$margin_amount,$pay_limit,
      $check_grossamount_control,$main_content,$other_limit_condition,$subcontractRow['create_userid'],$subcontractRow['create_date'],
      $subcontractRow['finalcost_userid'],$subcontractRow['check_userid'],$remark);

    if($result == false){
      $this->display('Staticpage/wrongalert');
    }
    $this->redirect('OperSubcontractManage/listSubcontract',array('resource_id'=>$resource_id),3,"修改分包合同成功...");


    //$this->show($remark);

  }

  public function deleteSubcontract(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = SUBCONTRACT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    if(isset($_GET['contractid'])==false || $_GET['contractid']<=0){
      $this->display('Staticpage/wrongalert');
      return;
    }
    $contractid = $_GET['contractid'];
    $contractRow = $this->subcontractDao->findById($contractid);
    $resource_id = $contractRow['resource_id'];
    $result = $this->subcontractDao->deleteById($contractid);
    if($result == false){
      $this->display('Staticpage/wrongalert');
      return;
    }

    $this->redirect('OperSubcontractManage/listSubcontract',array('resource_id'=>$resource_id),3,"删除分包合同成功...");
  }

  //公共函数-----------------------------------------------------
  //返回数组，包括 姓名，员工编号，公司，部门
  public function userInfoByUserid($userid){
    $resultArray = array();
    $userRow = $this->userDao->findById($userid);
    $employerRow = $this->employerDao->findById($userRow['employerid']);
    $departmentRow = $this->departmentDao->findById($employerRow['departmentid']);
    $companyRow = $this->companyDao->findById($employerRow['companyid']);

    $resultArray['name']=$employerRow['name'];
    $resultArray['employer_number']=$employerRow['employer_number'];
    $resultArray['department_name']=$departmentRow['name'];
    $resultArray['company_name']=$companyRow['name'];

    return $resultArray;

  }




  //公共函数=====================================================
}
?>
