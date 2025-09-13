<?php
session_start();

// Ambil data lama & error dari session (jika ada)
$formData = $_SESSION['form_data'] ?? [];
$errors   = $_SESSION['errors'] ?? [];

// Hapus supaya tidak numpuk tiap refresh
unset($_SESSION['form_data'], $_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas PBP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            margin: 0 0 30px 0;
            padding: 15px;
            background-color: #e8e8e8;
            border: 1px solid #ccc;
            font-size: 20px;
            font-weight: bold;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        td {
            padding: 15px;
            border: 1px solid #ccc;
            vertical-align: top;
        }
        
        .nama-baris {
            background-color: #f8f8f8;
            width: 150px;
            font-weight: bold;
        }
        
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 5px;
        }
        
        .note {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
        
        .radio-group, .checkbox-group {
            margin: 5px 0;
        }
        
        .radio-group label, .checkbox-group label {
            margin-left: 8px;
            font-weight: normal;
        }
        
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px auto;
            display: block;
        }
        
        .submit-btn:hover {
            background-color: #45a049;
        }
        
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            font-weight: bold;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 4px;
            margin-top: 20px;
        }
        
        .details h3 {
            margin-top: 0;
        }
        
        .details-item {
            margin: 10px 0;
        }
        
        .details-item strong {
            display: inline-block;
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="form-container">
            <h1>Student Sign On Form</h1>
            
            <form method="POST" action="proccess.php">
                <table>
                    <tr>
                        <td class="nama-baris">Username</td>
                        <td>
                            <input type="text" name="username" value="<?php echo htmlspecialchars($formData['username'] ?? ''); ?>">
                            <div class="note">Note: Username cannot contain numbers</div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="nama-baris">Email</td>
                        <td>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($formData['email'] ?? ''); ?>">
                            <div class="note">Note: Email contain @ followed by domain</div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="nama-baris">Perguruan Tinggi</td>
                        <td>
                            <input type="text" name="perguruan_tinggi" value="<?php echo htmlspecialchars($formData['perguruan_tinggi'] ?? ''); ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="nama-baris">Program Studi</td>
                        <td>
                            <div class="radio-group">
                                <input type="radio" id="informatika" name="program_studi" value="Informatika" <?php echo (($formData['program_studi'] ?? '') === 'Informatika') ? 'checked' : ''; ?>>
                                <label for="informatika">Informatika</label>
                            </div>
                            <div class="radio-group">
                                <input type="radio" id="matematika" name="program_studi" value="Matematika" <?php echo (($formData['program_studi'] ?? '') === 'Matematika') ? 'checked' : ''; ?>>
                                <label for="matematika">Matematika</label>
                            </div>
                            <div class="radio-group">
                                <input type="radio" id="fisika" name="program_studi" value="Fisika" <?php echo (($formData['program_studi'] ?? '') === 'Fisika') ? 'checked' : ''; ?>>
                                <label for="fisika">Fisika</label>
                            </div>
                            <div class="radio-group">
                                <input type="radio" id="kimia" name="program_studi" value="Kimia" <?php echo (($formData['program_studi'] ?? '') === 'Kimia') ? 'checked' : ''; ?>>
                                <label for="kimia">Kimia</label>
                            </div>
                            <div class="radio-group">
                                <input type="radio" id="statistika" name="program_studi" value="Statistika" <?php echo (($formData['program_studi'] ?? '') === 'Statistika') ? 'checked' : ''; ?>>
                                <label for="statistika">Statistika</label>
                            </div>
                            <div class="radio-group">
                                <input type="radio" id="biologi" name="program_studi" value="Biologi" <?php echo (($formData['program_studi'] ?? '') === 'Biologi') ? 'checked' : ''; ?>>
                                <label for="biologi">Biologi</label>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="nama-baris">Hobi:</td>
                        <td>
                            <div class="checkbox-group">
                                <input type="checkbox" id="futsal" name="hobi[]" value="Futsal" <?php echo in_array('Futsal', $formData['hobi'] ?? []) ? 'checked' : ''; ?>>
                                <label for="futsal">Futsal</label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" id="badminton" name="hobi[]" value="Badminton" <?php echo in_array('Badminton', $formData['hobi'] ?? []) ? 'checked' : ''; ?>>
                                <label for="badminton">Badminton</label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" id="membaca" name="hobi[]" value="Membaca" <?php echo in_array('Membaca', $formData['hobi'] ?? []) ? 'checked' : ''; ?>>
                                <label for="membaca">Membaca</label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" id="menulis" name="hobi[]" value="Menulis" <?php echo in_array('Menulis', $formData['hobi'] ?? []) ? 'checked' : ''; ?>>
                                <label for="menulis">Menulis</label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" id="travelling" name="hobi[]" value="Travelling" <?php echo in_array('Travelling', $formData['hobi'] ?? []) ? 'checked' : ''; ?>>
                                <label for="travelling">Travelling</label>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="nama-baris">Password</td>
                        <td>
                            <input type="password" name="password" value="<?php echo htmlspecialchars($formData['password'] ?? ''); ?>">
                            <div class="note">hint: Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, and one number.</div>
                        </td>
                    </tr>
                </table>
                
                <button type="submit" class="submit-btn">Submit</button>
            </form>
    </div>
</body>
</html>