<?php include("includes/includedfiles.php");

if(isset($_GET['id'])){
	$albumId = $_GET['id'];

}
else {
	header["Location : index.php"];
}
$album = new Album($con,$albumId);
$artist = $album->getArtist();



 ?>
<div class="entityInfo">
	<div class="leftSection">
		<img src="<?php echo $album->getArtworkPath(); ?>">
		

	</div>
	<div class="rightSection">
		<h2><?php echo $album->getTitle();?></h2>
		<p><?php echo $artist->getName();?></p>
		<p><?php echo $album->getNumberofSongs();?> songs</p>


	</div>

</div>

<div class="tracklistContainer">
	<ul class="tracklist">
		<?php
		$songIdArray = $album -> getSongIds();

		$i=1;


		foreach($songIdArray as $songId) {

			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
					<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"".$albumSong->getId() ."\",tempPlaylist,true)'>
					<span class='trackNumber'>$i</span>
					</div>

					<div class='trackInfo'>
						<span class='trackName'>" . $albumSong->getTitle(). "</span>
						<span class='artistName'>" . $albumArtist->getName() . "</span>
					</div>
					
					<div class='trackDuration'>
					<span class='duration'>" . $albumSong->getDuration() . "</span>
					</div>
			</li>";
			$i++;




		}?>
		<script >
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);


		</script>
	</ul>

</div>




