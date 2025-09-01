<?php    
    require "mysqlConnect.php";

    $editData = [
            'userid' => '',
            'name' => '',
            'email' => '',
            'password' => '',
            'role' => '',
            'isblocked' => '',
            'createdat' => ''
        ];
    $editing=false;


    //inserting:

    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['submit'])) {
        $name=$_POST['uname'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $role='Customer';
        $isblocked= (isset($_POST['blocked']))?1:0;
        $createdat=$_POST['date'];

        //TODO: Validation;
            $insertQuery="insert into users(name, email, password, role, isblocked, createdat) 
                          values('$name', '$email', '$password', '$role', '$isblocked', '$createdat')";
            mysqli_query($connection, $insertQuery);
            header("Location:". $_SERVER['PHP_SELF']);
    }

    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['delete'])) {
        $id=$_POST['id'];
        $deleteQuery="delete from users where userid=$id";
        mysqli_query($connection, $deleteQuery);
        header("Location:". $_SERVER['PHP_SELF']);
    }
    
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['edit'])) {
        $id=$_POST['id'];
        $rec=mysqli_query($connection, "select * from users where userid=$id");
        $data=mysqli_fetch_assoc($rec);
        if($data) {
            $editData=$data;
            $editing=true;
        }
        
    echo $editData['name'];
        print_r($editData);
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <style>
        table, td, th{
            border: 3px solid black;
            border-collapse: collapse;
            margin: 20px;
            text-align: center;
            padding: 15px;
        }
        th {
            background: gray;
            color: white; 
        }
        button {
            cursor: pointer;
            margin: 5px;
            padding: auto;
        }

    </style>
</head>
<body>
    <h3>User Manipulation:</h3>
    <form method="post">

        <label>Name of User:</label>
        <input type="text" name="uname" value=<?php echo $editData['name'] ?>><br><br>

        <label>Email:</label>
        <input type="text" name="email" value=<?php echo $editData['email'] ?>><br><br>

        <label>Password:</label>
        <input type="text" name="password" value=<?php echo $editData['password'] ?>><br><br>

        <!-- <label>Role:</label>
        <input type="radio" name="role">Customer
        <input type="radio" name="role">Admin<br><br> -->

        <label>Blocked:</label>
        <input type="checkbox" name="blocked" checked=<?php $editData['isblocked'] ?>><br><br>

        <label>Date:</label>
        <input type="date" name="date" value=<?php echo $editData['createdat'] ?>><br><br>

        <button type="submit" name="submit">Submit</button>
    </form>

    <table>
        <tr>
            <th>Sr No</th>
            <th>User Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>role</th>
            <th>Is Blocked</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
<?php

    $sql="select userid, name, email, password, role, isblocked, createdat from users";
    $result=mysqli_query($connection, $sql);
    $data=mysqli_fetch_all($result, MYSQLI_ASSOC);
    // print_r($data);
    
    $i=1;
    foreach($data as $row) {
        echo "<tr>";
            echo "<td>{$i}</td>";
            echo "<td>{$row['userid']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['password']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td>{$row['isblocked']}</td>";
            echo "<td>{$row['createdat']}</td>";
            echo "<td> <form method='post'><input type='hidden' name='id' value='{$row['userid']}'><button type='submit' name='edit' style='color: white;background: navy'>Edit</button><button type='submit' name='delete' style='color: white;background: darkred'>Remove</button></form></td>";
        echo "</tr>";
        $i++;
    }

    echo "</table>";
?>

</body>
</html>