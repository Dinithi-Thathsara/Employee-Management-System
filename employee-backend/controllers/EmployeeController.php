<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Employee.php';

class EmployeeController {

    private $employee;

    public function __construct() {
        $db = (new Database())->getConnection();
        $this->employee = new Employee($db);
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->employee->create($data);
        echo json_encode(["message" => "Employee saved"]);
    }

    public function getAll() {
        echo json_encode($this->employee->getAll());
    }

    public function getById($id) {
        $emp = $this->employee->getById($id);
        echo json_encode($emp ?: ["message" => "Not found"]);
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        $this->employee->update($id, $data);
        echo json_encode(["message" => "Employee updated"]);
    }

    public function delete($id) {
        $this->employee->delete($id);
        echo json_encode(["message" => "Employee deleted"]);
    }
}
