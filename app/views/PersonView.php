<!DOCTYPE html>
<html>
<head>
    <title>Simple Person Manager</title>
</head>
<body>
    <h1>Person List</h1>
    <ul>
        
        <?php foreach ($allPersons as $person): ?>
            <li><?php echo $person['firstName']; ?></li>
        <?php endforeach; ?>
    </ul>
    <form action="index.php" method="post">
        <input type="text" name="newPerson" placeholder="Enter a new person">
        <input type="submit" value="Add Person">
    </form>
</body>
</html>
