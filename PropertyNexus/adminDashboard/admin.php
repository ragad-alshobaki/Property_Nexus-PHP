<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <style>
        .container {
            padding: 10px;
            width: 1250px;
        }
        .empty {
            height: 50px;
        }
        .modal-backdrop.show {
            display: none;
            opacity: var(--bs-backdrop-opacity);
        }
        .subContainer {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 20px;
        }
        h2 {
            font-size: 3.5rem;
        }
        button {
            height: 50px;
            margin-top: 25px;
        }
    </style>
</head>
<body>

<?php

include("connection.php");

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Form handling
if (isset($_POST['addusr'])) {
    $fname = mysqli_real_escape_string($db_conn, $_POST['userFname']);
    $lname = mysqli_real_escape_string($db_conn, $_POST['userLname']);
    $pw = mysqli_real_escape_string($db_conn, $_POST['userPW']);
    $email = mysqli_real_escape_string($db_conn, $_POST['userEmail']);
    $adress = mysqli_real_escape_string($db_conn, $_POST['userAdress']);
    $mobile = mysqli_real_escape_string($db_conn, $_POST['userMobile']);
    $isAdmin = (int)$_POST['isAdmin'];

    if (empty($fname) || empty($lname) || empty($pw) || empty($email) || empty($mobile)) {
        header('Location: database.php');
        exit();
    } else {
        $insert_Q = "INSERT INTO users (userFname, userLname, userAdress, userPW, userMobile, userEmail, isAdmin) VALUES ('$fname', '$lname', '$adress', '$pw', '$mobile', '$email', '$isAdmin')";
        if (mysqli_query($db_conn, $insert_Q)) {
            header('Location: database.php');
        } else {
            die("Query Failed: " . mysqli_error($db_conn));
        }
        exit();
    }
}
?>

<!-- Bootstrap table -->
<div class="container">
    <div class="subContainer">
        <div class="empty"></div>
        <h2>Users</h2>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUsrModal">Add User</button>
    </div>
    
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User First Name</th>
                <th>User Last Name</th>
                <th>Mobile Number</th>
                <th>Email Address</th>
                <th>Admin Status</th>
                <th>Activity</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $select_Q = "SELECT * FROM users";
                $select_r = mysqli_query($db_conn, $select_Q);
                $counter = 1; 
                while ($rec = mysqli_fetch_assoc($select_r)) {
                    $userID = $rec['userID'];
                    echo "
                        <tr>
                            <td>{$counter}</td>
                            <td>{$rec['userFname']}</td>
                            <td>{$rec['userLname']}</td>
                            <td>{$rec['userMobile']}</td>
                            <td>{$rec['userEmail']}</td>
                            <td>" . ($rec['isAdmin'] ? 'Admin' : 'User') . "</td>
                            <td>
                                <button class='btn btn-warning btn-sm edit-btn' data-id='{$userID}' data-bs-toggle='modal' data-bs-target='#editUserModal'>
                                    <i class='fa-solid fa-pen fa-lg'></i>
                                </button>
                                <button class='btn btn-danger btn-sm delete-btn' data-id='{$userID}'>
                                    <i class='fa-solid fa-trash fa-lg'></i>
                                </button>
                                <button class='btn btn-info btn-sm toggle-admin-btn' data-id='{$userID}' data-isadmin='{$rec['isAdmin']}'>
                                    <i class='fa-solid fa-user-shield fa-lg'></i>
                                </button>
                            </td>
                        </tr>";
                        $counter++;
                }

            ?>
        </tbody>
    </table>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUsrModal" tabindex="-1" aria-labelledby="addUsrModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="addUsrModalLabel"><b>Add User Information</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="admin.php" method="POST">
                        <div class="form-group">
                            <label for="userFname">First Name</label>
                            <input type="text" name="userFname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="userLname">Last Name</label>
                            <input type="text" name="userLname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="userPW">User Password</label>
                            <input type="password" name="userPW" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email</label>
                            <input type="email" name="userEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="userAdress">Address</label>
                            <input type="text" name="userAdress" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="userMobile">Mobile Number</label>
                            <input type="text" name="userMobile" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="isAdmin">Admin Status</label>
                            <select name="isAdmin" class="form-control" required>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-success" name="addusr" value="ADD">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="editUserModalLabel"><b>Edit User Information</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="POST">
                        <input type="hidden" id="editUserID" name="userID">
                        <div class="form-group">
                            <label for="editUserFname">First Name</label>
                            <input type="text" id="editUserFname" name="userFname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editUserLname">Last Name</label>
                            <input type="text" id="editUserLname" name="userLname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editUserPW">Password</label>
                            <input type="password" id="editUserPW" name="userPW" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="editUserEmail">Email</label>
                            <input type="email" id="editUserEmail" name="userEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editUserAdress">Address</label>
                            <input type="text" id="editUserAdress" name="userAdress" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editUserMobile">Mobile Number</label>
                            <input type="text" id="editUserMobile" name="userMobile" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-success" name="updUser" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
$(document).ready(function() {
    // Populate Edit Modal with User Data
    $('.edit-btn').on('click', function() {
        var userID = $(this).data('id');
        
        $.ajax({
            url: 'get_user.php',
            method: 'POST',
            data: { userID: userID },
            dataType: 'json',
            success: function(data) {
                $('#editUserID').val(data.userID);
                $('#editUserFname').val(data.userFname);
                $('#editUserLname').val(data.userLname);
                $('#editUserEmail').val(data.userEmail);
                $('#editUserAdress').val(data.userAdress);
                $('#editUserMobile').val(data.userMobile);
                $('#editUserPW').val(data.userPW); // Optional: If you want to include the password in the modal
            }
        });
    });

    // Handle Edit Form Submission
    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'edit_user.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                swal("Success", response, "success").then(function() {
                    location.reload();
                });
            },
            error: function(response) {
                swal("Error", response, "error");
            }
        });
    });

    // Handle Delete Button Click
    $('.delete-btn').on('click', function() {
        var userID = $(this).data('id');

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'delete_user.php',
                    method: 'POST',
                    data: { userID: userID },
                    success: function(response) {
                        swal("Deleted!", response, "success").then(function() {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        swal("Error", response, "error");
                    }
                });
            } else {
                swal("Your user data is safe!");
            }
        });
    });

    // Handle Toggle Admin Button Click
    $('.toggle-admin-btn').on('click', function() {
        var userID = $(this).data('id');
        var isAdmin = $(this).data('isadmin') ? 0 : 1;

        $.ajax({
            url: 'toggle_admin.php',
            method: 'POST',
            data: { userID: userID, isAdmin: isAdmin },
            success: function(response) {
                swal("Success", response, "success").then(function() {
                    location.reload();
                });
            },
            error: function(response) {
                swal("Error", response, "error");
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    // Assume the logged-in user's ID is stored in a session and passed to the JavaScript.
    var loggedInUserID = <?php echo $_SESSION['userID']; ?>;

    // Handle Delete Button Click
    $('.delete-btn').on('click', function() {
        var userID = $(this).data('id');

        // Check if the user ID being deleted is the logged-in user's ID
        if (userID == loggedInUserID) {
            swal({
                title: "Warning!",
                text: "You cannot delete your own account!",
                icon: "warning",
                dangerMode: true,
            });
            return;
        }

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: 'delete_user.php',
                    method: 'POST',
                    data: { userID: userID },
                    success: function(response) {
                        swal("Deleted!", response, "success").then(function() {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        swal("Error", response, "error");
                    }
                });
            } else {
                swal("Your user data is safe!");
            }
        });
    });
});
</script>

</body>
</html>
