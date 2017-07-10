<div class="clear"></div>
<?php $options = get_option( 'theme_settings' ); ?>
<div class="main">
	<div id="footer">
		<div class="inners"><div class="siteinfo"><?php echo $options['text-copy']; ?> <a href="/navigmap">Карта сайта</a></div></div>
	</div>
</div>
<!-- end FOOTER -->
<?php wp_footer(); ?>

<?php echo $options['tracking']; ?>

<div class="feedback-modal">
  <div class="close-btn">✕</div>
  <form action="http://localhost:1337/brightdayspb.ru/" method="post">

    <div style="display: none;">
      <input type="hidden" name="_wpcf7" value="4">
      <input type="hidden" name="_wpcf7_version" value="4.7">
      <input type="hidden" name="_wpcf7_locale" value="ru_RU">
      <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f4-o1">
      <input type="hidden" name="_wpnonce" value="76f9ee8192">
      <input type="hidden" name="_wpcf7_is_ajax_call" value="1">
    </div>

    <div class="field">
      <label>Ваше имя:</label>
      <input type="text"/>
    </div>
    <div class="field">
      <label>Телефон для связи:</label>
      <input type="phone"/>
    </div>
    <div class="field error">
    </div>
    <div class="footer">
      <input type="submit" value="Заказать звонок" class="btn"/>
    </div>
  </form>
</div>
<div class="overlay"></div>

<script>
  $(document).ready(function () {
    $("a[rel^='zoom']").prettyPhoto({
      changepicturecallback: function () {
        jQuery('.twitter').empty();
        jQuery('.facebook').empty();
      }
    });
    $(".owl-carousel.works").owlCarousel({
      loop: true,
      nav: true,
      navText: ['‹', '›']
    });
    $(".owl-carousel.reviews").owlCarousel({
      items: 4,
      loop: true,
      nav: true,
      navText: ['‹', '›']
    });
  });
</script>

<script>
  $(document).ready(function () {
    var close = function() {
      $('.feedback-modal').toggleClass('opened');
      $('.overlay').toggleClass('opened');
    };
    var open = function() {
      $('.feedback-modal').toggleClass('opened');
      $('.overlay').toggleClass('opened');
    };
    $(".feedback-modal form").submit(function(e) {
//      console.log(this);
      $(".feedback-modal form input[type=submit]").attr("disabled", true);
    });
    $(".feedback-modal form").ajaxForm(function(r) {
      $(".feedback-modal form input[type=submit]").attr("disabled", false);
      if (!r) {
        close();
        return;
      }
      r = r.replace(/<textarea>(.*)<\/textarea>/, '$1');
      r = $.parseJSON(r);
      if (!r.mailSent) {
        $(".feedback-modal .error").html(r.message);
      }
    });
    $('.close-btn').click(close);
    $('.order-btn').click(open);
  });
</script>

</body>
</html>