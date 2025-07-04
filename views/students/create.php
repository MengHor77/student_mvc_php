<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Student</title>
</head>
<body>
    <h1>Add New Student</h1>
    <form action="index.php?action=create" method="post">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>
        <label>Gender:</label><br>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>
        <label>Age:</label><br>
        <input type="number" name="age" required><br><br>
        <button type="submit">Save</button>
    </form>
    <br>
    <a href="index.php?action=index">Back to list</a>
</body>
</html>
