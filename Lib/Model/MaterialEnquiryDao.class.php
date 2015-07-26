<?php
class MaterialEnquiryDao extends CommonDao{
    public function findAll(){
       
        $sql="select * from tb_material_enquiry order by enquiry_id asc";
        $statement=$this->commonPDO->query($sql);
        return $statement->fetchAll();
    }
    
    public function findById($enquiry_id){
		
		$sql="select * from tb_material_enquiry where enquiry_id=?";
		$statement = $this->commonPDO->prepare($sql);
		$statement->execute(array($enquiry_id));
		return $statement->fetch();
	}

    public function add($enterprise_id,$enquiry_offer,$offer_date,$material_id){
       
	$sql="insert into tb_material_enquiry(enterprise_id,enquiry_offer,enquiry_offerdate,material_id) values(?,?,?,?)";
	$statement = $this->commonPDO->prepare($sql);
	$result = $statement->execute(array($enterprise_id,$enquiry_offer,$offer_date,$material_id));
	if($result == false)return -1;
	else return $this->commonPDO->lastInsertId();
    }
	public function findByMaterialId($material_id){
		
		$sql="select * from tb_material_enquiry where material_id=?";
		$statement = $this->commonPDO->prepare($sql);
		$statement->execute(array($material_id));
		return $statement->fetchAll();
	}
	public function deleteById($enquiry_id){
		
		$sql="delete from tb_material_enquiry where enquiry_id=?";
		$statement = $this->commonPDO->prepare($sql);
		return $statement->execute(array($enquiry_id));
        }

	public function updateById($enquiry_id,$enterprise_id,$enquiry_offer,$offer_date){
	
		$sql="update tb_material_enquiry set enterprise_id=?,enquiry_offer=?,enquiry_offerdate=? where enquiry_id=?";
		$statement = $this->commonPDO->prepare($sql);
		$result = $statement->execute(array($enterprise_id,$enquiry_offer,$offer_date,$enquiry_id));
	}
}
?>
