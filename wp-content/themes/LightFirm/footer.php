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

<div class="feedback-modal" id="feedbackCall">
  <div class="close-btn">✕</div>
  <form action="/" method="post">
    <div style="display: none;">
      <input type="hidden" name="_wpcf7" value="460">
      <input type="hidden" name="_wpcf7_version" value="4.7">
      <input type="hidden" name="_wpcf7_locale" value="ru_RU">
      <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f460-o1">
      <input type="hidden" name="_wpnonce" value="e40e907fba">
      <input type="hidden" name="_wpcf7_is_ajax_call" value="1">
    </div>
    <div class="field">
      <label>Ваше имя: (обязательно)</label>
      <input name="name" type="text"/>
    </div>
    <div class="field">
      <label>Телефон для связи: (обязательно)</label>
      <input name="phone" type="phone"/>
    </div>
    <div class="field error">
    </div>
    <div class="footer">
      <input type="submit" value="Заказать звонок" class="btn"/>
    </div>
  </form>
  <div class="success">Отправлено успешно</div>
</div>


<div class="feedback-modal" id="feedbackOrder">
  <div class="close-btn">✕</div>
  <form action="/" method="post">
    <div style="display: none;">
      <input type="hidden" name="_wpcf7" value="4">
      <input type="hidden" name="_wpcf7_version" value="4.7">
      <input type="hidden" name="_wpcf7_locale" value="ru_RU">
      <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f4-o1">
      <input type="hidden" name="_wpnonce" value="76f9ee8192">
      <input type="hidden" name="_wpcf7_is_ajax_call" value="1">
    </div>
    <div class="field f-text">
      <label>Ваше имя: *</label>
      <input name="name" type="text"/>
    </div>
    <div class="field f-phone">
      <label>Телефон для связи: *</label>
      <input name="phone" type="phone"/>
    </div>
    <div class="field">
      <label>Текст сообщения:</label>
      <textarea></textarea>
    </div>
    <div class="field error">
    </div>
    <div class="footer">
      <div class="required-help">* обязательные для заполнения поля</div>
      <input type="submit" value="Сделать заказ" class="btn"/>
    </div>
  </form>
  <div class="success">Отправлено успешно</div>
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
    var initFeedbackModal = function(id) {
      var close = function () {
        $('#' + id).toggleClass('opened');
        $('.overlay').toggleClass('opened');
      };
      var open = function (e) {
        e.preventDefault();
        $('#' + id + ' form').css('display', 'block');
        $('#' + id + ' .success').css('display', 'none');
        //
        $('#' + id).toggleClass('opened');
        $('.overlay').toggleClass('opened');
      };
      $('#' + id + ' form').submit(function (e) {
        $('#' + id + ' form input[type=submit]').attr('disabled', true);
      });
      $('#' + id + ' form').ajaxForm(function (r) {
        $('#' + id + ' form input[type=submit]').attr('disabled', false);
        //console.log(r);
        //r = r.replace(/<textarea>(.*)<\/textarea>/, '$1');
        //r = $.parseJSON(r);
        if (!r.mailSent) {
          $('#' + id + ' .error').html(r.message);
        } else {
          $('#' + id + ' form').css('display', 'none');
          $('#' + id + ' .success').css('display', 'block');
        }
      });
      $('#' + id + ' .close-btn').click(close);
      return open;
    };
    var openOrderModal = initFeedbackModal('feedbackOrder');
    var openCallModal = initFeedbackModal('feedbackCall');

    $('.order-btn').click(openOrderModal);
    $('.call-btn').click(openCallModal);
  });
  window.onscroll = function() {
    var scrolled = window.pageYOffset || document.documentElement.scrollTop;
    if  (scrolled > 170)  $('.part1').show();
    else $('.part1').hide();
  }

</script>

</body>
</html>