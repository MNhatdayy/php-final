<?php

class UserModel
{
    // Các thuộc tính của lớp UserModel
    public $name;
    public $email;
    public $password;
    public $phone;
    public $role;

    // Constructor để khởi tạo đối tượng UserModel
    public function __construct($name, $email, $password, $phone, $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->role = $role;
    }

    // Getter và Setter cho thuộc tính name
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Getter và Setter cho thuộc tính email
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    // Getter và Setter cho thuộc tính password
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Getter và Setter cho thuộc tính phone
    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    // Getter và Setter cho thuộc tính role
    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    // Phương thức trả về thông tin người dùng dưới dạng chuỗi
    public function __toString()
    {
        return "Name: $this->name, Email: $this->email, Phone: $this->phone, Role: $this->role";
    }
}
