<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

   
    if (!empty($question) && !empty($option_a) && !empty($option_b) && !empty($option_c) && !empty($option_d) && !empty($correct_option)) {
        $sql = "INSERT INTO questions (question_text, option_a, option_b, option_c, option_d, correct_option)
                VALUES ('$question', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_option')";

        if (mysqli_query($conn, $sql)) {
            echo "<p style='color: green;'>✅ Question added successfully!</p>";
        } else {
            echo "<p style='color: red;'>❌ Error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color: red;'>⚠️ Please fill in all fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Quiz Questions</title>
    
</head>
<body>

<h2 style="text-align:center;">Add a New Quiz Question</h2>

<form method="POST" action="">
    <label>Question:</label>
    <textarea name="question" required></textarea>

    <label>Option A:</label>
    <input type="text" name="option_a" required>

    <label>Option B:</label>
    <input type="text" name="option_b" required>

    <label>Option C:</label>
    <input type="text" name="option_c" required>

    <label>Option D:</label>
    <input type="text" name="option_d" required>

    <label>Correct Option (A, B, C, or D):</label>
    <select name="correct_option" required>
        <option value="">--Select--</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select>

    <input type="submit" value="Add Question">
</form>

<div class="nav-links">
    <a href="take_quiz.php">Take Quiz</a>
    <a href="submit_quiz.php">Submit Quiz</a>
</div>

</body>
</html>

