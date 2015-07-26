<?php
header('Content-Type:text/html;charset=utf-8');

class OperRentManageAction extends LoginAfterAction{

  public function rentMaterialMaintain() {
    $this->display('OperRentManage/rentMaterialMaintain');
  }

  public function materialMaintain_addClass() {}

  public function materialMaintain_editClass() {}

  public function materialMaintain_deleteClass() {}


  public function materialMaintain_addCategory() {}

  public function materialMaintain_editCategory() {}

  public function materialMaintain_deleteCategory() {}


  public function materialMaintain_addMaterial() {}

  public function materialMaintain_editMaterial() {}

  public function materialMaintain_deleteMaterial() {}

  public function rentMaterialEnquiry() {
    $this->display('OperRentManage/rentMaterialEnquiry');
  }

  public function getEnquiry() {}

  public function addEnquiry() {}

  public function updateEnquiry() {}

  public function deleteEnquiry() {}

  public function listRentContract() {
    $this->display('OperRentManage/listRentContract');
  }

  public function addRentContract() {
    $this->display('OperRentManage/addRentContract');
  }

  public function addRentContractSubmit() {}

  public function editRentContractSubmit() {}

  public function deleteRentContract() {}

  public function editContract_addContent() {}

  public function editContract_editContent() {}

  public function editContract_deleteContent() {}

  public function editContract_importEnquiryToContract() {}

  public function editContract_importPlanToContract() {}

  public function editContract_checkDocument() {}

  public function editContract_deletefileOrigin() {}

  public function editContract_editDocument() {}

  public function editContract_editDocumentOrigin() {}

  public function editContract_deletefile() {}

  public function listRentInOrder() {
    $this->display('OperRentManage/listRentInOrder');
  }

  public function addRentInOrder() {
    $this->display('OperRentManage/addRentInOrder');
  }

  public function addRentInOrderSubmit() {}

  public function editRentInOrder() {
    $this->display('OperRentManage/editRentInOrder');
  }

  public function editRentInOrderSubmit() {}

  public function deleteRentInOrder() {}

  public function listRentOutOrder() {
    $this->display('OperRentManage/listRentOutOrder');
  }

  public function addRentOutOrder() {
    $this->display('OperRentManage/addRentOutOrder');
  }

  public function addRentOutOrderSubmit() {}

  public function editRentOutOrder() {
    $this->display('OperRentManage/editRentOutOrder');
  }

  public function editRentOutOrderSubmit() {}

  public function checkRentContractOrder() {
    // 租赁合同审核
  }

  public function uncheckRentContractOrder() {
    // 租赁合同取消审核
  }

  public function finalcostRentContract() {
    // 租赁合同结算
  }

  public function cancelfinalcostRentContract() {
    // 租赁合同取消结算
  }

  public function checkRentInOrder() {
    // 租赁租入单审核
  }

  public function uncheckRentInOrder() {
    // 租赁租入单取消审核
  }

  public function checkRentOutOrder() {
    // 租赁还租单审核
  }

  public function uncheckRentOutOrder() {
    // 租赁还租单取消审核
  }
}
?>
