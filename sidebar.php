<?php
include "config.php";
$select="SELECT * FROM categories";
$query=mysqli_query($config,$select);
?>

<div class="col-lg-4">
			<div class="card">
				<div class="card-body d-flex right-section">
					<div id="categories">
						<strong><h6  class="bg-info">Categories</h6>
						<ul>
							<?php while($cats=mysqli_fetch_assoc($query)) {?>
							<li>
								<a href="category.php?id=<?= $cats['cat_id'] ?>"><?= $cats['cat_name'] ?></a>
							</li>
							<?php } ?>
						</ul>
						</strong>
					</div>
				</div>
			</div>
		</div>