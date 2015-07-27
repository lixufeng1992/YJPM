<?php
import("@.Model.CommonDao");
	class companyDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_company order by companyid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($companyid){
			
			$sql="select * from tb_company where companyid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($companyid));
			return $statement->fetch();
		}

		public function add($name){
			
			$sql="insert into tb_company(name) values(?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($name));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($companyid,$name){
			
			$sql="update tb_company set name=? where companyid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($name,$companyid));		
		}

		public function deleteById($companyid){
			
			$sql="delete from tb_company where companyid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($companyid));		
		}

	}



?>
