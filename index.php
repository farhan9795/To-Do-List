<?php
    session_start();

    if(!isset($_SESSION['tasks'])) 
    {
        $_SESSION['tasks'] = [];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['addtask'])) {
            if(isset($_POST['task']) && !empty($_POST['task'])) {
                array_push($_SESSION['tasks'],$_POST['task']);
            }
        }
        if(isset($_POST['deleteall'])) {
            $_SESSION['tasks'] = [];
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if(isset($_GET['delete'])) {
        if(isset($_SESSION['tasks'][$_GET['delete']])) {
            array_splice($_SESSION['tasks'], $_GET['delete'], 1);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Todolist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center">
        <div class="row mb-3">
            <h1>Aplikasi Todolist</h1>
            <form method="post">
                <input type="text" name="task" class="form-control-sm">
                <button type="submit" name="addtask" class="btn btn-primary">Add</button>
                <button type="submit" name="deleteall" class="btn btn-danger">Del All</button>
            </form>
        </div>
        <div class="row">    
            <ul style="list-style-type: none;">
                <?php foreach ($_SESSION['tasks'] as $index => $item): ?>
                    <?php if ($item !== null): ?>
                        <li>
                            <?php echo htmlspecialchars($item); ?>
                            <a href="?delete=<?php echo $index; ?>" style="color: red; margin-left: 1px; text-decoration: none;">[Hapus]</a>
                            <input type="checkbox" class="form-check-input">
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>