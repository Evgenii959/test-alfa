<?php
class Domain {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllDomains() {
        $query = "SELECT 
                    id,
                    name, 
                    visits,
                    visits_last_month,
                    contact_count,
                    visitor_count,
                    last_contact_date,
                    created_at
                  FROM domains";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}