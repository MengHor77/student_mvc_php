<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="index.php?action=edit&id=<?= $this->student->id ?>" method="post">
        <input type="hidden" name="id" value="<?= $this->student->id ?>">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($this->student->name) ?>" required><br><br>
        <label>Gender:</label><br>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male" <?= $this->student->gender == 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= $this->student->gender == 'Female' ? 'selected' : '' ?>>Female</option>
        </select><br><br>
        <label>Age:</label><br>
        <input type="number" name="age" value="<?= $this->student->age ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
    <br>
    <a href="index.php?action=index">Back to list</a>
</body>
</html>
