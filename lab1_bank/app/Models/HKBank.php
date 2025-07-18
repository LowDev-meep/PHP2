<?php
    namespace App\BankSystem;

    use App\BankSystem\Bank;

    class HKBank extends Bank
    {
        protected $fullName;
        protected $dateOfBirth;
        const SAVINGS_INTEREST_RATE = 0.06;

        public function __construct($accountNumber,$accountName,$fullName,$dateOfBirth)
        {
            parent::__construct($accountNumber,$accountName);
            $this->fullName = $fullName;
            $this->dateOfBirth = $dateOfBirth;
            echo "Tài khoản cho: " . $this->fullName . " đã được thiết lập.<br>";
        }


        // Getter
        public function getFullName()
        {
            return $this->fullName;
        }
        public function getDateOfBirth()
        {
            return $this->dateOfBirth;
        }

        public function displayAccountInfo()
        {
            echo "<h3>---Thông tin tài khoản HKBank---</h3>";
            echo "Số tài khoản: " . $this->getAccountNumber() . "<br>";
            echo "Tên tài khoản: " . $this->getAccountName() . "<br>";
            echo "Họ tên chủ tài khoản: " . $this->fullName . "<br>";
            echo "Ngày sinh: " . $this->dateOfBirth . "<br>";
            echo "Số dư hiện tại: " . number_format($this->getBalance()) . "VNĐ<br>";
            echo "-------------------------------------<br>";
        }


        // Phương thức nạp tiền
        public function deposit($amount)
        {
            if($amount <= 0)
                {
                    echo "Số tiền nạp vào phải lớn hơn 0.<br>";
                    return false;
                }
            $this->balance += $amount;
            echo "TK " . $this->fullName . " đã nạp thành công " . number_format($amount) . "VNĐ vào tài khoản.<br>";
            echo "Số dư mới: " . number_format($this->getBalance()) . "VNĐ<br>";
            return true;
        }


        // Phương thức rút tiền
        public function withdraw($amount)
        {
            if($amount <= 0)
                {
                    echo "Số tiền rút phải lớn hơn 0.<br>";
                    return false;
                }
            if($this->balance < $amount)
                {
                    echo "Số dư không đủ để thực hiện giao dịch rút " . number_format($amount) . "VNĐ.<br>";
                    echo "Số dư hiện tại: " . number_format($this->getBalance()) . "VNĐ<br>";
                    return false;
                }
            $this->balance -= $amount;
            echo "TK " . $this->fullName . " đã rút thành công " . number_format($amount) . "VNĐ khỏi tài khoản.<br>";
            echo "Số dư mới: " . number_format($this->getBalance()) . "VNĐ<br>";
            return true;
        }




        // Phương thức gửi tiết kiệm
        public function savingsDeposit($amount, $years = 1)
            {
                if($amount <= 0)
                    {
                        echo "Số tiền gửi tiết kiệm phải lớn hơn 0.<br>";
                        return false;
                    }
                $interest = $amount * self::SAVINGS_INTEREST_RATE * $years;
                $totalAmount = $amount + $interest;

                $this->balance += $amount;
                echo "TK " . $this->fullName . " đã gửi " . number_format($amount) . "VNĐ vào sổ tiết kiệm.<br>";
                echo "Số tiền lãi dự kiến sau " . $years . " năm: " . number_format($interest) . "VNĐ.<br>";
                echo "Tổng cộng (gốc + lãi): " . number_format($totalAmount) . "VNĐ.<br>";
                echo "Số dư hiện tại: " . number_format($this->getBalance()) . "VNĐ (chưa tính lãi).<br>";
                return true;
            }



        /**
         * Phương thức chuyển tiền đến tài khoản khác
         * @param HKBank $targetAccount Đối tượng tài khoản nhận tiền
         * @param float $amount Số tiền muốn chuyển
         */
        public function transfer(HKBank $targetAccount, $amount)
            {
                if($amount <= 0)
                    {
                        echo "Số tiền cần chuyển phải lớn hơn 0.<br>";
                        return false;
                    }
                if($this->balance < $amount)
                    {
                        echo "Số dư không đủ để chuyển.<br>";
                        echo "Số dư hiện tại của bạn là: ". number_format($this->getBalance()) . "VNĐ.<br>";
                        return false;
                    }
                // Thực hiện rút tiền từ tài khoản hiện tại
                $this->withdraw($amount);//Hàm withdraw tự động in thông báo

                // Thực hiện nạp tiền vào tài khoản đích
                $targetAccount->deposit($amount);//Hàm deposit tự động in thông báo

                echo "<br>Chuyển tiền thành công!<br>";
                echo "Bạn đã chuyển " . number_format($amount) . 
                    " VNĐ từ tài khoản " . number_format($this->getAccountNumber()) . 
                    " đến tài khoản " . $targetAccount->getAccountNumber() . ".<br>";
                echo "Số dư còn lại của bạn là: " . number_format($this->getBalance()) . "VNĐ<br>";
                return true;
            }
    }
?>