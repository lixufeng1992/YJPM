<?php
import("@.Model.CommonDao");
	class ContractDocumentDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_contract_document order by documentid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($documentid){
			
			$sql="select * from tb_contract_document where documentid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($documentid));
			return $statement->fetch();
		}

		public function findByContractid($contractid){
			
			$sql="select * from tb_contract_document where contractid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($contractid));
			return $statement->fetchAll();
		}

		public function add($contractid,$name,$path,$remark,$create_userid,$lastupdate_userid,$checked_userid){
			
			$sql="insert into tb_contract_document(contractid,name,path,remark,create_userid,lastupdate_userid,checked_userid) values(?,?,?,?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($contractid,$name,$path,$remark,$create_userid,$lastupdate_userid,$checked_userid));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($documentid,$contractid,$name,$path,$remark,$create_userid,$lastupdate_userid,$checked_userid){
			
			$sql="update tb_contract_document set contractid=?,name=?,path=?,remark=?,create_userid=?,lastupdate_userid=?,checked_userid=? where documentid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($contractid,$name,$path,$remark,$create_userid,$lastupdate_userid,$checked_userid,$documentid));		
		}

		public function deleteById($documentid){
			
			$sql="delete from tb_contract_document where documentid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($documentid));		
		}

	}




?>