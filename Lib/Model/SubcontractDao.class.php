<?php
import("@.Model.CommonDao");
class SubcontractDao extends CommonDao
{

    public function findAll()
    {
        $sql = "select * from tb_subcontract order by contractid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($contractid)
    {
        $sql = "select * from tb_subcontract where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $contractid
        ));
        return $statement->fetch();
    }

    public function findByResourceid($resource_id)
    {
        $sql = "select * from tb_subcontract where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $resource_id
        ));
        return $statement->fetchAll();
    }

    public function add($resource_id, $contract_number, $name, $contract_type, $a_part_enterpriseid, $b_part_enterpriseid, $build_pattern, $contract_status, $construction_start_date, $construction_finish_date, $sign_date, $report_price, $pay_baseprice_according, $margin_amount, $pay_limit, $check_grossamount_control, $main_content, $other_limit_condition, $create_userid, $create_date, $finalcost_userid, $check_userid, $remark)
    {
        
        $sql = "insert into tb_subcontract(
				resource_id,contract_number,name,contract_type,a_part_enterpriseid,
				b_part_enterpriseid,build_pattern,contract_status,construction_start_date,construction_finish_date,
				sign_date,report_price,pay_baseprice_according,margin_amount,pay_limit,
				check_grossamount_control,main_content,other_limit_condition,create_userid,create_date,
				finalcost_userid,check_userid,remark
				) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_id,
            $contract_number,
            $name,
            $contract_type,
            $a_part_enterpriseid,
            $b_part_enterpriseid,
            $build_pattern,
            $contract_status,
            $construction_start_date,
            $construction_finish_date,
            $sign_date,
            $report_price,
            $pay_baseprice_according,
            $margin_amount,
            $pay_limit,
            $check_grossamount_control,
            $main_content,
            $other_limit_condition,
            $create_userid,
            $create_date,
            $finalcost_userid,
            $check_userid,
            $remark
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($contractid, $resource_id, $contract_number, $name, $contract_type, $a_part_enterpriseid, $b_part_enterpriseid, $build_pattern, $contract_status, $construction_start_date, $construction_finish_date, $sign_date, $report_price, $pay_baseprice_according, $margin_amount, $pay_limit, $check_grossamount_control, $main_content, $other_limit_condition, $create_userid, $create_date, $finalcost_userid, $check_userid, $remark)
    {
       
        $sql = "update tb_subcontract set resource_id=?,contract_number=?,name=?,contract_type=?,a_part_enterpriseid=?,
			b_part_enterpriseid=?,build_pattern=?,contract_status=?,construction_start_date=?,construction_finish_date=?,
			sign_date=?,report_price=?,pay_baseprice_according=?,margin_amount=?,pay_limit=?,
			check_grossamount_control=?,main_content=?,other_limit_condition=?,create_userid=?,create_date=?,
			finalcost_userid=?,check_userid=?,remark=? where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $resource_id,
            $contract_number,
            $name,
            $contract_type,
            $a_part_enterpriseid,
            $b_part_enterpriseid,
            $build_pattern,
            $contract_status,
            $construction_start_date,
            $construction_finish_date,
            $sign_date,
            $report_price,
            $pay_baseprice_according,
            $margin_amount,
            $pay_limit,
            $check_grossamount_control,
            $main_content,
            $other_limit_condition,
            $create_userid,
            $create_date,
            $finalcost_userid,
            $check_userid,
            $remark,
            $contractid
        ));
    }

    public function updateCheckstatusById($contractid, $check_userid)
    {
        
        $sql = "update tb_subcontract set check_userid=? where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $check_userid,
            $contractid
        ));
    }

    public function updateFinalcoststatusById($contractid, $finalcost_userid)
    {
       
        $sql = "update tb_subcontract set finalcost_userid=? where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $finalcost_userid,
            $contractid
        ));
    }

    public function deleteById($contractid)
    {
       
        $sql = "delete from tb_subcontract where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $contractid
        ));
    }
}

?>