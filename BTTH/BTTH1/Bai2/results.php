<?php include 'header.php' ?>

<h1 class = "text-center mb-4"> Kết quả bài làm</h1>

<?php
    $filename = "questions.txt";
    $fileContent = file($filename,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $answers = [];

    foreach($fileContent as $line){
        if(strpos($line, 'ANSWER:') !== false){
            $answers[] = trim(substr($line, strpos($line, ":") + 1)); 
        }
    }

    $score = 0; //khởi tạo biến điểm
    $total = count($answers); //khởi tạo biến đếm đáp án 

    //kiểm tra câu trả lời của người dùng
    foreach($_POST as $key => $userAnswer){
        $questionIndex = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT) - 1;
        if(isset($answers[$questionIndex]) && $answers[$questionIndex] === $userAnswer){
            $score++; //tăng điểm nếu đáp án đúng
        }
    }
?>

<div class="alert alert-success text-center">
    Bạn trả lời đúng <strong><?php echo $score; ?></strong>/<strong><?php echo $total; ?></strong> câu.
</div>

<div class="text-center">
    <a href="index.php" class="btn btn-primary">Làm lại</a>
</div>

<?php include 'footer.php'; ?>