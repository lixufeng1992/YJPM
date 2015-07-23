<?php
	class MaterialClassDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_material_class order by classid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($classid){
			
			$sql="select * from tb_material_class where classid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($classid));
			return $statement->fetch();
		}

		public function add($name){
			
			$sql="insert into tb_material_class(name) values(?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($name));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($classid,$name){
			
			$sql="update tb_material_class set name=? where classid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($name,$classid));		
		}

		public function deleteById($classid){
			
			$sql="delete from tb_material_class where classid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($classid));		
		}

	}




?>