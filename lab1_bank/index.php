<?php
    require_once __DIR__ . '/app/Models/Bank.php';
    require_once __DIR__ . '/app/Models/HKBank.php';

    use App\BankSystem\HKBank;

    echo "<h1>Hệ Thống Ngân Hàng Mô Phỏng</h1>";
    echo "<h2>Tạo tài khoản:</h2>";

    // ---Tạo các tài khoản---
    $account1 = new HKBank("001", "Tài khoản chính", "Trần Văn Long", "2004-05-10");
    $account2 = new HKBank("002", "Tài khoản phụ", "Vũ Thị Hạnh", "2004-30-01");

    echo "<h2>Hiển thị thông tin tài khoản ban đầu:</h2>";
    $account1->displayAccountInfo();
    $account2->displayAccountInfo();


    echo "<h2>Nạp tiền:</h2>";
    $account1->deposit(5000000);//Nạp 5 triệu từ tài khoản 1
    $account2->deposit(2000000);//Nạp 2 triệu vào tài khoản 2


    echo "<h2>Rút tiền:</h2>";
    $account1->withdraw(1500000);//Rút 1.5 triệu từ tài khoản 1
    $account2->withdraw(3000000);//Rút quá số tiền tài khoản 2


    echo "<h2>Hiển thị thông tin tài khoản sau giao dịch:</h2>";
    $account1->displayAccountInfo();
    $account2->displayAccountInfo();


    echo "<h2>Gửi tiết kiệm:</h2>";
    $account1->savingsDeposit(1000000, 2);//Gửi 1 triệu tiết kiệm 2 năm


    echo "<h2>Chuyển tiền:</h2>";
    $account1->transfer($account2, 2000000);//Chuyển 2 triệu từ tk 1 sang tk 2
    $account1->transfer($account2, 10000000);//Thử chuyển quá số dư

    
    echo "<h2>Hiển thị thông tin tài khoản sau chuyển tiền:</h2>";
    $account1->displayAccountInfo();
    $account2->displayAccountInfo();


    echo "<h2>Thử thay đổi tài khoản:</h2>";
    $account1->setAccountName("Tài khoản làm việc");
    $account1->displayAccountInfo();
?>