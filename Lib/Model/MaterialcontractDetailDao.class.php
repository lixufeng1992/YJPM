<?php
    class MaterialContractDetailDao extends Model{
        public function findAll(){
           
            $sql="select * from tb_materialcontract_detail order by detail_id asc";
            $statement = $this->commonPDO->query($sql);
            return $statement->fetchAll();
        }

        public function add($contractid,$material_id,$enquiry_id,$enquiry_offer,$count,$remark,$plan_id,$warehouseid,$warehouseworkerid){
           
            $sql="insert into tb_materialcontract_detail(contractid,material_id,enquiry_id,enquiry_offer,count,remark,plan_id,warehouseid,warehouseworkerid) values(?,?,?,?,?,?,?,?)";
            $statement = $this->commonPDO->prepare($sql);
            $result = $statement->execute(array($contractid,$material_id,$enquiry_id,$enquiry_offer,$count,$remark,$plan_id,$warehouseid,$warehouseworkerid));
            if($result == false) return -1;
            else return $this->commonPDO->lastInsertId();
        }

        public function findByPlanId($plan_id){
           
            $sql="select * from tb_materialcontract_detail where plan_id=?";
            $statement = $this->commonPDO->prepare($sql);
            $statement->execute(array($plan_id));
            return $statement->fetchAll();
        }

        public function findByContractid($contractid){
            
            $sql="select * from tb_materialcontract_detail where contractid=?";
            $statement = $this->commonPDO->prepare($sql);
            $statement->execute(array($contractid));
            return $statement->fetchAll();
        }

        public function deleteByPlanId($plan_id){
           
            $sql="delete from tb_materialcontract_detail where plan_id=?";
            $statement = $this->commonPDO->prepare($sql);
            $statement->execute(array($plan_id));
        }
    }
    
?>
