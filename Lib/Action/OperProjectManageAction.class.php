<?php
import("@.Model.CompanyDao");
import("@.Model.EmployerDao");
import("@.Model.DepartmentDao");
import("@.Model.EnterpriseDao");
import("@.Model.ProjectDao");
import("@.Model.ProjectstatusDao");
import("@.Model.ProjectstatuscategoryDao");
import("@.Model.ProjecttypeDao");
import("@.Model.ClerkDao");
import("@.Model.BiddateDao");
import("@.Model.MargindateDao");
import("@.Model.QuestionanswerdateDao");
import("@.Model.StartbiddateDao");
import("@.Model.SubmitbiddocdateDao");
import("@.Model.ProjectProgressDao");
import("@.Model.ProjectTracecostDao");
import("@.Model.ResourceDocumentDao");
import("@.Model.BiddingrivalDao");
import("@.Model.BiddateReminduserDao");
import("@.Model.MargindateReminduserDao");
import("@.Model.QuestionanswerdateReminduserDao");
import("@.Model.SubmitbiddocdateReminduserDao");
import("@.Model.StartbiddateReminduserDao");
import("@.Model.ProjectResourceDao");
import("@.Model.SubcontractorDao");
import("@.Model.WarehouseDao");
import("@.Model.WarehouseWorkerDao");
import("@.Model.SubcontractorWorkerDao");
import("@.Model.ProjectProcessDao");
import("@.Model.StandardProjectDao");
import("@.Model.ControlSettingDao");
import("@.Model.ProcessPeriodworkDao");
import("@.Model.ContractDao");
import("@.Model.ContractContentDao");
import("@.Model.ContractDocumentDao");
import("@.Model.ContractDocumentOriginDao");
import("@.Model.ProcessClassifyDao");
import("@.Model.ProcessDao");

header('Content-Type:text/html;charset=utf-8');

class OperProjectManageAction extends LoginAfterAction{
  private $companyDao;
  private $employerDao;
  private $departmentDao;
  private $enterpriseDao;
  private $projectDao;
  private $projectstatusDao;
  private $projectstatuscategoryDao;
  private $projecttypeDao;
  private $clerkDao;
  private $biddateDao;
  private $margindateDao;
  private $questionanswerdateDao;
  private $startbiddateDao;
  private $submitbiddocdateDao;
  private $projectProgressDao;
  private $projectTracecostDao;
  private $resourceDocumentDao;
  private $biddingrivalDao;
  private $biddateReminduserDao;
  private $margindateReminduserDao;
  private $questionanswerdateReminduserDao;
  private $submitbiddocdateReminduserDao;
  private $startbiddateReminduserDao;
  private $projectResourceDao;
  private $subcontractorDao;
  private $subcontractorWorkerDao;
  private $warehouseDao;
  private $warehouseWorkerDao;
  private $projectProcessDao;
  private $standardProjectDao;
  private $controlSettingDao;
  private $processPeriodworkDao;
  private $contractDao;
  private $contractContentDao;
  private $contractDocumentDao;
  private $contractDocumentOriginDao;
  private $processClassifyDao;
  private $processDao;

  public function _initialize(){
    parent::_initialize();

    $this->companyDao=new CompanyDao();
    $this->employerDao=new EmployerDao();
    $this->departmentDao=new DepartmentDao();
    $this->enterpriseDao=new EnterpriseDao();
    $this->projectDao=new ProjectDao();
    $this->projectstatusDao=new ProjectstatusDao();
    $this->projectstatuscategoryDao=new ProjectstatuscategoryDao();
    $this->projecttypeDao=new ProjecttypeDao();
    $this->clerkDao=new ClerkDao();
    $this->biddateDao=new BiddateDao();
    $this->margindateDao=new MargindateDao();
    $this->questionanswerdateDao=new QuestionanswerdateDao();
    $this->startbiddateDao=new StartbiddateDao();
    $this->submitbiddocdateDao=new SubmitbiddocdateDao();
    $this->projectProgressDao=new ProjectProgressDao();
    $this->projectTracecostDao=new ProjectTracecostDao();
    $this->resourceDocumentDao=new ResourceDocumentDao();
    $this->biddingrivalDao=new BiddingrivalDao();
    $this->biddateReminduserDao=new BiddateReminduserDao();
    $this->margindateReminduserDao=new MargindateReminduserDao();
    $this->questionanswerdateReminduserDao=new QuestionanswerdateReminduserDao();
    $this->submitbiddocdateReminduserDao=new SubmitbiddocdateReminduserDao();
    $this->startbiddateReminduserDao=new StartbiddateReminduserDao();
    $this->projectResourceDao=new ProjectResourceDao();
    $this->subcontractorDao=new SubcontractorDao();
    $this->subcontractorWorkerDao=new SubcontractorWorkerDao;
    $this->warehouseDao=new WarehouseDao();
    $this->warehouseWorkerDao=new WarehouseWorkerDao();
    $this->projectProcessDao=new ProjectProcessDao();
    $this->standardProjectDao=new StandardProjectDao();
    $this->controlSettingDao=new ControlSettingDao();
    $this->processPeriodworkDao=new ProcessPeriodworkDao();
    $this->contractDao=new ContractDao();
    $this->contractContentDao=new ContractContentDao();
    $this->contractDocumentDao=new ContractDocumentDao();
    $this->contractDocumentOriginDao=new ContractDocumentOriginDao();
    $this->processClassifyDao=new ProcessClassifyDao();
    $this->processDao=new ProcessDao();
    $this->userDao=new UserDao();

  }    



  //项目开拓--------------------------------------------------------------------------------
  public function listProject(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $projectRowArray = $this->projectDao->findAll();
    $currentstatusArray = array();
    foreach($projectRowArray as $key => $value){
      $currentstatusid = $value['currentstatusid'];
      $projectstatusRow = $this->projectstatusDao->findById($currentstatusid);
      $categoryid = $projectstatusRow['categoryid'];
      $projectstatuscategoryRow = $this->projectstatuscategoryDao->findById($categoryid);
      $currentstatusName = $projectstatuscategoryRow['name']."/".$projectstatusRow['name'];
      $currentstatusArray[$key]=$currentstatusName;
    }
    $this->assign('projectRowArray',$projectRowArray);
    $this->assign('currentstatusArray',$currentstatusArray);

    $this->display('OperProjectManage/listProject');
  }

  public function addProject(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }




    //项目所有状态
    $projectstatuscategoryRowArray = $this->projectstatuscategoryDao->findAll();
    $projectstatusRowArray = $this->projectstatusDao->findAll();
    //业务员
    $clerknameArray = $this->clerkDao->findAll_name();
    //项目类型
    $projecttypeRowArray = $this->projecttypeDao->findAll();
    //往来单位
    $enterpriseRowArray = $this->enterpriseDao->findAll();
    //分公司
    $companyRowArray = $this->companyDao->findAll();
    //部门
    $departmentRowArray = $this->departmentDao->findAll();
    //所有用户
    $userRowArray = $this->userDao->findAll();
    //所有员工
    $employerRowArray = $this->employerDao->findAll();

    $this->assign('projectstatuscategoryRowArray',$projectstatuscategoryRowArray);
    $this->assign('projectstatusRowArray',$projectstatusRowArray);
    $this->assign('clerknameArray',$clerknameArray);
    $this->assign('projecttypeRowArray',$projecttypeRowArray);
    $this->assign('enterpriseRowArray',$enterpriseRowArray);
    $this->assign('companyRowArray',$companyRowArray);
    $this->assign('departmentRowArray',$departmentRowArray);
    $this->assign('userRowArray',$userRowArray);
    $this->assign('employerRowArray',$employerRowArray);


    $this->display('OperProjectManage/addProject');
  }

  public function addProjectSubmit(){
    $projectname = $_POST['projectname'];
    $project_address = $_POST['project_address'];
    $currentstatusid = $_POST['currentstatusid'];
    $clerkname = $_POST['clerkname'];
    $project_type = $_POST['project_type'];
    $constract_counterparty = $_POST['constract_counterparty'];
    $biddoc_type = $_POST['biddoc_type'];
    $getbid_price = $_POST['getbid_price'];
    $build_enterpriseid = $_POST['build_enterpriseid'];
    $a_project_director_name = $_POST['a_project_director_name'];
    $a_project_director_phone = $_POST['a_project_director_phone'];
    $design_enterpriseid = $_POST['design_enterpriseid'];
    $a_technology_director_name = $_POST['a_technology_director_name'];
    $a_technology_director_phone = $_POST['a_technology_director_phone'];
    $construct_enterpriseid = $_POST['construct_enterpriseid'];
    $constructunit_director_name = $_POST['constructunit_director_name'];
    $constructunit_director_phone = $_POST['constructunit_director_phone'];
    $mediator_enterpriseid = $_POST['mediator_enterpriseid'];
    $mediator_constract = $_POST['mediator_constract'];
    $covered_area = $_POST['covered_area'];
    $use_purpose = $_POST['use_purpose'];
    $info_source = $_POST['info_source'];
    $scale = $_POST['scale'];
    $project_basic_info = $_POST['project_basic_info'];

    $isknown_bid_date = 0;
    if(isset($_POST['isknown_bid_date']))$isknown_bid_date = 1;//cb
    //$biddate_date = $_POST['biddate_date'];
    //$biddate_preremind_days = $_POST['biddate_preremind_days'];
    //$biddate_reminder_employerid = $_POST['biddate_reminder_employerid'];
    //$biddate_is_finished = 0;
    //if(isset($_POST['biddate_is_finished']))$biddate_is_finished = 1;//cb

    $isknown_questionanswer_date = 0;
    if(isset($_POST['isknown_questionanswer_date']))$isknown_questionanswer_date = 1;//cb
    //$questionanswerdate_date = $_POST['questionanswerdate_date'];
    //$questionanswerdate_preremind_days = $_POST['questionanswerdate_preremind_days'];
    //$questionanswerdate_reminder_employerid = $_POST['questionanswerdate_reminder_employerid'];
    //$questionanswerdate_is_finished = 0;
    //if(isset($_POST['questionanswerdate_is_finished']))$questionanswerdate_is_finished = 1;//cb

    $isknown_submitbiddoc_date = 0;
    if(isset($_POST['isknown_submitbiddoc_date']))$isknown_submitbiddoc_date = 1;//cb
    //$submitbiddocdate_date = $_POST['submitbiddocdate_date'];
    //$submitbiddocdate_preremind_days = $_POST['submitbiddocdate_preremind_days'];
    //$submitbiddocdate_reminder_employerid = $_POST['submitbiddocdate_reminder_employerid'];
    //$submitbiddocdate_is_finished = 0;
    //if(isset($_POST['submitbiddocdate_is_finished']))$submitbiddocdate_is_finished = 1;//cb

    $isknown_startbid_date = 0;
    if(isset($_POST['isknown_startbid_date']))$isknown_startbid_date = 1;//cb
    //$startbiddate_date = $_POST['startbiddate_date'];
    //$startbiddate_preremind_days = $_POST['startbiddate_preremind_days'];
    //$startbiddate_reminder_employerid = $_POST['startbiddate_reminder_employerid'];
    //$startbiddate_is_finished = 0;
    //if(isset($_POST['startbiddate_is_finished']))$startbiddate_is_finished = 1;//cb

    $isknown_margin_date = 0;
    if(isset($_POST['isknown_margin_date']))$isknown_margin_date = 1;//cb
    //$margindate_date = $_POST['margindate_date'];
    //$margindate_preremind_days = $_POST['margindate_preremind_days'];
    //$margindate_reminder_employerid = $_POST['margindate_reminder_employerid'];
    //$margindate_amount = $_POST['margindate_amount'];
    //$margindate_is_submit = 0;
    //if(isset($_POST['margindate_is_submit']))$margindate_is_submit = 1;//cb
    //$margindate_is_getback = 0;
    //if(isset($_POST['margindate_is_getback']))$margindate_is_getback = 1;//cb

    $advantage="";
    $drawback="";
    //dealing data
    $projectid = $this->projectDao->add($projectname,$currentstatusid,$clerkname,$build_enterpriseid,$design_enterpriseid,
      $construct_enterpriseid,$mediator_enterpriseid,$mediator_constract,$project_address,$project_type,
      $constract_counterparty,$a_project_director_name,$a_project_director_phone,$a_technology_director_name,$a_technology_director_phone,
      $constructunit_director_name,$constructunit_director_phone,$biddoc_type,$getbid_price,$use_purpose,
      $covered_area,$info_source,$scale,$project_basic_info,$isknown_bid_date,
      $isknown_questionanswer_date,$isknown_submitbiddoc_date,$isknown_startbid_date,$isknown_margin_date,$advantage,
      $drawback);

    if($projectid <=0 ){
      $this->display('Staticpage/wrongalert');
      return;
    }

    if($isknown_bid_date == 1){
      $biddate_date = $_POST['biddate_date'];
      $biddate_preremind_days = $_POST['biddate_preremind_days'];
      //$biddate_reminder_employerid = $_POST['biddate_reminder_employerid'];
      $biddate_is_finished = 0;
      if(isset($_POST['biddate_is_finished']))$biddate_is_finished = 1;//cb
      $biddate_id = $this->biddateDao->add($projectid,$biddate_date,$biddate_preremind_days,$biddate_is_finished);
      if($biddate_id <= 0){
        $this->display('Staticpage/wrongalert');
        return;
      }
      $biddate_reminder_userid = $_POST['biddate_reminder_userid'];
      //处理字串
      $useridArray = explode(",",$biddate_reminder_userid);
      foreach($useridArray as $value){
        $value = trim($value);
        if($value == "")continue;
        $result = $this->biddateReminduserDao->add($biddate_id,$value);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
    }

    if($isknown_questionanswer_date == 1){
      $questionanswerdate_date = $_POST['questionanswerdate_date'];
      $questionanswerdate_preremind_days = $_POST['questionanswerdate_preremind_days'];
      //$biddate_reminder_employerid = $_POST['biddate_reminder_employerid'];
      $questionanswerdate_is_finished = 0;
      if(isset($_POST['questionanswerdate_is_finished']))$questionanswerdate_is_finished = 1;//cb
      $questionanswerdate_id = $this->questionanswerdateDao->add($projectid,$questionanswerdate_date,$questionanswerdate_preremind_days,$questionanswerdate_is_finished);
      if($questionanswerdate_id <= 0){
        $this->display('Staticpage/wrongalert');
        return;
      }
      $questionanswerdate_reminder_userid = $_POST['questionanswerdate_reminder_userid'];
      //处理字串
      $useridArray = explode(",",$questionanswerdate_reminder_userid);
      foreach($useridArray as $value){
        $value = trim($value);
        if($value == "")continue;
        $result = $this->questionanswerdateReminduserDao->add($questionanswerdate_id,$value);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
    }

    if($isknown_submitbiddoc_date == 1){
      $submitbiddocdate_date = $_POST['submitbiddocdate_date'];
      $submitbiddocdate_preremind_days = $_POST['submitbiddocdate_preremind_days'];
      //$biddate_reminder_employerid = $_POST['biddate_reminder_employerid'];
      $submitbiddocdate_is_finished = 0;
      if(isset($_POST['submitbiddocdate_is_finished']))$submitbiddocdate_is_finished = 1;//cb
      $submitbiddocdate_id = $this->submitbiddocdateDao->add($projectid,$submitbiddocdate_date,$submitbiddocdate_preremind_days,$submitbiddocdate_is_finished);
      if($submitbiddocdate_id <= 0){
        $this->display('Staticpage/wrongalert');
        return;
      }
      $submitbiddocdate_reminder_userid = $_POST['submitbiddocdate_reminder_userid'];
      //处理字串
      $useridArray = explode(",",$submitbiddocdate_reminder_userid);
      foreach($useridArray as $value){
        $value = trim($value);
        if($value == "")continue;
        $result = $this->submitbiddocdateReminduserDao->add($submitbiddocdate_id,$value);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
    }

    if($isknown_startbid_date == 1){
      $startbiddate_date = $_POST['startbiddate_date'];
      $startbiddate_preremind_days = $_POST['startbiddate_preremind_days'];
      //$startbiddate_reminder_employerid = $_POST['startbiddate_reminder_employerid'];
      $startbiddate_is_finished = 0;
      if(isset($_POST['startbiddate_is_finished']))$startbiddate_is_finished = 1;//cb
      $startbiddate_id = $this->startbiddateDao->add($projectid,$startbiddate_date,$startbiddate_preremind_days,$startbiddate_is_finished);
      if($startbiddate_id <= 0){
        $this->display('Staticpage/wrongalert');
        return;
      }
      $startbiddate_reminder_userid = $_POST['startbiddate_reminder_userid'];
      //处理字串
      $useridArray = explode(",",$startbiddate_reminder_userid);
      foreach($useridArray as $value){
        $value = trim($value);
        if($value == "")continue;
        $result = $this->startbiddateReminduserDao->add($startbiddate_id,$value);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
    }

    if($isknown_margin_date == 1){
      $margindate_date = $_POST['margindate_date'];
      $margindate_preremind_days = $_POST['margindate_preremind_days'];
      //$margindate_reminder_employerid = $_POST['margindate_reminder_employerid'];
      $margindate_amount = $_POST['margindate_amount'];
      $margindate_is_submit = 0;
      if(isset($_POST['margindate_is_submit']))$margindate_is_submit = 1;//cb
      $margindate_is_getback = 0;
      if(isset($_POST['margindate_is_getback']))$margindate_is_getback = 1;//cb
      $margindateRow = $this->margindateDao->findByProjectid($projectid);
      $margindate_id = $this->margindateDao->add($projectid,$margindate_date,$margindate_preremind_days,$margindate_amount,$margindate_is_submit,$margindate_is_getback);

      $margindate_reminder_userid = $_POST['margindate_reminder_userid'];
      //处理字串
      $useridArray = explode(",",$margindate_reminder_userid);	
      foreach($useridArray as $value){
        $value = trim($value);
        if($value == "")continue;
        $result = $this->margindateReminduserDao->add($margindate_id,$value);
        if($result == false){$this->display('Staticpage/wrongalert');return;}
      }
    }

    $resourceid = $this->projectResourceDao->add($projectid,$projectname,0,0,0,0,0,0);
    if($resourceid <= 0){$this->display('Staticpage/wrongalert');return;}
    //创建文件夹
    $dir = "Data/resource_".$resourceid;
    while(!is_dir($dir)){
      mkdir($dir, 0777);
    }

    $this->redirect('OperProjectManage/listProject',array(),3,"添加开拓项目成功...");
  }

  public function editProject(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }


    if(isset($_GET['projectid']))$projectid = $_GET['projectid'];
    else $projectid = $this->projectid;
    $projectRow = $this->projectDao->findById($projectid);
    $projectstatusRow = $this->projectstatusDao->findById($projectRow['currentstatusid']);


    $categoryid = $projectstatusRow['categoryid'];
    $projectstatuscategoryRow = $this->projectstatuscategoryDao->findById($categoryid);
    $currentstatusName = $projectstatuscategoryRow['name']."/".$projectstatusRow['name'];
    $projectRow['currentstatusName'] = $currentstatusName;

    if($projectRow['isknown_bid_date'] == 1){
      $biddateRow = $this->biddateDao->findByProjectid($projectRow['projectid']);
      $biddateReminduserRowArray = $this->biddateReminduserDao->findByBiddateid($biddateRow['biddate_id']);
      foreach($biddateReminduserRowArray as $key=>$value){
        $userRow = $this->userDao->findById($value['userid']);
        $employerRow = $this->employerDao->findById($userRow['employerid']);
        $biddateReminduserRowArray[$key]['name_employernumber'] = $employerRow['name']."[".$employerRow['employer_number']."]";
      }

      $this->assign('biddateRow',$biddateRow);
      $this->assign('biddateReminduserRowArray',$biddateReminduserRowArray);
    }
    if($projectRow['isknown_questionanswer_date'] == 1){
      $questionanswerdateRow = $this->questionanswerdateDao->findByProjectid($projectRow['projectid']);
      $questionanswerdateReminduserRowArray = $this->questionanswerdateReminduserDao->findByquestionanswerdateid($questionanswerdateRow['questionanswerdate_id']);
      foreach($questionanswerdateReminduserRowArray as $key=>$value){
        $userRow = $this->userDao->findById($value['userid']);
        $employerRow = $this->employerDao->findById($userRow['employerid']);
        $questionanswerdateReminduserRowArray[$key]['name_employernumber'] = $employerRow['name']."[".$employerRow['employer_number']."]";
      }
      $this->assign('questionanswerdateRow',$questionanswerdateRow);
      $this->assign('questionanswerdateReminduserRowArray',$questionanswerdateReminduserRowArray);	

    }
    if($projectRow['isknown_submitbiddoc_date'] == 1){
      $submitbiddocdateRow = $this->submitbiddocdateDao->findByProjectid($projectRow['projectid']);
      $submitbiddocdateReminduserRowArray = $this->submitbiddocdateReminduserDao->findBysubmitbiddocdateid($submitbiddocdateRow['submitbiddocdate_id']);
      foreach($submitbiddocdateReminduserRowArray as $key=>$value){
        $userRow = $this->userDao->findById($value['userid']);
        $employerRow = $this->employerDao->findById($userRow['employerid']);
        $submitbiddocdateReminduserRowArray[$key]['name_employernumber'] = $employerRow['name']."[".$employerRow['employer_number']."]";
      }
      $this->assign('submitbiddocdateRow',$submitbiddocdateRow);
      $this->assign('submitbiddocdateReminduserRowArray',$submitbiddocdateReminduserRowArray);
    }
    if($projectRow['isknown_startbid_date'] == 1){
      $startbiddateRow = $this->startbiddateDao->findByProjectid($projectRow['projectid']);
      $startbiddateReminduserRowArray = $this->startbiddateReminduserDao->findBystartbiddateid($startbiddateRow['startbiddate_id']);
      foreach($startbiddateReminduserRowArray as $key=>$value){
        $userRow = $this->userDao->findById($value['userid']);
        $employerRow = $this->employerDao->findById($userRow['employerid']);
        $startbiddateReminduserRowArray[$key]['name_employernumber'] = $employerRow['name']."[".$employerRow['employer_number']."]";
      }
      $this->assign('startbiddateRow',$startbiddateRow);
      $this->assign('startbiddateReminduserRowArray',$startbiddateReminduserRowArray);

    }
    if($projectRow['isknown_margin_date'] == 1){

      $margindateRow = $this->margindateDao->findByProjectid($projectRow['projectid']);
      $margindateReminduserRowArray = $this->margindateReminduserDao->findBymargindateid($margindateRow['margindate_id']);
      foreach($margindateReminduserRowArray as $key=>$value){
        $userRow = $this->userDao->findById($value['userid']);
        $employerRow = $this->employerDao->findById($userRow['employerid']);
        $margindateReminduserRowArray[$key]['name_employernumber'] = $employerRow['name']."[".$employerRow['employer_number']."]";
      }
      $this->assign('margindateRow',$margindateRow);
      $this->assign('margindateReminduserRowArray',$margindateReminduserRowArray);

    }
    $projectProgressRowArray = $this->projectProgressDao->findByProjectid($projectRow['projectid']);
    $projectTracecostRowArray = $this->projectTracecostDao->findByProjectid($projectRow['projectid']);
    $resourceRow = $this->projectResourceDao->findByProjectid($projectRow['projectid']);
    $projectDocumentRowArray = $this->resourceDocumentDao->findByResourceid($resourceRow['resource_id']);
    foreach($projectDocumentRowArray as $key => $value){
      $userid = $value['create_userid'];

      $createuserInfo = $this->userInfoByUserid($userid);
      // $userRow = $this->userDao->findById($userid);
      // $employerRow = $this->employerDao->findById($userRow['employerid']);
      $suffix = substr($value['path'],strrpos($value['path'],"."));
      $projectDocumentRowArray[$key]['employer_number']=$createuserInfo['employer_number'];
      $projectDocumentRowArray[$key]['employer_name']=$createuserInfo['name'];
      // $departmentRow = $this->departmentDao->findById($employerRow['departmentid']);
      // $companyRow = $this->companyDao->findById($employerRow['companyid']);

      //projectid
      $projectDocumentRowArray[$key]['projectid']=$projectRow['projectid'];

      //$projectDocumentRowArray[$key]['employer_department']=$employerRow['name'];
      $projectDocumentRowArray[$key]['suffix'] = $suffix;
      $projectDocumentRowArray[$key]['employer_companyname'] = $createuserInfo['company_name'];
      $projectDocumentRowArray[$key]['employer_departmentname'] = $createuserInfo['department_name'];
    }

    $biddingrivalRowArray = $this->biddingrivalDao->findByProjectid($projectRow['projectid']);

    //项目所有状态
    $projectstatuscategoryRowArray = $this->projectstatuscategoryDao->findAll();
    $projectstatusRowArray = $this->projectstatusDao->findAll();
    //业务员
    $clerknameArray = $this->clerkDao->findAll_name();
    //项目类型
    $projecttypeRowArray = $this->projecttypeDao->findAll();
    //往来单位
    $enterpriseRowArray = $this->enterpriseDao->findAll();
    //分公司
    $companyRowArray = $this->companyDao->findAll();
    //部门
    $departmentRowArray = $this->departmentDao->findAll();
    //所有用户
    $userRowArray = $this->userDao->findAll();
    //所有员工
    $employerRowArray = $this->employerDao->findAll();

    $this->assign('projectRow',$projectRow);
    //$this->assign('currentstatusName',$currentstatusName);

    $this->assign('projectstatuscategoryRowArray',$projectstatuscategoryRowArray);
    $this->assign('projectstatusRowArray',$projectstatusRowArray);
    $this->assign('clerknameArray',$clerknameArray);
    $this->assign('projecttypeRowArray',$projecttypeRowArray);
    $this->assign('enterpriseRowArray',$enterpriseRowArray);
    $this->assign('companyRowArray',$companyRowArray);
    $this->assign('departmentRowArray',$departmentRowArray);
    $this->assign('projectProgressRowArray',$projectProgressRowArray);
    $this->assign('projectTracecostRowArray',$projectTracecostRowArray);
    $this->assign('projectDocumentRowArray',$projectDocumentRowArray);
    $this->assign('biddingrivalRowArray',$biddingrivalRowArray);
    $this->assign('userRowArray',$userRowArray);
    $this->assign('employerRowArray',$employerRowArray);

    if(isset($this->tagIndex) == false){
      $tagIndex = 0;
      $this->assign('tagIndex',$tagIndex);
    }
    $this->display('OperProjectManage/editProject');
  }

  public function editProject_addProgress(){
    $projectid = $_POST['projectid'];
    $content = $_POST['content'];
    $createdateArray = localtime(time(),true);
    $createdateYear = 1900+$createdateArray['tm_year'];
    $createdateMonth = 1+$createdateArray['tm_mon'];
    $createdateDay = $createdateArray['tm_mday'];
    $createdateStr = $createdateYear."-".$createdateMonth."-".$createdateDay;
    $createdate = Date("Y-m-d",strtotime($createdateStr));
    $progressid = $this->projectProgressDao->add($projectid,$createdate,$content);
    $tagIndex = 2;
    $this->assign('tagIndex',$tagIndex);
    $this->assign('projectid',$projectid);
    if($progressid<=0)$this->display('Staticpage/wrongalert');
    else{ //$this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid));
    $this->editProject();
    }
  }

  public function editProject_editProgress(){
    $progressid = $_POST['progressid'];
    $projectid = $_POST['projectid'];
    $content = $_POST['content'];
    $progressRow = $this->projectProgressDao->findById($progressid);
    $result = $this->projectProgressDao->updateById($progressid,$progressRow['projectid'],$progressRow['createdate'],$content);

    $tagIndex = 2;
    $this->assign('tagIndex',$tagIndex);
    $this->assign('projectid',$projectid);
    if($result == false)$this->display('Staticpage/wrongalert');
    else{ //$this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid));
    $this->editProject();
    }
  }

  public function editProject_deleteProgress(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $progressid = $_GET['progressid'];
    $progressRow = $this->projectProgressDao->findById($progressid);
    $projectid = $progressRow['projectid'];
    $result = $this->projectProgressDao->deleteById($progressid);

    $tagIndex = 2;
    $this->assign('tagIndex',$tagIndex);
    $this->assign('projectid',$projectid);
    if($result==false)$this->display('Staticpage/wrongalert');
    else{ //$this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid));
    $this->editProject();
    }
  }

  public function editProject_addDocument(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $projectid = $_POST['projectid'];
    $resourceRow = $this->projectResourceDao->findByProjectid($projectid);
    $resourceid = $resourceRow['resource_id'];
    $serial_number = "";
    if(isset($_POST['autoGenerate'])&&($_POST['autoGenerate']==9)){
      $serial_number = $this->resourceFileSNGenerate($resourceid);
    }
    else $serial_number = $_POST['serial_number'];
    $name = $_POST['name'];
    $remark = $_POST['remark'];

    $dirPath = "Data/resource_".$resourceRow['resource_id'];
    $suffix="";
    $result = func_createFile($dirPath,$serial_number,$_FILES["documentFile"],$suffix);
    if($result<0){
      $this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid),3,"文件上传失败，错误代码：".$result);
      return;
    }
    //$suffix = substr($_FILES["documentFile"]["name"],strrpos($_FILES["documentFile"]["name"],".")+1);
    $path=$dirPath."/".$serial_number.".".$suffix;
    $patharray = explode("/", $path);
    $path = implode("-_-", $patharray);


    $update_date = date("Y-m-d",time());

    //user employer
    $my_username = $_SESSION['my_username'];
    $userRow = $this->userDao->findByUsername($my_username);

    $create_userid = $userRow['userid'];
    $documentid = $this->resourceDocumentDao->add($resourceid,$serial_number,$name,$path,$update_date,
      $remark,$create_userid);

    $tagIndex = 3;
    $this->assign('tagIndex',$tagIndex);
    $this->assign('projectid',$projectid);
    if($documentid<=0)$this->display('Staticpage/wrongalert');
    else{ //$this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid));
    $this->editProject();
    }
  }

  public function editProject_editDocument(){	
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }


    $update_date = date("Y-m-d",time());
    $projectid = $_POST['projectid'];
    $serial_number = $_POST['serial_number'];
    $name = $_POST['name'];
    $remark = $_POST['remark'];
    $documentid = $_POST['documentid'];

    $documentRow = $this->resourceDocumentDao->findById($documentid);
    $path_old = $documentRow['path'];

    if($_FILES["documentFile"]["error"]>0){
      //$this->assign('wrongmessage',$_FILES["documentFile"]["error"]);
      $this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid),3,"文件上传失败，请检查文件是否过大...");
      return;
    }

    //文件夹
    $resourceRow = $this->projectResourceDao->findByProjectid($projectid);
    $dir = "Data/resource_".$resourceRow['resource_id'];
    while(!is_dir($dir)){
      mkdir($dir, 0777);
    }
    //文件
    $suffix = substr($_FILES["documentFile"]["name"],strrpos($_FILES["documentFile"]["name"],".")+1);
    $path="$dir/$serial_number.$suffix";
    //复制文件
    $patharray_old = explode("-_-", $path_old);
    $path_old = implode("/", $patharray_old);

    $result = unlink($path_old);
    if($result == false){$this->display('Staticpage/wrongalert');return;}
    move_uploaded_file($_FILES["documentFile"]["tmp_name"],$path);
    $patharray = explode("/", $path);
    $path = implode("-_-", $patharray);

    $result = $this->resourceDocumentDao->updateById($documentid,$documentRow['resourceid'],$documentRow['serial_number'],$name,$path,$update_date,
      $remark,$documentRow['create_userid']);


    $tagIndex = 3;
    $this->assign('tagIndex',$tagIndex);
    $this->assign('projectid',$projectid);
    if($result == false)$this->display('Staticpage/wrongalert');
    else{ //$this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid));
    $this->editProject();
    }

    // $test = $path_old;
    // $this->assign('test',$test);
    // $this->display('Test/test');
  }


  public function editProject_deleteDocument(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $documentid = $_GET['documentid'];
    $documentRow = $this->resourceDocumentDao->findById($documentid);
    $resourceid = $documentRow['resourceid'];
    $resourceRow = $this->projectResourceDao->findById($resourceid);
    $projectid = $resourceRow['project_id'];
    if($projectid == 0){$this->display('Staticpage/wrongalert');return;}
    $path = $documentRow['path'];
    $patharray = explode("-_-", $path);
    $path = implode("/", $patharray);
    $result = unlink($path);
    if($result == false){$this->display('Staticpage/wrongalert');return;}

    $result = $this->resourceDocumentDao->deleteById($documentid);
    $tagIndex = 3;
    $this->assign('tagIndex',$tagIndex);
    $this->assign('projectid',$projectid);
    if($result == false)$this->display('Staticpage/wrongalert');
    else{ //$this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid));
    $this->editProject();
    }
  }

  public function editProject_downloadFile(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }


    $filepath = $_GET['filepath'];
    $filepatharray = explode("-_-",$filepath);
    $filepath = implode("/", $filepatharray);

    func_downloadFile($filepath);
    exit;
  }

  public function editProject_addBiddingrival(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }


    $projectid = $_POST['projectid'];
    $name = $_POST['name'];
    $linkman = $_POST['linkman'];
    $linkman_phone = $_POST['linkman_phone'];
    $linkman_ourside = $_POST['linkman_ourside'];
    $cooperation_type = $_POST['cooperation_type'];
    $remark = $_POST['remark'];

    $biddingrivalid = $this->biddingrivalDao->add($projectid,$name,$linkman,$linkman_phone,
      $linkman_ourside,$cooperation_type,$remark);
    $tagIndex = 5;
    $this->assign('tagIndex',$tagIndex);
    $this->assign('projectid',$projectid);
    if($biddingrivalid<=0)$this->display('Staticpage/wrongalert');
    else{ //$this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid));
    $this->editProject();
    }

  }

  public function editProject_editBiddingrival(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $biddingrivalid = $_POST['biddingrivalid'];
    $projectid = $_POST['projectid'];
    $name = $_POST['name'];
    $linkman = $_POST['linkman'];
    $linkman_phone = $_POST['linkman_phone'];
    $linkman_ourside = $_POST['linkman_ourside'];
    $cooperation_type = $_POST['cooperation_type'];
    $remark = $_POST['remark'];

    // $this->assign('test',$remark);
    // $this->display('Test/test');
    $result = $this->biddingrivalDao->updateById($biddingrivalid,$projectid,$name,$linkman,$linkman_phone,
      $linkman_ourside,$cooperation_type,$remark);
    $tagIndex = 5;
    $this->assign('tagIndex',$tagIndex);
    $this->assign('projectid',$projectid);
    if($result == false)$this->display('Staticpage/wrongalert');
    else{ //$this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid));
    $this->editProject();
    }
  }

  public function editProject_deleteBiddingrival(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $biddingrivalid = $_GET['biddingrivalid'];
    $biddingrivalRow = $this->biddingrivalDao->findById($biddingrivalid);
    $projectid = $biddingrivalRow['projectid'];
    $result = $this->biddingrivalDao->deleteById($biddingrivalid);
    $tagIndex = 5;
    $this->assign('tagIndex',$tagIndex);
    $this->assign('projectid',$projectid);
    if($result == false)$this->display('Staticpage/wrongalert');
    else{ //$this->redirect('OperProjectManage/editProject',array('projectid'=>$projectid));
    $this->editProject();
    }
  }

  public function editProjectSubmit(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $projectid = $_POST['projectid'];
    $projectname = $_POST['projectname'];
    $project_address = $_POST['project_address'];
    $currentstatusid = $_POST['currentstatusid'];
    $clerkname = $_POST['clerkname'];
    $project_type = $_POST['project_type'];
    $constract_counterparty = $_POST['constract_counterparty'];
    $biddoc_type = $_POST['biddoc_type'];
    $getbid_price = $_POST['getbid_price'];
    $build_enterpriseid = $_POST['build_enterpriseid'];
    $a_project_director_name = $_POST['a_project_director_name'];
    $a_project_director_phone = $_POST['a_project_director_phone'];
    $design_enterpriseid = $_POST['design_enterpriseid'];
    $a_technology_director_name = $_POST['a_technology_director_name'];
    $a_technology_director_phone = $_POST['a_technology_director_phone'];
    $construct_enterpriseid = $_POST['construct_enterpriseid'];
    $constructunit_director_name = $_POST['constructunit_director_name'];
    $constructunit_director_phone = $_POST['constructunit_director_phone'];
    $mediator_enterpriseid = $_POST['mediator_enterpriseid'];
    $mediator_constract = $_POST['mediator_constract'];
    $covered_area = $_POST['covered_area'];
    $use_purpose = $_POST['use_purpose'];
    $info_source = $_POST['info_source'];
    $scale = $_POST['scale'];
    $project_basic_info = $_POST['project_basic_info'];

    $isknown_bid_date = 0;
    if(isset($_POST['isknown_bid_date']))$isknown_bid_date = 1;//cb
    if($isknown_bid_date == 1){
      $biddate_date = $_POST['biddate_date'];
      $biddate_preremind_days = $_POST['biddate_preremind_days'];
      //$biddate_reminder_employerid = $_POST['biddate_reminder_employerid'];
      $biddate_is_finished = 0;
      if(isset($_POST['biddate_is_finished']))$biddate_is_finished = 1;//cb
      $biddateRow = $this->biddateDao->findByProjectid($projectid);
      if($biddateRow == NULL){
        $this->biddateDao->add($projectid,$biddate_date,$biddate_preremind_days,$biddate_is_finished);
        $biddateRow = $this->biddateDao->findByProjectid($projectid);
      }
      else $this->biddateDao->updateById($biddateRow['biddate_id'],$projectid,$biddate_date,$biddate_preremind_days,$biddate_is_finished);

      $biddate_reminder_userid = $_POST['biddate_reminder_userid'];
      //处理字串
      $useridArray = explode(",",$biddate_reminder_userid);
      $biddateReminduserRowArray = $this->biddateReminduserDao->findByBiddateid($biddateRow['biddate_id']);
      foreach($biddateReminduserRowArray as $value){
        $result = $this->biddateReminduserDao->deleteById($value['id']);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
      foreach($useridArray as $value){
        $value = trim($value);
        if($value == "")continue;
        $result = $this->biddateReminduserDao->add($biddateRow['biddate_id'],$value);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
    }
    else{
      $biddateRow = $this->biddateDao->findByProjectid($projectid);
      if($biddateRow != NULL)$this->biddateDao->deleteById($biddateRow['biddate_id']);
    }



    $isknown_questionanswer_date = 0;
    if(isset($_POST['isknown_questionanswer_date']))$isknown_questionanswer_date = 1;//cb
    if($isknown_questionanswer_date == 1){
      $questionanswerdate_date = $_POST['questionanswerdate_date'];
      $questionanswerdate_preremind_days = $_POST['questionanswerdate_preremind_days'];
      //$questionanswerdate_reminder_employerid = $_POST['questionanswerdate_reminder_userid'];
      $questionanswerdate_is_finished = 0;
      if(isset($_POST['questionanswerdate_is_finished']))$questionanswerdate_is_finished = 1;//cb
      $questionanswerdateRow = $this->questionanswerdateDao->findByProjectid($projectid);
      if($questionanswerdateRow == NULL){
        $this->questionanswerdateDao->add($projectid,$questionanswerdate_date,$questionanswerdate_preremind_days,$questionanswerdate_is_finished);
        $questionanswerdateRow = $this->questionanswerdateDao->findByProjectid($projectid);
      }
      else $this->questionanswerdateDao->updateById($questionanswerdateRow['questionanswerdate_id'],$projectid,$questionanswerdate_date,$questionanswerdate_preremind_days,$questionanswerdate_is_finished);

      $questionanswerdate_reminder_userid = $_POST['questionanswerdate_reminder_userid'];
      //处理字串
      $useridArray = explode(",",$questionanswerdate_reminder_userid);
      $questionanswerdateReminduserRowArray = $this->questionanswerdateReminduserDao->findByquestionanswerdateid($questionanswerdateRow['questionanswerdate_id']);
      foreach($questionanswerdateReminduserRowArray as $value){
        $result = $this->questionanswerdateReminduserDao->deleteById($value['id']);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
      foreach($useridArray as $value){
        $value = trim($value);
        if($value == "")continue;
        $result = $this->questionanswerdateReminduserDao->add($questionanswerdateRow['questionanswerdate_id'],$value);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
    }
    else{
      $questionanswerdateRow = $this->questionanswerdateDao->findByProjectid($projectid);
      if($questionanswerdateRow != NULL)$this->questionanswerdateDao->deleteById($questionanswerdateRow['questionanswerdate_id']);
    }
    // $questionanswerdate_date = $_POST['questionanswerdate_date'];
    // $questionanswerdate_preremind_days = $_POST['questionanswerdate_preremind_days'];
    // $questionanswerdate_reminder_employerid = $_POST['questionanswerdate_reminder_employerid'];
    // $questionanswerdate_is_finished = 0;
    // if(isset($_POST['questionanswerdate_is_finished']))$questionanswerdate_is_finished = 1;//cb





    $isknown_submitbiddoc_date = 0;
    if(isset($_POST['isknown_submitbiddoc_date']))$isknown_submitbiddoc_date = 1;//cb
    if($isknown_submitbiddoc_date == 1){
      $submitbiddocdate_date = $_POST['submitbiddocdate_date'];
      $submitbiddocdate_preremind_days = $_POST['submitbiddocdate_preremind_days'];
      //$submitbiddocdate_reminder_employerid = $_POST['submitbiddocdate_reminder_employerid'];
      $submitbiddocdate_is_finished = 0;
      if(isset($_POST['submitbiddocdate_is_finished']))$submitbiddocdate_is_finished = 1;//cb
      $submitbiddocdateRow = $this->submitbiddocdateDao->findByProjectid($projectid);
      if($submitbiddocdateRow == NULL){
        $this->submitbiddocdateDao->add($projectid,$submitbiddocdate_date,$submitbiddocdate_preremind_days,$submitbiddocdate_is_finished);
        $submitbiddocdateRow = $this->submitbiddocdateDao->findByProjectid($projectid);
      }
      else $this->submitbiddocdateDao->updateById($submitbiddocdateRow['submitbiddocdate_id'],$projectid,$submitbiddocdate_date,$submitbiddocdate_preremind_days,$submitbiddocdate_is_finished);

      $submitbiddocdate_reminder_userid = $_POST['submitbiddocdate_reminder_userid'];
      //处理字串
      $useridArray = explode(",",$submitbiddocdate_reminder_userid);
      $submitbiddocdateReminduserRowArray = $this->submitbiddocdateReminduserDao->findBysubmitbiddocdateid($submitbiddocdateRow['submitbiddocdate_id']);
      foreach($submitbiddocdateReminduserRowArray as $value){
        $result = $this->submitbiddocdateReminduserDao->deleteById($value['id']);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
      foreach($useridArray as $value){
        $value = trim($value);
        if($value == "")continue;
        $result = $this->submitbiddocdateReminduserDao->add($submitbiddocdateRow['submitbiddocdate_id'],$value);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
    }
    else{
      $submitbiddocdateRow = $this->submitbiddocdateDao->findByProjectid($projectid);
      if($submitbiddocdateRow != NULL)$this->submitbiddocdateDao->deleteById($submitbiddocdateRow['submitbiddocdate_id']);
    }

    // $submitbiddocdate_date = $_POST['submitbiddocdate_date'];
    // $submitbiddocdate_preremind_days = $_POST['submitbiddocdate_preremind_days'];
    // $submitbiddocdate_reminder_employerid = $_POST['submitbiddocdate_reminder_employerid'];
    // $submitbiddocdate_is_finished = 0;
    // if(isset($_POST['submitbiddocdate_is_finished']))$submitbiddocdate_is_finished = 1;//cb

    $isknown_startbid_date = 0;
    if(isset($_POST['isknown_startbid_date']))$isknown_startbid_date = 1;//cb
    if($isknown_startbid_date == 1){
      $startbiddate_date = $_POST['startbiddate_date'];
      $startbiddate_preremind_days = $_POST['startbiddate_preremind_days'];
      //$startbiddate_reminder_employerid = $_POST['startbiddate_reminder_employerid'];
      $startbiddate_is_finished = 0;
      if(isset($_POST['startbiddate_is_finished']))$startbiddate_is_finished = 1;//cb
      $startbiddateRow = $this->startbiddateDao->findByProjectid($projectid);
      if($startbiddateRow == NULL){
        $this->startbiddateDao->add($projectid,$startbiddate_date,$startbiddate_preremind_days,$startbiddate_is_finished);
        $startbiddateRow = $this->startbiddateDao->findByProjectid($projectid);
      }

      else $this->startbiddateDao->updateById($startbiddateRow['startbiddate_id'],$projectid,$startbiddate_date,$startbiddate_preremind_days,$startbiddate_is_finished);

      $startbiddate_reminder_userid = $_POST['startbiddate_reminder_userid'];
      //处理字串
      $useridArray = explode(",",$startbiddate_reminder_userid);
      $startbiddateReminduserRowArray = $this->startbiddateReminduserDao->findBystartbiddateid($startbiddateRow['startbiddate_id']);
      foreach($startbiddateReminduserRowArray as $value){
        $result = $this->startbiddateReminduserDao->deleteById($value['id']);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
      foreach($useridArray as $value){
        $value = trim($value);
        if($value == "")continue;
        $result = $this->startbiddateReminduserDao->add($startbiddateRow['startbiddate_id'],$value);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
    }
    else{
      $startbiddateRow = $this->startbiddateDao->findByProjectid($projectid);
      if($startbiddateRow != NULL)$this->startbiddateDao->deleteById($startbiddateRow['startbiddate_id']);
    }
    // $startbiddate_date = $_POST['startbiddate_date'];
    // $startbiddate_preremind_days = $_POST['startbiddate_preremind_days'];
    // $startbiddate_reminder_employerid = $_POST['startbiddate_reminder_employerid'];
    // $startbiddate_is_finished = 0;
    // if(isset($_POST['startbiddate_is_finished']))$startbiddate_is_finished = 1;//cb

    $isknown_margin_date = 0;
    if(isset($_POST['isknown_margin_date']))$isknown_margin_date = 1;//cb
    if($isknown_margin_date == 1){
      $margindate_date = $_POST['margindate_date'];
      $margindate_preremind_days = $_POST['margindate_preremind_days'];
      //$margindate_reminder_employerid = $_POST['margindate_reminder_employerid'];
      $margindate_amount = $_POST['margindate_amount'];
      $margindate_is_submit = 0;
      if(isset($_POST['margindate_is_submit']))$margindate_is_submit = 1;//cb
      $margindate_is_getback = 0;
      if(isset($_POST['margindate_is_getback']))$margindate_is_getback = 1;//cb
      $margindateRow = $this->margindateDao->findByProjectid($projectid);
      if($margindateRow == NULL){
        $this->margindateDao->add($projectid,$margindate_date,$margindate_preremind_days,$margindate_amount,$margindate_is_submit,$margindate_is_getback);
        $margindateRow = $this->margindateDao->findByProjectid($projectid);
      }
      else $this->margindateDao->updateById($margindateRow['margindate_id'],$projectid,$margindate_date,$margindate_preremind_days,$margindate_amount,$margindate_is_submit,$margindate_is_getback);

      $margindate_reminder_userid = $_POST['margindate_reminder_userid'];
      //处理字串
      $useridArray = explode(",",$margindate_reminder_userid);
      $margindateReminduserRowArray = $this->margindateReminduserDao->findBymargindateid($margindateRow['margindate_id']);
      foreach($margindateReminduserRowArray as $value){
        $result = $this->margindateReminduserDao->deleteById($value['id']);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
      foreach($useridArray as $value){
        $value = trim($value);
        if($value == "")continue;
        $result = $this->margindateReminduserDao->add($margindateRow['margindate_id'],$value);
        if($result == false)$this->display('Staticpage/wrongalert');
      }
    }
    else{
      $margindateRow = $this->margindateDao->findByProjectid($projectid);
      if($margindateRow != NULL)$this->margindateDao->deleteById($margindateRow['margindate_id']);
    }

    // $margindate_date = $_POST['margindate_date'];
    // $margindate_preremind_days = $_POST['margindate_preremind_days'];
    // $margindate_reminder_employerid = $_POST['margindate_reminder_employerid'];
    // $margindate_amount = $_POST['margindate_amount'];
    // $margindate_is_submit = 0;
    // if(isset($_POST['margindate_is_submit']))$margindate_is_submit = 1;//cb
    // $margindate_is_getback = 0;
    // if(isset($_POST['margindate_is_getback']))$margindate_is_getback = 1;//cb


    $advantage = $_POST['advantage'];
    $drawback = $_POST['drawback'];

    //$this->assign('test',$build_enterpriseid);
    //$this->display('Test/test');

    //dealing data
    $result = $this->projectDao->updateById($projectid,$projectname,$currentstatusid,$clerkname,$build_enterpriseid,$design_enterpriseid,
      $construct_enterpriseid,$mediator_enterpriseid,$mediator_constract,$project_address,$project_type,
      $constract_counterparty,$a_project_director_name,$a_project_director_phone,$a_technology_director_name,$a_technology_director_phone,
      $constructunit_director_name,$constructunit_director_phone,$biddoc_type,$getbid_price,$use_purpose,
      $covered_area,$info_source,$scale,$project_basic_info,$isknown_bid_date,
      $isknown_questionanswer_date,$isknown_submitbiddoc_date,$isknown_startbid_date,$isknown_margin_date,$advantage,
      $drawback);
    if($result == false)$this->display('Staticpage/wrongalert');
    else $this->redirect('OperProjectManage/listProject');
  }

  public function deleteProject(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_EXPLORE;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $projectid = $_GET['projectid'];
    $result = $this->projectDao->deleteById($projectid);
    if($result == false){$this->display('Staticpage/wrongalert');return;}

    $projectResourceRow = $this->projectResourceDao->findByProjectid($projectid);
    if($projectResourceRow != NULL && $projectResourceRow['resource_level'] == 0){
      $this->projectResourceDao->deleteById($projectResourceRow['resource_id']);
      //删除文件夹
      $dir = "Data/resource_".$projectResourceRow['resource_id'];
      func_deleteDir($dir);
    }
    $this->redirect('OperProjectManage/listProject',array(),3,"删除开拓项目成功...");	

  }

  //项目开拓================================================================================
  //项目维护--------------------------------------------------------------------------------
  public function maintenanceProject(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resourceRowArray = $this->projectResourceDao->findAll();		
    $enterpriseRowArray = $this->enterpriseDao->findAll();

    $this->assign('resourceRowArray',$resourceRowArray);	
    $this->assign('enterpriseRowArray',$enterpriseRowArray);

    $processRowArray=$this->processDao->findAll();
    $processClassifyRowArray=$this->processClassifyDao->findAll();
    foreach($processRowArray as $key=>$value){
      $classify=$this->processClassifyDao->findById($value['process_classify_id']);
      $processRowArray[$key]['process_classify_name']=$classify['process_classify_name'];
    }
    $this->assign('processRowArray',$processRowArray);
    $this->assign('processClassifyRowArray',$processClassifyRowArray);

    $this->display('OperProjectManage/maintenanceProject');
  }

  public function projectResource(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resourceRowArray = $this->projectResourceDao->findAll();
    $projectRowArray=$this->projectDao->findALL_0_1_2_3_4_5();
    $companyRowArray = $this->companyDao->findAll();
    $userAuthorityRowArray=$this->userDao->findUserAuthority();

    foreach($projectRowArray as $key=>$value){
      $statueName=$this->projectstatusDao->findById($value['currentstatusid']);			
      $projectRowArray[$key]['currentstatusname']=$statueName['name'];

      $build_enterprise_name=$this->enterpriseDao->findById($value['build_enterpriseid']);
      $projectRowArray[$key]['buildenterprisename']=$build_enterprise_name['name'];

      $design_enterprise_name=$this->enterpriseDao->findById($value['design_enterpriseid']);
      $projectRowArray[$key]['designenterprisename']=$build_enterprise_name['name'];
    }
    $this->assign('resourceRowArray',$resourceRowArray);
    $this->assign('projectRowArray',$projectRowArray);
    $this->assign('companyRowArray',$companyRowArray);
    $this->assign('userAuthorityRowArray',$userAuthorityRowArray);
    $this->display('OperProjectManage/projectResource');
  }

  public function addProjectResource(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $project_id=$_POST['project_id'];
    $resource_name=$_POST['resource_name'];
    $resource_type=$_POST['resource_type'];
    $resource_belonged_subsidiary=$_POST['resource_belonged_subsidiary'];
    $resource_user_authority=$_POST['resource_user_authority'];
    $resource_father_id=$_POST['resource_father_id'];		
    $resource_level=$_POST['resource_level'];
    $resource_haschildren=$_POST['resource_haschildren'];
    $resource_haschildren_init=0;				

    if($resource_haschildren==1){
      $this->projectResourceDao->updateFather($resource_haschildren,$resource_father_id);
    }

    if($project_id!=0){
      $resourceRow = $this->projectResourceDao->findByProjectid($project_id);
      //$result=$this->projectResourceDao->updateByProjectId($project_id,$resource_name,$resource_belonged_subsidiary,$resource_user_authority);
      $result = $this->projectResourceDao->updateById($resourceRow['resource_id'],$resource_name,$resource_type,$resource_father_id,$resource_level,$resource_haschildren_init,$resource_belonged_subsidiary,$resource_user_authority,$project_id);
      if($result == false){
        $this->display('Staticpage/wrongalert');
        return;
      }
    }
    else{
      $result=$this->projectResourceDao->add($project_id,$resource_name,$resource_type,$resource_belonged_subsidiary,$resource_user_authority,$resource_father_id,$resource_level,$resource_haschildren_init);
      if($result <= 0){
        $this->display('Staticpage/wrongalert');
        return;
      }
      $dir = "Data/resource_".$result;
      while(!is_dir($dir)){
        mkdir($dir, 0777);
      }
    }

    $data['id']=$result;
    $this->ajaxReturn($data,'JSON');	
  }

  public function getSubsidiary(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resource_id=$_POST['resource_id'];
    $company_id=$this->projectResourceDao->findCompanyByResourceId($resource_id);

    $this->ajaxReturn($company_id['resource_belonged_subsidiary'],'JSON');
  }

  public function getAuthorityUser(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resource_id=$_POST['resource_id'];
    $authority_user=$this->projectResourceDao->findAuthorityByResourceId($resource_id);
    $this->ajaxReturn($authority_user['resource_user_authority'],'JSON');
  }

  public function updateProjectResource(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resource_id=$_POST['resource_id'];
    $resource_name=$_POST['resource_name'];
    $resource_belonged_subsidiary=$_POST['resource_belonged_subsidiary'];
    $resource_user_authority=$_POST['resource_user_authority'];

    $resourceRow=$this->projectResourceDao->findById($resource_id);
    $result=$this->projectResourceDao->updateById($resource_id,$resource_name,$resourceRow['resource_type'],$resourceRow['resource_father_id'],$resourceRow['resource_level'],$resourceRow['resource_haschildren'],$resource_belonged_subsidiary,$resource_user_authority,$resourceRow['project_id']);
  } 

  public function deleteProjectResource(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resource_id=$_POST['resource_id'];
    $resource_haschildren=$_POST['resource_haschildren'];
    $resource_father_id=$_POST['resource_father_id'];		

    if($resource_id==1 || $resource_id==2){
      return false;
    }else{		
      $resourceRow = $this->projectResourceDao->findById($resource_id);
      if($resourceRow['project_id'] != 0){
        $this->projectResourceDao->updateById($resource_id,$resourceRow['resource_name'],0,0,0,0,0,0,$resourceRow['project_id']);
      }else{
        //删除文件夹
        $dirPath = "Data/resource_".$resource_id;
        func_deleteDir($dirPath);
        $this->projectResourceDao->deleteById($resource_id);
      }

      $this->projectResourceDao->updateFather($resource_haschildren,$resource_father_id);			
      $this->standardProjectDao->deleteByResourceId($resource_id);
      $this->warehouseDao->deleteByResourceId($resource_id);
      $this->warehouseWorkerDao->deleteByResourceId($resource_id);
      $this->subcontractorDao->deleteByResourceId($resource_id);
      $this->subcontractorWorkerDao->deleteByResourceId($resource_id);
      $this->projectProcessDao->deleteByResourceId($resource_id);
      $this->controlSettingDao->deleteByResourceId($resource_id);
    }
  }

  public function getSubcontractor(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resource_id=$_POST['resource_id'];
    $related_subcontractor=$this->subcontractorDao->getByResourceId($resource_id);

    $this->ajaxReturn($related_subcontractor,'JSON');
  }

  public function addSubcontractor(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resource_id=$_POST['resource_id'];
    $enterprise_id=$_POST['enterprise_id'];
    $subcontractor_name=$_POST['subcontractor_name'];

    $result=$this->subcontractorDao->add($resource_id,$enterprise_id,$subcontractor_name);

    if($result == -1){
      $this->display('Staticpage/wrongalert');
    }else {
      $data['id']=$result;
      $this->ajaxReturn($data,'JSON');
    }
  }

  public function deleteSubcontractor(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $subcontractor_id=$_POST['subcontractor_id'];
    $this->subcontractorDao->deleteById($subcontractor_id);
    $this->subcontractorWorkerDao->deleteBySubcontractorId($subcontractor_id);
  }

  public function getSubcontractorWorker(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $subcontractor_id=$_POST['subcontractor_id'];
    $related_subcontractor_work=$this->subcontractorWorkerDao->getBySubcontractorId($subcontractor_id);

    $this->ajaxReturn($related_subcontractor_work,'JSON');
  }

  public function addSubcontractorWorker(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $subcontractor_worker_name=$_POST['subcontractor_worker_name'];
    $subcontractor_id=$_POST['subcontractor_id'];
    $result=$this->subcontractorWorkerDao->add($subcontractor_worker_name,$subcontractor_id);

    if($result == -1){
      $this->display('Staticpage/wrongalert');
    }else {
      $data['id']=$result;
      $this->ajaxReturn($data,'JSON');
    }
  }

  public function updateSubcontractorWorker(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $subcontractor_worker_id=$_POST['subcontractor_worker_id'];
    $subcontractor_worker_name=$_POST['subcontractor_worker_name'];

    $result=$this->subcontractorWorkerDao->updateById($subcontractor_worker_id,$subcontractor_worker_name);
  }

  public function deleteSubcontractorWorker(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $subcontractor_worker_id=$_POST['subcontractor_worker_id'];
    $result=$this->subcontractorWorkerDao->deleteById($subcontractor_worker_id);
  }

  public function getWarehouse(){

    $resource_id=$_POST['resource_id'];
    $related_warehouse=$this->warehouseDao->getByResourceId($resource_id);

    $this->ajaxReturn($related_warehouse,'JSON');
  }

  public function addWarehouse(){
    $resource_id=$_POST['resource_id'];
    $warehouse_name=$_POST['warehouse_name'];
    $result=$this->warehouseDao->add($warehouse_name,$resource_id);

    if($result == -1){
      $this->display('Staticpage/wrongalert');
    }else {
      $data['id']=$result;
      $this->ajaxReturn($data,'JSON');
    }
  }

  public function updateWarehouse(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $warehouse_name=$_POST['warehouse_name'];
    $warehouse_id=$_POST['warehouse_id'];

    $result=$this->warehouseDao->updateById($warehouse_name,$warehouse_id);
  }

  public function deleteWarehouse(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $warehouse_id=$_POST['warehouse_id'];
    $result=$this->warehouseDao->deleteById($warehouse_id);
  }

  public function getWarehouseWorker(){
    $resource_id=$_POST['resource_id'];
    $related_warehouse_worker=$this->warehouseWorkerDao->getByResourceId($resource_id);

    $this->ajaxReturn($related_warehouse_worker,'JSON');
  }

  public function addWarehouseWorker(){
    $resource_id=$_POST['resource_id'];
    $warehouse_worker_name=$_POST['warehouse_worker_name'];
    $result=$this->warehouseWorkerDao->add($warehouse_worker_name,$resource_id);

    if($result == -1){
      $this->display('Staticpage/wrongalert');
    }else {
      $data['id']=$result;
      $this->ajaxReturn($data,'JSON');
    }
  }

  public function updateWarehouseWorker(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $warehouse_worker_name=$_POST['warehouse_worker_name'];
    $warehouse_worker_id=$_POST['warehouse_worker_id'];

    $result=$this->warehouseWorkerDao->updateById($warehouse_worker_name,$warehouse_worker_id);
  }

  public function deleteWarehouseWorker(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $warehouse_worker_id=$_POST['warehouse_worker_id'];
    $result=$this->warehouseWorkerDao->deleteById($warehouse_worker_id);
  }

  public function getProjectProcess(){
    $resource_id=$_POST['resource_id'];
    $related_project_process=$this->projectProcessDao->findByResourceId($resource_id);

    $this->ajaxReturn($related_project_process,"JSON");
  }

  public function addProjectProcess(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resource_id=$_POST['resource_id'];
    $process_name=$_POST['process_name'];
    $quantity=$_POST['quantity'];
    $unit=$_POST['unit'];
    $unit_price=$_POST['unit_price'];		
    $plan_start_time=$_POST['plan_start_time'];
    $plan_duration=$_POST['plan_duration'];
    $actual_start_time=$_POST['actual_start_time'];
    $plan_cost=$_POST['plan_cost'];
    $material_budget=$_POST['material_budget'];

    $result=$this->projectProcessDao->addProjectProcess($resource_id,$process_name,$quantity,$unit,$unit_price,$plan_start_time,$plan_duration,$actual_start_time,$plan_cost,$material_budget);
    if($result == -1){
      $this->display('Staticpage/wrongalert');
    }else {
      $data['id']=$result;
      $this->ajaxReturn($data,'JSON');
    }
  }

  public function updateProjectProcess(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $project_process_id=$_POST['project_process_id'];
    $process_name=$_POST['process_name'];
    $quantity=$_POST['quantity'];
    $unit=$_POST['unit'];
    $unit_price=$_POST['unit_price'];		
    $plan_start_time=$_POST['plan_start_time'];
    $plan_duration=$_POST['plan_duration'];
    $actual_start_time=$_POST['actual_start_time'];
    $plan_cost=$_POST['plan_cost'];
    $material_budget=$_POST['material_budget'];

    $result=$this->projectProcessDao->updateProjectProcess($project_process_id,$process_name,$quantity,$unit,$unit_price,$plan_start_time,$plan_duration,$actual_start_time,$plan_cost,$material_budget);
  }

  public function deleteProjectProcess(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $project_process_id=$_POST['project_process_id'];

    $result=$this->projectProcessDao->deleteProjectProcess($project_process_id);
  }

  public function editProjectResource(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resource_id=$_POST['resource_id'];
    $prname=$_POST['prname'];
    $enterprise_1partid=$_POST['enterprise_1partid'];
    $enterprise_supervisorid=$_POST['enterprise_supervisorid'];
    $total_quantites=$_POST['total_quantites'];
    $construct_layers=$_POST['construct_layers'];
    $pm_name=$_POST['pm_name'];
    $vice_pm_name=$_POST['vice_pm_name'];
    $startdate_actually=$_POST['startdate_actually'];
    $finishdate_actually=$_POST['finishdate_actually'];
    $receivestuff_address=$_POST['receivestuff_address'];
    $receiveperson_phonenumber=$_POST['receiveperson_phonenumber'];
    $description=$_POST['description'];
    $materialbuyingprocess_setting=$_POST['materialbuyingprocess_setting'];
    $materialbuyingplanaudit_setting=$_POST['materialbuyingplanaudit_setting'];		
    $infield_pattern=$_POST['infield_pattern'];
    $infield_site=$_POST['infield_site'];

    $refuse_buyingplan_nobudget=$_POST['refuse_buyingplan_nobudget'];
    $refuse_buyingplan_excessbudget=$_POST['refuse_buyingplan_excessbudget'];
    $refuse_materialbuying_nobudget=$_POST['refuse_materialbuying_nobudget'];
    $refuse_materialbuying_excessbudget=$_POST['refuse_materialbuying_excessbudget'];
    $refuse_materialout_nobudget=$_POST['refuse_materialout_nobudget'];
    $refuse_materialout_excessbudget=$_POST['refuse_materialout_excessbudget'];
    $refuse_materialallocate_nobudget=$_POST['refuse_materialallocate_nobudget'];
    $refuse_materialallocate_excessbudget=$_POST['refuse_materialallocate_excessbudget'];
    $refuse_otherin_nobudget=$_POST['refuse_otherin_nobudget'];
    $refuse_otherin_excessbudget=$_POST['refuse_otherin_excessbudget'];

    $exist_id=$this->standardProjectDao->findExistId($resource_id);	
    if($exist_id!==false){			
      $result=$this->standardProjectDao->updateById($exist_id['standardprojectid'],$prname,$enterprise_1partid,$enterprise_supervisorid,
        $total_quantites,$construct_layers,$pm_name,$vice_pm_name,$startdate_actually,$finishdate_actually,
        $receivestuff_address,$receiveperson_phonenumber,$description,$materialbuyingprocess_setting,
        $materialbuyingplanaudit_setting,$infield_pattern,$infield_site);

    }else{
      $result=$this->standardProjectDao->add($resource_id,$prname,$enterprise_1partid,$enterprise_supervisorid,
        $total_quantites,$construct_layers,$pm_name,$vice_pm_name,$startdate_actually,$finishdate_actually,
        $receivestuff_address,$receiveperson_phonenumber,$description,$materialbuyingprocess_setting,
        $materialbuyingplanaudit_setting,$infield_pattern,$infield_site);
    }

    $exist_control_id=$this->controlSettingDao->findExistId($resource_id);
    if($exist_control_id!==false){			
      $result_control=$this->controlSettingDao->updateById($exist_control_id['controlsetting_id'],$refuse_buyingplan_nobudget,$refuse_buyingplan_excessbudget,
        $refuse_materialbuying_nobudget,$refuse_materialbuying_excessbudget,$refuse_materialout_nobudget,$refuse_materialout_excessbudget,
        $refuse_materialallocate_nobudget,$refuse_materialallocate_excessbudget,$refuse_otherin_nobudget,$refuse_otherin_excessbudget);		
    }else{
      $result_control=$this->controlSettingDao->add($resource_id,$refuse_buyingplan_nobudget,$refuse_buyingplan_excessbudget,
        $refuse_materialbuying_nobudget,$refuse_materialbuying_excessbudget,$refuse_materialout_nobudget,$refuse_materialout_excessbudget,
        $refuse_materialallocate_nobudget,$refuse_materialallocate_excessbudget,$refuse_otherin_nobudget,$refuse_otherin_excessbudget);
    }

    if($result == -1 || $result_control == -1){
      $this->display('Staticpage/wrongalert');
    }else{			
      $this->redirect('OperProjectManage/maintenanceProject',array(),3,"保存项目信息成功！");
    }
  }

  public function getStandardProject(){
    $resource_id=$_POST['resource_id'];
    $standardProjectRow=$this->standardProjectDao->findByResourceId($resource_id);		

    $enterprise_1part=$this->enterpriseDao->findById($standardProjectRow['enterprise_1partid']);
    $enterprise_supervisor=$this->enterpriseDao->findById($standardProjectRow['enterprise_supervisorid']);
    $standardProjectRow['enterprise_1part_name']=$enterprise_1part['name'];
    $standardProjectRow['enterprise_supervisor_name']=$enterprise_supervisor['name'];
    $this->ajaxReturn($standardProjectRow,'JSON');
  }

  public function getControlSetting(){
    $resource_id=$_POST['resource_id'];
    $controlSettingRow=$this->controlSettingDao->findByResourceId($resource_id);			
    $this->ajaxReturn($controlSettingRow,'JSON');
  }

  public function getResourceDocument(){
    $resource_id=$_POST['resource_id'];
    $related_resource_document=$this->resourceDocumentDao->findByResourceid($resource_id);
    foreach($related_resource_document as $key=>$value){
      $create_userid=$value['create_userid'];
      $related_resource_document[$key]['user']=$this->userInfoByUserid($create_userid);
    }
    $this->ajaxReturn($related_resource_document,'JSON');

  }

  public function addResourceDocument(){
 /*           $check=$_POST['check'];    
            if(!empty($_FILES['documentFile'])){
                $data['id']=$check;
          echo json_encode($data);

            }           

  */
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }   


    $resource_id=$_POST['resource_id'];
    $check=$_POST['check'];
    $document_id=$_POST['document_id'];
    $document_name=$_POST['document_name'];
    $document_remark=$_POST['document_remark'];
    if($check==1){
      $serial_number = $this->resourceFileSNGenerate($resource_id);
    }else $serial_number = $document_id;

    $dirPath = "Data/resource_".$resource_id;
    $suffix="";
    $result = func_createFile($dirPath,$serial_number,$_FILES["documentFile"],$suffix);
    if($result<0){
      $this->display('Staticpage/wrongalert');
      return;
    }
    //$suffix = substr($_FILES["documentFile"]["name"],strrpos($_FILES["documentFile"]["name"],".")+1);
    $path=$dirPath."/".$serial_number.".".$suffix;
    $patharray = explode("/", $path);
    $path = implode("-_-", $patharray);

    $update_date = date("Y-m-d",time());
    $my_username = $_SESSION['my_username'];
    $userRow = $this->userDao->findByUsername($my_username);

    $create_userid = $userRow['userid'];
    $documentid = $this->resourceDocumentDao->add($resource_id,$serial_number,$document_name,$path,$update_date,$document_remark,$create_userid);

    $document['id']=$documentid;
    $document['serial_number']=$serial_number;
    $document['name']=$document_name;
    $document['date']=$update_date;
    $document['remark']=$document_remark;
    $document['path']=$path;
    $document['user']=$this->userInfoByUserid($create_userid);
    echo json_encode($document);
  }

  public function editResourceDocument(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $document_id=$_POST['document_id'];
    $serial_number = $_POST['serial_number'];
    $update_date = date("Y-m-d",time());
    $document_name=$_POST['doc_name'];
    $document_remark=$_POST['doc_remark'];

    $documentRow = $this->resourceDocumentDao->findById($document_id);
    $path_old = $documentRow['path'];
    $dir = "Data/resource_".$documentRow['resourceid'];
    while(!is_dir($dir)){
      mkdir($dir, 0777);
    }

    $suffix = substr($_FILES["docFile"]["name"],strrpos($_FILES["docFile"]["name"],".")+1);
    $path="$dir/$serial_number.$suffix";

    //复制文件
    $patharray_old = explode("-_-", $path_old);
    $path_old = implode("/", $patharray_old);
    $result = unlink($path_old);
    if($result == false){$this->display('Staticpage/wrongalert');return;}
    move_uploaded_file($_FILES["docFile"]["tmp_name"],$path);
    $patharray = explode("/", $path);
    $path = implode("-_-", $patharray);
    $result = $this->resourceDocumentDao->updateById($document_id,$documentRow['resourceid'],$documentRow['serial_number'],$document_name,$path,$update_date,$document_remark,$documentRow['create_userid']);

    echo json_encode("修改成功！");
  }

  public function deleteResourceDocument(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $documentid = $_GET['documentid'];
    $documentRow = $this->resourceDocumentDao->findById($documentid);
    $resourceid = $documentRow['resourceid'];

    $path = $documentRow['path'];
    $patharray = explode("-_-", $path);
    $path = implode("/", $patharray);
    $result = unlink($path);
    if($result == false){$this->display('Staticpage/wrongalert');return;}
    $result = $this->resourceDocumentDao->deleteById($documentid);

  }

  //项目维护================================================================================
  //项目进度填报----------------------------------------------------------------------------
  public function resourceProcess(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_SCHEDULE_INPUT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }


    $resourceRowArray = $this->projectResourceDao->findAll();
    $this->assign('resourceRowArray',$resourceRowArray);

    if(isset($_GET['resource_id']) == false){
      //树打开 未选中
      $this->assign('treeExist',true);
      //$this->assign('currentResourceid',0);
      $this->display('OperProjectManage/resourceProcess');
      return;
    }

    $resource_id = $_GET['resource_id'];
    $resourceRow = $this->projectResourceDao->findById($resource_id);
    $this->assign('resourceRow',$resourceRow);
    $processRowArray = $this->projectProcessDao->findByResourceId($resource_id);
    foreach($processRowArray as $key=>$value){
      $project_process_id = $value['project_process_id'];
      $processPeriodworkRowArray = $this->processPeriodworkDao->findByProcessid($project_process_id);
      foreach($processPeriodworkRowArray as $key2=>$value2){
        $userRow = $this->userDao->findById($value2['create_userid']);
        $employerRow = $this->employerDao->findById($userRow['employerid']);
        $showName = $employerRow['name']."[".$employerRow['employer_number']."]";
        $processPeriodworkRowArray[$key2]['showName'] = $showName;
      }
      $processRowArray[$key]['processPeriodworkRowArray']=$processPeriodworkRowArray;
    }

    $this->assign('processRowArray',$processRowArray);
    //树收起 选中
    $this->assign('treeExist',false);
    $this->assign('currentResourceid',$resource_id);
    //$this->assign('test',$processRowArray[0]['process_name']);
    //$this->display('Test/test');
    $this->display('OperProjectManage/resourceProcess');
  }

  public function resourceProcess_addPeriodwork(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_SCHEDULE_INPUT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $confirm_date = $_POST['confirm_date'];
    $period_count = $_POST['period_count'];
    $remark = $_POST['remark'];
    $project_process_id = $_POST['partid'];
    $processRow = $this->projectProcessDao->findById($project_process_id);
    $resource_id = $processRow['resource_id'];
    //创建人
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    //$employerRow = $this->employerDao->findById($userRow['employerid']);
    //创建时间
    $create_date = date("Y-m-d",time());

    $result = $this->processPeriodworkDao->add($project_process_id,$create_date,$userRow['userid'],$confirm_date,$period_count,$remark);
    if($result == false)$this->display('Staticpage/wrongalert');

    // $this->assign('project_process_id',$project_process_id);
    // $this->assign('create_date',$create_date);
    // $this->assign('author',$author);
    // $this->assign('confirm_date',$confirm_date);
    // $this->assign('period_count',$period_count);
    // $this->assign('remark',$remark);

    else $this->redirect('OperProjectManage/resourceProcess',array('resource_id'=>$resource_id),3,"添加部位进度成功...");
  }

  public function resourceProcess_editPeriodwork(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_SCHEDULE_INPUT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $periodworkid = $_POST['periodworkid'];
    $confirm_date = $_POST['confirm_date'];
    $period_count = $_POST['period_count'];
    $remark = $_POST['remark'];

    $periodworkRow = $this->processPeriodworkDao->findById($periodworkid);
    $processRow = $this->projectProcessDao->findById($periodworkRow['project_process_id']);
    $resource_id = $processRow['resource_id'];

    $periodworkRow = $this->processPeriodworkDao->findById($periodworkid);
    $result = $this->processPeriodworkDao->updateById($periodworkid,$periodworkRow['project_process_id'],$periodworkRow['create_date'],$periodworkRow['create_userid'],$confirm_date,$period_count,$remark);
    if($result == false)$this->display('Staticpage/wrongalert');
    else $this->redirect('OperProjectManage/resourceProcess',array('resource_id'=>$resource_id),3,"修改部位进度成功...");

  }

  public function resourceProcess_deletePeriodwork(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_SCHEDULE_INPUT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $periodworkid = $_GET['periodworkid'];
    $periodworkRow = $this->processPeriodworkDao->findById($periodworkid);
    $processRow = $this->projectProcessDao->findById($periodworkRow['project_process_id']);
    $resourceRow = $this->projectResourceDao->findById($processRow['resource_id']);
    $resourceid = $resourceRow['resource_id'];
    // $this->assign('test',$resourceid);
    // $this->display('Test/test');
    $result = $this->processPeriodworkDao->deleteById($periodworkid);
    if($result == false)$this->display('Staticpage/wrongalert');
    else $this->redirect('OperProjectManage/resourceProcess',array('resource_id'=>$resourceid),3,"删除部位进度成功...");
  }


  //项目进度填报=============================================================================
  //项目形象进度------------------------------------------------------------------------------
  public function chartsProcess(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_SCHEDULE_SHOW;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }


    $resourceRowArray = $this->projectResourceDao->findAll();
    $this->assign('resourceRowArray',$resourceRowArray);

    if(isset($_GET['resource_id']) == false){
      //树打开 未选中
      $this->assign('treeExist',true);
      //$this->assign('currentResourceid',0);
      $this->display('OperProjectManage/chartsProcess');
      return;
    }

    $this->assign('treeExist',false);
    $resource_id = $_GET['resource_id'];

    $resourceRow = $this->projectResourceDao->findById($resource_id);
    $this->assign('resourceRow',$resourceRow);

    //部位
    $processRowArray = $this->projectProcessDao->findByResourceId($resource_id);
    foreach($processRowArray as $key=>$value){
      $processPeriodworkRowArray = $this->processPeriodworkDao->findByProcessid($value['project_process_id']);
      if(count($processPeriodworkRowArray) == 0){
        $actual_quntitySum = 0;
      }
      else{
        $actual_quntitySum = 0;
        foreach($processPeriodworkRowArray as $key2=>$value2){
          //累计工程量
          $actual_quntitySum += $value2['period_count'];
        }
      }

      $actualDuration = floor((time() - strtotime($value['actual_start_time']))/(24*3600))+1;
      $processRowArray[$key]['actualDuration']=$actualDuration;
      //完成工程量
      $processRowArray[$key]['actual_quntitySum']=$actual_quntitySum;
      $processRowArray[$key]['processPeriodworkRowArray']=$processPeriodworkRowArray;
    }

    $this->assign('processRowArray',$processRowArray);
    $this->display('OperProjectManage/chartsProcess');
  }

  //项目形象进度===============================================================================

  //承包合同----------------------------------------------------------------------------------
  public function addContract(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_CONTRACT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resourceRowArray = $this->projectResourceDao->findAll();
    $this->assign('resourceRowArray',$resourceRowArray);

    if(isset($_GET['resource_id']) == false){
      //树打开 未选中
      $this->assign('treeExist',true);
      $this->assign('infoReadOnly',true);
      //$this->assign('currentResourceid',0);
      $this->display('OperProjectManage/addContract');
      return;
    }
    $this->assign('treeExist',false);
    $this->assign('infoReadOnly',false);
    $resource_id = $_GET['resource_id'];
    $resourceRow = $this->projectResourceDao->findById($resource_id);
    $this->assign('resourceRow',$resourceRow);

    $companyRowArray = $this->companyDao->findAll();
    $this->assign('companyRowArray',$companyRowArray);
    $departmentRowArray = $this->departmentDao->findAll();
    $this->assign('departmentRowArray',$departmentRowArray);
    $enterpriseRowArray = $this->enterpriseDao->findAll();
    $this->assign('enterpriseRowArray',$enterpriseRowArray);

    $this->display('OperProjectManage/addContract');
  }

  public function addContractSubmit(){
    if(isset($_POST['resource_id'])==false || $_POST['resource_id']==0){
      $this->display('Staticpage/wrongalert');
      return;
    }
    $resourceid = $_POST['resource_id'];
    $contract_name = $_POST['contract_name'];
    $contract_number = $_POST['contract_number'];
    $duty_officer = $_POST['duty_officer'];
    $companyid = $_POST['companyid'];
    $departmentid = $_POST['departmentid'];
    $build_pattern = $_POST['build_pattern'];
    $contract_amount_money = $_POST['contract_amount_money'];
    $project_manager = $_POST['project_manager'];
    $operation_mode = $_POST['operation_mode'];

    $buying_from = $_POST['buying_from'];
    $sign_date = $_POST['sign_date'];
    $contract_start_date = $_POST['contract_start_date'];
    $contract_finish_date = $_POST['contract_finish_date'];
    $scale = $_POST['scale'];
    $operation_status = $_POST['operation_status'];
    $project_type = $_POST['project_type'];
    $project_category = $_POST['project_category'];
    $address = $_POST['address'];
    $total_quantities = $_POST['total_quantities'];

    $main_content = $_POST['main_content'];
    $a_part_enterpriseid = $_POST['a_part_enterpriseid'];
    $a_part_director = $_POST['a_part_director'];
    $b_part_enterpriseid = $_POST['b_part_enterpriseid'];
    $b_part_director = $_POST['b_part_director'];
    $supervisor_enterpriseid = $_POST['supervisor_enterpriseid'];
    $accept_amount_start = $_POST['accept_amount_start'];
    $budget_amount = $_POST['budget_amount'];
    $budget_director = $_POST['budget_director'];
    $budget_create_date = $_POST['budget_create_date'];

    $budget_create_person = $_POST['budget_create_person'];
    $budget_submit_date = $_POST['budget_submit_date'];
    $budget_confirm_amount = $_POST['budget_confirm_amount'];
    $budget_remark = $_POST['budget_remark'];
    $finalcost_amount = $_POST['finalcost_amount'];
    $finalcost_director = $_POST['finalcost_director'];
    $finalcost_create_date = $_POST['finalcost_create_date'];
    $finalcost_create_person = $_POST['finalcost_create_person'];
    $finalcost_submit_date = $_POST['finalcost_submit_date'];
    $finalcost_confirm_amount = $_POST['finalcost_confirm_amount'];

    $finalcost_remark = $_POST['finalcost_remark'];
    $audit_amount = $_POST['audit_amount'];
    $audit_confirm_amount = $_POST['audit_confirm_amount'];
    $audit_qualityassurance_amount = $_POST['audit_qualityassurance_amount'];
    $audit_remark = $_POST['audit_remark'];
    $remark = "";

    //userid获取
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $userid = $userRow['userid'];
    //当前时间
    $today = date('Y-m-d',time());

    $contractid = $this->contractDao->add($resourceid,$contract_name,$contract_number,$duty_officer,$companyid,
      $departmentid,$build_pattern,$contract_amount_money,$project_manager,$operation_mode,
      $buying_from,$sign_date,$contract_start_date,$contract_finish_date,$scale,
      $operation_status,$project_type,$project_category,$address,$total_quantities,
      $main_content,$a_part_enterpriseid,$a_part_director,$b_part_enterpriseid,$b_part_director,
      $supervisor_enterpriseid,$accept_amount_start,$budget_amount,$budget_director,$budget_create_date,
      $budget_create_person,$budget_submit_date,$budget_confirm_amount,$budget_remark,$finalcost_amount,
      $finalcost_director,$finalcost_create_date,$finalcost_create_person,$finalcost_submit_date,$finalcost_confirm_amount,
      $finalcost_remark,$audit_amount,$audit_confirm_amount,$audit_qualityassurance_amount,$audit_remark,
      $remark,0,0,$userid,$today
    );
    if($contractid <= 0){
      $this->display('Staticpage/wrongalert');
      return;
    }
    //创建文件夹
    $contractPath = "Data/resource_".$resourceid."/contract_".$contractid;
    mkdir($contractPath);
    mkdir($contractPath."/doc_e");
    mkdir($contractPath."/doc_origin");

    $this->redirect('OperProjectManage/listContract',array(),3,"添加承包合同成功...");

  }



  public function editContract(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_CONTRACT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    if(isset($_POST['contract_id']) == false || isset($_POST['contract_id'])<=0){
      $this->display('Staticpage/wrongalert');
      return;

    }
    $contractid = $_POST['contract_id'];
    $contractRow = $this->contractDao->findById($contractid);

    $enterpriseRow_apart = $this->enterpriseDao->findById($contractRow['a_part_enterpriseid']);
    $contractRow['enterpriseName_apart'] = $enterpriseRow_apart['name'];
    $enterpriseRow_supervisor = $this->enterpriseDao->findById($contractRow['supervisor_enterpriseid']);
    $contractRow['enterpriseName_supervisor'] = $enterpriseRow_supervisor['name'];
    $enterpriseRow_bpart = $this->enterpriseDao->findById($contractRow['b_part_enterpriseid']);
    $contractRow['enterpriseName_bpart'] = $enterpriseRow_bpart['name'];

    $this->assign('contractRow',$contractRow);

    $resourceRow = $this->projectResourceDao->findById($contractRow['resourceid']);
    $this->assign('resourceRow',$resourceRow);

    $companyRowArray = $this->companyDao->findAll();
    $this->assign('companyRowArray',$companyRowArray);
    $departmentRowArray = $this->departmentDao->findAll();
    $this->assign('departmentRowArray',$departmentRowArray);

    $enterpriseRowArray = $this->enterpriseDao->findAll();
    $this->assign('enterpriseRowArray',$enterpriseRowArray);

    $contractcontenRowArray = $this->contractContentDao->findByContractid($contractid);
    $this->assign('contractcontenRowArray',$contractcontenRowArray);

    $contractdocument_originRowArray = $this->contractDocumentOriginDao->findByContractid($contractid);
    foreach($contractdocument_originRowArray as $key=>$value){
      $path = $value['path'];
      $suffix = substr($path,strrpos($path,'.')+1);
      $contractdocument_originRowArray[$key]['suffix'] = $suffix;
    }
    $this->assign('contractdocument_originRowArray',$contractdocument_originRowArray);

    $contrcatdocumentRowArray = $this->contractDocumentDao->findByContractid($contractid);
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

    $this->display('OperProjectManage/editContract');
  }

  public function editContract_addcontent(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_CONTRACT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $contractid = $_POST['contractid'];
    $category = $_POST['contractcontent_category'];
    $name = $_POST['contractcontent_name'];
    $unit = $_POST['contractcontent_unit'];
    $price_perunit = $_POST['contractcontent_price_perunit'];
    $amount = $_POST['contractcontent_amount'];
    $remark = $_POST['contractcontent_remark'];
    $contentid=0;
    $contentid = $this->contractContentDao->add($contractid,$category,$name,$unit,$price_perunit,$amount,$remark);

    $resultArray = array();
    $resultArray['contentid'] = $contentid;
    $resultArray['contractid'] = $contractid;
    $resultArray['category'] = $category;
    $resultArray['name'] = $name;
    $resultArray['unit'] = $unit;
    $resultArray['price_perunit'] = $price_perunit;
    $resultArray['amount'] = $amount;
    $resultArray['remark'] = $remark;
    $this->ajaxReturn($resultArray,'JSON');
  }

  public function editContract_deleteContent(){
    $contentid = $_POST['contentid'];
    $result = $this->contractContentDao->deleteById($contentid);

    echo json_encode($result);
  }

  public function editContract_editContent(){
    $contentid = $_POST['contentid'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $amount = $_POST['amount'];
    $price_perunit = $_POST['price_perunit'];
    $remark = $_POST['remark'];

    $contentRow = $this->contractContentDao->findById($contentid);
    $result = $this->contractContentDao->updateById($contentid,$contentRow['contractid'],$category,$name,$unit,$price_perunit,$amount,$remark);
    echo json_encode($result);	
  }




  public function editContract_uploadfile(){
    $returnData = array();
    //$returnData['documentid'] = -1;
    //echo json_encode($returnData);
    //return;

    $doc_name = $_POST['name'];
    $doc_remark = $_POST['remark'];
    $contractid = $_POST['contractid'];
    $result = 0;
    $contractRow = $this->contractDao->findById($contractid);

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $userInfoArray = $this->userInfoByUserid($userRow['userid']);

    //存储数据库信息
    $insertId = $this->contractDocumentDao->add($contractid,$doc_name,"",$doc_remark,$userRow['userid'],$userRow['userid'],0);
    if($insertId <= 0){$returnData['documentid'] = $insertId;echo json_encode($returnData);return;}

    //存储文件
    $dirPath = "Data/resource_".$contractRow['resourceid']."/contract_".$contractid."/doc_e/";
    $suffix="";
    $result = func_createFile($dirPath,$insertId,$_FILES['documentFile1'],$suffix);
    if($result <= 0){$returnData['documentid'] = $result;echo json_encode($returnData);return;}
    //更新数据库信息
    $contractDocumentRow = $this->contractDocumentDao->findById($insertId);
    $path = $dirPath.$insertId.".".$suffix;
    $result = $this->contractDocumentDao->updateById($insertId,$contractDocumentRow['contractid'],$contractDocumentRow['name'],$path,$contractDocumentRow['remark'],$contractDocumentRow['create_userid'],$contractDocumentRow['lastupdate_userid'],$contractDocumentRow['checked_userid']);
    if($result == false){$returnData['documentid'] = -5;echo json_encode($returnData);return;}

    //返回
    $returnData['documentid'] = $insertId;
    $returnData['doc_name'] = $doc_name;
    $returnData['doc_remark'] = $doc_remark;
    $returnData['suffix'] = $suffix;
    $returnData['create_userInfo'] = $userInfoArray['name']."[".$userInfoArray['employer_number']."]";
    $returnData['lastupdate_userInfo'] = $userInfoArray['name']."[".$userInfoArray['employer_number']."]";
    $returnData['download_url'] = U('OperProjectManage/editContract_downloadDocument',array('documentid'=>$returnData['documentid']));

    echo json_encode($returnData);

  }

  public function editContract_uploadfileOrigin(){
    $doc_name = $_POST['name'];
    $doc_remark = $_POST['remark'];
    $contractid = $_POST['contractid'];
    $result = 0;
    $contractRow = $this->contractDao->findById($contractid);
    $returnData = array();

    //存储数据库信息
    $insertId = $this->contractDocumentOriginDao->add($contractid,$doc_name,"",$doc_remark);
    if($insertId <= 0){$returnData['documentid'] = $insertId;echo json_encode($returnData);return;}

    //存储文件
    $dirPath = "Data/resource_".$contractRow['resourceid']."/contract_".$contractid."/doc_origin/";
    $suffix="";
    $result = func_createFile($dirPath,$insertId,$_FILES['documentFile'],$suffix);
    if($result <= 0){$returnData['documentid'] = $result;echo json_encode($returnData);return;}
    //更新数据库信息
    $contractDocumentOriginRow = $this->contractDocumentOriginDao->findById($insertId);
    $path = $dirPath.$insertId.".".$suffix;
    $result = $this->contractDocumentOriginDao->updateById($insertId,$contractDocumentOriginRow['contractid'],$contractDocumentOriginRow['name'],$path,$contractDocumentOriginRow['remark']);
    if($result == false){$returnData['documentid'] = -5;echo json_encode($returnData);return;}

    //返回
    $returnData['documentid'] = $insertId;
    $returnData['doc_name'] = $doc_name;
    $returnData['doc_remark'] = $doc_remark;
    $returnData['suffix'] = $suffix;
    $returnData['download_url'] = U('OperProjectManage/editContract_downloadDocumentOrigin',array('documentid'=>$returnData['documentid']));
    //$resultData['contractid'] = $contractid;
    echo json_encode($returnData);
  }

  public function editContract_deletefile(){
    $data = false;
    $documentid = $_POST['documentid'];
    if($documentid <= 0){$data=false;return;}
    $documentRow = $this->contractDocumentDao->findById($documentid);
    $filepath = $documentRow['path'];

    //删除文件
    //$filepath = iconv("utf-8", "gbk", $filepath);
    $result = unlink($filepath);
    if($result == false){echo json_encode($data);return;}
    //删除数据库信息
    $result = $this->contractDocumentDao->deleteById($documentid);
    $data = $result;
    echo json_encode($data);
    //$this->ajaxReturn($data,"JSON");
  }

  public function editContract_downloadDocument(){
    $documentid = $_GET['documentid'];
    $documentRow = $this->contractDocumentDao->findById($documentid);
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

  public function editContract_downloadDocumentOrigin(){
    $documentid = $_GET['documentid'];
    $documentRow = $this->contractDocumentOriginDao->findById($documentid);
    $filepath = $documentRow['path'];

    //$downloadFilename = preg_replace('/^.+[\\\\\\/]/','',$filepath );
    //$this->assign('test',basename($filepath));
    //$this->display('Test/test');
    //return;
    //$filepath = iconv("utf-8", "gbk", $filepath);
    if(is_file($filepath)){
      func_downloadFile($filepath);
      // header("Content-Type: application/force-download");
      // header("Content-Disposition: attachment; filename=".basename($filepath));
      // readfile($filepath);
      // exit;

      // $file = fopen($filepath,"r"); // 打开文件
      // // 输入文件标签
      // Header("Content-type: application/octet-stream");
      // Header("Accept-Ranges: bytes");
      // Header("Accept-Length: ".filesize($filepath));
      // Header("Content-Disposition: attachment; filename=" ."abc.xlsx");
      // // 输出文件内容
      // echo fread($file,filesize($filepath));
      // fclose($file);
      // exit();

    }else{
      echo "文件不存在！";
      exit;
    }
  }

  public function editContract_deletefileOrigin(){
    $data = false;
    $documentid = $_POST['documentid'];
    if($documentid <= 0){$data=false;return;}
    $documentRow = $this->contractDocumentOriginDao->findById($documentid);
    $filepath = $documentRow['path'];
    //echo json_encode($filepath);
    //return;
    //删除文件
    //$filepath = iconv("utf-8", "gbk", $filepath);
    $result = unlink($filepath);
    if($result == false){echo json_encode($data);return;}
    //删除数据库信息
    $result = $this->contractDocumentOriginDao->deleteById($documentid);
    $data = $result;
    echo json_encode($data);
  }

  public function editContract_editDocument(){
    $returnData = array();
    $doc_name = $_POST['doc_name'];
    $doc_remark = $_POST['doc_remark'];
    $documentid = $_POST['documentid'];
    if($documentid <=0){$returnData['documentid'] = 0;echo json_encode($returnData);return;}

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $contractDocumentRow = $this->contractDocumentDao->findById($documentid);
    $result = $this->contractDocumentDao->updateById($documentid,$contractDocumentRow['contractid'],$doc_name,$contractDocumentRow['path'],$doc_remark,$contractDocumentRow['create_userid'],$userRow['userid'],$contractDocumentRow['checked_userid']);
    if($result == false){$returnData['documentid'] = 0;echo json_encode($returnData);return;}

    //扩展名
    //$suffix = substr($contractDocumentRow['path'],strrpos($contractDocumentRow['path'],".")+1);
    //创建人
    //$userInfoRow = $this->userInfoByUserid($contractDocumentRow['create_userid']);
    //$create_user_info = $userInfoRow['name']."[".$userInfoRow['employer_number']."]";

    //最后修改人
    $userInfoRow = $this->userInfoByUserid($userRow['userid']);
    $lastupdate_user_info = $userInfoRow['name']."[".$userInfoRow['employer_number']."]";

    $returnData['documentid'] = $documentid;
    $returnData['doc_name'] = $doc_name;
    $returnData['doc_remark'] = $doc_remark;

    $returnData['lastupdate_user_info'] = $lastupdate_user_info;



    echo json_encode($returnData);
  }

  public function editContract_editDocumentOrigin(){
    $returnData = array();
    $doc_name = $_POST['doc_name'];
    $doc_remark = $_POST['doc_remark'];
    $documentid = $_POST['documentid'];
    if($documentid <=0){$returnData['documentid'] = 0;echo json_encode($returnData);return;}

    $contractDocumentRow = $this->contractDocumentOriginDao->findById($documentid);
    $result = $this->contractDocumentDao->updateById($documentid,$contractDocumentRow['contractid'],$doc_name,$contractDocumentRow['path'],$doc_remark);
    if($result == false){$returnData['documentid'] = 0;echo json_encode($returnData);return;}

    $returnData['documentid'] = $documentid;
    $returnData['doc_name'] = $doc_name;
    $returnData['doc_remark'] = $doc_remark;

    echo json_encode($returnData);

  }

  public function editContract_checkDocument(){
    $documentid = $_POST['documentid'];
    $operation = $_POST['operation'];
    $returnData = array();
    $returnData['result'] = false;
    $contractDocumentRow = $this->contractDocumentDao->findById($documentid);
    if($operation == "check"){
      $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
      $result = $this->contractDocumentDao->updateById($documentid,$contractDocumentRow['contractid'],$contractDocumentRow['name'],$contractDocumentRow['path'],$contractDocumentRow['remark'],$contractDocumentRow['create_userid'],$contractDocumentRow['lastupdate_userid'],$userRow['userid']);
      $returnData['result'] = $result;
    }
    else if($operation == "uncheck"){

      $result = $this->contractDocumentDao->updateById($documentid,$contractDocumentRow['contractid'],$contractDocumentRow['name'],$contractDocumentRow['path'],$contractDocumentRow['remark'],$contractDocumentRow['create_userid'],$contractDocumentRow['lastupdate_userid'],0);
      $returnData['result'] = $result;
    }


    //$returnData['operation'] = $operation;
    //$returnData['result'] = $operation;
    echo json_encode($returnData);
  }

  public function deleteContract(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_CONTRACT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    if(isset($_GET['contractid']) == false){
      $this->display('Staticpage/wrongalert');
      return;
    }

    $contractRow = $this->contractDao->findById($_GET['contractid']);

    //删除附带内容
    //删除文件夹
    $path = "Data/resource_".$contractRow['resourceid']."/contract_".$contractRow['contractid'];
    //$this->assign('test',$path);
    //$this->display('Test/test');
    //return;
    func_deleteDir($path);

    //删除表项
    $contractContentRowArray = $this->contractContentDao->findByContractid($contractRow['contractid']);
    foreach($contractContentRowArray as $key=>$value){
      $this->contractContentDao->deleteById($value['contentid']);
    }

    $contractDocumentRowArray = $this->contractDocumentDao->findByContractid($contractRow['contractid']);
    foreach($contractDocumentRowArray as $key=>$value){
      $this->contractDocumentDao->deleteById($value['documentid']);
    }
    $contractDocumentOriginRowArray = $this->contractDocumentOriginDao->findByContractid($contractRow['contractid']);
    foreach($contractDocumentOriginRowArray as $key=>$value){
      $this->contractDocumentOriginDao->deleteById($value['documentid']);
    }

    //删除主表
    $result = $this->contractDao->deleteById($_GET['contractid']);
    if($result == false)$this->display('Staticpage/wrongalert');
    else $this->redirect('OperProjectManage/listContract',array(),3,"删除合同成功...");


  }


  public function checkContract(){
    $contractid = $_POST['contractid'];
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    //修改状态
    $this->contractDao->updateCheckstatusById($contractid,$userRow['userid']);
    //返回
    $ajaxArray = array();
    $ajaxArray['check_userid'] = $userRow['userid'];
    $this->ajaxReturn($ajaxArray,'JSON');
  }

  public function cancelcheckContract(){
    $contractid = $_POST['contractid'];
    //$userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    //修改状态
    $this->contractDao->updateCheckstatusById($contractid,0);
    //返回
    $ajaxArray = array();
    $ajaxArray['check_userid'] = 0;
    $this->ajaxReturn($ajaxArray,'JSON');
  }

  public function finalcostContract(){
    $contractid = $_POST['contractid'];
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    //修改状态
    $this->contractDao->updateFinalcoststatusById($contractid,$userRow['userid']);
    //返回
    $ajaxArray = array();
    $ajaxArray['finalcost_userid'] = $userRow['userid'];
    $this->ajaxReturn($ajaxArray,'JSON');
  }

  public function cancelfinalcostContract(){
    $contractid = $_POST['contractid'];
    //$userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    //修改状态
    $this->contractDao->updateFinalcoststatusById($contractid,0);
    //返回
    $ajaxArray = array();
    $ajaxArray['finalcost_userid'] = 0;
    $this->ajaxReturn($ajaxArray,'JSON');
  }


  public function editContractSubmit(){
    if(isset($_POST['contractid'])==false || $_POST['contractid']==0){
      $this->display('Staticpage/wrongalert');
      return;
    }

    // $this->display('Test/test');
    // return;
    $contractid = $_POST['contractid'];
    $contractRow = $this->contractDao->findById($contractid);

    $contract_name = $_POST['contract_name'];
    $contract_number = $_POST['contract_number'];
    $duty_officer = $_POST['duty_officer'];
    $companyid = $_POST['companyid'];
    $departmentid = $_POST['departmentid'];
    $build_pattern = $_POST['build_pattern'];
    $contract_amount_money = $_POST['contract_amount_money'];

    $project_manager = $_POST['project_manager'];
    $operation_mode = $_POST['operation_mode'];

    $buying_from = $_POST['buying_from'];
    $sign_date = $_POST['sign_date'];
    $contract_start_date = $_POST['contract_start_date'];
    $contract_finish_date = $_POST['contract_finish_date'];
    $scale = $_POST['scale'];
    $operation_status = $_POST['operation_status'];
    $project_type = $_POST['project_type'];
    $project_category = $_POST['project_category'];
    $address = $_POST['address'];
    $total_quantities = $_POST['total_quantities'];

    $main_content = $_POST['main_content'];
    $a_part_enterpriseid = $_POST['a_part_enterpriseid'];
    $a_part_director = $_POST['a_part_director'];
    $b_part_enterpriseid = $_POST['b_part_enterpriseid'];
    $b_part_director = $_POST['b_part_director'];
    $supervisor_enterpriseid = $_POST['supervisor_enterpriseid'];
    $accept_amount_start = $_POST['accept_amount_start'];
    $budget_amount = $_POST['budget_amount'];
    $budget_director = $_POST['budget_director'];
    $budget_create_date = $_POST['budget_create_date'];

    $budget_create_person = $_POST['budget_create_person'];
    $budget_submit_date = $_POST['budget_submit_date'];
    $budget_confirm_amount = $_POST['budget_confirm_amount'];
    $budget_remark = $_POST['budget_remark'];
    $finalcost_amount = $_POST['finalcost_amount'];
    $finalcost_director = $_POST['finalcost_director'];
    $finalcost_create_date = $_POST['finalcost_create_date'];
    $finalcost_create_person = $_POST['finalcost_create_person'];
    $finalcost_submit_date = $_POST['finalcost_submit_date'];
    $finalcost_confirm_amount = $_POST['finalcost_confirm_amount'];

    $finalcost_remark = $_POST['finalcost_remark'];
    $audit_amount = $_POST['audit_amount'];
    $audit_confirm_amount = $_POST['audit_confirm_amount'];
    $audit_qualityassurance_amount = $_POST['audit_qualityassurance_amount'];
    $audit_remark = $_POST['audit_remark'];
    $remark = $_POST['remark'];

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);

    $check_userid = 0;
    $finalcost_userid = 0;
    $contract_checked = $_POST['contract_checked'];
    $contract_finalcost = $_POST['contract_finalcost'];
    if($contract_checked == 1 && $contractRow['check_userid'] == 0){
      $check_userid = $userRow['userid'];
    }
    if($contract_finalcost == 1 && $contractRow['finalcost_userid'] == 0){
      $finalcost_userid = $userRow['userid'];
    }




    $result = $this->contractDao->updateById(
      $contractid,
      $contractRow['resourceid'],$contract_name,$contract_number,$duty_officer,$companyid,
      $departmentid,$build_pattern,$contract_amount_money,$project_manager,$operation_mode,
      $buying_from,$sign_date,$contract_start_date,$contract_finish_date,$scale,
      $operation_status,$project_type,$project_category,$address,$total_quantities,
      $main_content,$a_part_enterpriseid,$a_part_director,$b_part_enterpriseid,$b_part_director,
      $supervisor_enterpriseid,$accept_amount_start,$budget_amount,$budget_director,$budget_create_date,
      $budget_create_person,$budget_submit_date,$budget_confirm_amount,$budget_remark,$finalcost_amount,
      $finalcost_director,$finalcost_create_date,$finalcost_create_person,$finalcost_submit_date,$finalcost_confirm_amount,
      $finalcost_remark,$audit_amount,$audit_confirm_amount,$audit_qualityassurance_amount,$audit_remark,
      $remark,$check_userid,$finalcost_userid,$contractRow['create_userid'],$contractRow['create_date']
    );

    if($result == false){
      $this->display('Staticpage/wrongalert');
      return;
    }
    $this->redirect('OperProjectManage/listContract',array(),3,"修改合同信息成功...");

  }

  public function listContract(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROJECT_CONTRACT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    //树状图使用
    $resourceRowArray = $this->projectResourceDao->findAll();
    $this->assign('resourceRowArray',$resourceRowArray);

    if(isset($_GET['resource_id']) == false){
      //树打开 未选中
      $this->assign('treeExist',true);
      $this->display('OperProjectManage/listContract');
      return;
    }

    $resource_id = $_GET['resource_id'];
    $resourceRow = $this->projectResourceDao->findById($resource_id);
    $this->assign('resourceRow',$resourceRow);

    //树收起 选中
    $this->assign('treeExist',false);
    //$this->assign('currentResourceid',$resource_id);
    //合同数组
    $contractRowArray = $this->contractDao->findByResourceid($resource_id);

    foreach($contractRowArray as $key => $value){
      //合同时间
      $durationDays = round((strtotime($value['contract_finish_date'])-strtotime($value['contract_start_date']))/(24*3600));
      $contractRowArray[$key]['durationDays'] = $durationDays;

      //创建用户
      $userInfoArray = $this->userInfoByUserid($value['create_userid']);
      $name_employernumber = $userInfoArray['name']."[".$userInfoArray['employer_number']."]";
      $contractRowArray[$key]['name_employernumber'] = $name_employernumber;

      //甲方
      $enterpriseRow = $this->enterpriseDao->findById($value['a_part_enterpriseid']);
      $contractRowArray[$key]['a_part_enterprise_name'] = $enterpriseRow['name'];
    }


    $this->assign('contractRowArray',$contractRowArray);
    $this->display('OperProjectManage/listContract');
  }

  //承包合同=====================================================================================


  //公共函数-----------------------------------------------------------------------------------
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

  public function resourceFileSNGenerate($resourceid){
    $resourceDocumentRowArray = $this->resourceDocumentDao->findByResourceid($resourceid);
    $createdateArray = localtime(time(),true);
    $createdateYear = 1900+$createdateArray['tm_year'];
    $createdateMonth = 1+$createdateArray['tm_mon'];
    if($createdateMonth < 10)$createdateMonth = "0".$createdateMonth;
    $createdateDay = $createdateArray['tm_mday'];
    if($createdateDay < 10)$createdateDay = "0".$createdateDay;
    $createdateStr = $createdateYear.$createdateMonth.$createdateDay;

    $index = 1;
    foreach($resourceDocumentRowArray as $key=>$value){
      $serial_number_local = $value['serial_number'];
      $index_serial = substr($serial_number_local,8,4);
      if((substr($serial_number_local,0,8)==$createdateStr)&&is_numeric($index_serial)){
        if($index <= $index_serial)$index = $index_serial+1;
      }
    }
    $serial_number = $createdateStr;
    if($index<10)$serial_number .= "000".$index;
    else if($index<100)$serial_number .= "00".$index;
    else if($index<1000)$serial_number .= "0".$index;
    return $serial_number;

  }

  //公共函数===================================================================================





}



?>
