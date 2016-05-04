<?php
require 'config.php';

if ($_POST['txtUsername'] != $show_answers_user || $_POST['txtPassword'] != $show_answers_pass) {

    ?>

    <h1>Login</h1>

    <form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p><label for="txtUsername">Username:</label>
            <br /><input type="text" title="Enter your Username" name="txtUsername" /></p>

        <p><label for="txtpassword">Password:</label>
            <br /><input type="password" title="Enter your password" name="txtPassword" /></p>

        <p><input type="submit" name="Submit" value="Login" /></p>

    </form>

    <?php

}
else {
    ?>
    <html>
    <head>
        <title>
            Results
        </title>
    </head>
    <style>
        table {
            border-spacing: 0 3px;
        }
        table .c {
            width: 90px;
        }
        table td {
            border-bottom: 2px solid black;
            height:100%;
        }
        table tr {
            border: black 2px solid;
            height:30px;
        }
        img {
            max-width: 100%;
            max-height: 30px;
        }
    </style>
    <body><table>
    <?php
    require './sql_connect.php';
    $result = $mysqli->query("SELECT * FROM `AnswersA`");
    if ($result->num_rows > 0) {
        $yimg = '<img src="https://cdn4.iconfinder.com/data/icons/icocentre-free-icons/137/f-check_256-128.png">';
        $nimg = '<img src="Delete.png">';
        while($row = $result->fetch_assoc()) {
            //<td>" . $row["session_id"] . "</td>
            echo "<tr><td>" . ($row["answer"] ? $yimg : $nimg) . '</td><td class="c" style="background-color: #' . $row["color_a"] . ';"></td><td class="c" style="background-color: #' . $row["color_b"] . ';"></td>';
        }
    }
    ?>
    </table>
    </body>
        <?php

}

?>

