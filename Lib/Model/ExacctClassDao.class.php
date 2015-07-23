<?php
	class ExacctClassDao extends Model{
		public function findAll(){
			
			$sql="select * from tb_exacctclass order by exacctclassid asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($id){
			
			$sql="select * from tb_exacctclass where exacctclassid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add($name){
			
			$sql="insert into tb_exacctclass(name) values(?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($name));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($id,$name){
			
			$sql="update tb_exacctclass set name=? where exacctclassid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($name,$id));		
		}

		public function deleteById($id){
			
			$sql="delete from tb_exacctclass where exacctclassid=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($id));		
		}

	}



?>
