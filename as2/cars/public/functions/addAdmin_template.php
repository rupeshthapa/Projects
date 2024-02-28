<?php
$form = '<form action="/controller/addAdmin_controller.php" method="post">
        
        <label for="name">Name:</label>
        <input type="text"  name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email"  name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password"  name="password" required>
        <br>
        <input type="submit" name="submit" value="Submit">
        </form>';

?>