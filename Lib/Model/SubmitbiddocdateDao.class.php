<?php
	class SubmitbiddocdateDao extends Model{
		public function findAll(){
			
			$sql="select * from tb_submitbiddocdate order by submitbiddocdate_id asc";
			$statement = $this->commonPDO->query($sql);
			return $statement->fetchAll();
		}

		public function findByProjectid($projectid){
			
			$sql="select * from tb_submitbiddocdate where projectid=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($projectid));
			return $statement->fetch();
		}

		public function findById($submitbiddocdate_id){
			
			$sql="select * from tb_submitbiddocdate where submitbiddocdate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			$statement->execute(array($submitbiddocdate_id));
			return $statement->fetch();
		}

	public function add($projectid,$date,$preremind_days,$is_finished){
			
			$sql="insert into tb_submitbiddocdate(projectid,date,preremind_days,is_finished) values(?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($projectid,$date,$preremind_days,$is_finished));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}

		public function updateById($submitbiddocdate_id,$projectid,$date,$preremind_days,$is_finished){
			
			$sql="update tb_submitbiddocdate set projectid=?,date=?,preremind_days=?,is_finished=? where submitbiddocdate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($projectid,$date,$preremind_days,$is_finished,$submitbiddocdate_id));		
		}

		public function deleteById($submitbiddocdate_id){
			
			$sql="delete from tb_submitbiddocdate where submitbiddocdate_id=?";
			$statement = $this->commonPDO->prepare($sql);
			return $statement->execute(array($submitbiddocdate_id));		
		}

	}




?>