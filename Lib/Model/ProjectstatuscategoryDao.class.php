<?php
import("@.Model.CommonDao");
	class ProjectstatuscategoryDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_projectstatuscategory order by categoryid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($categoryid){
			
			$sql="select * from tb_projectstatuscategory where categoryid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($categoryid));
			return $statement->fetch();
		}

	

	}




?>