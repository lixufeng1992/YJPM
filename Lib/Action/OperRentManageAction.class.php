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

  public function listRentMaterialInOrder() {
    $this->display('OperRentManage/listRentInOrder');
  }

  public function addRentInOrder() {
    $this->display('OperRentManage/addRentInOrder');
  }

  public function addRentInOrderSubmit() {}

  public function editRentInOrderSubmit() {}

  public function deleteRentInOrder() {}

  public function listRentMaterialOutOrder() {
    $this->display('OperRentManage/listRentOutOrder');
  }
}
?>
