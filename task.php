<?php
// Initialize tasks array (stored in session for persistence between requests)
session_start();
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

$tasks = $_SESSION['tasks']; // Fetch tasks from session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_task'])) {
        // Add multiple tasks
        $descriptions = explode("\n", htmlspecialchars($_POST['description'])); // Split tasks by newline
        foreach ($descriptions as $description) {
            $description = trim($description);
            if (!empty($description)) {
                $tasks[] = ['description' => $description, 'status' => 'Pending'];
            }
        }
        $_SESSION['tasks'] = $tasks; // Store updated tasks back to session
    } elseif (isset($_POST['mark_completed'])) {
        // Mark task as completed
        $taskNumber = $_POST['task_number'] - 1;
        if (isset($tasks[$taskNumber])) {
            $tasks[$taskNumber]['status'] = 'Completed';
        }
        $_SESSION['tasks'] = $tasks; // Store updated tasks back to session
    } elseif (isset($_POST['undo_task'])) {
        // Undo task to pending
        $taskNumber = $_POST['task_number'] - 1;
        if (isset($tasks[$taskNumber])) {
            $tasks[$taskNumber]['status'] = 'Pending';
        }
        $_SESSION['tasks'] = $tasks; // Store updated tasks back to session
    } elseif (isset($_POST['delete_task'])) {
        // Delete task
        $taskNumber = $_POST['task_number'] - 1;
        if (isset($tasks[$taskNumber])) {
            unset($tasks[$taskNumber]);
            $tasks = array_values($tasks); // Reindex the array
        }
        $_SESSION['tasks'] = $tasks; // Store updated tasks back to session
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>To-Do List Manager</h1>

    <!-- Form to add tasks -->
    <form method="POST">
        <h3>Add Tasks</h3>
        <textarea name="description" placeholder="Enter multiple tasks, each on a new line" rows="4" required></textarea><br>
        <button type="submit" name="add_task">Add Tasks</button>
    </form>

    <!-- Display tasks -->
    <h3>Current Tasks</h3>
    <?php if (!empty($tasks)) : ?>
        <ul>
            <?php foreach ($tasks as $index => $task) : ?>
                <li style="color: <?php echo $task['status'] == 'Completed' ? 'green' : 'red'; ?>;">
                    <?php echo $index + 1 . ". " . $task['description']; ?>

                    <!-- Options for completed tasks -->
                    <?php if ($task['status'] == 'Completed') : ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="task_number" value="<?php echo $index + 1; ?>">
                            <button type="submit" name="undo_task">Undo</button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="task_number" value="<?php echo $index + 1; ?>">
                            <button type="submit" name="delete_task">Delete</button>
                        </form>
                    <?php else: ?>
                        <!-- Button to mark task as completed -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="task_number" value="<?php echo $index + 1; ?>">
                            <button type="submit" name="mark_completed">Mark as Done</button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="task_number" value="<?php echo $index + 1; ?>">
                            <button type="submit" name="delete_task">Delete</button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tasks found!</p>
    <?php endif; ?>

</body>
</html>
