<?php
include 'db.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Take Quiz — Quiz System</title>
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #eef2ff, #f8fafc);
      margin: 0;
      padding: 0;
      color: #1e293b;
    }

    .container {
      max-width: 850px;
      margin: 50px auto;
      background: #fff;
      padding: 45px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
      border: 1px solid #e2e8f0;
    }

    h1 {
      text-align: center;
      color: #0f172a;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .lead {
      text-align: center;
      color: #475569;
      margin-bottom: 35px;
      font-size: 15px;
    }

    /* Input Field */
    label {
      font-weight: 600;
      display: block;
      margin-bottom: 6px;
      color: #0f172a;
    }

    input[type="text"] {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #cbd5e1;
      background: #f8fafc;
      margin-bottom: 25px;
      font-size: 15px;
      transition: all 0.25s ease;
    }

    input[type="text"]:focus {
      border-color: #3b82f6;
      background: #fff;
      outline: none;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    /* Question Card */
    .question {
      margin-bottom: 25px;
      padding: 20px;
      background: #f8fbff;
      border-radius: 12px;
      border-left: 5px solid #3b82f6;
      box-shadow: 0 2px 5px rgba(59, 130, 246, 0.05);
      transition: 0.3s ease;
    }

    .question:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(59, 130, 246, 0.1);
    }

    .question h3 {
      margin: 0 0 12px;
      font-size: 17px;
      color: #1d4ed8;
      font-weight: 600;
    }

    .option {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      background: #f1f5ff;
      border-radius: 8px;
      padding: 8px 12px;
      transition: 0.2s ease;
      cursor: pointer;
      color: #334155;
      font-size: 15px;
    }

    .option:hover {
      background: #e0ebff;
    }

    .option input {
      margin-right: 10px;
      accent-color: #2563eb;
      transform: scale(1.1);
    }

    /* Buttons */
    .actions {
      text-align: center;
      margin-top: 30px;
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap;
    }

    .btn {
      background: #2563eb;
      color: #fff;
      border: none;
      padding: 12px 28px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 15px;
      font-weight: 600;
      transition: 0.3s ease;
      text-decoration: none;
    }

    .btn:hover {
      background: #1e40af;
      transform: translateY(-2px);
    }

    .btn-secondary {
      background: #64748b;
    }

    .btn-secondary:hover {
      background: #475569;
    }

    @media (max-width: 600px) {
      .container {
        padding: 25px;
      }
      h1 {
        font-size: 22px;
      }
      .option {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Online Quiz</h1>
    <p class="lead">Enter your name and answer the questions below. You will see correct answers after submission.</p>

    <form method="POST" action="submit_quiz.php">
      <label>Your Name</label>
      <input type="text" name="username" placeholder="Enter your full name" required>

      <?php
      $res = $conn->query("SELECT * FROM questions ORDER BY id ASC");
      if ($res && $res->num_rows > 0) {
          $no = 1;
          while ($row = $res->fetch_assoc()) {
              echo '<div class="question">';
              echo '<h3>' . $no . '. ' . htmlspecialchars($row['question']) . '</h3>';
              echo '<label class="option"><input type="radio" name="answers['.$row['id'].']" value="A"> A. ' . htmlspecialchars($row['option_a']) . '</label>';
              echo '<label class="option"><input type="radio" name="answers['.$row['id'].']" value="B"> B. ' . htmlspecialchars($row['option_b']) . '</label>';
              echo '<label class="option"><input type="radio" name="answers['.$row['id'].']" value="C"> C. ' . htmlspecialchars($row['option_c']) . '</label>';
              echo '<label class="option"><input type="radio" name="answers['.$row['id'].']" value="D"> D. ' . htmlspecialchars($row['option_d']) . '</label>';
              echo '</div>';
              $no++;
          }
      } else {
          echo '<p class="lead">No questions available yet. Please ask the admin to add questions.</p>';
      }
      ?>

      <div class="actions">
        <button class="btn" type="submit" name="submit">Submit Quiz</button>
        <a href="add_questions.php" class="btn btn-secondary">Add Questions</a>
      </div>
    </form>
  </div>
</body>
</html>
