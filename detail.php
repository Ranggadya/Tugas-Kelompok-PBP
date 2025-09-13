<?php
session_start();

// Cek apakah ada data student di session
if (!isset($_SESSION['student_data'])) {
    header('Location: index.php');
    exit;
}

$student_data = $_SESSION['student_data'];

// Cek apakah success alert perlu ditampilkan
$show_success_alert = isset($_SESSION['success']) && $_SESSION['success'] === true;

// Setelah dibaca, hapus flag success biar tidak alert lagi saat refresh
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 30px auto;
            padding: 15px;
            background-color: #fafafa;
        }
        .details-container {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        .success-header {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 20px;
        }
        .success-header h1 {
            font-size: 20px;
            margin: 0 0 5px 0;
        }
        .details h3 {
            margin-top: 0;
            color: #333;
            font-size: 18px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 6px;
            margin-bottom: 15px;
        }
        .details-item {
            margin: 10px 0;
        }
        .details-item strong {
            display: inline-block;
            width: 150px;
            color: #222;
        }
        .details-value {
            color: #555;
        }
        .hobi-list {
            display: inline-flex;
            flex-wrap: wrap;
            gap: 5px;
        }
        .hobi-tag {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 13px;
            border: 1px solid #a5d6a7;
        }
        .no-hobi {
            color: #999;
            font-style: italic;
        }
        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 8px 18px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="details-container">
        <div class="success-header">
            <h1>Form Submitted Successfully</h1>
            <p>Student registration completed</p>
        </div>

        <?php if ($show_success_alert): ?>
        <script>
            alert('Form submitted successfully!');
        </script>
        <?php endif; ?>

        <div class="details">
            <h3>Student Information</h3>
            <div class="details-item">
                <strong>Username:</strong>
                <span class="details-value"><?= htmlspecialchars($student_data['username']) ?></span>
            </div>
            <div class="details-item">
                <strong>Email:</strong>
                <span class="details-value"><?= htmlspecialchars($student_data['email']) ?></span>
            </div>
            <div class="details-item">
                <strong>Perguruan Tinggi:</strong>
                <span class="details-value"><?= htmlspecialchars($student_data['perguruan_tinggi']) ?></span>
            </div>
            <div class="details-item">
                <strong>Program Studi:</strong>
                <span class="details-value"><?= htmlspecialchars($student_data['program_studi']) ?></span>
            </div>
            <div class="details-item">
                <strong>Hobi:</strong>
                <span class="details-value">
                    <?php if (!empty($student_data['hobi'])): ?>
                        <div class="hobi-list">
                            <?php foreach ($student_data['hobi'] as $hobi): ?>
                                <span class="hobi-tag"><?= htmlspecialchars($hobi) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <span class="no-hobi">None selected</span>
                    <?php endif; ?>
                </span>
            </div>
        </div>

        <div class="action-buttons">
            <a href="index.php" class="btn btn-primary">← Back to Form</a>
        </div>
    </div>
</body>
</html>
