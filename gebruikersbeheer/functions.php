<?php  
function getAllUsers() {

	$conn = mysqli_connect("localhost", "root", "", "insights_db");
	if ($conn-> connect_error) {
		die("Connection failed:". $conn-> connect_error);
	}
	$sql = "SELECT userName, firstname, lastname, role FROM user";
	$result = $conn-> query($sql);
	if ($result-> num_rows > 0) {
		while ($row = $result-> fetch_assoc()) {
			echo "<tr><td>". $row["userName"] ."</td><td>". $row["firstname"] ."</td><td>". $row["lastname"] ."</td><td>". $row["role"] ."<td class='icon-cell'><i class='fas fa-pencil-alt glyph-icon'></i><i class='fas fa-trash-alt glyph-icon'></i>". "</td></tr>";
		}
		echo "</table>";
	}
	else {
		echo "Gebruikersoverzicht is leeg";
	}

	$conn->	close();
}
?>