<?php

class Album {

		private $id;
		private $con;
		private $title;
		private $artistId;
		private $genre;
		private $artWorkPath;

		public function __construct($con, $id) {
			$this -> con = $con;
			$this -> id = $id;
			$query = mysqli_query($this->con, "SELECT * FROM albums WHERE id = '$this->id'");
			$album = mysqli_fetch_array($query);

			$this->title = $album['title'];
			$this->artistId = $album['artist'];
			$this->genre = $album['genre'];
			$this->artWorkPath = $album['artWorkPath'];


		}

		public function getTitle() {
			
			return$this->title ;
		}



		public function getArtist() {
			
			return new Artist($this->con,$this->artistId) ;
		}


		public function getGenre() {
			
			return$this->genre ;
		}



		public function getArtWorkPath() {
			
			return$this->artWorkPath;
		}

		public function getNumberofSongs() {
			$query=mysqli_query($this->con, "SELECT id FROM songs WHERE album='$this->id'");
			return mysqli_num_rows($query);
			}

			public function getSongIds() {
				$query = mysqli_query($this->con, "SELECT id FROM songs WHERE album = '$this->id' ORDER BY albumOrder ASC ");
				$array = array();
				while ($row = mysqli_fetch_array($query)){
					array_push($array, $row['id']);
				}
				return $array;
			}



}



 ?>