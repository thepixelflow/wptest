<?php global $business; 

if(isset($business['divider-text'])){

if($business['divider-text']){ 

?>

<!-- DIVIDER -->
<section class="section-divider-one" id="divider-one">
	

	<div class="container">
		<h2 class="heading-divider"><?php echo $business['divider-text']; ?></h2>
	</div>
	
</section> <!-- end divider -->
<!-- END DIVIDER -->

<?php } } ?>