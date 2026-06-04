<!DOCTYPE html>
<html lang="en">
<head>
    <?php require(__DIR__.'/../components/head.php'); ?>
    <title>MVC PROJECT - Confirm delete student</title>
    <link rel="stylesheet" href="/static/css/delete.css">
</head>
<body>
    <?php require(__DIR__.'/../components/header.php'); ?>
    <main class="container">
        <div class="delete-box">

            <div class="delete-header">
                <h2>Delete Student</h2>
                <p>Are you sure you want to delete this student?</p>
            </div>

            <div class="delete-actions">
                <a href="/" class="btn cancel">Cancel</a>

                <form action="/delete-student" method="POST">
                    <input name="id" value="<?=$student_id?>" hidden>
                    <button type="submit" class="btn delete">Yes, Delete</button>
                </form>
            </div>

        </div>

    </main>
    <?php require(__DIR__.'/../components/footer.php'); ?>
</body>
</html>