
<?php 
//p;aylist converted to json
$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
$resultArray=array();
while($row=mysqli_fetch_array($songQuery)) {
	array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray); 


?>

<script>
	

	$(document).ready(function(){
		currentPlaylist = <?php echo $jsonArray; ?>;
		audioElement = new Audio();
		setTrack(currentPlaylist[0], currentPlaylist, false);
		updateVolumeProgressBar(audioElement.audio);

		$("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e){
			e.preventDefault();
		})


	$(".playbackBar .progressBar").mousedown(function(){
	mouseDown = true;
});

	$(".playbackBar .progressBar").mousemove(function(e){
		if(mouseDown){
			//set time of song, depending on position of mouse
			timeFromOffSet(e, this);
		}
});
	$(".playbackBar .progressBar").mouseup(function(e){
		
			timeFromOffSet(e, this);
		
});


	$(".volumeBar .progressBar").mousedown(function(){
	mouseDown = true;
});



	$(".volumeBar .progressBar").mousemove(function(e){
		var percentage = e.offsetX/$(this).width();
		if(mouseDown){
			if(percentage>=0 && percentage<=1){

			audioElement.audio.volume=percentage;

			}
					}
});
	$(".volumeBar .progressBar").mouseup(function(e){
		var percentage = e.offsetX/$(this).width();
		if(mouseDown){
			if(percentage>=0 && percentage<=1){

			audioElement.audio.volume=percentage;

			}
					}
		
});
	$(document).mouseup(function(){
		mouseDown=false;
	})

});
	function timeFromOffSet(mouse, progressBar){
		var percentage = mouse.offsetX/$(progressBar).width()*100;
		var seconds = audioElement.audio.duration * (percentage/100);
		audioElement.setTime(seconds);
	}

	function prevSong() {
		if(audioElement.audio.currentTime >=3 || currentIndex ==0) {
			audioElement.setTime(0);
		}
		else {
			currentIndex = currentIndex - 1;
			setTrack(currentPlaylist[currentIndex], currentPlaylist,true);
		}
	}


	function nextSong() {
		if(repeat==true) {
			audioElement.setTime(0);
			playSong();
			return;
		}
		if(currentIndex == currentPlaylist.length - 1){
			currentIndex=0;
		}
		else {
			currentIndex++;
		}
		var trackToPlay = currentPlaylist[currentIndex];
	setTrack(trackToPlay, currentPlaylist, true);
	}

	function setRepeat() {
		repeat = !repeat;
		var imageName = repeat ? "repeat-active.png": "repeat.png";
		$(".controlButton.repeat img").attr("src", "assets/images/icons/"+ imageName);
	}


	function setMute() {
		audioElement.audio.muted=!audioElement.audio.muted;
		var imageName = audioElement.audio.muted ? "volume-mute.png": "volume.png";
		$(".controlButton.volume img").attr("src", "assets/images/icons/"+ imageName);
	}




	function setTrack(trackId, newPlaylist,play) {
		currentIndex = currentPlaylist.indexOf(trackId);
		pauseSong();
		
		$.post("includes/handlers/Ajax/getSongJson.php", {songId:trackId}, function(data){

		
		var track = JSON.parse(data);
		$(".trackName span").text(track.title);

		$.post("includes/handlers/Ajax/getArtistJson.php", {artistId:track.artist}, function(data) {
			var artist = JSON.parse(data);
			$(".artistName span").text(artist.name);
			$(".artistName span").attr("onclick", "openPage('artist.php?id=" + artist.id +"')");

		});

		$.post("includes/handlers/Ajax/getAlbumJson.php", {albumId:track.album}, function(data) {
			var album = JSON.parse(data);
			$(".albumLink img").attr("src", album.artWorkPath);
			$(".albumLink img").attr("onclick", "openPage('album.php?id=" + album.id +"')");
			$(".trackName span").attr("onclick", "openPage('album.php?id=" + album.id +"')");

		});

		audioElement.setTrack(track.path);
		
				if(play) {
					playSong();
		}

		});
		
		
	}

	function playSong(){
		$('.controlButton.play').hide();
		$('.controlButton.pause').show();
		audioElement.play();
	}
	function pauseSong(){
		$('.controlButton.play').show();
		$('.controlButton.pause').hide();
		audioElement.pause();
	}
	</script>


<div id ="nowPlayingBarContainer">
<p class="mobileText" >Visit on desktop to get full experience</p>
	<div id="nowPlayingBar">
		<div id="nowPlayingLeft">
			<div class="content">
				<span role="link"class="albumLink">
					<img src=""class="albumArtwork">
				</span>
					<div class="trackInfo">
						<span class="trackName">
							<span role="link"></span>
						</span>
						<span class="artistName">
							<span role="link"></span>
						</span>
					</div>


			</div>
		</div>
		<div id="nowPlayingCenter">
			<div class="content playerControls">
				
				<div class="buttons">
					<button class="controlButton shuffle" title="shuffle button">
						<img src="assets/images/icons/shuffle.png" alt="shuffle">
					</button>
					<button class="controlButton previous" title="previous button" onclick="prevSong()">
						<img src="assets/images/icons/previous.png" alt="previous">
					</button>
					<button class="controlButton play" title="play button" onclick="playSong()">
						<img src="assets/images/icons/play.png" alt="play">
					</button>
					<button class="controlButton pause" title="pause button"style="display: none;" onclick="pauseSong()">
						<img src="assets/images/icons/pause.png" alt="pause">
					</button>
					<button class="controlButton next" title="next button" onclick="nextSong()">
						<img src="assets/images/icons/next.png" alt="next">
					</button>
					<button class="controlButton repeat" title="repeat button" onclick="setRepeat()">
						<img src="assets/images/icons/repeat.png" alt="repeat">
					</button>

				</div>
				<div class="playbackBar">
					<span class="progressTime current">0.00</span>
					<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress"></div>
						</div>
					</div>
					<span class="progressTime remaining">0.00</span>
				</div>
			</div>
		</div>
		<div id="nowPlayingRight">

			<div class="volumeBar">
				<button class="controlButton volume" title="volume button" onclick="setMute()">
					<img src="assets/images/icons/volume.png" alt="volume">
				</button>
				<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress"></div>
						</div>

			</div>
			
		</div>
	</div>