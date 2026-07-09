<?php
class BankAccount
{
    public $soTaiKhoan;
    public $tenChuTaiKhoan;
    public $soDu;

    public function __construct($soTaiKhoan, $tenChuTaiKhoan, $soDu)
    {
        $this->soTaiKhoan = $soTaiKhoan;
        $this->tenChuTaiKhoan = $tenChuTaiKhoan;
        $this->soDu = $soDu;
    }

    public function napTien($soTien)
    {
        if ($soTien >= 0) {
            $this->soDu += $soTien;
            echo "Số dư hiện tại sau khi nạp: {$this->soDu} <br>";
        }

    }

    public function rutTien($soTien)
    {
        if ($soTien >= 0 && $this->soDu >= $soTien) {
            $this->soDu -= $soTien;
            echo "Số dư hiện tại sau rút nạp: {$this->soDu}";
        }

    }

    public function hienThiThongTin()
    {
        echo "--- THÔNG TIN TÀI KHOẢN --- <br>";
        echo "Số tài khoản: {$this->soTaiKhoan} <br>";
        echo "Tên chủ tài khoản: {$this->tenChuTaiKhoan} <br>";
        echo "Số dư hiện tại: {$this->soDu} <br>";
        echo "----------------------------- <br>";
    }
}

$bank = new BankAccount("123", "Khang", 500);

$bank->hienThiThongTin();

$bank->napTien(50);

$bank->rutTien(20);
?>