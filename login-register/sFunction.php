<?php
    function generateRandomNumber() {
        $length = rand(4, 20);
        $number = '';
    
        for ($i = 0; $i < $length; $i++) {
            $number .= rand(0, 9);
        }
    
        return $number;
    }
    
?>