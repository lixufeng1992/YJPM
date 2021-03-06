<?php
import("@.Model.CommonDao");
	class BiddateReminduserDao extends CommonDao{
		public function findAll(){
			
			$sql="select * from tb_biddate_reminduser order by id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByBiddateid($biddate_id){
			
			$sql="select * from tb_biddate_reminduser where biddate_id=? order by id asc";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($biddate_id));
			return $statement->fetchAll();
		}

		public function findById($id){
			
			$sql="select * from tb_biddate_reminduser where id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($id));
			return $statement->fetch();
		}

		public function add($biddate_id,$userid){
			
			$sql="insert into tb_biddate_reminduser(biddate_id,userid) values(?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($biddate_id,$userid));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function deleteById($id){
			
			$sql="delete from tb_biddate_reminduser where id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($id));		
		}

	}




?>