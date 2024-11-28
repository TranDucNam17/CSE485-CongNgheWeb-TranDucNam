<?php include 'header.php' ?>

<h1 class = "text-center mb-4">Bài kiểm tra trắc nghiệm ngắn</h1>

<form method="post" action="results.php">
    <div class = "container bg-light p-4 rounded">
        <?php
            $filename = "questions.txt";
            $fileContent = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $currentQuestion = [];
            $number = 0;

            if(file_exists($filename)){
                $fileContent = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $currentQuestion = [];
                $number = 0;

                foreach($fileContent as $line){
                    //kiểm tra dòng bắt đầu với "Câu"
                    if(strpos($line, "Câu") === 0){
                        if(!empty($currentQuestion)){
                            //hiển thị câu hỏi cũ
                            echo "<div class = 'card mb-4 bg-light text-dark'>";
                            echo "<div class = 'card-header'><strong>{$currentQuestion[0]}</strong></div>";
                            echo "<div class = 'card-body'>";
                            for($i = 1; $i <= 4; $i++){
                                $optionValue = substr($currentQuestion[$i], 0, 1); //lấy ra đáp án A, B, C, D
                                echo "<div class = 'form-check'>";
                                echo "<input class = 'form-check-input' type = 'radio' name = 'question{$number}' value = '$optionValue' id='question{$number}{$optionValue}>'";
                                echo "<label class = 'form-check-label' for='question{$number}{$optionValue}'>{$currentQuestion[$i]}</label>";
                                echo "</div>";
                            }
                            echo "</div>";
                            echo "</div>";
                        }
                        $currentQuestion = [];
                        $number++;
                    }
                    //lưu câu hỏi hiện tại vào mảng
                    $currentQuestion[] = $line;
                }
                if (!empty($currentQuestion)) {
                    echo "<div class='card mb-4 bg-light text-dark'>";
                    echo "<div class='card-header'><strong>{$currentQuestion[0]}</strong></div>";
                    echo "<div class='card-body'>";
                    for ($i = 1; $i <= 4; $i++) {
                        $optionValue = substr($currentQuestion[$i], 0, 1); // Lấy đáp án A, B, C, D
                        echo "<div class='form-check'>";
                        echo "<input class='form-check-input' type='radio' name='question{$number}' value='$optionValue' id='question{$number}{$optionValue}'>";
                        echo "<label class='form-check-label' for='question{$number}{$optionValue}'>{$currentQuestion[$i]}</label>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
            }else{
                echo "<div class = 'alert alert-danger'> Không tìm thấy câu hỏi </div>";
            }
        ?>
    </div>
    
    <button type = "submit" class = "btn btn-primary">Nộp bài</button>
</form>

<?php include 'footer.php' ?>