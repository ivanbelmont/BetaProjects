<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php 
include '../conexion.php';
 $mysqli=conectar(1);

?>
<html>
    <head>
        <title>Music Portfolio Template with HTML5 and jQuery</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Music Portfolio Template and Audio Player with HTML5 and jQuery" />
        <meta name="keywords" content="music, audio, html5, player, playlist, template, portfolio, artist, band, albums, discography, jquery"/>
		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="css/skin.css" type="text/css" media="screen"/>
		<link href="css/jplayer.codrops.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
		<script src="js/jquery.jcarousel.min.js" type="text/javascript"></script>
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
		<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
		<script type="text/javascript">
			Cufon.replace('h2,h3,a',{
				textShadow: '1px 1px 1px #000000'
			});
		</script>
		<script type="text/javascript">
			$(function() {
				/**
				* build the carousel for the Albums
				*/
				$('#mp_albums').jcarousel({
					scroll : 3
				}).children('li')
				  .bind('click',function(){
					//when clicking on an album, display its info, and hide the current one
					var $this = $(this);
					$('#mp_content_wrapper').find('.mp_content:visible')
											.hide();
											
												$('#mp_content_wrapper')
												.find('.mp_content:nth-child('+ parseInt($this.index()+1) +')')
											    .fadeIn(1000);
											
			});

				/****  The Player  ****/
				// Local copy of jQuery selectors, for performance.
				var jpPlayTime = $("#jplayer_play_time");
				var jpTotalTime = $("#jplayer_total_time");
				var $list 		= $("#jplayer_playlist ul");

				/**
				* Innitialize the Player 
				* (see jPlayer documentation for other options)
				*/
				$("#jquery_jplayer").jPlayer({
					oggSupport	: true,
					preload		:"auto"
				})
				.jPlayer("onProgressChange", 
					function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {
					jpPlayTime.text($.jPlayer.convertTime(playedTime));
					jpTotalTime.text($.jPlayer.convertTime(totalTime));
				})
				.jPlayer("onSoundComplete", function() {
					playListNext();
				});

				/**
				* click previous button, plays previous song
				*/
				$("#jplayer_previous").bind('click', function(){
					playListPrev();
					$(this).blur();
					return false;
				});

				/**
				* click next button, plays next song
				*/
				$("#jplayer_next").bind('click', function() {
					playListNext();
					$(this).blur();
					return false;
				});

				/**
				* plays song in position i of the list of songs (playlist)
				*/
				function playSong(i){
					var $next_song 		= $list.find('li:nth-child('+ i +')');
					var mp3				= $next_song.find('.mp_mp3').html();
					var ogg				= $next_song.find('.mp_ogg').html();
					$list.find('.jplayer_playlist_current').removeClass("jplayer_playlist_current");
					$next_song.find('a').addClass("jplayer_playlist_current");
					$("#jquery_jplayer").jPlayer("setFile", mp3, ogg).jPlayer("play");
				}

				/**
				* plays the next song in the playlist
				*/
				function playListNext() {
					var $list_nmb_elems = $list.children().length;
					var $curr 			= $list.find('.jplayer_playlist_current');
					var idx				= $curr.parent().index();
					var index 			= (idx < $list_nmb_elems-1) ? idx+1 : 0;
					playSong(index+1);
				}

				/**
				* plays the previous song in the playlist
				*/
				function playListPrev() {
					var $list_nmb_elems = $list.children().length;
					var $curr 			= $list.find('.jplayer_playlist_current');
					var idx				= $curr.parent().index();
					var index 			= (idx-1 >= 0) ? idx-1 : $list_nmb_elems-1;
					playSong(index+1);
				}
				
				/**
				* User clicks the play icon on one of the songs listed for an Album.
				* Adds it to the Playlist, and plays it
				*/
				function addFirst(song_idx,name,mp3,ogg) {
					$list.empty();
					/**
					* each song element in the playlist has:
					* - span for the close / remove action
					* - the mp3 path
					* - the ogg path
					*/
					var song_html = "<a href='#' class='jplayer_playlist_current' tabindex='1'>" + name + "</a>";
					song_html 	 += "<span></span>";
					song_html 	 += "<div class='mp_mp3' style='display:none;'>"+mp3+"</div>";
					song_html 	 += "<div class='mp_ogg' style='display:none;'>"+ogg+"</div>";
					var $listItem = $("<li/>",{
						id			: song_idx,	
						className	: 'jplayer_playlist_current',
						html 		: song_html
					});
					$list.append($listItem);
					//event to play the song when User clicks on it
					$listItem.find('a').bind('click',clickSong);
					//event to remove the song from the playlist when User clicks the remove button
					$listItem.find('span').bind('click',removeSong);
					//start playing it
					$("#jquery_jplayer").jPlayer("setFile", mp3, ogg).jPlayer("play");
					jpTotalTime.show();
					jpPlayTime.show();
				}
				
				/**
				* adds a song to the playlist, if not there already.
				* if it is the only one, start playing it
				*/
				function addToPlayList(song_idx,name,mp3,ogg) {
					var $list_nmb_elems = $list.children().length;
					//if already in the list return
					if($list.find('#'+song_idx).length)
						return;
					//class for the current song being played
					var c = '';
					if($list_nmb_elems == 0)
						c = 'jplayer_playlist_current';
					var song_html = "<a href='#' class="+c+" tabindex='1'>" + name + "</a>";
					song_html 	 += "<span></span>";
					song_html 	 += "<div class='mp_mp3' style='display:none;'>"+mp3+"</div>";
					song_html 	 += "<div class='mp_ogg' style='display:none;'>"+ogg+"</div>";
					var $listItem = $("<li/>",{
						id			: song_idx,	
						html 		: song_html
					});
					$list.append($listItem);
					//if its the only song play it
					if($list_nmb_elems == 0){
						$("#jquery_jplayer").jPlayer("setFile", mp3, ogg).jPlayer("play");
						jpTotalTime.show();
						jpPlayTime.show();
					}
					$listItem.find('a').bind('click',clickSong);
					$listItem.find('span').bind('click',removeSong);
				}
				
				/**
				* removes a song from the playlist.
				* if the song was the current one, and there are more songs 
				* in the playlist, then plays the next one.
				* if there are no more, stops the player, and removes the status bar
				* otherwise keeps playing whatever song was being played
				*/
				function removeSong() {
					var $this 	= $(this); 
					var current = $this.parent().find('a.jplayer_playlist_current').length;
					$this.parent().remove();
					var $list_nmb_elems = $list.children().length;
					if($list_nmb_elems > 0 && current)
						playListNext();
					else if($list_nmb_elems == 0){
						$("#jquery_jplayer").jPlayer("clearFile");
						jpTotalTime.hide();
						jpPlayTime.hide();
					}	
					return false;
				}
				
				/**
				* User clicks on a song in the playlist. Plays it
				*/
				function clickSong() {
						var index = $(this).parent().index();
						playSong(index+1);
						return false;
				}
				
				/**
				* The next are the events for clicking on both "play" and "add to playlist" icons
				*/
				$('#mp_content_wrapper').find('.mp_play').bind('click',function(){
					var $this 		= $(this);
					var $paths		= $this.parent().siblings('.mp_song_info');
					var title   	= $paths.find('.mp_song_title').html();
					var mp3			= $paths.find('.mp_mp3').html();
					var ogg			= $paths.find('.mp_ogg').html();
					var album_id 	= $this.closest('.mp_content').attr('id');
					var song_index	= $this.parent().parent().index();
					var song_idx	= album_id + '_' + song_index;
					//add to playlist and play the song
					addFirst(song_idx,title,mp3,ogg);
				});
				$('#mp_content_wrapper').find('.mp_addpl').bind('click',function(){
					var $this 		= $(this);
					var $paths		= $this.parent().siblings('.mp_song_info');
					var title   	= $paths.find('.mp_song_title').html();
					var mp3			= $paths.find('.mp_mp3').html();
					var ogg			= $paths.find('.mp_ogg').html();
					var album_id 	= $this.closest('.mp_content').attr('id');
					var song_index	= $this.parent().parent().index();
					var song_idx	= album_id + '_' + song_index;
					//add to playlist and play the song if none is there
					addToPlayList(song_idx,title,mp3,ogg);
				});
				
				/**
				* we want to show on the album image, the play button for playing the whole album
				*/
				$('#mp_content_wrapper').find('.mp_content').bind('mouseenter',function(){
					var $this 		= $(this);
					$this.find('.mp_playall').show();
				}).bind('mouseleave',function(){
					var $this 		= $(this);
					$this.find('.mp_playall').hide();
				});
				
				/**
				* to play the whole album, we play the first song and add all the others to the playlist.
				* playing the first one, guarantees us that the playlist is set to empty before
				*/
				$('#mp_content_wrapper').find('.mp_playall').bind('click',function(){
					var $this 		= $(this);
					var $album		= $this.parent();
					$album.find('.mp_play:first').trigger('click');
					$album.find('.mp_addpl').trigger('click');
				})
				
				/**
				* playlist songs can be reordered
				*/
				$list.sortable();
				$list.disableSelection();
				
			});
		</script>
        <style>
			.reference{
				font-family:Arial;
				position:relative;
				width:100%;
				font-size:12px;
				text-transform:uppercase;
				text-align:center;
			}
			.reference a{
				color:#f9f9f9;
				text-decoration:none;
				margin-right:20px;
			}
		</style>
    </head>
    <body>
		<div class="mp_wrapper">
			<div id="mp_content_wrapper" class="mp_content_wrapper">
			<?php
			   $mysqli->real_query ('SELECT * FROM  `Spotify_album` order by nombre DESC');
			    $resultado = $mysqli->use_result();
				  while ($fila = $resultado->fetch_object())
           {
		   ?>
		   <div class="mp_content" id='album_<?php echo $fila->id; ?>'; 
		   <?php
		  $principal=$fila->Principal;
		  IF($principal==1)
		  {
		  echo "";
		  
		  }
		  else
		  {
		  echo 'style="display:none;"';
		  }
		   
		   ?>
		   >
					<img src="img_Album/<?php echo $fila->id; ?>.jpg" alt="<?php echo $fila->nombre; ?>"/>
					<a href="#" class="mp_playall">Play all</a>
					<div class="mp_description">
						<h2><?php echo ucwords($fila->nombre); ?></h2>
						<p>
							<?php echo ucwords($fila->Descripcion); ?>
						</p>
					</div>
					<div class="mp_songs">
						<div>
							<h3>Our Resolve</h3>
							<div class="mp_options">
								<span class="mp_play">Play</span>
								<span class="mp_addpl">Add to playlist</span>
							</div>
							<div class="mp_song_info" style="display:none;">
								<span class="mp_song_title">Our Resolve</span>
								<span class="mp_mp3">music/album1/ramblinglibrarian_-_Our_Resolve.mp3</span>
								<span class="mp_ogg">music/album1/ramblinglibrarian_-_Our_Resolve.ogg</span>
							</div>
						</div>
						<div>
							<h3>How do I make you see</h3>
							<div class="mp_options">
								<span class="mp_play">Play</span>
								<span class="mp_addpl">Add to playlist</span>
							</div>
							<div class="mp_song_info" style="display:none;">
								<span class="mp_song_title">How do I make you see</span>
								<span class="mp_mp3">music/album1/ramblinglibrarian_-_Rock_Version_-_How_Do_I_Make_You_See_1.mp3</span>
								<span class="mp_ogg">music/album1/ramblinglibrarian_-_Rock_Version_-_How_Do_I_Make_You_See_1.ogg</span>
							</div>
						</div>
						<div>
							<h3>BurningIdolStickerbrushSymphony</h3>
							<div class="mp_options">
								<span class="mp_play">Play</span>
								<span class="mp_addpl">Add to playlist</span>
							</div>
							<div class="mp_song_info" style="display:none;">
								<span class="mp_song_title">BurningIdolStickerbrushSymphony</span>
								
								<span class="mp_mp3">http://valeriussoftware.890m.com/Ejemplos/Archivos/Musica/BurningIdolStickerbrushSymphony.mp3</span>
								<span class="mp_ogg">http://valeriussoftware.890m.com/Ejemplos/Archivos/Musica/BurningIdolStickerbrushSymphony.ogg</span>
							</div>
						</div>
					</div>
					</div>
		   <?php
		  // echo $fila->nombre;
		   }
			?>
			</div>
			
			<div class="mp_player">
				<div id="jquery_jplayer"></div>
				<div class="jp-playlist-player">
					<div class="jp-interface">
						<ul class="jp-controls">
							<li><a href="#" id="jplayer_play" class="jp-play" tabindex="1">play</a></li>
							<li><a href="#" id="jplayer_pause" class="jp-pause" tabindex="1">pause</a></li>
							<li><a href="#" id="jplayer_stop" class="jp-stop" tabindex="1">stop</a></li>
							<li><a href="#" id="jplayer_volume_min" class="jp-volume-min" tabindex="1">min volume</a></li>
							<li><a href="#" id="jplayer_volume_max" class="jp-volume-max" tabindex="1">max volume</a></li>
							<li><a href="#" id="jplayer_previous" class="jp-previous" tabindex="1">previous</a></li>
							<li><a href="#" id="jplayer_next" class="jp-next" tabindex="1">next</a></li>
						</ul>
						<div class="jp-progress">
							<div id="jplayer_load_bar" class="jp-load-bar">
								<div id="jplayer_play_bar" class="jp-play-bar"></div>
							</div>
						</div>
						<div id="jplayer_volume_bar" class="jp-volume-bar">
							<div id="jplayer_volume_bar_value" class="jp-volume-bar-value"></div>
						</div>
						<div id="jplayer_play_time" class="jp-play-time"></div>
						<div id="jplayer_total_time" class="jp-total-time"></div>
					</div>
					<div id="jplayer_playlist" class="jp-playlist"><ul></ul></div>
				</div>
			</div>
			<div class="mp_player">
			<a>Agregar Pistas</a>
			<a>Agregar Album</a>
			</div>
			<ul id="mp_albums" class="mp_albums jcarousel-skin">
            <?php 			
			$mysqli->real_query ('SELECT * FROM  `Spotify_album` order by nombre DESC');
			    $resultado = $mysqli->use_result();
				  while ($fila = $resultado->fetch_object())
           {
		   ?>
		   <li><img src="img_Album/thumb<?php echo $fila->id; ?>.jpg" alt="<?php echo $fila->nombre; ?>" /></li>
		    
		   <?php
		   }
		   ?>
			</ul>
		</div>
<!-- <iframe src="https://onedrive.live.com/embed?cid=4C82A0FC9E7726E1&resid=4C82A0FC9E7726E1%21217&authkey=AMfp7oXQLkQpPqU" width="98" height="120" frameborder="0" scrolling="no"></iframe>-->
   <iframe src="https://drive.google.com/file/d/0B8fM7TgcS3c1RVVkRTZReHZMZVU/preview" width="200" height="200"></iframe>
  <!-- <iframe src="https://embed.spotify.com/?uri=spotify%3Atrack%3A0C9Rd7s2wQggmMBCu4BSKf" width="300" height="380" frameborder="0" allowtransparency="true"></iframe>-->
	</body>
</html>