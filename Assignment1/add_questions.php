<?php
include 'db.php';

$message = ""; // store message

// Only run the logic if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $question = trim($_POST['question'] ?? '');
    $option_a = trim($_POST['option_a'] ?? '');
    $option_b = trim($_POST['option_b'] ?? '');
    $option_c = trim($_POST['option_c'] ?? '');
    $option_d = trim($_POST['option_d'] ?? '');
    $correct_option = trim($_POST['correct_option'] ?? '');

    if ($question && $option_a && $option_b && $option_c && $option_d && $correct_option) {
        $sql = "INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct_answer)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssss", $question, $option_a, $option_b, $option_c, $option_d, $correct_option);
            if ($stmt->execute()) {
                $message = "✅ Question added successfully!";
            } else {
                $message = "❌ Error adding question: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            $message = "❌ SQL prepare failed: " . htmlspecialchars($conn->error);
        }
    } else {
        $message = "⚠️ Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Quiz Question</title>
</head>
<body>

<h2>Add New Quiz Question</h2>

<?php if (!empty($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label>Question:</label><br>
    <textarea name="question" required></textarea><br><br>

    <label>Option A:</label><br>
    <input type="text" name="option_a" required><br><br>

    <label>Option B:</label><br>
    <input type="text" name="option_b" required><br><br>

    <label>Option C:</label><br>
    <input type="text" name="option_c" required><br><br>

    <label>Option D:</label><br>
    <input type="text" name="option_d" required><br><br>

    <label>Correct Option (A, B, C, or D):</label><br>
    <select name="correct_option" required>
        <option value="">--Select--</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select><br><br>

    <input type="submit" name="submit" value="Add Question">
</form>

<p><a href="take_quiz.php">Take Quiz</a></p>

</body>
</html>
