<?php
import("@.Model.CommonDao");
	class ControlSettingDao extends CommonDao{
		public function add($resource_id,$refuse_buyingplan_nobudget,$refuse_buyingplan_excessbudget,
											$refuse_materialbuying_nobudget,$refuse_materialbuying_excessbudget,$refuse_materialout_nobudget,$refuse_materialout_excessbudget,
											$refuse_materialallocate_nobudget,$refuse_materialallocate_excessbudget,$refuse_otherin_nobudget,$refuse_otherin_excessbudget){
											
			
			$sql="insert into tb_pr_controlsetting(resource_id,refuse_buyingplan_nobudget,refuse_buyingplan_excessbudget,
											refuse_materialbuying_nobudget,refuse_materialbuying_excessbudget,refuse_materialout_nobudget,refuse_materialout_excessbudget,
											refuse_materialallocate_nobudget,refuse_materialallocate_excessbudget,refuse_otherin_nobudget,refuse_otherin_excessbudget) values(?,?,?,?,?,?,?,?,?,?,?)";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($resource_id,$refuse_buyingplan_nobudget,$refuse_buyingplan_excessbudget,
											$refuse_materialbuying_nobudget,$refuse_materialbuying_excessbudget,$refuse_materialout_nobudget,$refuse_materialout_excessbudget,
											$refuse_materialallocate_nobudget,$refuse_materialallocate_excessbudget,$refuse_otherin_nobudget,$refuse_otherin_excessbudget));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();
		}
		
		public function updateById($exist_id,$refuse_buyingplan_nobudget,$refuse_buyingplan_excessbudget,
											$refuse_materialbuying_nobudget,$refuse_materialbuying_excessbudget,$refuse_materialout_nobudget,$refuse_materialout_excessbudget,
											$refuse_materialallocate_nobudget,$refuse_materialallocate_excessbudget,$refuse_otherin_nobudget,$refuse_otherin_excessbudget){
			
			$sql="update tb_pr_controlsetting set refuse_buyingplan_nobudget=?,refuse_buyingplan_excessbudget=?,
											refuse_materialbuying_nobudget=?,refuse_materialbuying_excessbudget=?,refuse_materialout_nobudget=?,refuse_materialout_excessbudget=?,
											refuse_materialallocate_nobudget=?,refuse_materialallocate_excessbudget=?,refuse_otherin_nobudget=?,refuse_otherin_excessbudget=? where controlsetting_id=?";
			$statement=$this->commonPDO->prepare($sql);
			$result=$statement->execute(array($refuse_buyingplan_nobudget,$refuse_buyingplan_excessbudget,
											$refuse_materialbuying_nobudget,$refuse_materialbuying_excessbudget,$refuse_materialout_nobudget,$refuse_materialout_excessbudget,
											$refuse_materialallocate_nobudget,$refuse_materialallocate_excessbudget,$refuse_otherin_nobudget,$refuse_otherin_excessbudget,$exist_id));
			if($result == false)return -1;
			else return $this->commonPDO->lastInsertId();								
		}
		
		public function findExistId($resource_id){
			
			$sql="select controlsetting_id from tb_pr_controlsetting where resource_id=?";
			$statement=$this->commonPDO->prepare($sql);
			$statement->execute(array($resource_id));
			return $statement->fetch();	
		}
		
		public function findByResourceId($resource_id){
			
			$sql="select * from tb_pr_controlsetting where resource_id=?";
			$statement=$this->commonPDO->prepare($sql);
			$statement->execute(array($resource_id));
			$result=$statement->fetch();
			return $result;
		}
		
		public function deleteByResourceId($resource_id){
			
			$sql="delete from tb_pr_controlsetting where resource_id=?";
			$statement = $this->commonPDO->prepare($sql);
			$result = $statement->execute(array($resource_id));
		}
	}
?>