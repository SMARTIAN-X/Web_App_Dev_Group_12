<?php
// view_individual_result.php
include 'db.php';

if (!isset($_GET['id'])) {
    die("Invalid result ID.");
}

$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM results WHERE id = $id");
if (!$res || $res->num_rows === 0) {
    die("Result not found.");
}

$row = $res->fetch_assoc();
$username = htmlspecialchars($row['username'] ?? 'Unknown');
$score = intval($row['score'] ?? 0);
$total = intval($row['total'] ?? 0);
$submitted_at = $row['created_at'] ?? $row['submitted_at'] ?? '';

$userAnswers = [];
if (isset($row['answers']) && $row['answers'] !== null && $row['answers'] !== '') {
    $decoded = json_decode($row['answers'], true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $userAnswers = $decoded;
    } else {
        $maybe = @unserialize($row['answers']);
        if ($maybe !== false && is_array($maybe)) {
            $userAnswers = $maybe;
        }
    }
}

// Fetch questions
$questionsRes = $conn->query("SELECT * FROM questions ORDER BY id ASC");
if (!$questionsRes) {
    die("Could not fetch questions.");
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Result for <?php echo $username; ?> — Quiz System</title>
    
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 90%;
      max-width: 800px;
      margin: 30px auto;
      background: #fff;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 6px;
    }

    h1 {
      text-align: center;
      font-size: 24px;
      color: #222;
    }

    .lead {
      text-align: center;
      margin-bottom: 20px;
      color: #555;
    }

    .question {
      margin-bottom: 20px;
      padding: 10px 15px;
      background: #f9fafb;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .question h3 {
      margin: 0 0 8px;
      font-size: 17px;
      color: #333;
    }

    .question p {
      margin: 4px 0;
    }

    .correct {
      color: green;
      font-weight: bold;
    }

    .wrong {
      color: red;
      font-weight: bold;
    }

    .explanation {
      margin-top: 8px;
      background: #fff8c4;
      padding: 8px;
      border-radius: 4px;
      font-size: 14px;
    }

    .actions {
      text-align: center;
      margin-top: 25px;
    }

    .btn {
      display: inline-block;
      background: #007bff;
      color: white;
      text-decoration: none;
      padding: 8px 14px;
      border-radius: 4px;
      margin: 0 5px;
      font-size: 14px;
    }

    .btn:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Result for <?php echo $username; ?></h1>
    <p class="lead">
      Score: <strong><?php echo $score; ?></strong> / <?php echo $total; ?>  
      &nbsp; | &nbsp; 
      Submitted: <?php echo htmlspecialchars($submitted_at); ?>
    </p>

    <?php
    $num = 1;
    while ($q = $questionsRes->fetch_assoc()) {
        $qid = $q['id'];
        $correct = strtoupper($q['correct_answer'] ?? ($q['correct_option'] ?? ''));
        $userAnswer = null;

        if (isset($userAnswers[$qid])) {
            $userAnswer = strtoupper($userAnswers[$qid]);
        } elseif (isset($userAnswers[(string)$qid])) {
            $userAnswer = strtoupper($userAnswers[(string)$qid]);
        }

        echo '<div class="question">';
        echo '<h3>' . $num++ . '. ' . htmlspecialchars($q['question']) . '</h3>';

        $opts = [
            'A' => $q['option_a'] ?? '',
            'B' => $q['option_b'] ?? '',
            'C' => $q['option_c'] ?? '',
            'D' => $q['option_d'] ?? ''
        ];

        foreach ($opts as $k => $v) {
            $mark = '';
            if ($userAnswer !== null && $userAnswer === $k && $userAnswer === $correct) {
                $mark = ' <span class="correct">✔ Your choice — Correct</span>';
            } elseif ($userAnswer !== null && $userAnswer === $k && $userAnswer !== $correct) {
                $mark = ' <span class="wrong">✖ Your choice — Wrong</span>';
            } elseif ($k === $correct) {
                $mark = ' <span class="correct">(Correct Answer)</span>';
            }

            echo '<p>' . htmlspecialchars($k . '. ' . $v) . $mark . '</p>';
        }

        if (!empty($q['explanation'])) {
            echo '<div class="explanation"><em>Explanation:</em> ' . htmlspecialchars($q['explanation']) . '</div>';
        }

        echo '</div>';
    }
    ?>

    <div class="actions">
      <a href="view_results.php" class="btn">← Back to All Results</a>
      <a href="take_quiz.php" class="btn" style="background:#475569;">Take Quiz Again</a>
    </div>
  </div>
</body>
</html>
