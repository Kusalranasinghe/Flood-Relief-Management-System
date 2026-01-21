<?php

include 'database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Reilief Request</title>
</head>

<body>



    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <h2>Flood Reilief Requests</h2>

        <label for="type">Type of Reilief </label>
        <select id="type" name="type">
            <option value="food">Food</option>
            <option value="water">Water</option>
            <option value="medicine">Medicine</option>
            <option value="shelter">Shelter</option>
        </select>

        <label for="district">District</label>
        <input type="text" id="district" name="district" placeholder="Your district..">

        <label for="ds_div">Divisional Secretariat Division</label>
        <input type="text" id="ds_div" name="ds_div" placeholder="Your DS division..">

        <label for="gn_div">Grama Niladari Division</label>
        <input type="text" id="gn_div" name="gn_div" placeholder="Your GN division">

         <label for="name">Person's Name</label>
        <input type="text" id="name" name="name" placeholder="Your name..">

        <label for="telephone">Telephone</label>
        <input type="text" id="telephone" name="telephone" placeholder="Your telephone..">

        <label for="address">Address</label>
        <input type="text" id="address" name="address" placeholder="Your address..">

        <label for="no_of_members">Number of Family Members</label>
        <input type="text" id="no_ofmembers" name="no_ofmembers" placeholder="Number of family members..">

        <label for="sev_level">Flood severity level</label>
        <select id="sev_level" name="sev_level">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>

        <label for="description">Description</label>
        <input type="text" id="description" name="description" placeholder="Description..">


        <input type="submit" value="Submit">
    </form>

</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $type = $_POST['type'];
    $district = $_POST['district'];
    $ds_div = $_POST['ds_div'];
    $gn_div = $_POST['gn_div'];
    $name = $_POST['name'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $no_ofmembers = $_POST['no_ofmembers'];
    $sev_level = $_POST['sev_level'];
    $description = $_POST['description'];

    if (empty($type) || empty($district) || empty($ds_div) || empty($gn_div) || empty($name) || empty($telephone) || empty($address) || empty($no_ofmembers) || empty($sev_level) || empty($description)) {
        echo "<script>alert('All fields are required.');</script>";
        exit;

    }

    else { 
        $sql = "INSERT INTO requests (type, district, ds_div, gn_div, name, telephone, address, no_ofmembers, sev_level, description) VALUES ('$type', '$district', '$ds_div', '$gn_div', '$name', '$telephone', '$address', '$no_ofmembers', '$sev_level', '$description')";

        mysqli_query($conn, $sql);
        echo "<script>alert('Request submitted successfully.');</script>";
    

    mysqli_close($conn);

    }

}
?>