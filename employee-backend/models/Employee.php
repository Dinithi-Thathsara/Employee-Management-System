<?php

class Employee {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $sql = "INSERT INTO employees 
                (emp_id, emp_name, email, salary, city, dept_id)
                VALUES (:emp_id, :emp_name, :email, :salary, :city, :dept_id)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ":emp_id" => $data["emp_id"],
            ":emp_name" => $data["emp_name"],
            ":email" => $data["email"],
            ":salary" => $data["salary"],
            ":city" => $data["city"],
            ":dept_id" => $data["department"]["dept_id"]
        ]);
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM employees");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ THIS IS WHAT PHP CANNOT SEE
    public function getById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM employees WHERE emp_id = :id"
        );
        $stmt->execute([":id" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $sql = "UPDATE employees SET
                    emp_name = :emp_name,
                    email = :email,
                    salary = :salary,
                    city = :city,
                    dept_id = :dept_id
                WHERE emp_id = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ":emp_name" => $data["emp_name"],
            ":email" => $data["email"],
            ":salary" => $data["salary"],
            ":city" => $data["city"],
            ":dept_id" => $data["department"]["dept_id"],
            ":id" => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM employees WHERE emp_id = :id"
        );
        return $stmt->execute([":id" => $id]);
    }
}
