<?php
class Visitor {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllVisitors() {
        $query = "SELECT 
                    visitor_id, 
                    domain_id, 
                    contact_id, 
                    visit_date, 
                    created_at, 
                    ip_address 
                  FROM visitors";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
