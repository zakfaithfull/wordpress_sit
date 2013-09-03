

		</div> <!-- end #container -->
		
<footer class="footer" role="contentinfo">

	<div id="inner-footer" class="responsive-container clearfix">

		<nav role="navigation">
				<?php bones_footer_links(); ?>
		</nav>

		<p class="copyright first"><a href="javascript:void(0)" class="show_hide">Website Terms and Conditions of Use</a></p>
		
		<p class="credit last">Design &amp; Development by <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">Think</a></p>
		
		<div class="website-terms slidingDiv">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>


	</div> <!-- end #inner-footer -->

</footer> <!-- end footer -->		

</div>

<!-- all js scripts are loaded in library/bones.php -->
<?php wp_footer(); ?>

<script type="text/javascript">
jQuery(document).ready(function(){
		 
    $(".slidingDiv").hide();
    $(".show_hide").show();
 
    $('.show_hide').click(function(){
    $(".slidingDiv").slideToggle();
    });
 
});
</script>

</body>

</html> <!-- end page. what a ride! -->
