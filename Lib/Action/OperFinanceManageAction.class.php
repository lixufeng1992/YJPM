<?php
require_once dirname(__FILE__).'/../auto_load.php';


header('Content-Type:text/html;charset=utf-8');

class OperFinanceManageAction extends LoginAfterAction{
  private $materialClassDao;
  private $materialCategoryDao;
  private $materialDao;
  private $materialEnquiry;
  private $projectResourceDao;
  private $materialEnquiryDao;
  private $materialPurchasePlanOrderDao;
  private $materialPurchasePlanOrderDetailsDao;
  private $materialcontractDao;
  private $materialcontractContentDao;
  private $materialcontractDocumentDao;
  private $materialcontractDocumentOriginDao;
  private $companyDao;
  //private $employerDao;
  private $departmentDao;
  private $enterpriseDao;
  private $warehouseDao;
  private $warehouseWorkerDao;
  private $subcontractorDao;
  private $subcontractorWorkerDao;
  private $materialcontractDetailDao;
  private $materialPurchaseOrderDao;
  private $materialPurchaseOrderDetailsDao;
  private $materialOutboundOrderDao;
  private $materialOutboundOrderDetailsDao;
  private $materialInventoryDao;
  private $exacctClassDao;
  private $exacctDao;

  public function _initialize(){
    parent::_initialize();
    $this->materialClassDao=new MaterialClassDao();
    $this->materialCategoryDao=new MaterialCategoryDao();
    $this->materialDao=new MaterialDao();
    $this->materialEnquiryDao=new MaterialEnquiryDao();
    $this->projectResourceDao=new ProjectResourceDao();
    $this->materialEnquiryDao=new MaterialEnquiryDao();
    $this->materialPurchasePlanOrderDao=new MaterialPurchasePlanOrderDao();
    $this->materialPurchasePlanOrderDetailsDao=new MaterialPurchasePlanOrderDetailsDao();
    $this->materialcontractDao=new MaterialcontractDao();
    $this->materialcontractContentDao=new MaterialcontractContentDao();
    $this->materialcontractDocumentDao=new MaterialcontractDocumentDao();
    $this->materialcontractDocumentOriginDao=new MaterialcontractDocumentOriginDao();
    $this->companyDao=new CompanyDao();
    //$this->employerDao=new EmployerDao();
    $this->departmentDao=new DepartmentDao();
    $this->enterpriseDao=new EnterpriseDao();
    $this->warehouseDao=new WarehouseDao();
    $this->warehouseWorkerDao=new WarehouseWorkerDao();
    $this->subcontractorDao=new SubcontractorDao();
    $this->subcontractorWorkerDao=new SubcontractorWorkerDao();
    $this->materialcontractDetailDao=new MaterialcontractDetailDao();
    $this->materialPurchaseOrderDao=new MaterialPurchaseOrderDao();
    $this->materialPurchaseOrderDetailsDao=new MaterialPurchaseOrderDetailsDao();
    $this->materialOutboundOrderDao=new MaterialOutboundOrderDao();
    $this->materialOutboundOrderDetailsDao=new MaterialOutboundOrderDetailsDao();
    $this->materialInventoryDao=new MaterialInventoryDao();
    $this->exacctClassDao = new ExacctClassDao();
    $this->exacctDao = new ExacctDao();
  }


  //------------------------------------------------------------------------------------
  public function listOtherBudget(){
   $resourceRowArray = $this->projectResourceDao->findAll();
   $this->assign('resourceRowArray',$resourceRowArray);
   $this->display('OperFinanceManage/listOtherBudget');
 }
 
 public function classifyOtherExpense(){
   $exacctClassRowArray = $this->exacctClassDao->findAll();
   $this->assign('exacctClassRowArray',$exacctClassRowArray);
   $this->display('OperFinanceManage/classifyOtherExpense');
 }
 
 public function addOtherExpenseClass(){
   $name = $_POST['name'];
   $this->exacctClassDao->add($name);
   $this->redirect('OperFinanceManage/classifyOtherExpense',array(),3,"添加分类成功...");
 }
 
 public function editOtherExpenseClass(){
   $id = $_POST['exacctclassid'];
   $name = $_POST['name'];
   $this->exacctClassDao->updateById($id,$name);
   $this->redirect('OperFinanceManage/classifyOtherExpense',array(),3,"修改分类成功...");
 }
 
 public function deleteOtherExpenseClass(){
   $id = $_GET['exacctclassid'];
   $this->exacctClassDao->deleteById($id);
   $this->redirect('OperFinanceManage/classifyOtherExpense',array(),3,"删除分类成功...");
 }
 
 public function maintainOtherExpense(){
   $exacctArray = $this->exacctDao->findAll();
   $levelArray;
   $firstlevel;
   foreach ($exacctArray as $value){
    if (empty($value["parentid"])){
     $firstlevel[]=$value["exacctid"];
   }
   $levelArray[$value["exacctid"]] = $value;
 }
 foreach ($exacctArray as $value){
  if (!empty($value["parentid"])){
   $levelArray[$value["parentid"]]["children"][]=$value;
 }
}
$exacctClassRowArray = $this->exacctClassDao->findAll();
$this->assign('exacctClassRowArray',$exacctClassRowArray);
$this->assign('firstlevel',$firstlevel);
$this->assign('levelArray',$levelArray);
$this->display('OperFinanceManage/maintainOtherExpense');
}

public function addOtherExpenseAcct(){
	$name = $_POST["exacctname"];
	$remark = $_POST["remark"];
	$classid = $_POST["classid"];
	$parentid = $_POST["parentid"];
	$id;
	if (!empty($_POST["exacctid"])){
		$id = $_POST["exacctid"];
		$this->exacctDao->updateById($id,$name,$remark,$classid);
	}else{
		$id = $this->exacctDao->add($name,$remark,$classid,$parentid);
	}
	$result = array($id,$name,$remark,$classid,$parentid);
	$this->ajaxReturn($result);
}

public function deleteOtherExpenseAcct(){
 $id = $_POST["exacctid"];
 $result = $this->exacctDao->deleteById($id);
 $result = array($result,$result?"succeed":"该科目下有子科目，不可删除");
 $this->ajaxReturn($result);
}

}

?>
