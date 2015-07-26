<?php
    class MaterialPurchasePlanOrderDetailsDao extends CommonDao{
        public function findAll(){
           
            $sql="select * from tb_mpp_order_details order by detail_id asc";
            $statement = $this->commonPDO->query($sql);
            return $statement->fetchAll();
        }

        public function findById($detail_id){
          
            $sql="select * from tb_mpp_order_details where detail_id = ?";
            $statement = $this->commonPDO->prepare($sql);
            $statement->execute(array($detail_id));
            return $statement->fetch();   
        }

        public function add($plan_id,$material_id,$enquiry_id,$enquiry_offer,$count,$remark){
          
            $sql="insert into tb_mpp_order_details(plan_id,material_id,enquiry_id,enquiry_offer,count,remark) values(?,?,?,?,?,?)";
            $statement = $this->commonPDO->prepare($sql);
            $result = $statement->execute(array($plan_id,$material_id,$enquiry_id,$enquiry_offer,$count,$remark));
            if($result == false) return -1;
            else return $this->commonPDO->lastInsertId();
        }

        public function findByPlanId($plan_id){
           
            $sql="select * from tb_mpp_order_details where plan_id=?";
            $statement = $this->commonPDO->prepare($sql);
            $statement->execute(array($plan_id));
            return $statement->fetchAll();
        }

        public function deleteByPlanId($plan_id){
          
            $sql="delete from tb_mpp_order_details where plan_id=?";
            $statement = $this->commonPDO->prepare($sql);
            $statement->execute(array($plan_id));
        }
    }
    
?>
