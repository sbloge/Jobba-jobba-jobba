<html lang="sv">

	<head>
		<script src="Slide.js"></script>
		<link rel="stylesheet" href="test.css">
	</head>
	<body>
		<div class="main">
			<div class="content">
				<div class="images">
					<?php
						//Read all files in image folder
						$files = glob('imgs/' . "*");
						$count = count($files);

						//For every file in the image folder load the file
						foreach($files as $img) {
							echo "<img src=".$img.">";
						}

					?>
				</div>
			</div>	
			<div class="bar">
				<div class="top">
					<h1>test</h1>
				</div>

				<!-- This is the weather client -->
				<div class="bottom">
					<a class="weatherwidget-io" href="https://forecast7.com/sv/62d9317d79/kramfors/" data-label_1="KRAMFORS" data-theme="original" >KRAMFORS</a>
					<script>
						!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];
						if(!d.getElementById(id)){
						js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}
						(document,'script','weatherwidget-io-js');
					</script>
				</div>
			</div>
		</div>
		<?php
			//Load aftonbladets RSS feed
			$url = "https://rss.aftonbladet.se/rss2/small/pages/sections/senastenytt";

			$feeds = simplexml_load_file($url);

			$i = 0;

			if(!empty($feeds)){

				$site = $feeds->channel->title;
				echo "<div class='news'>";
				echo ($site);
				echo "<br/>";

					echo "<div class='post'>";
						
					//Load a new div for each article
					foreach($feeds->channel->item as $item) {

						if($i>=8) break;

						//Open new div for images
						echo "<div class='images'>";
	
							//Get the images
							echo "<img src=".$item->enclosure['url'].">";
						
						//Close the image div
						echo "</div>";
						
						//Display the news text
						echo "<div class='text'>";

							//Get the headline
							echo "<h2>".$item->title."</h1>";
					
							//Get more description and make it max 30 characters long
							echo "<h4>".implode(' ', array_slice(explode(' ', $item->description), 0 , 30)) . "..."."</h4>";

							//Get publishing date
							echo "<h6>".$item->pubDate."</h6>";

						//Close the text div
						echo "</div>";

						$i++;
					}	
					echo "</div>";
				echo "</div>";
			}
		?>	
	</body>
</html>
