<?php
import("@.Model.CommonDao");
	class OperationDao extends CommonDao{

		public function findById($operationid){
			
			$sql="select * from tb_operation where operationid= ?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($operationid));
			return $statement->fetch();
		}
		public function findAll(){
			
			$sql="select * from tb_operation order by operationid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();	
		}

	}

?>