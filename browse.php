<?php 
include("includes/includedfiles.php");


 ?>

<h1 class="pageHeadingBig">Check out some of my favorite Artists</h1>
<div class="gridViewContainer">
	
	<?php 
	$albumQuery = mysqli_query($con,"SELECT * FROM albums ORDER BY RAND() LIMIT 10");
	while($row = mysqli_fetch_array($albumQuery)){

		echo "<div class='gridViewItem'>

				<span onclick='openPage(\"album.php?id=".$row['id']."\")'>
					<img src='" . $row['artWorkPath'] . "'>

				<div class='gridViewInfo'>" . $row['title'] . "</div>
				</span>
		 		</div>";
	}
	?>

</div>