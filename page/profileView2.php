<?php

    require_once '../process/homepageProcess.php';
    require_once '../process/profileProcess.php';
    require_once '../process/commonsProcess.php';

    $id = $_SESSION['id'];

    if (isset($_GET['id']))
    {
		$id = isStringSafe($_GET['id'],$id);
        if ($id != "mine" && $id != $_SESSION['id'])
        {
			$data = getUserProfileWithID($id);
			$profileOrang = true;
        }
		else
		{
			$profileOrang = false;
			$data = getUserProfile();
		}
    }
	else
	{
		$profileOrang = false;
		$data = getUserProfile();
	}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>ConnectUs</title>

	<!-- Vendor: Bootstrap CSS -->
	<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />

	<!-- Style CSS -->
	<link rel="stylesheet" href="../assets/css/dashboard.css" />
	<link rel="stylesheet" href="../assets/css/style.css" />

	<!-- Fontawesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
  </head>
  <body>
	<!-- Navbar -->

	<header class="navbar navbar-expand-lg navbar-dark bg-yellow fixed-top flex-md-nowrap shadow">
	  <a class="ps-4 font-Akronim navbar-brand" href="homepage.php">ConnectUs</a>

	  <button class="navbar-toggler mt-4 position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="navbar-nav ms-auto">
		<form class="d-flex title-profile">
		  <h3>Profile</h3>
		</form>
	  </div>
	</header>

	<!-- End Navbar -->

	<!-- Sidebar -->
	<div class="container-fluid">
	  <div class="row">
		<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-yellow-1 sidebar collapse">
		  <div class="position-sticky pt-10">
			<ul class="nav flex-column" id="sideCol">
			<div class="profileNav">
			  <li class="profile-side">
				
                <img src = <?php echo getImagePath($id);?> width="100%" height="100%" class="me-3 rounded-circle">
				
				<form action="profile.php" method="POST">
					<div class="row mb-3 pt-2">
						<label for="name" class="col-sm-2 col-form-label" style="font-family: Arial, Helvetica, sans-serif">Name</label>
						<div class="col-sm-10">
							<?php
								if (!$profileOrang)
								{
									echo '
										<input type="text" class="form-control" id="name" name="name" value="'.$data['name'].'">
									';
								}
								else
								{
									echo '
										<input type="text" class="form-control" id="name" name="name" value="'.$data['name'].'" disabled>
									';
								}
							?>
						</div>
					</div>

					<div class="row mb-3">
						<label for="gender" class="col-sm-2 col-form-label" style="font-family: Arial, Helvetica, sans-serif">Gender</label>
						<div class="col-sm-10">
							<?php
								if ($profileOrang)
								{
									if ($data['gender'])
									{
										echo '
										<input type="text" class="form-control" id="gender" name="gender" value="Pria" disabled>';
									}
									else
									{
										echo '
										<input type="text" class="form-control" id="gender" name="gender" value="Wanita" disabled>';
									}
								}
								else
								{
									echo '
										<select class="col-md col-sm-auto form-control form-select" id="gender" name="gender" aria-required="true">
									';
									if ($data['gender'])
									{
										echo '
												<option selected value="Pria">Pria</option>
                                				<option value="Wanita">Wanita</option>
											</select>
										';
									}
									else
									{
										echo '
												<option value="Pria">Pria</option>
                                				<option selected value="Wanita">Wanita</option>
											</select>
										';
									}
								}
							?>
						</div>
					</div>
					
					<?php
						if (!$profileOrang)
						{
							echo '
								<div class="row mb-3">
									<label for="borndate" class="col-sm-2 col-form-label"  style="font-family: Arial, Helvetica, sans-serif">Borndate</label>
									<div class="col-sm-10">
										<input type="date" class="form-control" id="borndate" name="borndate" value="'.$data['dateborn'].'">
									</div>
								</div>
		
								<div class="row mb-3">
									<label for="email_user" class="col-sm-2 col-form-label"  style="font-family: Arial, Helvetica, sans-serif">Email</label>
									<div class="col-sm-10">
										<input type="email" class="form-control" id="email_user" name="email" value="'.$data['email'].'">
									</div>
								</div>
		
								<div class="row mb-3">
									<label for="password" class="col-sm-2 col-form-label"  style="font-family: Arial, Helvetica, sans-serif">Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" id="password" name="password">
									</div>
								</div>							
							';
						}
					?>

					<?php
						if (!$profileOrang)
						{
							echo '
								<div class="text-center">
								<button id="updateProfile" name="updateProfile" type="submit" class="btn btn-primary">Edit Profile</button>
								</div>
							';
							echo '
								<p></p>
								<div class="text-center">
								<button id="logout" name="logout" type="submit" class="btn btn-danger">Logout</button>
								</div>
							';
						}
						else
						{
							if (!isFollowed($_SESSION['id'], $id))
							{
								echo '
									<div class="text-center">
									<input type="hidden" name="target_id" value="'.$id.'" required>
									<button id="follow" name="follow" type="submit" class="btn btn-primary">Follow</button>
									</div>
								';
							}
							else
							{
								echo '
									<div class="text-center">
									<input type="hidden" name="target_id" value="'.$id.'" required>
									<button id="unfollow" name="unfollow" type="submit" class="btn btn-danger">Unfollow</button>
									</div>
								';
							}
						}
					?>
					
				</form>
			  </li>
			</div>
			</ul>
		  </div>
		</nav>
		<!-- End sidebar -->
		<!-- Card -->
		<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
		 
		<?php
		
			if (!$profileOrang)
			{
				echo '
				<div class="row mt-4 p-2">
				<div class="col-lg-12 mb-lg-0 mb-4 pt-10">
				<div class="card">
					<div class="card-body">
					<div class="followed">
						<img src="'.getImagePath($_SESSION['id']).'" width="50" height="50" class="me-3 rounded-circle" />
						<h3>Create Post</h3>
						
					</div>

					<form action="profile.php" method="POST">
						<textarea class="form-control" name="content" rows="3"></textarea>

						<div class="text-center">
						<button type="submit" name="createPost" id="createPost" class="btn btn-primary">Post</button>
						</div>
					</form>
					

					</div>
				</div>
				</div>
			</div>
				';
			}

		?>

		  <!-- Post cards

		  <div class="row mt-4 p-2">
			<div class="col-lg-12 mb-lg-0 mb-4 pt-10">
			  <div class="card">
				<div class="card-body">
				  <div class="followed">
					<img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="50" height="50" class="me-3 rounded-circle" />

					<a href="" class="publisher-name">Followed1</a>
				  </div>
				  Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur voluptatem deserunt laboriosam doloremque atque, quasi aut cupiditate aperiam minima hic odit eos distinctio ducimus vel tempore quisquam totam
				  perferendis. Aliquid iusto tenetur, dolor beatae odit laboriosam fugiat tempora iure expedita! Quibusdam ab ipsa illo. Sint nobis ad ducimus quibusdam. Dolore laborum atque reprehenderit tempora saepe tenetur alias placeat
				  quibusdam deserunt voluptatem sint ipsa ipsum quis eligendi totam sit architecto, libero optio consequatur animi dolor. Sint dolores vero velit omnis laboriosam, libero reprehenderit cum voluptas. Assumenda rem a aperiam
				  porro ipsum minus iste ex quo rerum, doloremque officiis sunt repellat cupiditate.
				</div>
			  </div>
			</div>
		  </div>
		  -->

		  <?php
			getPostsForProfile($data['id'], $profileOrang);
		  ?>

		</main>
	  </div>
	</div>

  </body>
  <!-- Vendor: Bootstrap JS-->
  <script type="text/javascript" src="../assets/js/script.js"></script>
  <script type="text/javascript" src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</html>
