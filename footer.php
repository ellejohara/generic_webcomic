<?php
/**
 * Generic Webcomic footer template part
 *
 * @package		generic-webcomic
 * @author		Astrid Lydia Johannsen
 * @copyright	2022 ellejohara
 * @license		GNU General Public License v3 or later
 *
 */
?>

<?php
if(get_theme_mod('copyright_credit')) {
    $copyright_credit = get_theme_mod('copyright_credit');
} else {
    $copyright_credit = get_bloginfo('name');
}
?>
<footer id="footer">
<p><span class="copy">&copy;<?php echo date('Y'); ?></span> | <span id="copyright-name"><?php echo $copyright_credit; ?></span></p>
<p id="generic-webcomic-credit"><small><a href="https://github.com/ellejohara/generic-webcomic/" target="_blank">Generic Webcomic</a> theme by <a href="https://github.com/ellejohara/">ellejohara</a>.</small></p>
</footer><!-- #footer -->

</div><!-- #container -->

<script src="<?php bloginfo('template_url'); ?>/js/keyboard-image-nav.js"></script>
<?php wp_footer(); ?>
</body>

</html>