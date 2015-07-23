<?php

class EnterpriseDao extends Model
{

    public function findAll()
    {
        $sql = "select * from tb_enterprise order by enterpriseid asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($enterpriseid)
    {
        $sql = "select * from tb_enterprise where enterpriseid=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $enterpriseid
        ));
        return $statement->fetch();
    }

    public function add($name, $address, $contact_person, $remark, $phone_number, $fax, $email, $website, $credit_rank, $zip_number, $legal_person, $tax_number, $service_zone, $is_1part, $is_divideman, $is_materialman, $is_machineman, $is_transman, $is_client, $is_otherpart)
    {
        $sql = "insert into tb_enterprise(name,address,contact_person,remark,phone_number,fax,email,website,credit_rank,zip_number,
				legal_person,tax_number,service_zone,is_1part,is_divideman,is_materialman,is_machineman,is_transman,is_client,is_otherpart) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $name,
            $address,
            $contact_person,
            $remark,
            $phone_number,
            $fax,
            $email,
            $website,
            $credit_rank,
            $zip_number,
            $legal_person,
            $tax_number,
            $service_zone,
            $is_1part,
            $is_divideman,
            $is_materialman,
            $is_machineman,
            $is_transman,
            $is_client,
            $is_otherpart
        ));
        if ($result == false)
            return - 1;
        else
            return $this->commonPDO->lastInsertId();
    }

    public function updateById($enterpriseid, $name, $address, $contact_person, $remark, $phone_number, $fax, $email, $website, $credit_rank, $zip_number, $legal_person, $tax_number, $service_zone, $is_1part, $is_divideman, $is_materialman, $is_machineman, $is_transman, $is_client, $is_otherpart)
    {
        $sql = "update tb_enterprise set name=?,address=?,contact_person=?,remark=?,phone_number=?,fax=?,email=?,website=?,credit_rank=?,zip_number=?,
				legal_person=?,tax_number=?,service_zone=?,is_1part=?,is_divideman=?,is_materialman=?,is_machineman=?,is_transman=?,is_client=?,is_otherpart=? where enterpriseid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $name,
            $address,
            $contact_person,
            $remark,
            $phone_number,
            $fax,
            $email,
            $website,
            $credit_rank,
            $zip_number,
            $legal_person,
            $tax_number,
            $service_zone,
            $is_1part,
            $is_divideman,
            $is_materialman,
            $is_machineman,
            $is_transman,
            $is_client,
            $is_otherpart,
            $enterpriseid
        ));
    }

    public function deleteById($enterpriseid)
    {
        $sql = "delete from tb_enterprise where enterpriseid=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $enterpriseid
        ));
    }
}

?>