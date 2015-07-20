<?php require_once('../config/setup.php');?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bumba</title>
		<?php include('../templates/header.php');?>
	</head>
	
	<body>
		<div class="container">
			<form action="index.php" method="post" name="addpost">
				<div class="form-group">
					<label for="postTitle">Post Title</label>
					<input name="title" type="text" class="form-control" id="postTitle" placeholder="Enter a post title">
				</div>
			    <div class="form-group">
					<label for "textInput">Comments</label>
					<textarea name="body" class="form-control" rows="3" id="textInput"></textarea>
				</div>
			  <button type="submit" class="btn btn-default" value="submit">Submit</button>
			</form>
			
			<?php
            if(isset($_POST['title'],$_POST['body'])){
                $title = $_POST['title'];
                $body = $_POST['body'];
                $query = "INSERT INTO user_post (title,body) VALUES (:title,:body)";
                $statement = $db->prepare($query);
                $statement->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
                $statement->bindParam(":body", $_POST['body'], PDO::PARAM_STR);
                $statement->execute();
                echo sprintf('<p style="color:white">sucessfuly added post with this data</p>');
				header("Location: success.php");
            }
        ?>
			
			
		</div>
		<?php include('../templates/footer.php');?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>