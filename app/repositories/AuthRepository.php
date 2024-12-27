<?php

class AuthRepository
{
    private $conn;

    // Constructor để khởi tạo kết nối cơ sở dữ liệu
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Hàm đăng ký người dùng mới
    public function register($name, $email, $password, $phone, $role)
    {
        // Mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Câu lệnh SQL để thêm người dùng vào cơ sở dữ liệu
        $query = "INSERT INTO users (name, email, password, phone, role) VALUES (?, ?, ?, ?, ?)";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($query);

        // Bind giá trị vào câu lệnh SQL
        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $phone, $role);

        // Thực thi câu lệnh SQL
        if ($stmt->execute()) {
            return true; // Đăng ký thành công
        }

        return false; // Đăng ký không thành công
    }

    // Hàm đăng nhập người dùng
    public function login($email, $password)
    {
        // Câu lệnh SQL để lấy thông tin người dùng từ cơ sở dữ liệu
        $query = "SELECT id, name, email, password, phone, role FROM users WHERE email = ? LIMIT 1";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($query);

        // Bind giá trị vào câu lệnh SQL
        $stmt->bind_param("s", $email);

        // Thực thi câu lệnh SQL
        $stmt->execute();

        // Lấy kết quả truy vấn
        $stmt->store_result();

        // Nếu người dùng tồn tại
        if ($stmt->num_rows > 0) {
            $id = '';
            $name = '';
            $emailFromDb = '';
            $hashedPassword = '';
            $phone = '';
            $role = '';
            $stmt->bind_result($id, $name, $emailFromDb, $hashedPassword, $phone, $role);
            $stmt->fetch();

            // Kiểm tra mật khẩu
            if (password_verify($password, $hashedPassword)) {
                return [
                    'id' => $id,
                    'name' => $name,
                    'email' => $emailFromDb,
                    'phone' => $phone,
                    'role' => $role
                ];
            }
        }

        return false;
    }
    public function getUserByEmail($email)
    {
        $stmt = $this->conn->prepare("
            SELECT u.*, p.role_id 
            FROM users u 
            LEFT JOIN permissions p ON u.id = p.user_id 
            WHERE u.email = ?
        ");
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
