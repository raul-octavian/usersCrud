
<?php
spl_autoload_register(function ($class)
{require_once"classes/".$class.".php";});

$user = new User();



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>All Users</title>
</head>
<body>


<div class="m-3">
    <h1>All users</h1>
    <a href="newUser.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Add new user</a>
</div>


<?php if(isset($user->message)): ?>

    <div>
        <h3><?php echo $user->message ?></h3>
    </div>

<?php endif  ?>


<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">About</th>
        <th scope="col">Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($user->fetchAllUsers() as $res): ?>
    <tr>
        <th scope="row"></th>
        <td><?php echo $res['username']?></td>
        <td><?php echo $res['fName'] . " " . $res['lName']?></td>
        <td><?php echo $res['email']?></td>
        <td><?php echo $res['description']?></td>
<!--        <td>--><?php //echo $res['ID']?><!--</td>-->
        <td><a href= "updateUser.php?id=<?php echo$res['ID'] ?>" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Edit</a>
            <a href= "deleteUser.php?delete=<?php echo $res['ID']?>" class="btn btn-danger btn-lg active" role="button" aria-pressed="true">Delete</a></td>
    </tr>
    <?php endforeach ?>

    </tbody>
</table>

</body>
</html>

