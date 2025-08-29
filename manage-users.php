<?php
$conn = mysqli_connect("localhost", "root", "", "unit4_practice");

$editMode = false;
$editData = [
    'userid' => '',
    'name' => '',
    'email' => '',
    'password' => '',
    'role' => '',
    'isblocked' => '',
    'createdat' => ''
];

// Handle Edit
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit'])) {
    $id = $_POST['action_id'];
    $sql = "SELECT * FROM users WHERE userid = $id";
    $res = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($res);
    if ($user) {
        $editMode = true;
        $editData = $user;
    }
}

// Handle Delete
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $id = $_POST['action_id'];
    $sql = "DELETE FROM users WHERE userid = $id";
    mysqli_query($conn, $sql);
    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();
}

// Handle Submit (Insert or Update)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $name = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'Customer';
    $isBlocked = isset($_POST['blocked']) ? 1 : 0;
    $date = $_POST['date'];

    if (!empty($_POST['edit_userid'])) {
        // Update
        $id = $_POST['edit_userid'];
        $sql = "UPDATE users SET name='$name', email='$email', password='$password', role='$role', isblocked='$isBlocked', createdat='$date' WHERE userid=$id";
        mysqli_query($conn, $sql);
    } else {
        // Insert
        $sql = "INSERT INTO users (name, email, password, role, isblocked, createdat)
                VALUES ('$name', '$email', '$password', '$role', '$isBlocked', '$date')";
        mysqli_query($conn, $sql);
    }

    header("Location: " . $_SERVER['PHP_SELF']); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <style>
        table, th, td {
            border: 1px solid;
            border-collapse: collapse;
            text-align: center;
            margin: 30px;
            padding: 10px;
        }
        th {
            background: black;
            color: white;
        }
        button {
            margin: 4px;
            cursor: pointer;
        }
        #delete {
            background: red;
            color: white;
        }
        #edit {
            background: blue;
            color: white;
        }
    </style>
</head>
<body>
    <h3>User Manipulation:</h3>
    <form method="post">
        <input type="hidden" name="edit_userid" value="<?= $editMode ? $editData['userid'] : '' ?>">

        <label>Name of User:</label>
        <input type="text" name="uname" value="<?= $editData['name'] ?>"><br><br>

        <label>Email:</label>
        <input type="text" name="email" value="<?= $editData['email'] ?>"><br><br>

        <label>Password:</label>
        <input type="text" name="password" value="<?= $editData['password'] ?>"><br><br>

        <label>Role:</label>
        <input type="radio" name="role" value="Customer" <?= $editData['role'] === 'Customer' ? 'checked' : '' ?>>Customer
        <input type="radio" name="role" value="Admin" <?= $editData['role'] === 'Admin' ? 'checked' : '' ?>>Admin<br><br>

        <label>Blocked:</label>
        <input type="checkbox" name="blocked" <?= $editData['isblocked'] ? 'checked' : '' ?>><br><br>

        <label>Date:</label>
        <input type="date" name="date" value="<?= $editData['createdat'] ?>"><br><br>

        <button type="submit" name="submit"><?= $editMode ? "Update" : "Submit" ?></button>
    </form>

    <?php
    // Display Users
    $sql = "SELECT * FROM users";
    $res = mysqli_query($conn, $sql);
    $records = mysqli_fetch_all($res, MYSQLI_ASSOC);

    if (!empty($records)) {
        echo "<table>
            <tr>
                <th>SrNo</th>
                <th>UserId</th>
                <th>UserName</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>IsBlocked</th>
                <th>CreatedAt</th>
                <th>Action</th>
            </tr>";

        $i = 1;
        foreach ($records as $rec) {
            echo "<tr>
                <td>{$i}</td>
                <td>{$rec['userid']}</td>
                <td>{$rec['name']}</td>
                <td>{$rec['email']}</td>
                <td>{$rec['password']}</td>
                <td>{$rec['role']}</td>
                <td>{$rec['isblocked']}</td>
                <td>{$rec['createdat']}</td>
                <td>
                    <form method='post'>
                        <input type='hidden' name='action_id' value='{$rec['userid']}'>
                        <button type='submit' name='edit' id='edit'>Edit</button>
                        <button type='submit' name='delete' id='delete'>Delete</button>
                    </form>
                </td>
            </tr>";
            $i++;
        }

        echo "</table>";
    } else {
        echo "<p>No Data Available</p>";
    }
    ?>
</body>
</html>
