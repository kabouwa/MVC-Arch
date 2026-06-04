<!DOCTYPE html>
<html lang="en">
<head>
    <?php require(__DIR__.'/../components/head.php'); ?>
    <title>MVC PROJECT - Students</title>
    <link rel="stylesheet" href="/static/css/create.css">
</head>
<body>
    <?php require(__DIR__.'/../components/header.php'); ?>
    <main class="container">

    <div class="form-header">
        <h2>Add New Student</h2>
        <p>Fill the form to create a new student</p>
    </div>

    <form class="student-form" method="POST" action="" enctype="multipart/form-data">
            <div class="input-profile">
                <label>Profile Picture</label>

                <div class="upload-box">
                    <label for="profile-upload" class="upload-label">
                        <i class="fa-solid fa-image"></i>
                        Choose Image (PNG)
                    </label>

                    <input type="file" id="profile-upload" name="profile" accept="image/png, image/jpeg" hidden>
                </div>
            </div>
            <div class="form-grid">
                <div class="input-box">
                    <label>First Name</label>
                    <input type="text" name="firstname" >
                </div>

                <div class="input-box">
                    <label>Last Name</label>
                    <input type="text" name="lastname" >
                </div>

                <div class="input-box">
                    <label>Age</label>
                    <input type="number" name="age" >
                </div>

                <div class="input-box">
                    <label>City</label>
                    <input type="text" name="city" >
                </div>

                <div class="input-box">
                    <label>Group</label>
                    <input type="text" name="group" >
                </div>

            </div>

            <button type="submit" class="btn-submit">
                Create Student
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