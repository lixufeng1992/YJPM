<?php
import("@.Model.CommonDao");
	class ClerkDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_clerk order by clerkid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findAll_name(){
			
			$sql="select name from tb_clerk order by clerkid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($clerkid){
			
			$sql="select * from tb_clerk where clerkid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($clerkid));
			return $statement->fetch();
		}

	}




?>