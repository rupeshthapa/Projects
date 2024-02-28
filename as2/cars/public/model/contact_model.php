<?php

class Contact
{
    private $name;
    private $email;
    private $number;
    private $enquiry;
    private $pdo;

    public function __construct()
    {
        $host = 'db';
        $dbname = 'cars';
        $username = 'student';
        $password = 'student';

        $dsn = "mysql:host=$host;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);

        $this->pdo = $pdo;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setEnquiry($enquiry)
    {
        $this->enquiry = $enquiry;
    }

    public function save()
    {
        $stmt = $this->pdo->prepare('INSERT INTO enquiries (name, email, number, enquiry) VALUES (:name, :email, :number, :textarea)');
        $stmt->execute([
            'name' => $this->name,
            'email' => $this->email,
            'number' => $this->number,
            'textarea' => $this->enquiry,
        ]);
    }
}
?>