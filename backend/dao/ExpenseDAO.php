<?php
require_once 'BaseDao.php';

class ExpenseDao extends BaseDao {
    public function __construct() {
        parent::__construct('expenses');
    }

    
    public function getByUserId($user_id) {
        $stmt = $this->connection->prepare("SELECT * FROM expenses WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
    public function getByCategory($category_id) {
        $stmt = $this->connection->prepare("SELECT * FROM expenses WHERE category_id = :category_id");
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
