<?php
require_once 'BaseDao.php';

class AccountDao extends BaseDao {
    public function __construct() {
        parent::__construct('accounts');
    }

    
    public function getByUserId($user_id) {
        $stmt = $this->connection->prepare("SELECT * FROM accounts WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
