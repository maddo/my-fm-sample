<div class="hero-unit">
	<h1>Welcome</h1>
	<h2>To Mike's 5Media Member's Only Site Test</h2>
	<div>
		<p>I really had a blast with this, I never made my own little framework before.	</p>
		<?php if ($data['userData']['authorized']): ?>
		<p>Well <span class="attention"><?php echo $data['userData']['username']; ?></span>, there isn't much to do here in this test, but feel free to <a href="/user/deauthorize">logout</a> now if you're done.</p>
		<?php else: ?>
		<p>There isn't much to do here in this test, but feel free to <a href="/user/login">login</a> or <a href="/user/register">register</a> to see the members only section</p>
		<?php endif; ?>
	</div>
</div>
