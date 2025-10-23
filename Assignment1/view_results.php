<?php
include 'db.php';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Quiz Results — Smart Quiz System</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f8fafc;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1000px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      transition: all 0.3s ease-in-out;
    }

    h1 {
      text-align: center;
      color: #1e293b;
      font-size: 2rem;
      margin-bottom: 10px;
    }

    .lead {
      text-align: center;
      color: #64748b;
      font-size: 1rem;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    thead tr {
      background: #1e3a8a;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 0.03em;
    }

    th, td {
      padding: 14px 16px;
      text-align: left;
      font-size: 15px;
    }

    tbody tr {
      border-bottom: 1px solid #e2e8f0;
      transition: background 0.2s ease-in-out;
    }

    tbody tr:hover {
      background: #f1f5f9;
    }

    td:first-child {
      font-weight: 600;
      color: #1e293b;
    }

    .btn {
      display: inline-block;
      background: #2563eb;
      color: #fff;
      padding: 8px 14px;
      border-radius: 8px;
      font-size: 14px;
      transition: 0.3s;
      text-decoration: none;
    }

    .btn:hover {
      background: #1d4ed8;
      transform: translateY(-2px);
    }

    .actions {
      margin-top: 30px;
      text-align: center;
    }

    .actions a {
      margin: 0 10px;
      background: #475569;
    }

    .actions a:hover {
      background: #334155;
    }

    @media (max-width: 700px) {
      .container {
        margin: 20px;
        padding: 20px;
      }

      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead {
        display: none;
      }

      tbody tr {
        margin-bottom: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 10px;
      }

      td {
        padding: 10px 0;
        text-align: right;
        position: relative;
      }

      td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        text-transform: uppercase;
        color: #64748b;
        font-weight: 600;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Quiz Results</h1>
    <p class="lead">Below are all submitted quizzes and their scores.</p>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Score</th>
          <th>Date Submitted</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $res = $conn->query("SELECT * FROM results ORDER BY id DESC");

        if ($res && $res->num_rows > 0) {
          $i = 1;
          while ($row = $res->fetch_assoc()) {
            $username = htmlspecialchars($row['username'] ?? 'Unknown');
            $score = htmlspecialchars($row['score'] ?? '0');
            $submitted_at = '';

            if (!empty($row['submitted_at'])) {
                $submitted_at = $row['submitted_at'];
            } elseif (!empty($row['created_at'])) {
                $submitted_at = $row['created_at'];
            } elseif (!empty($row['date'])) {
                $submitted_at = $row['date'];
            } else {
                $submitted_at = 'N/A';
            }

            echo "<tr>
                    <td data-label='#'>{$i}</td>
                    <td data-label='Username'>{$username}</td>
                    <td data-label='Score'>{$score}</td>
                    <td data-label='Date Submitted'>{$submitted_at}</td>
                    <td data-label='Actions'>
                      <a href='view_individual_result.php?id={$row['id']}' class='btn'>View Answers</a>
                    </td>
                  </tr>";
            $i++;
          }
        } else {
          echo "<tr><td colspan='5' style='text-align:center; color:#64748b;'>No quiz results yet.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <div class="actions">
      <a href="take_quiz.php" class="btn">Take Another Quiz</a>
    </div>
  </div>
</body>
</html>