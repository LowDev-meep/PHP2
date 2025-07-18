<?php
    // Hàm dd dùng để bug dữ liệu
    function dd(...$data)
    {
        echo "<pre>";

        foreach ($data as $value)
        {
            var_dump($value);
        }
        exit;
    }
?>