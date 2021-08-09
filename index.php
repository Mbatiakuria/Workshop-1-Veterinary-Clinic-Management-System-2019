<?php
	require "header.php"
?>

<main>
	<main>
		<?php
			if(isset($_SESSION['userId'])) {
				echo "You are logged in!";
			}
			else {
				echo "You are logged out!";
			}
		?>
	</main>
</main>