<!DOCTYPE html>
<html lang="en">
<head>
    <?php require(__DIR__.'/../components/head.php'); ?>
    <title>MVC PROJECT - Students</title>
    <link rel="stylesheet" href="/static/css/update.css">
</head>
<body>
    <?php require(__DIR__.'/../components/header.php'); ?>
    <main class="container">

    <div class="form-header">
        <div class="profile">
            <img alt="profile" src="<?=$pictures . $std['idStud']?>">
        </div>
        <h2>Update Student</h2>
        <p>Fill the form to create a new student</p>
    </div>

    <form class="student-form" method="POST" action="">
            <input type="text" name="id" value="<?=$student_id?>" hidden>
            <div class="input-profile">

            </div>
            <div class="form-grid">
                <div class="input-box">
                    <label>First Name</label>
                    <input type="text" name="firstname" required readonly value="<?=$std['firstNameStud']?>">
                </div>

                <div class="input-box">
                    <label>Last Name</label>
                    <input type="text" name="lastname" required readonly value="<?=$std['lastNameStud']?>">
                </div>

                <div class="input-box">
                    <label>Age</label>
                    <input type="number" name="age" required value="<?=$std['ageStud']?>">
                </div>

                <div class="input-box">
                    <label>City</label>
                    <input type="text" name="city" required value="<?=$std['cityStud']?>">
                </div>

                <div class="input-box">
                    <label>Group</label>
                    <input type="text" name="group" required value="<?=$std['groupStud']?>">
                </div>

            </div>

            <button type="submit" class="btn-submit">
                Update Student
            </button>
            
            <?php foreach($errors as $error): ?>
                <div class="alert alert-danger">
                    <strong>Error :</strong> <?=$error?>
                </div>
            <?php endforeach; ?>

        </form>

    </main>
    <?php require(__DIR__.'/../components/footer.php'); ?>
</body>
</html>