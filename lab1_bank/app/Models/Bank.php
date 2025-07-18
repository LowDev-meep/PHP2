<?php
    namespace App\BankSystem;
    
    abstract class Bank
    {
        protected $accountNumber;
        protected $accountName;
        protected $balance;

        public function __construct($accountNumber,$accountName,$balance = 0)
        {
            $this->accountNumber = $accountNumber;
            $this->accountName   = $accountName;
            $this->balance       = $balance;
            echo "Tài khoản ngân hàng " . 
                $this->accountName . 
                " (" . $this->accountNumber . ") đã được tạo với số dư ban đầu: " . 
                number_format($this->balance) . "VNĐ<br>";
        }

        // Getter
        public function getAccountNumber()
            {
                return $this->accountNumber;
            }

        public function getAccountName()
            {
                return $this->accountName;
            }

        public function getBalance()
            {
                return $this->balance;
            }

        // Setter
        public function setAccountName($name)
            {
                $this->accountName = $name;
                echo "Tên tài khoản được cập nhật thành: " . $name . "<br>";
            }

        // Các phương thức trừu tượng
        // Các phương thức này phải được định nghĩa trong lớp con kế thừa
        abstract public function displayAccountInfo();
        abstract public function deposit($amount); //Nạp
        abstract public function withdraw($amount); //Rút
    }
?>