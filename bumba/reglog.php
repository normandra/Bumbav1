<?php require_once('../bumba/config/setup.php');?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bumba</title>
		<?php include('../bumba/templates/header.php');?>
	</head>
	
	<body>
		<div class="container">
			
			<?php
            $query = "SELECT * FROM user_post ORDER BY id DESC";
            $statement = $db->query($query);
					
            while($r = $statement->fetch()) {
                $title = $r['title'];
                $body = $r['body'];
                $id = $r['id'];
                $short_body = substr(strip_tags($body), 0, 200);
				echo '<div class="box">';
                echo sprintf('<p class="idtag">%s.</p><a class="mainlink" href="post.php?id=%s">%s</a>',$id,$id, $title);
                echo sprintf('<p>%s...</p>', $short_body);
				echo '</div>';
            }
        ?>
			
			
		</div>
		<?php include('../bumba/templates/footer.php');?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>