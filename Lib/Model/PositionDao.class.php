<?php
	class PositionDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_position order by positionid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function add($name){
			
			$sql="insert into tb_position(name) values(?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($name));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($positionid,$name){
			
			$sql="update tb_position set name=? where positionid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($name,$positionid));		
		}

		public function deleteById($positionid){
			
			$sql="delete from tb_position where positionid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($positionid));		
		}






	}




?>