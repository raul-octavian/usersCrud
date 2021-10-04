<?php
spl_autoload_register(function ($class)
{require_once"classes/".$class.".php";});
$user = new User();

$result = [];

if (isset($_GET['submit'])) {

    $user->updateValues(
            $_GET['username'],
            $_GET['lName'],
            $_GET['fName'],
            $_GET['description'],
            $_GET['rank'],
            $_GET['email'],
            $_GET['id']
            );

    ($result = $user->fetchUser($_GET['id']));
}elseif(isset($_GET['id'])) {

    ($result = $user->fetchUser($_GET['id']));

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Update user <?php echo $result['username']?></title>
</head>
<body>

<div class="m-3">
    <h1>Update user <?php echo $result['username']?></h1>

    <?php if(isset($user->message)): ?>

        <div>
            <h3><?php echo $user->message ?></h3>
        </div>

    <?php endif  ?>
    <a href="allUsers.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Back to user overview</a>
</div>
<?php if ($result) {
     ?>

<form action="" method="get">
    <div class="form-row">
        <div class="col-md-5 mb-3">
            <label for="validationDefault01">First name</label>
            <input type="text" class="form-control" id="validationDefault01" placeholder="First name" value="<?php echo $result['fName']?>" name="fName" required>
        </div>
        <div class="col-md-5 mb-3">
            <label for="validationDefault02">Last name</label>
            <input type="text" class="form-control" id="validationDefault02" placeholder="Last name" value="<?php echo $result['lName']?>" name="lName" required >
        </div>
        <div class="col-md-5 mb-3">
            <label for="validationDefaultUsername">Username</label>
            <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Username" value="<?php echo $result['username']?>" aria-describedby="inputGroupPrepend2" name="username" required>
        </div>

    </div>
    <div class="form-row">
        <div class="col-md-5 mb-3">
            <label for="validationDefault03">Email</label>
            <input type='email' class="form-control" id="validationDefault03" placeholder="email" value = "<?php echo $result['email']?>" required name="email">
        </div>
        <div class="col-md-5 mb-3">
            <label for="validationDefault04">About</label>
            <textarea class="form-control" id="validationDefault04" placeholder="State"   name="description"> <?php echo $result['description']?> </textarea>
        </div>
        <input  hidden type="text" class="form-control" id="validationDefault06"  required value = 1 name = 'rank'>
        <input  hidden type="text" class="form-control" id="validationDefault07"  required value = "<?php echo $_GET['id']?>" name = 'id'>

    </div>

    <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
</form>
<?php
}
?>

</body>
</html>

