<?php
	class DepartmentDao extends Model{
		public function findAll(){
			
			$sql="select * from tb_department order by departmentid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($departmentid){
			
			$sql="select * from tb_department where departmentid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($departmentid));
			return $statement->fetch();
		}

		public function add($name){
			
			$sql="insert into tb_department(name) values(?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($name));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($departmentid,$name){
			
			$sql="update tb_department set name=? where departmentid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($name,$departmentid));		
		}

		public function deleteById($departmentid){
			
			$sql="delete from tb_department where departmentid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($departmentid));		
		}

	}




?>