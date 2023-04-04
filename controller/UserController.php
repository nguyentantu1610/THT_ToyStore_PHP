<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/src/Exception.php';
require '../vendor/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/src/SMTP.php';

require_once('../model/User.php');
require_once('../service/UserService.php');
require_once('../phpconnectmongodb.php');

class UserController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new userService();
    }

    public function getAllUser()
    {
        return $this->userService->getAll();
    }

    public function getUserById($id)
    {
        return $this->userService->findOneById($id);
    }

    public function countUserById()
    {
        $total = $this->userService->countUser();
        return $total;
    }

    public function signIn()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userService->findOneByEmail($_POST['userEmail']);
            if (password_verify($_POST['userPassword'], $user['userPassword'])) {
                $_SESSION["user"] = serialize($user);
                if ($user['userRole'] == "ROLE_AMIN") {
                    header('Location:../view/dashboard.php');
                } else {
                    header('Location:../view/index.php');
                }
            } else {
                $_SESSION['error_message'] = "Sai thông tin email hoặc mật khẩu";
            }
        }
    }

    public function signUp()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userService->findOneByEmail($_POST['userEmail']);
            if ($user == null) {
                $data = array(
                    'userName' => ($_POST['userName']),
                    'userPhoneNumber' => 0,
                    'userAddress' => 'Đang cập nhật',
                    'userRole' => 'ROLE_USER',
                    'userEmail' => ($_POST['userEmail']),
                    'userPassword' => password_hash($_POST['userPassword'], PASSWORD_DEFAULT)
                );
                header('Location:../view/signin.php');
                return $this->userService->create($data);
            } else {
                $_SESSION['error_message'] = "Email đã tồn tại trong hệ thống";
            }
        }
    }

    public function forgotPassword()
    {
        if (isset($_POST['code'])) {
            if ($_SESSION['code'] == $_POST['code']) {
                $_SESSION['form'] = "form3";
                unset($_POST['code']);
            } else {
                $_SESSION['error_message'] = "Sai mã xác thực";
            }
        } elseif (isset($_POST['userPassword'])) {
            $user = $this->userService->findOneByEmail($_SESSION['userEmail']);
            $data = array(
                'userName' => $user['userName'],
                'userEmail' => $_SESSION['userEmail'],
                'userPhoneNumber' => $user['userPhoneNumber'],
                'userAddress' => $user['userAddress'],
                'userRole' => $user['userRole'],
                'userPassword' => password_hash($_POST['userPassword'], PASSWORD_DEFAULT)
            );
            unset($_SESSION['form']);
            unset($_SESSION['userEmail']);
            $this->userService->update($user['userID'], $data);
            header('Location:../view/signin.php');
        } else {
            if (isset($_POST['userEmail'])) {
                $user = $this->userService->findOneByEmail($_POST['userEmail']);
                if ($user != null) {
                    $_SESSION['form'] = "form2";
                    $_SESSION['userEmail'] = $_POST['userEmail'];

                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'tiennguyen558.tn@gmail.com';
                    $mail->Password = 'jqwnvarqphujghxc';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom('tiennguyen558.tn@gmail.com', 'THT ToyStore');
                    $mail->addAddress($_SESSION['userEmail']);
                    $mail->isHTML(true);
                    $mail->Subject = '[Forgot Password] Mã xác nhận thay đổi mật khẩu';
                    $mail->CharSet = 'UTF-8';
                    $code = rand(100000, 999999);
                    $_SESSION['code'] = $code;

                    $mail->Body = "<div style=\"box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19) !important;\">\r\n"
                        . "<p style=\"margin: 20px 0 20px 0;\">Kính gửi " . $user['userName'] . ",</p>\r\n"
                        . "<p style=\"margin: 0 0 20px 0;\">Mã xác thực của bạn là: " . $code . "</p>\r\n"
                        . "<p style=\"margin: 0 0 20px 0;\">Trân trọng,</p>\r\n"
                        . "<p style=\"margin: 0 0 20px 0;\">THTV - BookStore</p>\r\n" . "</div>";

                    $mail->send();
                } else {
                    $_SESSION['error_message'] = "Không tìm thấy email";
                }
            }
        }
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = unserialize($_SESSION["user"]);
            if ($user != null) {
                $data = array(
                    'userName' => ($user['userName']),
                    'userPhoneNumber' => $_POST['userPhoneNumber'],
                    'userAddress' => $_POST['userAddress'],
                    'userRole' => 'ROLE_USER',
                    'userEmail' => ($user['userEmail']),
                    'userPassword' => ($user['userPassword'])
                );
               
                $this->userService->update($user['userID'], $data);
                $_SESSION["user"] = serialize($this->userService->findOneById($user['userID']));
                header('Location:../view/account.php');
            }
        }
    }
}
