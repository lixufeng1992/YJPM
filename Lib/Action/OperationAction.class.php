<?php
require_once dirname(__FILE__).'/../auto_load.php';

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
    $strRedirectUrl = $_GET['module'].'/'.$_GET['function'];
    $this->redirect($strRedirectUrl);
    return;
  }
}

?>
