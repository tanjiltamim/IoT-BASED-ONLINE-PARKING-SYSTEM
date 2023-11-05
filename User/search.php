<?php

include '../connect.php';
$sql = "SELECT * FROM parkingplace WHERE thana LIKE '%".$_POST['location']."%' OR fulladdress LIKE '%".$_POST['location']."%'";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0){
	while ($row=mysqli_fetch_assoc($result)) {
        $id = $row['id'];
		echo "	<tr>
		          <td>".$row['thana']."  </td>
		          <td>".$row['fulladdress']."  </td>
		          <td>Ward No: ".$row['ward']."  </td>
                  <td>
                    <button><a href='parking_status.php?placeid=" . $id . "'>View</a></button>
                  </td>
		        </tr>";
	}
}
else{
	echo "<tr><td>This location is not added yet.</td></tr>";
}

?>