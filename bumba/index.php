<?php require_once('config/setup.php');?>
<?php include('templates/header.php');?>

	<div class="content">
		<div class="content-heading">
			<div class="container">
				<h1 class="heading">Hi there. What's up?</h1>
			</div>
		</div>
		<div class="container">
			<section class="content-inner">
				<div class="card-wrap">
					<div class="row">

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
							$short_body = substr(strip_tags($body), 0, 10);
							
							$commentcountsql = "SELECT COUNT(original_id) as total FROM post_comment WHERE original_id={$id}";
							$result = $db->prepare($commentcountsql);
							$result->execute();
							$number_of_rows = $result->fetchColumn();

						// Inhalt werden eingefügt

						if(isset($id)){
							echo '
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="card">
								<div class="card-main">
									<div class="card-inner">';
										
										echo sprintf('<a href="post.php?id=%s"><p class="card-heading">%s.%s</p></a>',$id,$id, $title);
										echo sprintf ('<p>%s...',$short_body);
										echo sprintf ('<br>%s Comments</p>',$number_of_rows);
									echo '
									
									</div>
									<div class="card-action">
										<ul class="nav nav-list pull-left">
											<li>
												<a href="javascript:void(0)"><span class="icon">add</span></a>
											</li>
											<li>
												<a href="javascript:void(0)"><span class="icon">delete</span></a>
											</li>
											<li class="dropdown">
												<a class="dropdown-toggle" data-toggle="dropdown"><span class="icon">settings</span></a>
												<ul class="dropdown-menu">
													<li>
														<a href="javascript:void(0)"><span class="icon margin-right-sm">loop</span>&nbsp;Lorem Ipsum</a>
													</li>
													<li>
														<a href="javascript:void(0)"><span class="icon margin-right-sm">replay</span>&nbsp;Consectetur Adipiscing</a>
													</li>
													<li>
														<a href="javascript:void(0)"><span class="icon margin-right-sm">shuffle</span>&nbsp;Sed Ornare</a>
													</li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>';
									}
								}
						?>

					</div>
				</div>
			</section>
		</div>
	</div>



		
			<?php /*
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
						}
						else{
									echo sprintf('<br><p class="alert">No more posts available</p><br>');
						echo sprintf('<br><br><a class="btn" href="index.php">BACK TO FRONT</a>');	
						}
				*/
				?>

<?php include('/templates/footer.php');?>