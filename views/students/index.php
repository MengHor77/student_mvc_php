<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
</head>
<body>
    <h1>All Students</h1>

<a href="/student_mvc_php/public/index.php?action=create">Add New Student</a>
    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)) : ?>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?= htmlspecialchars($student['id']) ?></td>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['gender']) ?></td>
                        <td><?= htmlspecialchars($student['age']) ?></td>
                        <td>
                            <a href="index.php?action=edit&id=<?= $student['id'] ?>">Edit</a> |
                            <a href="index.php?action=delete&id=<?= $student['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No students found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
