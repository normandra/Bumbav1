<?php require_once('config/setup.php');?>
<?php include('templates/header.php');?>

	<div class="content">
		<div class="content-heading">
			<div class="container">
				<h1 class="heading">Comments</h1>
			</div>
		</div>
		<div class="container">
			<section class="content-inner">
				<div class="tile-wrap">

					<?php
					// defines $title and $body to show main post
			        if(isset($_GET['id'])){
			            $id = $_GET['id'];
			            $query = "SELECT * FROM user_post WHERE id =:id";
			            $statement = $db->prepare($query);
			            $statement->bindParam(":id", $_GET['id'], PDO::PARAM_INT);
			            $statement->execute();
			            $row = $statement->fetchObject();
			            $title = htmlspecialchars($row->title);
			            $body = htmlspecialchars($row->body);
			        }
			        ?>

					<div class="tile tile-collapse tile-alt">
						<div data-target="#tile-collapse-16" data-toggle="tile">
							<div class="tile-inner">
								<div class="text-overflow"><?php echo $title ?>: <?php echo $body; ?></div>
							</div>
						</div>
						<div class="tile-active-show collapse" id="tile-collapse-16">
							<div class="tile-sub">
								<p>Aliquam in pharetra leo. In congue, massa sed elementum dictum, justo quam efficitur risus, in posuere mi orci ultrices diam. This is a <a href="javascript:void(0)">link</a> among some other text.</p>
							</div>
							<div class="tile-footer">
								<ul class="nav nav-list pull-left">
									<li>
										<a href="javascript:void(0)"><span class="icon">check</span>&nbsp;OK</a>
									</li>
									<li>
										<a data-dismiss="tile" href="javascript:void(0)"><span class="icon">close</span>&nbsp;Cancel</a>
									</li>
								</ul>
							</div>
						</div>
					</div>

<?php
// show comments to main post
$query = "SELECT * FROM post_comment ORDER BY id ASC";
$statement = $db->query($query);
while($r = $statement->fetch()) {
    $poster = htmlspecialchars($r['poster']);
    $comment = htmlspecialchars($r['comment']);
    $id = $r['id'];
	$original_id = $r['original_id'];
	if($original_id == $_GET['id']){
		echo '
					<div class="tile tile-collapse">
						<div data-target="#tile-collapse-1" data-toggle="tile">
							<div class="pull-left tile-side" data-ignore="tile">
								<div class="avatar avatar-blue avatar-sm">
									<span class="icon">alarm</span>
								</div>
							</div>
							<div class="tile-action" data-ignore="tile">
								<ul class="nav nav-list pull-right">
									<li>
										<a href="javascript:void(0)"><span class="icon">star</span></a>
									</li>
									<li>
										<a href="javascript:void(0)"><span class="icon">delete</span></a>
									</li>
									<li class="dropdown">
										<a class="dropdown-toggle" data-toggle="dropdown"><span class="icon">settings</span></a>
										<ul class="dropdown-menu">
											<li>
												<a href="javascript:void(0)"><span class="icon margin-right-sm">loop</span>Lorem Ipsum</a>
											</li>
											<li>
												<a href="javascript:void(0)"><span class="icon margin-right-sm">replay</span>Consectetur Adipiscing</a>
											</li>
											<li>
												<a href="javascript:void(0)"><span class="icon margin-right-sm">shuffle</span>Sed Ornare</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="tile-inner">
								<div class="text-overflow">'.$comment.'</div>
							</div>
						</div>';
		if ($poster != "") {
			echo '
						<div class="tile-active-show collapse" id="tile-collapse-1">
							<div class="tile-sub">
								<p>Posted by '.$poster.'</p>
							</div>
							<div class="tile-footer">
								<ul class="nav nav-list pull-left">
									<li>
										<a href="javascript:void(0)"><span class="icon">check</span>&nbsp;OK</a>
									</li>
									<li>
										<a data-dismiss="tile" href="javascript:void(0)"><span class="icon">close</span>&nbsp;Cancel</a>
									</li>
								</ul>
							</div>
						</div>';
			}
			echo
					'</div>';
	}
}
?>


				</div>
				<fieldset>
					<form class="form" action="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']; ?>" method="post" name="addpost">
						<legend>Leave a comment</legend>
						<div class="form-group form-group-icon">
							<div class="row">
								<div class="col-lg-6 col-sm-8">
									<div class="media">
										<div class="media-object pull-left">
											<label class="form-icon-label" for="input-comment"><span class="icon">comment</span></label>
										</div>
										<div class="media-inner">
											<textarea class="form-control textarea-autosize" id="input-comment" name="comment" placeholder="Comment" rows="1"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group form-group-icon">
								<div class="row">
									<div class="col-lg-6 col-sm-8">
										<div class="media">
											<div class="media-object pull-left">
												<label class="form-icon-label" for="input-address"><span class="icon">pencil</span></label>
											</div>
											<div class="media-inner">
												<input class="form-control" id="input-name" name="poster" placeholder="Enter nick (can be left empty)" type="text">
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="form-group">
							<div class="checkbox switch">
								<label for="input-switch-2">
									<input class="access-hide" id="input-switch-2" name="input-switch" type="checkbox"><span class="switch-toggle switch-toggle-alt"></span>Stay anonymously
								</label>
							</div>
						</div>
						<div class="form-group-btn">
							<button class="btn btn-blue waves-button waves-light waves-effect" type="submit" onClick="window.location.reload()">Post</button>
							<button class="btn waves-button waves-effect" type="button">Cancel</button>
						</div>
					</fieldset>
			</section>
		</div>
	</div>
			
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

<?php include('/templates/footer.php');?>