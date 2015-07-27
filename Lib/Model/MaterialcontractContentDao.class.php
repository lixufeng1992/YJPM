<?php
import("@.Model.CommonDao");
	class MaterialcontractContentDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_materialcontract_content order by contentid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($contentid){
			
			$sql="select * from tb_materialcontract_content where contentid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($contentid));
			return $statement->fetch();
		}

		public function findByContractid($contractid){
			
			$sql="select * from tb_materialcontract_content where contractid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($contractid));
			return $statement->fetchAll();
		}

		public function add($contractid,$material_id,$enquiry_id,$amount,$remark,$plan_id){
			
			$sql="insert into tb_materialcontract_content (contractid,material_id,enquiry_id,amount,remark,plan_id) values(?,?,?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($contractid,$material_id,$enquiry_id,$amount,$remark,$plan_id));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($contentid,$contractid,$material_id,$enquiry_id,$amount,$remark,$plan_id){
			
			$sql="update tb_materialcontract_content set contractid=?,material_id=?,enquiry_id=?,amount=?,remark=?,plan_id=? where contentid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($contractid,$material_id,$enquiry_id,$amount,$remark,$plan_id,$contentid));		
		}

		public function deleteById($contentid){
			
			$sql="delete from tb_materialcontract_content where contentid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($contentid));		
		}

	}




?>