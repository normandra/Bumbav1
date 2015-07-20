<?php require_once('config/setup.php');?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bumba</title>
		<?php include('templates/header.php');?>
	</head>
	
	<body>
		<div class="container">
		
			<?php
				if(isset($_GET['number'])){
					$number = $_GET['number'];
					$query = "SELECT * FROM user_post WHERE id<{$number} ORDER BY id DESC LIMIT 10";
				}
				else{
				$query = "SELECT * FROM user_post ORDER BY id DESC LIMIT 10";
				}
				
				$statement = $db->query($query);	
					while($r = $statement->fetch()) {
						$title = $r['title'];
						$body = $r['body'];
						$id = $r['id'];
						$time = $r['time'];
						$short_body = substr(strip_tags($body), 0, 200);
						
						$commentcountsql = "SELECT COUNT(original_id) as total FROM post_comment WHERE original_id={$id}";
						$result = $db->prepare($commentcountsql);
						$result->execute();
						$number_of_rows = $result->fetchColumn();
						
						
						
						
						if(isset($id)){
						echo '<div class="box">';
						echo sprintf('<a href="post.php?id=%s">%s.%s</a><br>',$id,$id, $title);
						echo sprintf('  <p id="subtittle">%s...</p>',$short_body);
						echo sprintf ('<p class="commentamount">%s Comments</p>',$number_of_rows);
						echo '</div>';
						}
					}
						
				
			 	if(isset($id)){
						echo sprintf('<a class="btn" href="index.php?number=%s">MOAR POST</a><br>',$id);
						echo sprintf('<br><br><a class="btn" href="index.php">BACK TO FRONT</a>');
						}else{
									echo sprintf('<br><p class="alert">No more posts available</p><br>');
						echo sprintf('<br><br><a class="btn" href="index.php">BACK TO FRONT</a>');	
						}
				?>
			
			
		</div>
		<?php include('../bumba/templates/footer.php');?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>