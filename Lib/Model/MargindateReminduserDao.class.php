<?php
	class MargindateReminduserDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_margindate_reminduser order by id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByMargindateid($margindate_id){
			
			$sql="select * from tb_margindate_reminduser where margindate_id=? order by id asc";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($margindate_id));
			return $statement->fetchAll();
		}

		public function findById($id){
			
			$sql="select * from tb_margindate_reminduser where id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add($margindate_id,$userid){
			
			$sql="insert into tb_margindate_reminduser(margindate_id,userid) values(?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($margindate_id,$userid));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		

		public function deleteById($id){
			
			$sql="delete from tb_margindate_reminduser where id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($id));		
		}

	}




?>