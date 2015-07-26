<?php
class CommonDao {
    protected $commonPDO;
    
    /**
     * @return the $commonPDO
     */
    public function getCommonPDO()
    {
        return $this->commonPDO;
    }

 /**
     * @param PDO $commonPDO
     */
    public function setCommonPDO($commonPDO)
    {
        $this->commonPDO = $commonPDO;
    }

    public function __construct(){
        $dsn = C('DB_DSN1');
        $this->commonPDO = new PDO($dsn,C('MYSQL_USERNAME'),C('MYSQL_PASSWORD'));
        $this->commonPDO->query('set names utf8;');
        
    }

}

?>
