<!DOCTYPE html>
<html>

<head>
    <title>Bai Tap</title>
</head>

<body>
    <?php
    /**
     * 
     */
    class Ex
    {
        private $am = [];
        private $duong = [];

        function __construct()
        {
            $array = [];
            // Nhập mảng 4x4 ngẫu nhiên
            for ($a = 0; $a < 4; $a++) {
                for ($b = 0; $b < 4; $b++) {
                    $array[$a][$b] = rand(-100, 100);
                }
            }
            $this->render($array, 0);
            echo '<br/> Có ' . count($this->am) . ' phần tử âm: ';
            foreach ($this->am as $key => $value) {
                echo $value . ' ';
            }
            echo ' Tổng là: ' . array_sum($this->am);
            echo '<br/> Có ' . count($this->duong) . ' phần tử dương: ';
            foreach ($this->duong as $key => $value) {
                echo $value . ' ';
            }
            echo ' Tổng là: ' . array_sum($this->duong);
        }

        function render($input, $deep)
        {
            if (is_array($input)) {
                $deep++;
                echo '<ul>';
                foreach ($input as $key => $value) {
                    $this->render($value, $deep);
                }
                echo '</ul>';
            } else {
                if ($input > 0) {
                    array_push($this->duong, $input);
                } elseif ($input < 0) {
                    array_push($this->am, $input);
                }
                echo '<div style="width: 100px; display: inline-block">' . $input . '</div>';
            }
        }
    }

    new Ex();
    ?>
</body>

</html>