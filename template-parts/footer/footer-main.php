</main>
<!--END MAIN-->

<!--BEGIN FOOTER-->

<?php

$footer_container_with = get_field('footer_container_width', 'options');

?>

<footer id="footer">
    <div class="uk-container <?= $footer_container_with; ?>">
    </div>
    <?php
    include_once THEME_TEMPLATES_DIR . '/footer/copyright.php';
    include_once THEME_TEMPLATES_DIR . '/components/totop.php';
    ?>
</footer>
<!--END FOOTER-->

</div>
<!--END PAGE-->

<?php wp_footer(); ?>

</body>
</html>
