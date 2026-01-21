<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Reilief Request</title>
</head>

<body>



    <form action="/action_page.php">

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
        <input type="text" id="no_of_members" name="no_of_members" placeholder="Number of family members..">

        <label for="sev_level">Flood severity level</label>
        <select id="sev_level" name="sev_level">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>

        <input type="submit" value="Submit">
    </form>

</body>

</html>