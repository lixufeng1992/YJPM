<?PHP
import("@.Model.ProcessClassifyDao");
import("@.Model.ProcessDao");

header('Content-Type:text/html;charset=utf-8');

class OperBasicInfoManageAction extends LoginAfterAction{
  private $processClassifyDao;
  private $processDao;

  public function _initialize(){
    parent::_initialize();
    $this->processClassifyDao = new ProcessClassifyDao();
    $this->processDao = new ProcessDao();
  }
  //项目管理========================================================================== 
  public function listProcess(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROCESS_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
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
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROCESS_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
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
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROCESS_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $classify_id=$_POST['classify_id'];
    $classify_name=$_POST['classify_name'];
    $this->processClassifyDao->updateById($classify_id,$classify_name);

  }

  public function deleteProcessClassify(){
    //权限检查
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROCESS_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
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
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROCESS_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
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
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROCESS_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
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
    $params = array();
    $params['result'] = false;
    $params['operationid'] = PROCESS_MAINTAIN;
    tag('behavior_authoritycheck',$params);
    if($params['result'] == false){
      $this->redirect('Staticpage/wrongalert',array(),3,"您无此操作权限!");
      return;
    }

    $process_id=$_POST['process_id'];
    $this->processDao->deleteById($process_id);
  }
  //项目管理========================================================================== 



}
?>
