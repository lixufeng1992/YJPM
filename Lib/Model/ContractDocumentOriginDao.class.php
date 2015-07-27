<?php
import("@.Model.CommonDao");
	class ContractDocumentOriginDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_contract_document_origin order by documentid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($documentid){
			
			$sql="select * from tb_contract_document_origin where documentid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($documentid));
			return $statement->fetch();
		}

		public function findByContractid($contractid){
			
			$sql="select * from tb_contract_document_origin where contractid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($contractid));
			return $statement->fetchAll();
		}

		public function add($contractid,$name,$path,$remark){
			
			$sql="insert into tb_contract_document_origin(contractid,name,path,remark) values(?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($contractid,$name,$path,$remark));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($documentid,$contractid,$name,$path,$remark){
			
			$sql="update tb_contract_document_origin set contractid=?,name=?,path=?,remark=? where documentid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($contractid,$name,$path,$remark,$documentid));		
		}

		public function deleteById($documentid){
			
			$sql="delete from tb_contract_document_origin where documentid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($documentid));		
		}

	}




?>