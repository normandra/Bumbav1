<?php require_once('config/setup.php');?>
<?php include('templates/header.php');?>
	
		<div class="container">
			<?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT * FROM user_post WHERE id =:id";
            $statement = $db->prepare($query);
            $statement->bindParam(":id", $_GET['id'], PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetchObject();
            $title = htmlspecialchars($row->title);
            $body = htmlspecialchars($row->body);
            echo sprintf('<div class="view_post">');
            echo "<h1> {$title}</h1>";
            echo sprintf('<p>%s</p>',$body);
            echo sprintf('</div>');

        }
        else{
            header('Location: index.php');
        }
        ?>
		<hr><hr>
		<?php
            $query = "SELECT * FROM post_comment ORDER BY id ASC";
            $statement = $db->query($query);
			echo sprintf('<div class="comment">');
            while($r = $statement->fetch()) {
                $poster = htmlspecialchars($r['poster']);
                $comment = htmlspecialchars($r['comment']);
                $id = $r['id'];
				$original_id = $r['original_id'];
				if($original_id == $_GET['id']){
					echo sprintf('<b style="color:red">%s</b></br>',$poster);
					echo sprintf('<p style="color:red">%s</p></br><hr>',$comment);
				}
            }
			echo sprintf('</div>');
        ?>
		<hr><hr>
		
		
		
			<form action="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']; ?>" method="post" name="addpost">
				<div class="form-group">
					<label for="postposter">Credentials</label>
					<input name="poster" type="text" class="form-control" id="postposter" placeholder="Enter nick (can be left empty)">
				</div>
			    <div class="form-group">
					<label for "textInput">Comments</label>
					<textarea name="comment" class="form-control" rows="3" id="textInput"></textarea>
				</div>
			  <button type="submit" class="btn btn-default" value="submit">Submit</button>
			</form>
			
			<?php
            $link = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
            if(isset($_POST['poster'],$_POST['comment'],$_GET['id'])){
                $poster = $_POST['poster'];
                $comment = $_POST['comment'];
				$original_id = $_GET['id'];
                $query = "INSERT INTO post_comment (poster,comment,original_id) VALUES (:poster,:comment,:original_id)";
                $statement = $db->prepare($query);
                $statement->bindParam(":poster", $_POST['poster'], PDO::PARAM_STR);
                $statement->bindParam(":comment", $_POST['comment'], PDO::PARAM_STR);
				$statement->bindParam(":original_id", $_GET['id'], PDO::PARAM_INT);
                $statement->execute();
				header("Location: $link");
            }
			?>
		</div>
		<?php #include('templates/footer.php');?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>		