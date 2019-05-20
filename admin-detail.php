<?php require 'header.php';


if (!isset($_SESSION['id'])) {
    die("I'm sorry, this page is only available for Administrators");
}



?>
    <div>
        <h1>Admin Detail Page</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet aut blanditiis ea ipsum,
            iure iusto maxime natus nihil odit porro quasi quo, quod sed similique sit, ullam voluptas? Consequuntur, rerum?</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid distinctio ea expedita modi nihil placeat possimus quaerat,
            reiciendis suscipit vel! Dolores harum libero veritatis. Cum debitis dicta nisi soluta velit?</p>
    </div>














<?php require 'footer.php'; ?>