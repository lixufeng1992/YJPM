<?php

class MaterialcontractDao extends CommonDao
{

    public function findAll()
    {
        $sql = "select * from tb_materialcontract order by contractid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($contractid)
    {
        $sql = "select * from tb_materialcontract where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $contractid
        ));
        return $statement->fetch();
    }

    public function findByResourceid($resource_id)
    {
        $sql = "select * from tb_materialcontract where resource_id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $resource_id
        ));
        return $statement->fetchAll();
    }

    public function add($resource_id, $contract_number, $name, $a_part_enterpriseid, $supplier_enterpriseid, $duty_officer, $companyid, $departmentid, $build_pattern, $sign_date, $pay_baseprice_according, $margin_amount, $pay_limit, $check_grossamount_control, $main_content, $other_limit_condition, $remark, $finalcost_userid, $check_userid, $create_userid, $create_date)
    {
        $sql = "insert into tb_materialcontract(resource_id,contract_number,name,a_part_enterpriseid,supplier_enterpriseid,
							duty_officer,companyid,departmentid,build_pattern,sign_date,
							pay_baseprice_according,margin_amount,pay_limit,check_grossamount_control,main_content,
							other_limit_condition,remark,finalcost_userid,check_userid,create_userid,
							create_date) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $resource_id,
            $contract_number,
            $name,
            $a_part_enterpriseid,
            $supplier_enterpriseid,
            $duty_officer,
            $companyid,
            $departmentid,
            $build_pattern,
            $sign_date,
            $pay_baseprice_according,
            $margin_amount,
            $pay_limit,
            $check_grossamount_control,
            $main_content,
            $other_limit_condition,
            $remark,
            $finalcost_userid,
            $check_userid,
            $create_userid,
            $create_date
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($contractid, $resource_id, $contract_number, $name, $a_part_enterpriseid, $supplier_enterpriseid, $duty_officer, $companyid, $departmentid, $build_pattern, $sign_date, $pay_baseprice_according, $margin_amount, $pay_limit, $check_grossamount_control, $main_content, $other_limit_condition, $remark, $finalcost_userid, $check_userid, $create_userid, $create_date)
    {
        $sql = "update tb_materialcontract set resource_id=?,contract_number=?,name=?,a_part_enterpriseid=?,supplier_enterpriseid=?,
							duty_officer=?,companyid=?,departmentid=?,build_pattern=?,sign_date=?,
							pay_baseprice_according=?,margin_amount=?,pay_limit=?,check_grossamount_control=?,main_content=?,
							other_limit_condition=?,remark=?,finalcost_userid=?,check_userid=?,create_userid=?,
							create_date=? where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $resource_id,
            $contract_number,
            $name,
            $a_part_enterpriseid,
            $supplier_enterpriseid,
            $duty_officer,
            $companyid,
            $departmentid,
            $build_pattern,
            $sign_date,
            $pay_baseprice_according,
            $margin_amount,
            $pay_limit,
            $check_grossamount_control,
            $main_content,
            $other_limit_condition,
            $remark,
            $finalcost_userid,
            $check_userid,
            $create_userid,
            $create_date,
            $contractid
        ));
    }

    public function updateCheckstatusById($contractid, $check_userid)
    {
        $sql = "update tb_materialcontract set check_userid=? where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $check_userid,
            $contractid
        ));
    }

    public function updateFinalcoststatusById($contractid, $finalcost_userid)
    {
        $sql = "update tb_materialcontract set finalcost_userid=? where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $finalcost_userid,
            $contractid
        ));
    }

    public function deleteById($contractid)
    {
        $sql = "delete from tb_materialcontract where contractid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $contractid
        ));
    }
}

?>