<!DOCTYPE html>
<html lang="en">
<head>
    <?php require(__DIR__.'/../components/head.php'); ?>
    <title>MVC PROJECT - Students</title>
    <link rel="stylesheet" href="/static/css/students.css">
</head>
<body>
    <?php require(__DIR__.'/../components/header.php'); ?>
    <main class="container">

        <div class="table-header">
            <h2>Students List</h2>
            <p>Manage all registered students</p>
        </div>
        <?php foreach($success as $succ): ?>
            <div class="alert alert-success">
                <strong>Success :</strong> <?=$succ?>
            </div>
        <?php endforeach; ?>

        <?php foreach($errors as $error): ?>
            <div class="alert alert-danger">
                <strong>Error :</strong> <?=$error?>
            </div>
        <?php endforeach; ?>
        <table class="students-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profile</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>City</th>
                    <th>Group</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php if(empty($students)): ?>
                    <tr>
                        <td colspan="8">
                            No Student Founded !
                        </td>
                    </tr>
                <?php endif ?>

                <?php foreach($students as $std):;?>
                    <tr>
                        <td> <?=$std['idStud'] ?> </td>
                        <td> <img class="profile-picture" alt="profile" src="<?=$pictures . $std['idStud']?>"> </td>
                        <td> <?=$std['firstNameStud'] ?> </td>
                        <td> <?=$std['lastNameStud'] ?> </td>
                        <td> <?=$std['ageStud'] ?> </td>
                        <td> <?=$std['cityStud'] ?> </td>
                        <td> <?=$std['groupStud'] ?> </td>
                        <td>
                            <a href="/update-student?id=<?=$std['idStud'] ?>">Update</a>
                        </td>
                        <td>
                            <a href="/delete-student?id=<?=$std['idStud'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>

    </main>
    <?php require(__DIR__.'/../components/footer.php'); ?>
</body>
</html>