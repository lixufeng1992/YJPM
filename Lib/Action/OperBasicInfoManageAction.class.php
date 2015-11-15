<?PHP
require_once dirname(__FILE__).'/../auto_load.php';

header('Content-Type:text/html;charset=utf-8');

class OperBasicInfoManageAction extends LoginAfterAction{
  private $processClassifyDao;
  private $processDao;
  private $enterpriseDao;

  public function _initialize(){
    parent::_initialize();
    $this->processClassifyDao = new ProcessClassifyDao();
    $this->processDao = new ProcessDao();
    $this->enterpriseDao=new EnterpriseDao();
    $this->module = substr(__CLASS__, 0,strlen(__CLASS__)-6);//6:sizeof(Action)
  }
  // 项目管理==========================================================================

  // 项目部位维护
  public function listProcess(){
    //权限检查
    $operationname="部位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $processRowArray=$this->processDao->findAll();
    $processClassifyRowArray=$this->processClassifyDao->findAll();
    $this->assign('processRowArray',$processRowArray);
    $this->assign('processClassifyRowArray',$processClassifyRowArray);
    $this->display('OperBasicInfoManage/listProcess');
  }
  //项目部位分类
  public function addProcessClassify(){
    //权限检查
    $operationname="部位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $classify_name=$_POST['classify_name'];
    $classify_id=$this->processClassifyDao->add($classify_name);
    if($classify_id==-1){
      $this->display('Staticpage/wrongalert');
    }else $this->ajaxReturn($classify_id,"JSON");
  }

  public function updateProcessClassify(){
    //权限检查
    $operationname="部位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $classify_id=$_POST['classify_id'];
    $classify_name=$_POST['classify_name'];
    $this->processClassifyDao->updateById($classify_id,$classify_name);

  }

  public function deleteProcessClassify(){
    //权限检查
    $operationname="部位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $classify_id=$_POST['classify_id'];
    $this->processClassifyDao->deleteById($classify_id);
    $this->processDao->deleteByClassifyId($classify_id);
  }

  //项目部位
  public function addProcess(){
    //权限检查
    $operationname="部位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $classify_id=$_POST['classify_id'];
    $process_name=$_POST['process_name'];

    $process_id=$this->processDao->add($process_name,$classify_id);
    if($process_id==-1){
      $this->display('Staticpage/wrongalert');
    }else $this->ajaxReturn($process_id,"JSON");
  }

  public function updateProcess(){
    //权限检查
    $operationname="部位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $process_id=$_POST['process_id'];
    $process_name=$_POST['process_name'];
    $process_classify_id=$_POST['process_classify_id'];
    $this->processDao->updateById($process_id,$process_name,$process_classify_id);
  }

  public function deleteProcess(){
    //权限检查
    $operationname="部位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $process_id=$_POST['process_id'];
    $this->processDao->deleteById($process_id);
  }
  //项目管理==========================================================================

  //往来单位维护--------------------------------------------------------------------------------
  public function listEnterprise(){
    //权限检查
    $operationname="往来单位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $enterpriseRowArray = $this->enterpriseDao->findAll();
    $this->assign('enterpriseRowArray',$enterpriseRowArray);
    $this->display('OperBasicInfoManage/listEnterprise');
  }

  public function addEnterprise(){
    //权限检查
    $operationname="往来单位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $this->display('OperBasicInfoManage/addEnterprise');
  }

  public function addEnterpriseSubmit(){
    //权限检查
    $operationname="往来单位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_person = $_POST['contact_person'];
    $remark = $_POST['remark'];
    $phone_number = $_POST['phone_number'];
    $fax = $_POST['fax'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $credit_rank = $_POST['credit_rank'];
    $zip_number = $_POST['zip_number'];
    $legal_person = $_POST['legal_person'];
    $tax_number = $_POST['tax_number'];
    $service_zone = $_POST['service_zone'];
    $is_1part = $_POST['is_1part'];
    $is_divideman = $_POST['is_divideman'];
    $is_materialman = $_POST['is_materialman'];
    $is_machineman = $_POST['is_machineman'];
    $is_transman = $_POST['is_transman'];
    $is_client = $_POST['is_client'];
    $is_otherpart = $_POST['is_otherpart'];

    $insertid = $this->enterpriseDao->add($name,$address,$contact_person,$remark,$phone_number,$fax,$email,$website,$credit_rank,$zip_number,
      $legal_person,$tax_number,$service_zone,$is_1part,$is_divideman,$is_materialman,$is_machineman,$is_transman,$is_client,$is_otherpart);
    if($insertid <0)$this->display('Staticpage/wrongalert');
    else $this->redirect('OperBasicInfoManage/listEnterprise',array(),3,"添加往来单位成功...");
  }

  public function editEnterprise(){
    //权限检查
    $operationname="往来单位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $enterpriseid = $_GET['enterpriseid'];
    $enterpriseRow = $this->enterpriseDao->findById($enterpriseid);
    $this->assign('enterpriseRow',$enterpriseRow);
    $this->display('OperBasicInfoManage/editEnterprise');
  }

  public function editEnterpriseSubmit(){
    //权限检查
    $operationname="往来单位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $enterpriseid = $_POST['enterpriseid'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_person = $_POST['contact_person'];
    $remark = $_POST['remark'];
    $phone_number = $_POST['phone_number'];
    $fax = $_POST['fax'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $credit_rank = $_POST['credit_rank'];
    $zip_number = $_POST['zip_number'];
    $legal_person = $_POST['legal_person'];
    $tax_number = $_POST['tax_number'];
    $service_zone = $_POST['service_zone'];
    $is_1part = 0;if(isset($_POST['is_1part']))$is_1part = 1;
    $is_divideman = 0;if(isset($_POST['is_divideman']))$is_divideman = 1;
    $is_materialman = 0;if(isset($_POST['is_materialman']))$is_materialman = 1;
    $is_machineman = 0;if(isset($_POST['is_machineman']))$is_machineman = 1;
    $is_transman = 0;if(isset($_POST['is_transman']))$is_transman = 1;
    $is_client = 0;if(isset($_POST['is_client']))$is_client = 1;
    $is_otherpart = 0;if(isset($_POST['is_otherpart']))$is_otherpart = 1;

    $result = $this->enterpriseDao->updateById($enterpriseid,$name,$address,$contact_person,$remark,$phone_number,$fax,$email,$website,$credit_rank,
      $zip_number,$legal_person,$tax_number,$service_zone,$is_1part,$is_divideman,$is_materialman,$is_machineman,$is_transman,$is_client,
      $is_otherpart);
    if($result == false)$this->display('Staticpage/wrongalert');
    else $this->redirect('OperBasicInfoManage/listEnterprise',array(),3,"修改往来单位成功...");
  }

  public function deleteEnterprise(){
    //权限检查
    $operationname="往来单位维护";
    if($this->authoritycheck($this->module,$operationname)==false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $enterpriseid = $_GET['enterpriseid'];
    $result = $this->enterpriseDao->deleteById($enterpriseid);
    if($result == false)$this->display('Staticpage/wrongalert');
    else $this->redirect('OperBasicInfoManage/listEnterprise',array(),3,"删除往来单位成功...");
  }
  //往来单位维护================================================================================

  // 材料维护------------------------------------------------------------------------------------
    public function materialMaintain()
    {
        //权限检查
        $operationname="材料维护";
        if($this->authoritycheck($this->module,$operationname)==false){
          $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
          return;
        }
        
        if (isset($_POST['operation'])) {
            $result['name'] = '' . $_POST['name'] . 'succ';
            $result['id'] = 1;
            $this->ajaxReturn($result, "不能删除", true);
        } else {
            
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
            $this->assign('materialClassRowArray', $materialClassRowArray);
            $this->assign('materialRowArray', $materialRowArray);
            $this->display('OperBasicInfoManage/materialMaintain');
        }
    }

    public function materialMaintain_addClass()
    {
        //权限检查
        $operationname="材料维护";
        if($this->authoritycheck($this->module,$operationname)==false){
          $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
          return;
        }
        $returnData = array();
        $returnData['name'] = $_POST['name'];
        $insertId = $this->materialClassDao->add($_POST['name']);
        $returnData['id'] = $insertId;
        echo json_encode($returnData);
    }

    public function materialMaintain_deleteClass()
    {
        //权限检查
        $operationname="材料维护";
        if($this->authoritycheck($this->module,$operationname)==false){
          $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
          return;
        }
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

    public function materialMaintain_editClass()
    {
        //权限检查
        $operationname="材料维护";
        if($this->authoritycheck($this->module,$operationname)==false){
          $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
          return;
        }
        $returnData = array();
        // $returnData['classid'] = $_POST['classid'];
        $returnData['name'] = $_POST['name'];
        $returnData['result'] = $this->materialClassDao->updateById($_POST['classid'], $_POST['name']);
        echo json_encode($returnData);
    }

    public function materialMaintain_addCategory()
    {
        //权限检查
        $operationname="材料维护";
        if($this->authoritycheck($this->module,$operationname)==false){
          $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
          return;
        }
        $returnData = array();
        $returnData['name'] = $_POST['name'];
        // $returnData['classid'] = $_POST['classid'];
        $insertId = $this->materialCategoryDao->add($_POST['classid'], $_POST['name']);
        $returnData['id'] = $insertId;
        echo json_encode($returnData);
    }

    public function materialMaintain_deleteCategory()
    {
        //权限检查
        $operationname="材料维护";
        if($this->authoritycheck($this->module,$operationname)==false){
          $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
          return;
        }
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

    public function materialMaintain_editCategory()
    {
        //权限检查
        $operationname="材料维护";
        if($this->authoritycheck($this->module,$operationname)==false){
          $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
          return;
        }
        $returnData = array();
        // $returnData['categoryid'] = $_POST['categoryid'];
        $returnData['name'] = $_POST['name'];
        $materialCategoryRow = $this->materialCategoryDao->findById($_POST['categoryid']);
        $returnData['result'] = $this->materialCategoryDao->updateById($_POST['categoryid'], $materialCategoryRow['classid'], $_POST['name']);
        echo json_encode($returnData);
    }

    public function materialMaintain_addMaterial()
    {
        //权限检查
        $operationname="材料维护";
        if($this->authoritycheck($this->module,$operationname)==false){
          $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
          return;
        }
        $name = $_POST['name'];
        $categoryid = $_POST['categoryid'];
        $worktype = $_POST['worktype'];
        $unit = $_POST['unit'];
        $price_in = $_POST['price_in'];
        $parameter = $_POST['parameter'];
        $specification = $_POST['specification'];
        $brand = $_POST['brand'];
        $returnData = array();
        $insertId = $this->materialDao->add($name, $categoryid, $worktype, $unit, $price_in, $parameter, $specification, $brand);
        $materialCategoryRow = $this->materialCategoryDao->findById($categoryid);
        $returnData['materialid'] = $insertId;
        $returnData['classid'] = $materialCategoryRow['classid'];
        $returnData['category_name'] = $materialCategoryRow['name'];
        echo json_encode($returnData);
    }

    public function materialMaintain_deleteMaterial()
    {
        //权限检查
        $operationname="材料维护";
        if($this->authoritycheck($this->module,$operationname)==false){
          $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
          return;
        }
        $materialid = $_POST['materialid'];
        $result = $this->materialDao->deleteById($materialid);
        echo json_encode($result);
    }

    public function materialMaintain_editMaterial()
    {
        //权限检查
        $operationname="材料维护";
        if($this->authoritycheck($this->module,$operationname)==false){
          $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
          return;
        }
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
        
        $result = $this->materialDao->updateById($materialid, $name, $categoryid, $worktype, $unit, $price_in, $parameter, $specification, $brand);
        $returnData['result'] = $result;
        // $materialid = $_POST['materialid'];
        // $result = $this->materialDao->deleteById($materialid);
        echo json_encode($returnData);
    }
    // 材料维护================================================================================


}
?>
