<?php
	class (tbname)Dao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_(tbname) order by (tbname)id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findById($id){
			
			$sql="select * from tb_(tbname) where (tbname)id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add(...){
			
			$sql="insert into tb_(tbname)(...) values(...)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array(...));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($id,...){
			
			$sql="update tb_(tbname) set ...=?,...=? where (tbname)id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array(...,$id));		
		}

		public function deleteById($id){
			
			$sql="delete from tb_(tbname) where (tbname)id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($id));		
		}

	}



?>
