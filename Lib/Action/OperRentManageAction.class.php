<?php
header('Content-Type:text/html;charset=utf-8');
require_once dirname(__FILE__).'/../auto_load.php';
// import("@.Model.MaterialClassDao");
// import("@.Model.MaterialCategoryDao");
// import("@.Model.MaterialrentDao");
// import("@.Model.MaterialDao");

class OperRentManageAction extends LoginAfterAction
{
    private $materialClassDao;
    
    private $materialCategoryDao;
    
    private $materialrentDao;
    
    private $materialDao;
    
   	private $projectResourceDao;
   
    private $enterpriseDao;

		private $materialcontractDao;
		private $materialcontractContentDao;
		private $materialEnquiryDao;
		
    public function _initialize()
    {
        parent::_initialize();
        $this->materialClassDao = new MaterialClassDao();
        $this->materialCategoryDao = new MaterialCategoryDao();
        $this->materialrentDao = new MaterialrentDao();
        $this->materialDao = new MaterialDao();
        $this->projectResourceDao = new ProjectResourceDao();
        $this->enterpriseDao = new EnterpriseDao();
        
        $this->materialcontractDao = new MaterialcontractDao();
        $this->materialcontractContentDao = new MaterialcontractContentDao();
        $this->materialEnquiryDao = new MaterialEnquiryDao();
    }
    
    
    public function rentMaterialMaintain()
    {
        // 权限检查
        $params = array();
        $params['result'] = false;
        $params['operationid'] = RENT_MAINTAIN;
        tag('behavior_authoritycheck', $params);
        if ($params['result'] == false) {
            $this->redirect('Staticpage/wrongalert', array(), 3, "您无此操作权限!");
            return;
        }
        
        // 分类，子分类
        $materialClassRowArray = $this->materialClassDao->findAll();
        foreach ($materialClassRowArray as $key => $value) {
            $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($value['classid']);
            $materialClassRowArray[$key]['materialCategoryRowArray'] = $materialCategoryRowArray;
        }
        // 材料实体
        $materialrentRowArray = $this->materialrentDao->findAll();
        foreach ($materialrentRowArray as $key => $value) {
            $materialCategoryRow = $this->materialCategoryDao->findById($value['categoryid']);
            $materialrentRowArray[$key]['materialCategoryRow'] = $materialCategoryRow;
        }
        $this->assign('materialClassRowArray', $materialClassRowArray);
        $this->assign('materialrentRowArray', $materialrentRowArray);
        $this->display('OperRentManage/rentMaterialMaintain');
        
        // $this->display('OperRentManage/rentMaterialMaintain');
    }

    public function materialMaintain_addClass()
    {
        $returnData = array();
        $returnData['name'] = $_POST['name'];
        $insertId = $this->materialClassDao->add($_POST['name']);
        $returnData['id'] = $insertId;
        echo json_encode($returnData);
    }

    public function materialMaintain_editClass()
    {
        $returnData = array();
        $returnData['name'] = $_POST['name'];
        $returnData['result'] = $this->materialClassDao->updateById($_POST['classid'], $_POST['name']);
        echo json_encode($returnData);
    }

    public function materialMaintain_deleteClass()
    {
        $classid = $_POST['classid'];
        $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($classid);
        if (count($materialCategoryRowArray) > 0) {
            $returnData = - 1; // 还有子元素，拒绝删除
            echo json_encode($returnData);
            return;
        }
        $returnData = $this->materialClassDao->deleteById($classid);
        echo json_encode($returnData);
    }

    public function materialMaintain_addCategory()
    {
        $returnData = array();
        $returnData['name'] = $_POST['name'];
        // $returnData['classid'] = $_POST['classid'];
        $insertId = $this->materialCategoryDao->add($_POST['classid'], $_POST['name']);
        $returnData['id'] = $insertId;
        echo json_encode($returnData);
    }

    public function materialMaintain_editCategory()
    {
        $returnData = array();
        $returnData['name'] = $_POST['name'];
        $materialCategoryRow = $this->materialCategoryDao->findById($_POST['categoryid']);
        $returnData['result'] = $this->materialCategoryDao->updateById($_POST['categoryid'], $materialCategoryRow['classid'], $_POST['name']);
        echo json_encode($returnData);
    }

    public function materialMaintain_deleteCategory()
    {
        $returnData = array();
        $categoryid = $_POST['categoryid'];
        $returnData['categoryid'] = $categoryid;
        $materialRowArray = $this->materialDao->findByCategoryid($categoryid);
        $materialrentRowArray = $this->materialrentDao->findByCategoryid($categoryid);
        if (count($materialRowArray) > 0 || count($materialrentRowArray) > 0) {
            $returnData['result'] = - 1;
            echo json_encode($returnData);
            return;
        }
        $result = $this->materialCategoryDao->deleteById($categoryid);
        $returnData['result'] = $result;
        echo json_encode($returnData);
    }

    public function materialMaintain_addMaterial()
    {
        $name = $_POST['name'];
        $categoryid = $_POST['categoryid'];
        $worktype = $_POST['worktype'];
        $unit = $_POST['unit'];
        $price_rent = $_POST['price_rent'];
        $parameter = $_POST['parameter'];
        $specification = $_POST['specification'];
        $brand = $_POST['brand'];
        $returnData = array();
        $insertId = $this->materialrentDao->add($name, $categoryid, $worktype, $unit, $price_rent, $parameter, $specification, $brand);
        $materialCategoryRow = $this->materialCategoryDao->findById($categoryid);
        $returnData['materialid'] = $insertId;
        $returnData['classid'] = $materialCategoryRow['classid'];
        $returnData['category_name'] = $materialCategoryRow['name'];
        echo json_encode($returnData);
    }

    public function materialMaintain_editMaterial()
    {
        $materialid = $_POST['id'];
        $name = $_POST['name'];
        $categoryid = $_POST['classid'];
        $worktype = $_POST['type'];
        $unit = $_POST['unit'];
        $price_rent = $_POST['price'];
        $parameter = $_POST['parameter'];
        $specification = $_POST['standard'];
        $brand = $_POST['brand'];
        $returnData = array();
        
        $returnData['materialid'] = $materialid;
        $returnData['name'] = $name;
        $returnData['categoryid'] = $categoryid;
        $returnData['worktype'] = $worktype;
        $returnData['unit'] = $unit;
        $returnData['price_rent'] = $price_rent;
        $returnData['parameter'] = $parameter;
        $returnData['specification'] = $specification;
        $returnData['brand'] = $brand;
        
        $result = $this->materialrentDao->updateById($materialid, $name, $categoryid, $worktype, $unit, $price_rent, $parameter, $specification, $brand);
        $returnData['result'] = $result;
        
        echo json_encode($returnData);
    }

    public function materialMaintain_deleteMaterial()
    {
        $materialid = $_POST['materialid'];
        $result = $this->materialrentDao->deleteById($materialid);
        echo json_encode($result);
    }

    public function rentMaterialEnquiry()
    {
        $this->display('OperRentManage/rentMaterialEnquiry');
    }

    public function getEnquiry()
    {}

    public function addEnquiry()
    {}

    public function updateEnquiry()
    {}

    public function deleteEnquiry()
    {}

    public function listRentContract()
    {
        $this->display('OperRentManage/listRentContract');
    }

    public function addRentContract()
    {
        $this->display('OperRentManage/addRentContract');
    }

    public function addRentContractSubmit()
    {}

    public function editRentContractSubmit()
    {}

    public function deleteRentContract()
    {}

    public function editContract_addContent()
    {}

    public function editContract_editContent()
    {}

    public function editContract_deleteContent()
    {}

    public function editContract_importEnquiryToContract()
    {}

    public function editContract_importPlanToContract()
    {}

    public function editContract_checkDocument()
    {}

    public function editContract_deletefileOrigin()
    {}

    public function editContract_editDocument()
    {}

    public function editContract_editDocumentOrigin()
    {}

    public function editContract_deletefile()
    {}

    public function listRentInOrder()
    {
        $this->display('OperRentManage/listRentInOrder');
    }

    public function addRentInOrder()
    {
        $this->display('OperRentManage/addRentInOrder');
    }

    public function addRentInOrderSubmit()
    {}

    public function editRentInOrder()
    {
        $this->display('OperRentManage/editRentInOrder');
    }

    public function editRentInOrderSubmit()
    {}

    public function deleteRentInOrder()
    {}

    public function listRentOutOrder()

    {
		// 分类，子分类
            $materialClassRowArray = $this->materialClassDao->findAll();
            foreach ($materialClassRowArray as $key => $value) {
                $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($value['classid']);
                $materialClassRowArray[$key]['materialCategoryRowArray'] = $materialCategoryRowArray;
            }
            // 材料实体
            $materialRowArray = $this->materialDao->findAll();
            foreach ($materialRowArray as $key => $value) {
                $materialCategoryRow = $this->materialCategoryDao->findById($value['categoryid']);
                $materialRowArray[$key]['materialCategoryRow'] = $materialCategoryRow;
            }
            $resourceRowArray = $this->projectResourceDao->findAll();
        		$this->assign('resourceRowArray', $resourceRowArray);
            $this->assign('materialClassRowArray', $materialClassRowArray);
            $this->assign('materialRowArray', $materialRowArray);
            
            $enterpriseRowArray = $this->enterpriseDao->findAll();
       			$this->assign('enterpriseRowArray', $enterpriseRowArray);
       			 
       			$contractRowArray = $this->materialcontractDao->findAll();
       	 		foreach ($contractRowArray as $key => $value) {
            		$supplier = $this->enterpriseDao->findById($value['supplier_enterpriseid']);
           			$contractRowArray[$key]['supplier'] = $supplier;
           			$contractContentRowArray = $this->materialcontractContentDao->findByContractid($value['contractid']);
           	 		$totalValue = 0;
		            foreach ($contractContentRowArray as $key2 => $value2) {
		                $material = $this->materialDao->findById($value2['material_id']);
		                $contractContentRowArray[$key2]['material'] = $material;
		                $enquiry = $this->materialEnquiryDao->findById($value2['enquiry_id']);
		                $contractContentRowArray[$key2]['enquiry'] = $enquiry;
		                $totalValue += $enquiry['enquiry_offer'] * $value2['amount'];
		            }
		            $contractRowArray[$key]['totalValue'] = $totalValue;
		            $contractRowArray[$key]['content'] = $contractContentRowArray;
		            $this->assign('contractRowArray', $contractRowArray);
        		}
        $this->display('OperRentManage/listRentOutOrder');
    }

    public function addRentOutOrder()
    {
    	  // 分类，子分类
            $materialClassRowArray = $this->materialClassDao->findAll();
            foreach ($materialClassRowArray as $key => $value) {
                $materialCategoryRowArray = $this->materialCategoryDao->findByClassid($value['classid']);
                $materialClassRowArray[$key]['materialCategoryRowArray'] = $materialCategoryRowArray;
            }
            // 材料实体
            $materialRowArray = $this->materialDao->findAll();
            foreach ($materialRowArray as $key => $value) {
                $materialCategoryRow = $this->materialCategoryDao->findById($value['categoryid']);
                $materialRowArray[$key]['materialCategoryRow'] = $materialCategoryRow;
            }
            $resourceRowArray = $this->projectResourceDao->findAll();
        		$this->assign('resourceRowArray', $resourceRowArray);
            $this->assign('materialClassRowArray', $materialClassRowArray);
            $this->assign('materialRowArray', $materialRowArray);
            
            $enterpriseRowArray = $this->enterpriseDao->findAll();
       			$this->assign('enterpriseRowArray', $enterpriseRowArray);
       			 
       			$contractRowArray = $this->materialcontractDao->findAll();
       	 		foreach ($contractRowArray as $key => $value) {
            		$supplier = $this->enterpriseDao->findById($value['supplier_enterpriseid']);
           			$contractRowArray[$key]['supplier'] = $supplier;
           			$contractContentRowArray = $this->materialcontractContentDao->findByContractid($value['contractid']);
           	 		$totalValue = 0;
		            foreach ($contractContentRowArray as $key2 => $value2) {
		                $material = $this->materialDao->findById($value2['material_id']);
		                $contractContentRowArray[$key2]['material'] = $material;
		                $enquiry = $this->materialEnquiryDao->findById($value2['enquiry_id']);
		                $contractContentRowArray[$key2]['enquiry'] = $enquiry;
		                $totalValue += $enquiry['enquiry_offer'] * $value2['amount'];
		            }
		            $contractRowArray[$key]['totalValue'] = $totalValue;
		            $contractRowArray[$key]['content'] = $contractContentRowArray;
		            $this->assign('contractRowArray', $contractRowArray);
        		}
       			 
            
      		  $this->display('OperRentManage/addRentOutOrders');
    }

    public function addRentOutOrderSubmit()
    {}

    public function editRentOutOrder()
    {
        $this->display('OperRentManage/editRentOutOrder');
    }

    public function editRentOutOrderSubmit()
    {}

    public function checkRentContractOrder()
    {
        // 租赁合同审核
    }

    public function uncheckRentContractOrder()
    {
        // 租赁合同取消审核
    }

    public function finalcostRentContract()
    {
        // 租赁合同结算
    }

    public function cancelfinalcostRentContract()
    {
        // 租赁合同取消结算
    }

    public function checkRentInOrder()
    {
        // 租赁租入单审核
    }

    public function uncheckRentInOrder()
    {
        // 租赁租入单取消审核
    }

    public function checkRentOutOrder()
    {
        // 租赁还租单审核
    }

    public function uncheckRentOutOrder()
    {
        // 租赁还租单取消审核
    }
}
?>
