<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Member's Only</title>
	<link rel="stylesheet" type="text/css" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
	<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="/">Exclusive Website</a>
				<div class="nav-collapse">
					<ul class="nav">
						<?php if ($data['userData']['authorized']): ?>
						<li>Welcome <?php echo $data['userData']['username']; ?></li>
						<li><a href="/user/deauthorize">Logout</a></li>
						<?php else: ?>
						<li><a href="/user/login">Login</a></li>
						<li><a href="/user/register">Register</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<?php if (isset($data['flash']['bucket']) && count($data['flash']['bucket']) > 0): ?>
		<div>
			<ul>
				<?php foreach ($data['flash']['bucket'] as $msg): ?>
				<li>
					<?php echo $msg; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
		<div class="row">
