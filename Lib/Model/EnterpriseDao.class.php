<?php
import("@.Model.CommonDao");
class EnterpriseDao extends CommonDao
{

    public function findAll()
    {
        $sql = "select * from tb_enterprise order by id asc";
        $statement = $this->commonPDO->query($sql);
        return $statement->fetchAll();
    }

    public function findById($id)
    {
        $sql = "select * from tb_enterprise where id=?";
        $statement = $this->commonPDO->prepare($sql);
        $statement->execute(array(
            $id
        ));
        return $statement->fetch();
    }

    public function add(
        $name, 
        $address, 
        $contact_person_id, 
        $remark, 
        $phone_number, 
        $fax, 
        $email, 
        $website, 
        $credit_rank, 
        $zip_number, 
        $legal_person_id, 
        $tax_number, 
        $service_zone, 
        $is_1part, 
        $is_divideman, 
        $is_materialman, 
        $is_machineman, 
        $is_transman, 
        $is_client, 
        $is_otherpart)
    {
        $sql = "insert into tb_enterprise(
            name,
            address,
            contact_person_id,
            remark,
            phone_number,
            fax,
            email,
            website,
            credit_rank,
            zip_number,
			legal_person_id,
            tax_number,
            service_zone,
            is_1part,
            is_divideman,
            is_materialman,
            is_machineman,
            is_transman,
            is_client,
            is_otherpart) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->commonPDO->prepare($sql);
        $result = $statement->execute(array(
            $name,
            $address,
            $contact_person_id,
            $remark,
            $phone_number,
            $fax,
            $email,
            $website,
            $credit_rank,
            $zip_number,
            $legal_person_id,
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

    public function updateById($id, $name, $address, $contact_person_id, $remark, $phone_number, $fax, $email, $website, $credit_rank, $zip_number, $legal_person_id, $tax_number, $service_zone, $is_1part, $is_divideman, $is_materialman, $is_machineman, $is_transman, $is_client, $is_otherpart)
    {
        $sql = "update tb_enterprise set name=?,address=?,contact_person_id=?,remark=?,phone_number=?,fax=?,email=?,website=?,credit_rank=?,zip_number=?,
				legal_person_id=?,tax_number=?,service_zone=?,is_1part=?,is_divideman=?,is_materialman=?,is_machineman=?,is_transman=?,is_client=?,is_otherpart=? where id=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $name,
            $address,
            $contact_person_id,
            $remark,
            $phone_number,
            $fax,
            $email,
            $website,
            $credit_rank,
            $zip_number,
            $legal_person_id,
            $tax_number,
            $service_zone,
            $is_1part,
            $is_divideman,
            $is_materialman,
            $is_machineman,
            $is_transman,
            $is_client,
            $is_otherpart,
            $id
        ));
    }

    public function deleteById($id)
    {
        $sql = "delete from tb_enterprise where id=?";
        $statement = $this->commonPDO->prepare($sql);
        return $statement->execute(array(
            $id
        ));
    }
}

?>