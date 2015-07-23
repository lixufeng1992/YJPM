<?php
	class TestDao extends Model{
		public function add($isit){
			
			$sql="insert into tb_test(isit) values(?)";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($isit));
		}

	}




?>