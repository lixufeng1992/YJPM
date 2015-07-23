<?php
	class MaterialCategoryDao extends Model{
		public function findAll(){
			
			$sql="select * from tb_material_category order by categoryid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($categoryid){
			
			$sql="select * from tb_material_category where categoryid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($categoryid));
			return $statement->fetch();
		}

		public function findByClassid($classid){
			
			$sql="select * from tb_material_category where classid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($classid));
			return $statement->fetchAll();
		}

		public function add($classid,$name){
			
			$sql="insert into tb_material_category(classid,name) values(?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($classid,$name));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($categoryid,$classid,$name){
			
			$sql="update tb_material_category set classid=?,name=? where categoryid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($classid,$name,$categoryid));		
		}

		public function deleteById($categoryid){
			
			$sql="delete from tb_material_category where categoryid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($categoryid));		
		}

	}




?>