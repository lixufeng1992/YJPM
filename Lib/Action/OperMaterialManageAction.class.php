<?php
import("@.Model.MaterialClassDao");
import("@.Model.MaterialCategoryDao");
import("@.Model.MaterialDao");
import("@.Model.EnterpriseDao");
import("@.Model.MaterialEnquiryDao");
import("@.Model.ProjectResourceDao");
import("@.Model.MaterialEnquiryDao");
import("@.Model.MaterialPurchasePlanOrderDao");
import("@.Model.MaterialPurchasePlanOrderDetailsDao");
import("@.Model.MaterialcontractDao");
import("@.Model.MaterialcontractContentDao");
import("@.Model.MaterialcontractDocumentDao");
import("@.Model.MaterialcontractDocumentOriginDao");
import("@.Model.EmployerDao");
import("@.Model.DepartmentDao");
import("@.Model.CompanyDao");
import("@.Model.WarehouseDao");
import("@.Model.WarehouseWorkerDao");
import("@.Model.SubcontractorDao");
import("@.Model.SubcontractorWorkerDao");
import("@.Model.MaterialcontractDetailDao");
import("@.Model.MaterialPurchaseOrderDao");
import("@.Model.MaterialPurchaseOrderDetailsDao");
import("@.Model.MaterialOutboundOrderDao");
import("@.Model.MaterialOutboundOrderDetailsDao");
import("@.Model.MaterialInventoryDao");

header('Content-Type:text/html;charset=utf-8');

class OperMaterialManageAction extends LoginAfterAction{
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
  private $employerDao;
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
    $this->employerDao=new EmployerDao();
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
  }

  //材料维护------------------------------------------------------------------------------------
  public function materialMaintain(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    if(isset($_POST['operation'])){
      $result['name'] = ''.$_POST['name'].'succ';
      $result['id'] = 1;
      $this->ajaxReturn($result,"不能删除",true);
    }else{

      //分类，子分类
      $materialClassRowArray = $this->materialClassDao->findAll();
      foreach($materialClassRowArray as $key=>$value){
        $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($value['classid']);
        $materialClassRowArray[$key]['materialCategoryRowArray'] = $materialCategoryRowArray;
      }
      //材料实体
      $materialRowArray = $this->materialDao->findAll();
      foreach($materialRowArray as $key=>$value){
        $materialCategoryRow = $this->materialCategoryDao->findById($value['categoryid']);
        $materialRowArray[$key]['materialCategoryRow'] = $materialCategoryRow;
      }
      $this->assign('materialClassRowArray',$materialClassRowArray);
      $this->assign('materialRowArray',$materialRowArray);
      $this->display('OperMaterialManage/materialMaintain');
    }
  }

  public function materialMaintain_addClass(){
    $returnData = array();
    $returnData['name'] = $_POST['name'];
    $insertId = $this->materialClassDao->add($_POST['name']);
    $returnData['id'] = $insertId;
    echo json_encode($returnData);
  }

  public function materialMaintain_deleteClass(){
    $classid = $_POST['classid'];
    $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($classid);
    if(count($materialCategoryRowArray) > 0){
      $returnData = -1;//还有子元素，拒绝删除		
      echo json_encode($returnData);
      return;
    }
    $returnData = $this->materialClassDao->deleteById($classid);
    echo json_encode($returnData);
  }

  public function materialMaintain_editClass(){
    $returnData = array();
    //$returnData['classid'] = $_POST['classid'];
    $returnData['name'] = $_POST['name'];
    $returnData['result'] = $this->materialClassDao->updateById($_POST['classid'],$_POST['name']);
    echo json_encode($returnData);
  }

  public function materialMaintain_addCategory(){
    $returnData = array();
    $returnData['name'] = $_POST['name'];
    //$returnData['classid'] = $_POST['classid'];
    $insertId = $this->materialCategoryDao->add($_POST['classid'],$_POST['name']);
    $returnData['id'] = $insertId;
    echo json_encode($returnData);
  }

  public function materialMaintain_deleteCategory(){
    $returnData = array();
    $categoryid = $_POST['categoryid'];
    $returnData['categoryid'] = $categoryid;
    $materialRowArray = $this->materialDao->findByCategoryid($categoryid);
    if(count($materialRowArray) > 0){$returnData['result'] = -1;echo json_encode($returnData);return;}
    $result = $this->materialCategoryDao->deleteById($categoryid);
    $returnData['result'] = $result;
    echo json_encode($returnData);

  }

  public function materialMaintain_editCategory(){
    $returnData = array();
    //$returnData['categoryid'] = $_POST['categoryid'];
    $returnData['name'] = $_POST['name'];
    $materialCategoryRow = $this->materialCategoryDao->findById($_POST['categoryid']);
    $returnData['result'] = $this->materialCategoryDao->updateById($_POST['categoryid'],$materialCategoryRow['classid'],$_POST['name']);
    echo json_encode($returnData);
  }


  public function materialMaintain_addMaterial(){
    $name = $_POST['name'];
    $categoryid = $_POST['categoryid'];
    $worktype = $_POST['worktype'];
    $unit = $_POST['unit'];
    $price_in = $_POST['price_in'];
    $parameter = $_POST['parameter'];
    $specification = $_POST['specification'];
    $brand = $_POST['brand'];
    $returnData = array();
    $insertId = $this->materialDao->add($name,$categoryid,$worktype,$unit,$price_in,$parameter,$specification,$brand);
    $materialCategoryRow = $this->materialCategoryDao->findById($categoryid);
    $returnData['materialid'] = $insertId;
    $returnData['classid'] = $materialCategoryRow['classid'];
    $returnData['category_name'] = $materialCategoryRow['name'];
    echo json_encode($returnData);
  }

  public function materialMaintain_deleteMaterial(){
    $materialid = $_POST['materialid'];
    $result = $this->materialDao->deleteById($materialid);
    echo json_encode($result);
  }

  public function materialMaintain_editMaterial(){
    $materialid = $_POST['id'];
    $name = $_POST['name'];
    $categoryid = $_POST['classid'];
    $worktype = $_POST['type'];
    $unit = $_POST['unit'];
    $price_in = $_POST['price'];
    $parameter = $_POST['parameter'];
    $specification = $_POST['standard'];
    $brand = $_POST['brand'];
    $returnData = array();

    $returnData['materialid'] = $materialid;
    $returnData['name'] = $name;
    $returnData['categoryid'] = $categoryid;
    $returnData['worktype'] = $worktype;
    $returnData['unit'] = $unit;
    $returnData['price_in'] = $price_in;
    $returnData['parameter'] = $parameter;
    $returnData['specification'] = $specification;
    $returnData['brand'] = $brand;

    $result = $this->materialDao->updateById($materialid,$name,$categoryid,$worktype,$unit,$price_in,$parameter,$specification,$brand);
    $returnData['result'] = $result;
    //$materialid = $_POST['materialid'];
    //$result = $this->materialDao->deleteById($materialid);
    echo json_encode($returnData);
  }
  //材料维护================================================================================
  //材料询价================================================================================
  public function materialEnquiry(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_ENQUIRY;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }


    //分类，子分类
    $materialClassRowArray = $this->materialClassDao->findAll();
    foreach($materialClassRowArray as $key=>$value){
      $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($value['classid']);
      $materialClassRowArray[$key]['materialCategoryRowArray'] = $materialCategoryRowArray;
    }
    $materialRowArray = $this->materialDao->findAll();
    foreach($materialRowArray as $key=>$value){
      $materialCategoryRow = $this->materialCategoryDao->findById($value['categoryid']);
      $materialRowArray[$key]['materialCategoryRow'] = $materialCategoryRow;
    }
    $enterpriseRowArray=$this->enterpriseDao->findAll();
    $this->assign('enterpriseRowArray',$enterpriseRowArray);

    $this->assign('materialClassRowArray',$materialClassRowArray);
    $this->assign('materialRowArray',$materialRowArray);

    $this->display('OperMaterialManage/materialEnquiry');
  }

  public function addEnquiry(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_ENQUIRY;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $enterprise_id=$_POST['enterprise_id'];
    $enquiry_offer=$_POST['enquiry_offer'];
    $offer_date=$_POST['offer_date'];
    $material_id=$_POST['material_id'];

    $enquiry_id=$this->materialEnquiryDao->add($enterprise_id,$enquiry_offer,$offer_date,$material_id);
    //$enquiry['id']=1;
    $this->ajaxReturn($enquiry_id,"JSON");
  }

  public function updateEnquiry(){
    $enquiry_id=$_POST['enquiry_id'];
    $enterprise_id=$_POST['enterprise_id'];
    $enquiry_offer=$_POST['enquiry_offer'];
    $offer_date=$_POST['offer_date'];

    $result=$this->materialEnquiryDao->updateById($enquiry_id,$enterprise_id,$enquiry_offer,$offer_date);
  }

  public function getEnquiry(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_ENQUIRY;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $material_id=$_GET['material_id'];

    $enquiryRow=$this->materialEnquiryDao->findByMaterialId($material_id);
    foreach($enquiryRow as $key=>$value){
      $enterpriseRow=$this->enterpriseDao->findById($value['enterprise_id']);
      $enquiryRow[$key]['enterprise_name']=$enterpriseRow['name'];
    }

    $this->ajaxReturn($enquiryRow,"JSON");
  }

  public function deleteEnquiry(){
    $enquiry_id=$_POST['enquiry_id'];

    $result=$this->materialEnquiryDao->deleteById($enquiry_id);

  }
  //材料询价================================================================================
  //材料采购单------------------------------------------------------------------------------------
  public function listPurchaseOrder(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_PURCHASE_ORDER;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $purchaseOrderArray = $this->materialPurchaseOrderDao->getAll();
    $resourceRowArray = $this->projectResourceDao->findAll();
    $this->assign('purchaseOrderArray',$purchaseOrderArray);
    $this->assign('resourceRowArray',$resourceRowArray);
    $this->display('OperMaterialManage/listPurchaseOrder');
  }
  public function addPurchaseOrder(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_PURCHASE_ORDER;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resourceRowArray = $this->projectResourceDao->findAll();
    $enterpriseRowArray = $this->enterpriseDao->findAll();
    //分类，子分类
    $materialClassRowArray = $this->materialClassDao->findAll();
    foreach($materialClassRowArray as $key=>$value){
      $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($value['classid']);
      $materialClassRowArray[$key]['materialCategoryRowArray'] = $materialCategoryRowArray;
    }
    //材料实体
    $materialRowArray = $this->materialDao->findAll();
    foreach($materialRowArray as $key=>$value){
      $materialCategoryRow = $this->materialCategoryDao->findById($value['categoryid']);
      $materialRowArray[$key]['materialCategoryRow'] = $materialCategoryRow;
    }
    $purchasePlanOrderRow=$this->materialPurchasePlanOrderDao->findAll();
    foreach($purchasePlanOrderRow as $key=>$value){
      $details = $this->materialPurchasePlanOrderDetailsDao->findByPlanId($value['plan_id']);
      foreach($details as $key2=>$value2){
        $material = $this->materialDao->findById($value2['material_id']);
        $details[$key2]['material']=$material;
      }
      $purchasePlanOrderRow[$key]['details']=$details;
      $resource_name = $this->projectResourceDao->findById($value['resource_id']);
      $purchasePlanOrderRow[$key]['resource_name'] = $resource_name['resource_name'];
    }
    $contractRowArray = $this->materialcontractDao->findAll();
    foreach ($contractRowArray as $key=>$value){
      $supplier = $this->enterpriseDao->findById($value['supplier_enterpriseid']);
      $contractRowArray[$key]['supplier'] = $supplier;
      $contractContentRowArray = $this->materialcontractContentDao->findByContractid($value['contractid']);
      $totalValue = 0;
      foreach ($contractContentRowArray as $key2=>$value2){
        $material = $this->materialDao->findById($value2['material_id']);
        $contractContentRowArray[$key2]['material']=$material;
        $enquiry = $this->materialEnquiryDao->findById($value2['enquiry_id']);
        $contractContentRowArray[$key2]['enquiry']=$enquiry;
        $totalValue += $enquiry['enquiry_offer']*$value2['amount'];
      }
      $contractRowArray[$key]['totalValue'] = $totalValue;
      $contractRowArray[$key]['content'] = $contractContentRowArray;
    }
    $this->assign('materialClassRowArray',$materialClassRowArray);
    $this->assign('materialRowArray',$materialRowArray);
    $this->assign('resourceRowArray',$resourceRowArray);
    $this->assign('enterpriseRowArray',$enterpriseRowArray);
    $this->assign('purchasePlanOrderRowArray',$purchasePlanOrderRow);
    $this->assign('contractRowArray',$contractRowArray);

    $this->display('OperMaterialManage/addPurchaseOrder');
  }
  public function addPurchaseOrderSubmit(){
    $plan_id=$_POST['planid'];
    $contract_id=$_POST['contractid'];
    $project_id=$_POST['projectid'];
    $enterprise_id=$_POST['enterpriseid'];
    $document=$_POST['document'];
    $happen_date=$_POST['happen_date'];
    $transactor=$_POST['transactor'];
    $in_method=$_POST['in_method'];
    $default_warehose_id=$_POST['default_warehouse'];
    $default_administrator_id=$_POST['default_administrator'];
    $price=$_POST['price'];
    $remark=$_POST['remark'];
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $create_user_id=$userRow['userid'];
    $create_date=date("Y-m-d",time());
    $material_ids=$_POST['material_id'];
    $administrators=$_POST['administrator'];
    $warehouses=$_POST['warehouse'];
    $material_remarks=$_POST['material_remark'];
    $material_prices=$_POST['material_price'];
    $amounts=$_POST['amount'];
    $unit_prices=$_POST['unit_price'];
    $specifications=$_POST['specification'];

    $purchaseOrderid = $this->materialPurchaseOrderDao->add($plan_id,$contract_id,$project_id,$enterprise_id,$document,$happen_date,$transactor,$in_method,$default_warehose_id,$default_administrator_id,$price,$remark,$create_user_id,$create_date);
    if($purchaseOrderid <= 0){
      $this->display('Staticpage/wrongalert');
      return;
    }
    foreach ($material_ids as $key=>$value){
      if ($key>0){
        $this->materialPurchaseOrderDetailsDao->add($value,$specifications[$key],$unit_prices[$key],$amounts[$key],$material_prices[$key],$material_remarks[$key],$warehouses[$key],$administrators[$key],$purchaseOrderid);
      }
    }
    $this->redirect('OperMaterialManage/listPurchaseOrder',array(),3,"添加采购单成功...");
  }

  public function editPurchaseOrder(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_PURCHASE_ORDER;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $enterpriseRowArray = $this->enterpriseDao->findAll();
    //分类，子分类
    $materialClassRowArray = $this->materialClassDao->findAll();
    foreach($materialClassRowArray as $key=>$value){
      $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($value['classid']);
      $materialClassRowArray[$key]['materialCategoryRowArray'] = $materialCategoryRowArray;
    }
    //材料实体
    $materialRowArray = $this->materialDao->findAll();
    foreach($materialRowArray as $key=>$value){
      $materialCategoryRow = $this->materialCategoryDao->findById($value['categoryid']);
      $materialRowArray[$key]['materialCategoryRow'] = $materialCategoryRow;
    }
    $purchasePlanOrderRow=$this->materialPurchasePlanOrderDao->findAll();
    foreach($purchasePlanOrderRow as $key=>$value){
      $details = $this->materialPurchasePlanOrderDetailsDao->findByPlanId($value['plan_id']);
      foreach($details as $key2=>$value2){
        $material = $this->materialDao->findById($value2['material_id']);
        $details[$key2]['material']=$material;
      }
      $purchasePlanOrderRow[$key]['details']=$details;
      $resource_name = $this->projectResourceDao->findById($value['resource_id']);
      $purchasePlanOrderRow[$key]['resource_name'] = $resource_name['resource_name'];
    }
    $contractRowArray = $this->materialcontractDao->findAll();
    foreach ($contractRowArray as $key=>$value){
      $supplier = $this->enterpriseDao->findById($value['supplier_enterpriseid']);
      $contractRowArray[$key]['supplier'] = $supplier;
      $contractContentRowArray = $this->materialcontractContentDao->findByContractid($value['contractid']);
      $totalValue = 0;
      foreach ($contractContentRowArray as $key2=>$value2){
        $material = $this->materialDao->findById($value2['material_id']);
        $contractContentRowArray[$key2]['material']=$material;
        $enquiry = $this->materialEnquiryDao->findById($value2['enquiry_id']);
        $contractContentRowArray[$key2]['enquiry']=$enquiry;
        $totalValue += $enquiry['enquiry_offer']*$value2['amount'];
      }
      $contractRowArray[$key]['totalValue'] = $totalValue;
      $contractRowArray[$key]['content'] = $contractContentRowArray;
    }
    $order_id = $_GET['order_id'];
    $purchaseOrder = $this->materialPurchaseOrderDao->getById($order_id);
    $purchaseOrderDetailsArray = $this->materialPurchaseOrderDetailsDao->getByOrderId($order_id);
    $resource_id=$purchaseOrder['project_id'];
    $related_warehouse=$this->warehouseDao->getByResourceId($resource_id);
    $related_administrator=$this->warehouseWorkerDao->getByResourceId($resource_id);
    $purchaseOrder['related_warehouse'] = $related_warehouse;
    $purchaseOrder['related_administrator'] = $related_administrator;
    $contractRow=$this->materialcontractDao->findById($purchaseOrder['contract_id']);
    $purchaseOrder['contract_name']=$contractRow['name'];

    $this->assign('materialClassRowArray',$materialClassRowArray);
    $this->assign('materialRowArray',$materialRowArray);
    $this->assign('enterpriseRowArray',$enterpriseRowArray);
    $this->assign('purchasePlanOrderRowArray',$purchasePlanOrderRow);
    $this->assign('purchaseOrder',$purchaseOrder);
    $this->assign('purchaseOrderDetailsArray',$purchaseOrderDetailsArray);
    $this->assign('contractRowArray',$contractRowArray);
    $this->display('OperMaterialManage/editPurchaseOrder');
  }

  public function editPurchaseOrderSubmit(){
    $order_id=$_POST['order_id'];
    $plan_id=$_POST['planid'];
    $contract_id=$_POST['contractid'];
    $project_id=$_POST['projectid'];
    $enterprise_id=$_POST['enterpriseid'];
    $document=$_POST['document'];
    $happen_date=$_POST['happen_date'];
    $transactor=$_POST['transactor'];
    $in_method=$_POST['in_method'];
    $default_warehouse_id=$_POST['default_warehouse'];
    $default_administrator_id=$_POST['default_administrator'];
    $price=$_POST['price'];
    $remark=$_POST['remark'];

    $material_ids=$_POST['material_id'];
    $administrators=$_POST['administrator'];
    $warehouses=$_POST['warehouse'];
    $material_remarks=$_POST['material_remark'];
    $material_prices=$_POST['material_price'];
    $amounts=$_POST['amount'];
    $unit_prices=$_POST['unit_price'];
    $specifications=$_POST['specification'];
    $this->materialPurchaseOrderDao->updateById($plan_id,$contract_id,$enterprise_id,$document,$happen_date,$transactor,$in_method,$default_warehouse_id,$default_administrator_id,$price,$remark,$order_id);
    $this->materialPurchaseOrderDetailsDao->deleteByOrderId($order_id);
    foreach ($material_ids as $key=>$value){
      if ($key>0){
        $this->materialPurchaseOrderDetailsDao->add($value,$specifications[$key],$unit_prices[$key],$amounts[$key],$material_prices[$key],$material_remarks[$key],$warehouses[$key],$administrators[$key],$order_id);
      }
    }
    $this->redirect('OperMaterialManage/listPurchaseOrder',"修改采购单成功...");
  }

  public function deletePurchaseOrder(){
    $order_id=$_GET['order_id'];
    $this->materialPurchaseOrderDao->deleteById($order_id);
    $this->materialPurchaseOrderDetailsDao->deleteByOrderId($order_id);
    $this->redirect('OperMaterialManage/listPurchaseOrder',array(),3,"删除采购单成功...");	
  }

  public function checkPurchaseOrder(){
    $order_id=$_POST['order_id'];
    $purchaseOrderDetailsRowArray=$this->materialPurchaseOrderDetailsDao->findById($order_id);
    $flag=1;
    foreach($purchaseOrderDetailsRowArray as $value){
        //$this->materialInventoryDao->add($value['warehouse_id'],$value['material_id'],$value['price'],$value['count'],$value['order_id']);
        $inventoryRowArray=$this->materialInventoryDao->findAll();
       foreach($inventoryRowArray as $value_2){
            if($value['warehouse_id']==$value_2['warehouse_id'] && $value['material_id']==$value_2['material_id']){
                $final_count=$value_2['count']+$value['count'];
                $this->materialInventoryDao->updateCountById($final_count,$value_2['inventory_id']);
                $flag=0; 
                break;
            }else $flag=1;
       
       }
        if($flag==1){
            $this->materialInventoryDao->add($value['warehouse_id'],$value['material_id'],$value['count']);
        }
    }

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $userId=$userRow['userid'];
    $date = date("Y-m-d",time());
    $this->materialPurchaseOrderDao->updateCheckById($_POST['order_id'],true,$userId,$date);
    $this->ajaxReturn(Array($_SESSION['my_username'],$date),"JSON");
  }

  public function uncheckPurchaseOrder(){
    $order_id=$_POST['order_id'];
    $purchaseOrderDetailsRowArray=$this->materialPurchaseOrderDetailsDao->findById($order_id);
    $inventoryRowArray=$this->materialInventoryDao->findAll();
    foreach($purchaseOrderDetailsRowArray as $value){
        foreach($inventoryRowArray as $value_2){
            if($value['warehouse_id']==$value_2['warehouse_id'] && $value['material_id']==$value_2['material_id']){
                $final_count=$value_2['count']-$value['count'];
                $this->materialInventoryDao->updateCountById($final_count,$value_2['inventory_id']);
                break;
            }
        }
    }
    
    $this->materialPurchaseOrderDao->updateCheckById($_POST['order_id'],false,null,null);
    $this->ajaxReturn($_POST['order_id'],"JSON");
  }

  //材料采购单================================================================================
  //材料采购计划单============================================================================
  public function listPurchasePlanOrder(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PURCHASE_PLAN_ORDER;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $purchasePlanOrderRowArray=$this->materialPurchasePlanOrderDao->findAll();
    foreach($purchasePlanOrderRowArray as $key=>$value){
      $creatorRow=$this->userInfoByUserid($value['user_id']);
      $purchasePlanOrderRowArray[$key]['creator']=$creatorRow['name'];

      if($value['verify']==1){
        $verifyUserRow=$this->userInfoByUserid($value['verify_user']);
        $purchasePlanOrderRowArray[$key]['verify_user']=$verifyUserRow['name'];
      }

      $projectResourceRow=$this->projectResourceDao->findById($value['resource_id']);
      $purchasePlanOrderRowArray[$key]['resource_name']=$projectResourceRow['resource_name'];
    }
    $resourceRowArray=$this->projectResourceDao->findAll();
    $this->assign('resourceRowArray',$resourceRowArray);
    $this->assign('purchasePlanOrderRowArray',$purchasePlanOrderRowArray);
    $this->display('OperMaterialManage/listPurchasePlanOrder');
  }

  public function addPurchasePlanOrder(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PURCHASE_PLAN_ORDER;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    //分类，子分类
    $materialClassRowArray = $this->materialClassDao->findAll();
    foreach($materialClassRowArray as $key=>$value){
      $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($value['classid']);
      $materialClassRowArray[$key]['materialCategoryRowArray'] = $materialCategoryRowArray;
    }
    //材料实体
    $materialRowArray = $this->materialDao->findAll();
    foreach($materialRowArray as $key=>$value){
      $materialCategoryRow = $this->materialCategoryDao->findById($value['categoryid']);
      $materialRowArray[$key]['materialCategoryRow'] = $materialCategoryRow;
    }
    $this->assign('materialClassRowArray',$materialClassRowArray);
    $this->assign('materialRowArray',$materialRowArray);

    $resourceRowArray = $this->projectResourceDao->findAll();
    foreach($resourceRowArray as $key=>$value){
      $purchasePlanOrderRowArray=$this->materialPurchasePlanOrderDao->findByResourceId($value['resource_id']);
      $resourceRowArray[$key]['order_number']=count($purchasePlanOrderRowArray);
    }                
    $this->assign('resourceRowArray',$resourceRowArray);

    $materialEnquiryRowArray=$this->materialEnquiryDao->findAll();
    foreach($materialEnquiryRowArray as $key=>$value){
      $enquiryRow=$this->enterpriseDao->findById($value['enterprise_id']);
      $materialEnquiryRowArray[$key]['enterprise_name']=$enquiryRow['name'];
    }
    $this->assign('materialEnquiryRowArray',$materialEnquiryRowArray);       

    $this->display('OperMaterialManage/addPurchasePlanOrder');
  }

  public function addPurchasePlanOrderSubmit(){
    $resource_id=$_POST['resource_id'];        
    $plan_name=$_POST['plan_name'];        
    $plan_number=$_POST['plan_number'];        
    $plan_type=$_POST['plan_type'];        
    $plan_proposer=$_POST['plan_proposer'];        
    $declare_date=$_POST['declare_date'];        
    $plan_date=$_POST['plan_date'];        
    $tech_explanation=$_POST['tech_explanation'];        
    $plan_remark=$_POST['plan_remark'];        
    $enquiry_id=$_POST['enquiry_id'];        
    $enquiry_offer=$_POST['enquiry_offer'];
    $count=$_POST['count'];        
    $materialid=$_POST['materialid'];        
    $remark=$_POST['remark'];
    $amount=$_POST['amount'];

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $userId=$userRow['userid'];


    $plan_id=$this->materialPurchasePlanOrderDao->add($resource_id,$plan_name,$plan_number,$plan_type,$plan_proposer,$declare_date,$plan_date,$tech_explanation,$plan_remark,$amount,$userId);

    foreach($materialid as $key=>$value){
      if($key>0 && $plan_id){
        //$this->assign('test',$count[$key]);
        //$this->display('Test/test');
        $this->materialPurchasePlanOrderDetailsDao->add($plan_id,$value,$enquiry_id[$key],$enquiry_offer[$key],$count[$key],$remark[$key]);
      }    
    }

    $this->redirect('OperMaterialManage/listPurchasePlanOrder',array(),3,"添加采购计划单成功...");	

  }

  public function editPurchasePlanOrder(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PURCHASE_PLAN_ORDER;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $plan_id=$_POST['plan_id'];

    $purchasePlanOrderRow=$this->materialPurchasePlanOrderDao->findById($plan_id);
    $purchasePlanOrderDetailsRowArray=$this->materialPurchasePlanOrderDetailsDao->findByPlanId($plan_id);

    foreach($purchasePlanOrderDetailsRowArray as $key=>$value){
      $materialRow=$this->materialDao->findById($value['material_id']);
      $purchasePlanOrderDetailsRowArray[$key]['material']=$materialRow;

      $enquiryRow=$this->materialEnquiryDao->findById($value['enquiry_id']);
      $enterpriseRow=$this->enterpriseDao->findById($enquiryRow['enterprise_id']);
      $purchasePlanOrderDetailsRowArray[$key]['enterprise_name']=$enterpriseRow['name'];
    }
    $materialEnquiryRowArray=$this->materialEnquiryDao->findAll();
    foreach($materialEnquiryRowArray as $key=>$value){
      $enquiryRow=$this->enterpriseDao->findById($value['enterprise_id']);
      $materialEnquiryRowArray[$key]['enterprise_name']=$enquiryRow['name'];
    }
    //分类，子分类
    $materialClassRowArray = $this->materialClassDao->findAll();
    foreach($materialClassRowArray as $key=>$value){
      $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($value['classid']);
      $materialClassRowArray[$key]['materialCategoryRowArray'] = $materialCategoryRowArray;
    }
    //材料实体
    $materialRowArray = $this->materialDao->findAll();
    foreach($materialRowArray as $key=>$value){
      $materialCategoryRow = $this->materialCategoryDao->findById($value['categoryid']);
      $materialRowArray[$key]['materialCategoryRow'] = $materialCategoryRow;
    }
    $this->assign('materialClassRowArray',$materialClassRowArray);
    $this->assign('materialRowArray',$materialRowArray);
    $this->assign('materialEnquiryRowArray',$materialEnquiryRowArray);       
    $this->assign('purchasePlanOrderRow',$purchasePlanOrderRow);
    $this->assign('purchasePlanOrderDetailsRowArray',$purchasePlanOrderDetailsRowArray);
    $this->display('OperMaterialManage/editPurchasePlanOrder');
  }

  public function editPurchasePlanOrderSubmit(){
    $plan_id=$_POST['plan_id'];        
    $plan_name=$_POST['plan_name'];        
    $plan_number=$_POST['plan_number'];        
    $plan_type=$_POST['plan_type'];        
    $plan_proposer=$_POST['plan_proposer'];        
    $declare_date=$_POST['declare_date'];        
    $plan_date=$_POST['plan_date'];        
    $tech_explanation=$_POST['tech_explanation'];        
    $plan_remark=$_POST['plan_remark'];        
    $enquiry_id=$_POST['enquiry_id'];        
    $enquiry_offer=$_POST['enquiry_offer'];
    $count=$_POST['count'];        
    $materialid=$_POST['materialid'];        
    $remark=$_POST['remark'];
    $amount=$_POST['amount'];

    $materialPurchasePlanOrderRow = $this->materialPurchasePlanOrderDao->findById($plan_id);
    $result = $this->materialPurchasePlanOrderDao->updateById($plan_id,$materialPurchasePlanOrderRow['resource_id'],$plan_name,$plan_number,$plan_type,$plan_proposer,$declare_date,$plan_date,$tech_explanation,$plan_remark,$amount,$materialPurchasePlanOrderRow['user_id'],$materialPurchasePlanOrderRow['verify_user'],$materialPurchasePlanOrderRow['verify'],$materialPurchasePlanOrderRow['finish']);
    if($result != true){
      $this->display('Staticpage/wrongalert');
      return;
    }
    $this->materialPurchasePlanOrderDetailsDao->deleteByPlanId($plan_id);
    foreach($materialid as $key=>$value){
      if($key>0 && $plan_id){
        //$this->assign('test',$count[$key]);
        //$this->display('Test/test');
        $this->materialPurchasePlanOrderDetailsDao->add($plan_id,$value,$enquiry_id[$key],$enquiry_offer[$key],$count[$key],$remark[$key]);
      }    
    }

    $this->redirect('OperMaterialManage/listPurchasePlanOrder',array(),3,"修改采购计划单成功...");	
  }

  public function deletePurchasePlanOrder(){
    $plan_id=$_GET['plan_id'];
    $this->materialPurchasePlanOrderDao->deleteById($plan_id);
    $this->materialPurchasePlanOrderDetailsDao->deleteByPlanId($plan_id);
    $this->redirect('OperMaterialManage/listPurchasePlanOrder',array(),3,"删除采购计划单成功...");	
  }

  public function PurchasePlanOrderUpdateVerify(){
    $plan_id=$_POST['plan_id'];
    $state=$_POST['state'];

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $userId=$userRow['userid'];
    if($state==1){
      $this->materialPurchasePlanOrderDao->updateVerifyById($plan_id,$state,$userId);
      $user=$this->userInfoByUserid($userId);
      $this->ajaxReturn($user,"JSON");
    }
    if($state==0){
      $userId=0;
      $this->materialPurchasePlanOrderDao->updateVerifyById($plan_id,$state,$userId);
    }

  }

  public function PurchasePlanOrderUpdateFinish(){
    $plan_id=$_POST['plan_id'];
    $state=$_POST['state'];            
    $this->materialPurchasePlanOrderDao->updateFinishById($plan_id,$state);
  }
  //材料采购计划单============================================================================

  //材料采购合同---------------------------------------------------------------------------------
  public function listContract(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_CONTRACT;
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
      $this->assign('treeExist',1);
      $this->display('OperMaterialManage/listContract');
      return;
    }
    else{
      $resource_id = $_GET['resource_id'];
      $resourceRow = $this->projectResourceDao->findById($resource_id);
      $this->assign('resource_name',$resourceRow['resource_name']);
      $this->assign('treeExist',0);

      $contractRowArray = $this->materialcontractDao->findByResourceid($resource_id);
      foreach($contractRowArray as $key=>$value){
        //供货商名称
        $enterprise1Row = $this->enterpriseDao->findById($value['a_part_enterpriseid']);
        $enterprise2Row = $this->enterpriseDao->findById($value['supplier_enterpriseid']);
        $contractRowArray[$key]['a_part_enterprise_name'] = $enterprise1Row['name'];
        $contractRowArray[$key]['supplier_enterprise_name'] = $enterprise2Row['name'];
        //创建人姓名
        $create_userRow = $this->userInfoByUserid($value['create_userid']);
        $contractRowArray[$key]['create_user_name'] = $create_userRow['name'];
        //合同金额
        $contractContentRowArray = $this->materialcontractContentDao->findByContractid($value['contractid']);
        $totalValue = 0;
        foreach ($contractContentRowArray as $key2 => $value2){
          $totalValue += $value2['price_perunit']*$value2['amount'];
        }
        $contractRowArray[$key]['totalValue'] = $totalValue;
      }
      $this->assign('contractRowArray',$contractRowArray);
      $this->display('OperMaterialManage/listContract');
    }
  }

  public function checkContract(){
    $returnData = array();
    $contractid = $_POST['contractid'];
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $this->materialcontractDao->updateCheckstatusById($contractid,$userRow['userid']);
    $returnData['check_userid'] = $userRow['userid'];
    echo json_encode($returnData);
  }

  public function cancelcheckContract(){
    $returnData = array();
    $contractid = $_POST['contractid'];
    $this->materialcontractDao->updateCheckstatusById($contractid,0);
    $returnData['check_userid'] = 0;
    echo json_encode($returnData);
  }

  public function finalcostContract(){
    $returnData = array();
    $contractid = $_POST['contractid'];
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $this->materialcontractDao->updateFinalcoststatusById($contractid,$userRow['userid']);
    $returnData['finalcost_userid'] = $userRow['userid'];
    echo json_encode($returnData);
  }

  public function cancelfinalcostContract(){
    $returnData = array();
    $contractid = $_POST['contractid'];
    $this->materialcontractDao->updateFinalcoststatusById($contractid,0);
    $returnData['finalcost_userid'] = 0;
    echo json_encode($returnData);
  }


  public function addContract(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_CONTRACT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $resourceRowArray = $this->projectResourceDao->findAll();
    $this->assign('resourceRowArray',$resourceRowArray);
    $companyRowArray = $this->companyDao->findAll();
    $this->assign('companyRowArray',$companyRowArray);
    $departmentRowArray = $this->departmentDao->findAll();
    $this->assign('departmentRowArray',$departmentRowArray);

    if(isset($_GET['resource_id']) == false){
      $this->assign('treeExist',1);
      $this->display('OperMaterialManage/addContract');
      return;
    }
    else{
      $this->assign('treeExist',0);
      $resource_id = $_GET['resource_id'];
      $resourceRow = $this->projectResourceDao->findById($resource_id);
      $this->assign('resourceRow',$resourceRow);

      $enterpriseRowArray = $this->enterpriseDao->findAll();
      $this->assign('enterpriseRowArray',$enterpriseRowArray);

      $this->display('OperMaterialManage/addContract');
    }
  }

  public function addContractSubmit(){
    $contract_number = $_POST['contract_number'];
    $name = $_POST['name'];
    $a_part_enterpriseid = $_POST['a_part_enterpriseid'];
    $supplier_enterpriseid = $_POST['b_part_enterpriseid'];
    $duty_officer = $_POST['duty_officer'];
    $companyid = $_POST['companyid'];
    $departmentid = $_POST['departmentid'];
    $build_pattern = $_POST['build_pattern'];
    $sign_date = $_POST['sign_date'];
    $pay_baseprice_according = $_POST['pay_baseprice_according'];
    $margin_amount = $_POST['margin_amount'];
    $pay_limit = $_POST['pay_limit'];
    if(isset($_POST['check_grossamount_control']))$check_grossamount_control = 1;
    else $check_grossamount_control = 0;
    $main_content = $_POST['main_content'];
    $other_limit_condition = $_POST['other_limit_condition'];
    $resource_id = $_POST['resource_id'];

    $remark = "";
    $finalcost_userid = 0;
    $check_userid = 0;
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $create_userid = $userRow['userid'];
    $create_date = date('Y-m-d',time());

    $insertId = $this->materialcontractDao->add($resource_id,$contract_number,$name,$a_part_enterpriseid,$supplier_enterpriseid,
      $duty_officer,$companyid,$departmentid,$build_pattern,$sign_date,
      $pay_baseprice_according,$margin_amount,$pay_limit,$check_grossamount_control,$main_content,
      $other_limit_condition,$remark,$finalcost_userid,$check_userid,$create_userid,
      $create_date);

    if($insertId > 0)
      $this->redirect('OperMaterialManage/listContract',array('resource_id'=>$resource_id),3,"材料采购合同添加成功...");
    else
      $this->display('Staticpage/wrongalert');
  }

  public function editContract(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_CONTRACT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    // $contractid=$_POST['contract_id'];
    // echo "contractid:".$contractid;

    //合同基本信息
    $contractid=$_POST['contract_id'];
    $contractRow = $this->materialcontractDao->findById($contractid);
    //合同甲方、供货方信息
    $a_part_enterpriseRow = $this->enterpriseDao->findById($contractRow['a_part_enterpriseid']);
    $supplier_enterpriseRow = $this->enterpriseDao->findById($contractRow['supplier_enterpriseid']);
    $contractRow['a_part_enterprise_name'] = $a_part_enterpriseRow['name'];
    $contractRow['a_part_enterprise_legal_person'] = $a_part_enterpriseRow['legal_person'];
    $contractRow['a_part_enterprise_phone_number'] = $a_part_enterpriseRow['phone_number'];
    $contractRow['a_part_enterprise_address'] = $a_part_enterpriseRow['address'];
    $contractRow['a_part_enterprise_zip_number'] = $a_part_enterpriseRow['zip_number'];

    $contractRow['supplier_enterprise_name'] = $supplier_enterpriseRow['name'];
    $contractRow['supplier_enterprise_legal_person'] = $supplier_enterpriseRow['legal_person'];
    $contractRow['supplier_enterprise_phone_number'] = $supplier_enterpriseRow['phone_number'];
    $contractRow['supplier_enterprise_address'] = $supplier_enterpriseRow['address'];
    $contractRow['supplier_enterprise_zip_number'] = $supplier_enterpriseRow['zip_number'];

    $this->assign('contractRow',$contractRow);
    //对应项目信息
    $resourceRow = $this->projectResourceDao->findById($contractRow['resource_id']);
    $this->assign('resourceRow',$resourceRow);
    //公司、部门信息
    $companyRowArray = $this->companyDao->findAll();
    $this->assign('companyRowArray',$companyRowArray);
    $departmentRowArray = $this->departmentDao->findAll();
    $this->assign('departmentRowArray',$departmentRowArray);
    //往来单位信息
    $enterpriseRowArray = $this->enterpriseDao->findAll();
    $this->assign('enterpriseRowArray',$enterpriseRowArray);

    //合同文本信息
    $contractDocumentRowArray = $this->materialcontractDocumentDao->findByContractid($contractid);
    foreach($contractDocumentRowArray as $key=>$value){
      $createuser_info = $this->userInfoByUserid($value['create_userid']);
      $updateuser_info = $this->userInfoByUserid($value['lastupdate_userid']);
      $contractDocumentRowArray[$key]['create_userInfo'] = $createuser_info['name']."[".$createuser_info['employer_number']."]";
      $contractDocumentRowArray[$key]['lastupdate_userInfo'] = $updateuser_info['name']."[".$updateuser_info['employer_number']."]";
      $suffix = substr(strrchr($value['path'],"."),1);
      $contractDocumentRowArray[$key]['suffix'] = $suffix;
    }
    $this->assign('contractDocumentRowArray',$contractDocumentRowArray);
    //合同原件信息
    $contractDocumentOriginRowArray = $this->materialcontractDocumentOriginDao->findByContractid($contractid);
    foreach($contractDocumentOriginRowArray as $key=>$value){
      $suffix = substr(strrchr($value['path'],"."),1);
      $contractDocumentOriginRowArray[$key]['suffix'] = $suffix;
    }
    $this->assign('contractDocumentOriginRowArray',$contractDocumentOriginRowArray);
    //合同内容信息
    $contractContentRowArray = $this->materialcontractContentDao->findByContractid($contractid);
    $this->assign('contractContentRowArray',$contractContentRowArray);
    //材料信息
    //分类，子分类
    $materialClassRowArray = $this->materialClassDao->findAll();
    foreach($materialClassRowArray as $key=>$value){
      $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($value['classid']);
      $materialClassRowArray[$key]['materialCategoryRowArray'] = $materialCategoryRowArray;
    }
    $this->assign('materialClassRowArray',$materialClassRowArray);
    // //材料实体
    // $materialRowArray = $this->materialDao->findAll();
    // foreach($materialRowArray as $key=>$value){
    // 	$materialCategoryRow = $this->materialCategoryDao->findById($value['categoryid']);
    // 	$materialRowArray[$key]['materialCategoryRow'] = $materialCategoryRow;
    // }
    //$this->assign('materialRowArray',$materialRowArray);
    //材料报价
    $materialEnquiryRowArray=$this->materialEnquiryDao->findAll();
    foreach($materialEnquiryRowArray as $key=>$value){
      $materialEnquiryRowArray[$key]['enquiry_id']=$value['enquiry_id'];
      $enterpriseRow=$this->enterpriseDao->findById($value['enterprise_id']);
      $materialEnquiryRowArray[$key]['enterprise_name']=$enterpriseRow['name'];
      $materialRow = $this->materialDao->findById($value['material_id']);
      $materialEnquiryRowArray[$key]['worktype']=$materialRow['worktype'];
      $materialEnquiryRowArray[$key]['name']=$materialRow['name'];
      $materialEnquiryRowArray[$key]['specification']=$materialRow['specification'];
      $materialEnquiryRowArray[$key]['unit']=$materialRow['unit'];
      $materialEnquiryRowArray[$key]['categoryid']=$materialRow['categoryid'];
      $categoryRow = $this->materialCategoryDao->findById($materialRow['categoryid']);
      $materialEnquiryRowArray[$key]['classid']=$categoryRow['classid'];
    }
    $this->assign('materialEnquiryRowArray',$materialEnquiryRowArray);
    //材料计划
    $materialPlanRowArray = $this->materialPurchasePlanOrderDao->findByResourceid($resourceRow['resource_id']);
    $mppdDisplayRowArray = array();
    foreach($materialPlanRowArray as $key=>$value){
      //材料计划内容
      $mppDetailRowArray = $this->materialPurchasePlanOrderDetailsDao->findByPlanId($value['plan_id']);
      foreach($mppDetailRowArray as $key=>$value1){
        $mppdDisplayRow = array();
        //detail_id worktype name parameter unit
        $materialRow = $this->materialDao->findById($value1['material_id']);
        $mppdDisplayRow['detail_id'] = $value1['detail_id'];
        $mppdDisplayRow['worktype'] = $materialRow['worktype'];
        $mppdDisplayRow['name'] = $materialRow['name'];
        $mppdDisplayRow['specification'] = $materialRow['specification'];
        $mppdDisplayRow['unit'] = $materialRow['unit'];
        // supplier_name
        $enquiryRow = $this->materialEnquiryDao->findById($value1['enquiry_id']);
        $enterpriseRow = $this->enterpriseDao->findById($enquiryRow['enterprise_id']);
        $mppdDisplayRow['supplier_name'] = $enterpriseRow['name'];
        // enquiry_offer
        $mppdDisplayRow['enquiry_offer'] = $enquiryRow['enquiry_offer'];
        // count
        $mppdDisplayRow['count'] = $value1['count'];
        // remark
        $mppdDisplayRow['remark'] = $value1['remark'];
        // plan_id
        $mppdDisplayRow['plan_id'] = $value['plan_id'];
        $mppdDisplayRowArray[]=$mppdDisplayRow;
      }
    }
    $this->assign('mppdDisplayRowArray',$mppdDisplayRowArray);
    $this->assign('materialPlanRowArray',$materialPlanRowArray);

    //合同内容
    $contractContentRowArray = $this->materialcontractContentDao->findByContractid($contractid);
    $contractContentDisplayRowArray=array();
    $index = 0;
    foreach($contractContentRowArray as $key=>$value){
      //contentid
      $contractContentDisplayRowArray[$index]['contentid'] = $value['contentid'];
      //工种
      $materialRow = $this->materialDao->findById($value['material_id']);
      $contractContentDisplayRowArray[$index]['worktype'] = $materialRow['worktype'];
      //名称
      $contractContentDisplayRowArray[$index]['name'] = $materialRow['name'];
      //规格
      $contractContentDisplayRowArray[$index]['specification'] = $materialRow['specification'];
      //单位
      $contractContentDisplayRowArray[$index]['unit'] = $materialRow['unit'];
      //供应商
      $enquiryRow = $this->materialEnquiryDao->findById($value['enquiry_id']);
      $enterpriseRow = $this->enterpriseDao->findById($enquiryRow['enterprise_id']);
      $contractContentDisplayRowArray[$index]['enterprise_name'] = $enterpriseRow['name'];
      //报价
      $contractContentDisplayRowArray[$index]['enquiry_offer'] = $enquiryRow['enquiry_offer'];
      //数量
      $contractContentDisplayRowArray[$index]['amount'] = $value['amount'];
      //备注
      $contractContentDisplayRowArray[$index]['remark'] = $value['remark'];
      //计划单号
      if(empty($value['plan_id']) == false){
        $planRow = $this->materialPurchasePlanOrderDao->findById($value['plan_id']);
        $contractContentDisplayRowArray[$index]['plan_number'] = $planRow['plan_number'];
      }
      else $contractContentDisplayRowArray[$index]['plan_number'] = "";
      $index++;
    }
    $this->assign('contractContentDisplayRowArray',$contractContentDisplayRowArray);



    $this->display('OperMaterialManage/editContract');
  }

  public function editContractSubmit(){
    $contractid = $_POST['contractid'];
    $contract_number = $_POST['contract_number'];
    $name = $_POST['name'];
    $a_part_enterpriseid = $_POST['a_part_enterpriseid'];
    $supplier_enterpriseid = $_POST['b_part_enterpriseid'];
    $duty_officer = $_POST['duty_officer'];
    $companyid = $_POST['companyid'];
    $departmentid = $_POST['departmentid'];
    $build_pattern = $_POST['build_pattern'];
    $sign_date = $_POST['sign_date'];
    $pay_baseprice_according = $_POST['pay_baseprice_according'];
    $margin_amount = $_POST['margin_amount'];
    $pay_limit = $_POST['pay_limit'];
    if(isset($_POST['check_grossamount_control']))$check_grossamount_control = 1;
    else $check_grossamount_control = 0;
    $main_content = $_POST['main_content'];
    $other_limit_condition = $_POST['other_limit_condition'];
    $resource_id = $_POST['resource_id'];

    $remark = $_POST['remark'];
    $contractRow = $this->materialcontractDao->findById($contractid);
    // $this->assign('test',$other_limit_condition);
    // $this->assign('test1',$remark);
    // $this->display('Test/test');
    // return;

    $result = $this->materialcontractDao->updateById($contractid,$resource_id,$contract_number,$name,$a_part_enterpriseid,$supplier_enterpriseid,
      $duty_officer,$companyid,$departmentid,$build_pattern,$sign_date,
      $pay_baseprice_according,$margin_amount,$pay_limit,$check_grossamount_control,$main_content,
      $other_limit_condition,$remark,$contractRow['finalcost_userid'],$contractRow['check_userid'],$contractRow['create_userid'],
      $contractRow['create_date']);

    if($result == false){
      $this->display('Staticpage/wrongalert');
      return;
    }
    elseif($result == true)
      $this->redirect('OperMaterialManage/listContract',array('resource_id'=>$resource_id),3,"修改材料采购合同成功...");
  }

  public function editContract_uploadfile(){
    $returnData = array();
    $doc_name = $_POST['name'];
    $doc_remark = $_POST['remark'];
    $contractid = $_POST['contractid'];
    $result = 0;
    $contractRow = $this->materialcontractDao->findById($contractid);

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $userInfoArray = $this->userInfoByUserid($userRow['userid']);

    //存储数据库信息
    $insertId = $this->materialcontractDocumentDao->add($contractid,$doc_name,"",$doc_remark,$userRow['userid'],$userRow['userid'],0);
    if($insertId <= 0){$returnData['documentid'] = $insertId;echo json_encode($returnData);return;}

    //存储文件
    $dirPath = "Data/resource_".$contractRow['resource_id']."/materialcontract_".$contractid."/doc_e/";
    $suffix="";
    $result = func_createFile($dirPath,$insertId,$_FILES['documentFile1'],$suffix);
    if($result <= 0){$returnData['documentid'] = $result;echo json_encode($returnData);return;}
    //更新数据库信息
    $contractDocumentRow = $this->materialcontractDocumentDao->findById($insertId);
    $path = $dirPath.$insertId.".".$suffix;
    $result = $this->materialcontractDocumentDao->updateById($insertId,$contractDocumentRow['contractid'],$contractDocumentRow['name'],$path,$contractDocumentRow['remark'],$contractDocumentRow['create_userid'],$contractDocumentRow['lastupdate_userid'],$contractDocumentRow['checked_userid']);
    if($result == false){$returnData['documentid'] = -5;echo json_encode($returnData);return;}

    //返回
    $returnData['documentid'] = $insertId;
    $returnData['doc_name'] = $doc_name;
    $returnData['doc_remark'] = $doc_remark;
    $returnData['suffix'] = $suffix;
    $returnData['create_userInfo'] = $userInfoArray['name']."[".$userInfoArray['employer_number']."]";
    $returnData['lastupdate_userInfo'] = $userInfoArray['name']."[".$userInfoArray['employer_number']."]";
    $returnData['download_url'] = U('OperMaterialManage/editContract_downloadDocument',array('documentid'=>$returnData['documentid']));
    echo json_encode($returnData);
  }

  public function editContract_checkDocument(){
    $documentid = $_POST['documentid'];
    $operation = $_POST['operation'];
    $returnData = array();
    $returnData['result'] = false;
    $contractDocumentRow = $this->materialcontractDocumentDao->findById($documentid);
    if($operation == "check"){
      $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
      $result = $this->materialcontractDocumentDao->updateById($documentid,$contractDocumentRow['contractid'],$contractDocumentRow['name'],$contractDocumentRow['path'],$contractDocumentRow['remark'],$contractDocumentRow['create_userid'],$contractDocumentRow['lastupdate_userid'],$userRow['userid']);
      $returnData['result'] = $result;
    }
    else if($operation == "uncheck"){

      $result = $this->materialcontractDocumentDao->updateById($documentid,$contractDocumentRow['contractid'],$contractDocumentRow['name'],$contractDocumentRow['path'],$contractDocumentRow['remark'],$contractDocumentRow['create_userid'],$contractDocumentRow['lastupdate_userid'],0);
      $returnData['result'] = $result;
    }
    echo json_encode($returnData);
  }

  public function editContract_editDocument(){
    $returnData = array();
    $doc_name = $_POST['doc_name'];
    $doc_remark = $_POST['doc_remark'];
    $documentid = $_POST['documentid'];
    if($documentid <=0){$returnData['documentid'] = 0;echo json_encode($returnData);return;}
    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $contractDocumentRow = $this->materialcontractDocumentDao->findById($documentid);
    $result = $this->materialcontractDocumentDao->updateById($documentid,$contractDocumentRow['contractid'],$doc_name,$contractDocumentRow['path'],$doc_remark,$contractDocumentRow['create_userid'],$userRow['userid'],$contractDocumentRow['checked_userid']);
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

  public function editContract_downloadDocument(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_CONTRACT;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $documentid = $_GET['documentid'];
    $documentRow = $this->materialcontractDocumentDao->findById($documentid);
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
  public function editContract_deletefile(){
    $data = false;
    $documentid = $_POST['documentid'];
    if($documentid <= 0){$data=false;return;}
    $documentRow = $this->materialcontractDocumentDao->findById($documentid);
    $filepath = $documentRow['path'];
    //删除文件
    //$filepath = iconv("utf-8", "gbk", $filepath);
    $result = unlink($filepath);
    if($result == false){echo json_encode($data);return;}
    //删除数据库信息
    $result = $this->materialcontractDocumentDao->deleteById($documentid);
    $data = $result;
    echo json_encode($data);
  }

  public function editContract_uploadfileOrigin(){
    $doc_name = $_POST['name'];
    $doc_remark = $_POST['remark'];
    $contractid = $_POST['contractid'];
    $result = 0;
    $contractRow = $this->materialcontractDao->findById($contractid);
    $returnData = array();

    //存储数据库信息
    $insertId = $this->materialcontractDocumentOriginDao->add($contractid,$doc_name,"",$doc_remark);
    if($insertId <= 0){$returnData['documentid'] = $insertId;echo json_encode($returnData);return;}

    //存储文件
    $dirPath = "Data/resource_".$contractRow['resource_id']."/materialcontract_".$contractid."/doc_origin/";
    $suffix="";
    $result = func_createFile($dirPath,$insertId,$_FILES['documentFile'],$suffix);
    if($result <= 0){$returnData['documentid'] = $result;echo json_encode($returnData);return;}
    //更新数据库信息
    $contractDocumentOriginRow = $this->materialcontractDocumentOriginDao->findById($insertId);
    $path = $dirPath.$insertId.".".$suffix;
    $result = $this->materialcontractDocumentOriginDao->updateById($insertId,$contractDocumentOriginRow['contractid'],$contractDocumentOriginRow['name'],$path,$contractDocumentOriginRow['remark']);
    if($result == false){$returnData['documentid'] = -5;echo json_encode($returnData);return;}

    //返回
    $returnData['documentid'] = $insertId;
    $returnData['doc_name'] = $doc_name;
    $returnData['doc_remark'] = $doc_remark;
    $returnData['suffix'] = $suffix;
    $returnData['download_url'] = U('OperMaterialManage/editContract_downloadDocumentOrigin',array('documentid'=>$returnData['documentid']));
    //$resultData['contractid'] = $contractid;
    echo json_encode($returnData);
  }

  // public function test(){
  // 	$detail_id = $_POST['detail_id'];
  // 	$mppRow = $this->materialPurchasePlanOrderDetailsDao->findById($detail_id);

  // }

  public function editContract_importPlanToContract(){
    $returnData = array();
    $detail_ids = explode(",", $_POST['detail_ids']);
    $contractid = $_POST['contractid'];
    foreach($detail_ids as $key=>$value){
      $mppRow = $this->materialPurchasePlanOrderDetailsDao->findById($value);
      $contentid = $this->materialcontractContentDao->add($contractid,$mppRow['material_id'],$mppRow['enquiry_id'],$mppRow['count'],$mppRow['remark'],$mppRow['plan_id']);
      //material_id category_name worktype name specification unit
      $material_id = $mppRow['material_id'];
      $materialRow = $this->materialDao->findById($mppRow['material_id']);
      $worktype = $materialRow['worktype'];
      $name = $materialRow['name'];
      $specification = $materialRow['specification'];
      $unit = $materialRow['unit'];
      //$categoryRow = $this->materialCategoryDao->findById($materialRow['categoryid']);
      //$category_name = $categoryRow['name'];

      //enquiry_id enquiry_offer supplier_name supplierid 
      $enquiry_id = $mppRow['enquiry_id'];
      $enquiryRow = $this->materialEnquiryDao->findById($mppRow['enquiry_id']);
      $enquiry_offer = $enquiryRow['enquiry_offer'];
      $enterpriseRow = $this->enterpriseDao->findById($enquiryRow['enterprise_id']);
      $supplier_name = $enterpriseRow['name'];
      $supplierid = $enterpriseRow['enterpriseid'];
      //plan_id plan_number
      $plan_id = $mppRow['plan_id'];
      $planRow = $this->materialPurchasePlanOrderDao->findById($mppRow['plan_id']);
      $plan_number = $planRow['plan_name'];
      //count remark
      $count = $mppRow['count'];
      $remark = $mppRow['remark']; 	
    }

    $returnData['contentid'] = $contentid;
    $returnData['worktype'] = $worktype;
    $returnData['name'] = $name;
    $returnData['specification'] = $specification;
    $returnData['unit'] = $unit;
    //$returnData['category_name'] = $category_name;
    $returnData['supplier_name'] = $supplier_name;
    $returnData['enquiry_offer'] = $enquiry_offer;
    $returnData['count'] = $count;
    $returnData['remark'] = $remark;
    $returnData['plan_number'] = $plan_number;	

    $returnData['contractid'] = $contractid;
    $returnData['material_id'] = $material_id;
    $returnData['enquiry_id'] = $enquiry_id;
    $returnData['supplierid'] = $supplierid;
    $returnData['plan_id'] = $plan_id;

    echo json_encode($returnData);
  }

  public function editContract_importEnquiryToContract(){
    $returnData = array();
    $enquiry_id = $_POST['enquiry_id'];
    $enquiryRow = $this->materialEnquiryDao->findById($enquiry_id);
    $amount = $_POST['count'];
    $contractid = $_POST['contractid'];
    $contentid = $this->materialcontractContentDao->add($contractid,$enquiryRow['material_id'],$enquiryRow['enquiry_id'],$amount,"","");
    $materialRow = $this->materialDao->findById($enquiryRow['material_id']);
    $enterpriseRow = $this->enterpriseDao->findById($enquiryRow['enterprise_id']);

    $returnData['contentid'] = $contentid;
    $returnData['worktype'] = $materialRow['worktype'];
    $returnData['name'] = $materialRow['name'];
    $returnData['specification'] = $materialRow['specification'];
    $returnData['unit'] = $materialRow['unit'];
    //$returnData['category_name'] = $category_name;
    $returnData['supplier_name'] = $enterpriseRow['name'];
    $returnData['enquiry_offer'] = $enquiryRow['enquiry_offer'];
    $returnData['count'] = $amount;
    $returnData['remark'] = "";
    $returnData['plan_number'] = "";	

    $returnData['contractid'] = $contractid;
    $returnData['material_id'] = $enquiryRow['material_id'];
    $returnData['enquiry_id'] = $enquiry_id;
    $returnData['supplierid'] = $enterpriseRow['supplierid'];
    $returnData['plan_id'] = 0;

    echo json_encode($returnData);

  }

  public function editContract_deleteContent(){
    $returnData = array();
    $contentid = $_POST['contentid'];
    $result = $this->materialcontractContentDao->deleteById($contentid);
    $returnData['result'] = $result;
    echo json_encode($returnData);
  }

  public function editContract_editContent(){
    $returnData = array();
    $contentid = $_POST['contentid'];
    $amount = $_POST['amount'];
    $remark = $_POST['remark'];
    $contentRow = $this->materialcontractContentDao->findById($contentid);
    $result = $this->materialcontractContentDao->updateById($contentid,$contentRow['contractid'],$contentRow['material_id'],$contentRow['enquiry_id'],$amount,$remark,0);
    $returnData['result'] = $result;
    echo json_encode($returnData);



  }

  //材料采购合同==================================================================================

  //材料出库单====================================================================================    
  public function listOutboundOrder(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_OUTBOUND_ORDER;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $resourceRowArray=$this->projectResourceDao->findAll();
    $this->assign('resourceRowArray',$resourceRowArray);

    $outboundOrderRowArray=$this->materialOutboundOrderDao->findAll();
    foreach($outboundOrderRowArray as $key=>$value){
      $warehouseRow=$this->warehouseDao->findById($value['warehouse_id']);
      $outboundOrderRowArray[$key]['warehouse']=$warehouseRow[warehouse_name];
      $warehouseWorkerRow=$this->warehouseWorkerDao->findById($value['warehouse_worker_id']);
      $outboundOrderRowArray[$key]['warehouse_worker']=$warehouseWorkerRow['warehouse_worker_name'];
      $subcontractorRow=$this->subcontractorDao->findById($value[subcontractor_id]);
      $outboundOrderRowArray[$key]['subcontractor']=$subcontractorRow['subcontractor_name'];
      $subcontractorWorkerRow=$this->subcontractorWorkerDao->findById($value['subcontractor_worker_id']);
      $outboundOrderRowArray[$key]['subcontractor_worker']=$subcontractorWorkerRow['subcontractor_worker_name'];
      $projectResourceRow=$this->projectResourceDao->findById($value['resource_id']);
      $outboundOrderRowArray[$key]['resource_name']=$projectResourceRow['resource_name'];

      if($value['verify']==1){
        $verifyUserRow=$this->userInfoByUserid($value['verify_user']);
        $outboundOrderRowArray[$key]['verify_user']=$verifyUserRow['name'];
      }
      $creatorRow=$this->userInfoByUserid($value['user_id']);
      $outboundOrderRowArray[$key]['creator']=$creatorRow['name'];

    }
    $this->assign('outboundOrderRowArray',$outboundOrderRowArray);
    $this->display('OperMaterialManage/listOutboundOrder');
  }

  public function addOutboundOrder(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_OUTBOUND_ORDER;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }


    $resourceRowArray=$this->projectResourceDao->findAll();
    foreach($resourceRowArray as $key=>$value){
      $outboundRowArray=$this->materialOutboundOrderDao->findByResourceId($value['resource_id']);
      $resourceRowArray[$key]['order_number']=count($outboundRowArray);
    }                
    $warehouseRowArray=$this->warehouseDao->findAll();
    $warehouseWorkerRowArray=$this->warehouseWorkerDao->findAll();
    $subcontractorRowArray=$this->subcontractorDao->findAll();
    $subcontractorWorkerRowArray=$this->subcontractorWorkerDao->findAll();

    $this->assign('warehouseRowArray',$warehouseRowArray);
    $this->assign('warehouseWorkerRowArray',$warehouseWorkerRowArray);
    $this->assign('resourceRowArray',$resourceRowArray);
    $this->assign('subcontractorRowArray',$subcontractorRowArray);
    $this->assign('subcontractorWorkerRowArray',$subcontractorWorkerRowArray);

    $materialInventoryRowArray=$this->materialInventoryDao->findAll();
    foreach($materialInventoryRowArray as $key=>$value){
      $materialRow=$this->materialDao->findById($value['material_id']);
      $materialInventoryRowArray[$key]['material']=$materialRow;
    }
    $this->assign('materialInventoryRowArray',$materialInventoryRowArray);
    $this->display('OperMaterialManage/addOutboundOrder');

  }

  public function addOutboundOrderSubmit(){
    $resource_id=$_POST['resource_id'];
    $outbound_number=$_POST['outbound_number'];
    $outbound_man=$_POST['outbound_man'];
    $outbound_date=$_POST['outbound_date'];
    $warehouse=$_POST['warehouse'];
    $warehouse_worker=$_POST['warehouse_worker'];
    $subcontractor=$_POST['subcontractor'];
    $subcontractor_worker=$_POST['subcontractor_worker'];
    $outbound_remark=$_POST['outbound_remark'];
    $count=$_POST['count'];
    $materialid=$_POST['materialid'];
    $remark=$_POST['remark'];
    $inventory_id=$_POST['inventoryid'];

    $verify=0;
    $verify_user="";

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $user_id=$userRow['userid'];

    $outbound_id=$this->materialOutboundOrderDao->add($resource_id,$user_id,$outbound_number,$outbound_man,$outbound_date,$warehouse,$warehouse_worker,$subcontractor,$subcontractor_worker,$outbound_remark,$verify,$verify_user);

    foreach($materialid as $key=>$value){
      if($key>0 && $outbound_id){
        $detail_id=$this->materialOutboundOrderDetailsDao->add($materialid[$key],$count[$key],$remark[$key],$outbound_id);
        $this->materialOutboundInventoryDao->add($outbound_id,$inventory_id[$key],$detail_id);
      }
    }

    
    $this->redirect('OperMaterialManage/listOutboundOrder',array(),3,"添加材料出库单成功...");	
  }

  public function editOutboundOrder(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_OUTBOUND_ORDER;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
    $outbound_id=$_POST['outbound_id'];

    $outboundOrderRow=$this->materialOutboundOrderDao->findById($outbound_id);
    $outboundOrderDetailsRowArray=$this->materialOutboundOrderDetailsDao->findByOutboundOrderId($outbound_id);

    $warehouseRowArray=$this->warehouseDao->findAll();
    $warehouseWorkerRowArray=$this->warehouseWorkerDao->findAll();
    $subcontractorRowArray=$this->subcontractorDao->findAll();
    $subcontractorWorkerRowArray=$this->subcontractorWorkerDao->findAll();

    foreach($outboundOrderDetailsRowArray as $key=>$value){
      $materialRow=$this->materialDao->findById($value['material_id']);
      $outboundOrderDetailsRowArray[$key]['material']=$materialRow;
      //$outboundInventoryRow=$this->materialOutboundInventoryDao->findByOutboundOrderDetailId($value['detail_id']);
      //$outboundOrderDetailsRowArray[$key]['inventory_id']=$outboundInventoryRow['inventory_id'];
      $outboundOrderRow=$this->materialOutboundOrderDao->findById($value['outbound_id']);
      $outboundOrderDetailsRowArray[$key]['warehouse_id']=$outboundOrderRow['warehouse_id'];
      $inventoryRow=$this->materialInventoryDao->findByMaterialIdWarehouseId($value['material_id'],$outboundOrderRow['warehouse_id']);
      $outboundOrderDetailsRowArray[$key]['inventory_id']=$inventoryRow['inventory_id'];
      $outboundOrderDetailsRowArray[$key]['max_count']=$inventoryRow['count'];
    }


    $projectResourceRow=$this->projectResourceDao->findById($outboundOrderRow['resource_id']);
    $outboundOrderRow['resource_name']=$projectResourceRow['resource_name'];

    $warehouseRow=$this->warehouseDao->findById($outboundOrderRow['warehouse_id']);
    $outboundOrderRow['warehouse']=$warehouseRow[warehouse_name];

    $warehouseWorkerRow=$this->warehouseWorkerDao->findById($outboundOrderRow['warehouse_worker_id']);
    $outboundOrderRow['warehouse_worker']=$warehouseWorkerRow['warehouse_worker_name'];

    $subcontractorRow=$this->subcontractorDao->findById($outboundOrderRow[subcontractor_id]);
    $outboundOrderRow['subcontractor']=$subcontractorRow['subcontractor_name'];

    $subcontractorWorkerRow=$this->subcontractorWorkerDao->findById($outboundOrderRow['subcontractor_worker_id']);
    $outboundOrderRow['subcontractor_worker']=$subcontractorWorkerRow['subcontractor_worker_name'];

    $materialInventoryRowArray=$this->materialInventoryDao->findAll();
    foreach($materialInventoryRowArray as $key=>$value){
      $materialRow=$this->materialDao->findById($value['material_id']);
      $materialInventoryRowArray[$key]['material']=$materialRow;
    }

    //$outboundInventoryRowArray=$this->materialOutboundInventoryDao->findAll()i;
    $flag=1;
    foreach($materialInventoryRowArray as $key_1=>$value_1){
        foreach($outboundOrderDetailsRowArray as $key_2=>$value_2){
            if($value_1['warehouse_id']==$value_2['warehouse_id'] && $value_1['material_id']==$value_2['material_id']){
                $materialInventorySelectedRowArray[]=$materialInventoryRowArray[$key_1];
                $flag=0;
                break;
            }else $flag=1;
        }
        if($flag==1){
           $materialInventoryUnselectedRowArray[]=$materialInventoryRowArray[$key_1];
        }
    }

    foreach($materialInventoryUnselectedRowArray as $key=>$value){
        $warehouse_id=$outboundOrderRow['warehouse_id'];
        if($value['warehouse_id']==$warehouse_id){
            $materialInventorySameWarehouseRowArray[]=$materialInventoryUnselectedRowArray[$key];
        }else $materialInventoryUnsameWarehouseRowArray[]=$materialInventoryUnselectedRowArray[$key];
    }

    $this->assign('materialInventorySelectedRowArray',$materialInventorySelectedRowArray);
    $this->assign('materialInventorySameWarehouseRowArray',$materialInventorySameWarehouseRowArray);
    $this->assign('materialInventoryUnsameWarehouseRowArray',$materialInventoryUnsameWarehouseRowArray);
    $this->assign('materialInventoryRowArray',$materialInventoryRowArray);

    $this->assign("outboundOrderRow",$outboundOrderRow);
    $this->assign("outboundOrderDetailsRowArray",$outboundOrderDetailsRowArray);

    $this->assign('warehouseRowArray',$warehouseRowArray);
    $this->assign('warehouseWorkerRowArray',$warehouseWorkerRowArray);
    $this->assign('subcontractorRowArray',$subcontractorRowArray);
    $this->assign('subcontractorWorkerRowArray',$subcontractorWorkerRowArray);

    $this->display('OperMaterialManage/editOutboundOrder');
  }

  public function editOutboundOrderSubmit(){
    $outbound_id=$_POST['outbound_id'];
    $outbound_man=$_POST['outbound_man'];
    $outbound_date=$_POST['outbound_date'];
    $warehouse=$_POST['warehouse'];
    $warehouse_worker=$_POST['warehouse_worker'];
    $subcontractor=$_POST['subcontractor'];
    $subcontractor_worker=$_POST['subcontractor_worker'];
    $outbound_remark=$_POST['outbound_remark'];
    $count=$_POST['count'];
    $materialid=$_POST['materialid'];
    $remark=$_POST['remark'];
    $inventory_id=$_POST['inventoryid'];
    $count_max=$_POST['count_max'];
/*
    $inventoryByoutboundRowArray=$this->materialOutboundInventoryDao->findByOutboundOrderId($outbound_id);
    foreach($inventoryByoutboundRowArray as $value_1){
        foreach($inventory_id as $key=>$value_2){
        if($key>0){
            if($value_1['inventory_id']==$value_2){
                $flag=0;
                break;
            }else $flag=1; 
        }
        }    
        if($flag==1){
            $deletedInventoryRowArray[]=$value_1;
        }
    }

    $inventoryRowArray=$this->materialInventoryDao->findAll();
    foreach($deletedInventoryRowArray as $value_1){
        foreach($inventoryRowArray as $value_2){
            if($value_1['inventory_id']==$value_2['inventory_id']){
                $outboundDetailRow=$this->materialOutboundOrderDetailsDao->findById($value_1['outbound_detail_id']);
                $final_count=$outboundDetailRow['count']+$value_2['count'];
                $this->materialInventoryDao->updateCountById($final_count,$value_1['inventory_id']);
            }
        }
    }
 */  
    $this->materialOutboundOrderDao->updateById($outbound_man,$outbound_date,$warehouse,$warehouse_worker,$subcontractor,$subcontractor_worker,$outbound_remark,$outbound_id);
    $this->materialOutboundOrderDetailsDao->deleteByOutboundId($outbound_id);
   // $this->materialOutboundInventoryDao->deleteByOutboundId($outbound_id); 
    foreach($materialid as $key=>$value){
      if($key>0){
        $detail_id=$this->materialOutboundOrderDetailsDao->add($materialid[$key],$count[$key],$remark[$key],$outbound_id);
       // $this->materialOutboundInventoryDao->add($outbound_id,$inventory_id[$key],$detail_id);
      }
    }        
  /*  
    foreach($inventory_id as $key=>$value){
        if($key>0){
            $inventoryRow=$this->materialInventoryDao->findById($value);
            $final_count=$count_max[$key]-$count[$key];
            $this->materialInventoryDao->updateCountById($final_count,$value);
        }
    }    
   */
    $this->redirect('OperMaterialManage/listOutboundOrder',array(),3,"添加材料出库单成功...");	

  }

  public function OutboundOrderUpdateVerify(){
    $outbound_id=$_POST['outbound_id'];
    $state=$_POST['state'];

    $userRow = $this->userDao->findByUsername($_SESSION['my_username']);
    $userId=$userRow['userid'];
    if($state==1){
        $outboundDetailsRowArray=$this->materialOutboundOrderDetailsDao->findAll();
        foreach($outboundDetailsRowArray as $key=>$value){
            $outboundRow=$this->materialOutboundOrderDao->findById($value['outbound_id']);
            
            $inventoryRow=$this->materialInventoryDao->findByMaterialIdWarehouseId($value['material_id'],$outboundRow['warehouse_id']);
            $final_count=$inventoryRow['count']-$value['count'];
            $this->materialInventoryDao->updateCountById($final_count,$inventoryRow['inventory_id']);
        }
             
      $this->materialOutboundOrderDao->updateVerifyById($outbound_id,$state,$userId);
      $user=$this->userInfoByUserid($userId);
      $this->ajaxReturn($user,"JSON");
    }
    if($state==0){
        $outboundDetailsRowArray=$this->materialOutboundOrderDetailsDao->findAll();
        foreach($outboundDetailsRowArray as $key=>$value){
            $outboundRow=$this->materialOutboundOrderDao->findById($value['outbound_id']);
            
            $inventoryRow=$this->materialInventoryDao->findByMaterialIdWarehouseId($value['material_id'],$outboundRow['warehouse_id']);
            $final_count=$inventoryRow['count']+$value['count'];
            $this->materialInventoryDao->updateCountById($final_count,$inventoryRow['inventory_id']);
        }
             
      $userId=0;
      $this->materialOutboundOrderDao->updateVerifyById($outbound_id,$state,$userId);
    }

  }
  public function deleteOutboundOrder(){
    $outbound_id=$_GET['outbound_id'];
    $this->materialOutboundOrderDao->deleteById($outbound_id);
    $this->materialOutboundOrderDetailsDao->deleteByOutboundId($outbound_id);
    $this->materialOutboundInventoryDao->deleteByOutboundId($outbound_id);
    $this->redirect('OperMaterialManage/listOutboundOrder',array(),3,"删除材料出库单成功...");	
  }

  //材料出库单====================================================================================    
  //库存==========================================================================================

    public function listInventory(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_INVENTORY;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }
        
        $resourceRowArray=$this->projectResourceDao->findAll();
        $warehouseRowArray=$this->warehouseDao->findAll();
        foreach($warehouseRowArray as $key=>$value){
            $resourceRow=$this->projectResourceDao->findById($value['resource_id']);
            $warehouseRowArray[$key]['resource_name']=$resourceRow['resource_name'];
        }
        $this->assign('warehouseRowArray',$warehouseRowArray);
        $this->assign('resourceRowArray',$resourceRowArray);
        $this->display('OperMaterialManage/listInventory');  
    }

    public function getInventory(){
        //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = MATERIAL_INVENTORY;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    } 
        $warehouse_id=$_GET['warehouse_id'];
        $materialRowArray=$this->materialInventoryDao->findByWarehouseId($warehouse_id);
        foreach($materialRowArray as $key=>$value){
            $materialRow=$this->materialDao->findById($value['material_id']);
            $materialRowArray[$key]['material']=$materialRow;
        }
        $this->ajaxReturn($materialRowArray,"JSON");
          
    
    }

  //库存==========================================================================================
  //公共函数======================================================================================
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
  //公共函数======================================================================================
}

?>
