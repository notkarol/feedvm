<footer>

<!-- <p>Footer content</p> -->

</footer>

		</section>
		<nav class="shifter-navigation">
			<ul>
				<?php 
				
					if(basename($_SERVER['PHP_SELF'])=="index.php"){
						print '<li>Home</li>' . "\n";
					} else {
						print '<li><a href="index.php">Home</a></li>' . "\n";
					} 

					if(basename($_SERVER['PHP_SELF'])=="my_events.php"){
						print '<li>My Events</li>' . "\n";
					} else {
						print '<li><a href="my_events.php">My Events</a></li>' . "\n";
					}

					if(basename($_SERVER['PHP_SELF'])=="map.php"){
						print '<li>Map</li>' . "\n";
					} else {
						print '<li><a href="map.php">Map</a></li>' . "\n";
					} 
					
					if(basename($_SERVER['PHP_SELF'])=="insert_event.php"){
						print '<li>Submit Event</li>' . "\n";
					} else {
						print '<li><a href="insert_event.php">Submit Event</a></li>' . "\n";
					}
				?>
			</ul>
		</nav>

		    <script>

		    // var picker = new Pikaday(
		    // {
		    //     field: document.getElementById('datepicker'),
		    //     firstDay: 1,
		    //     minDate: new Date('2000-01-01'),
		    //     maxDate: new Date('2020-12-31'),
		    //     yearRange: [2000,2020]
		    // });

		    </script>

	</body>
</html>