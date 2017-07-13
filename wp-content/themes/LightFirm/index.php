<?php get_header(); ?>
    <div class="main">
        <div class="slidescool">
            <div class="slider-over">
                <div class="search">
                    <form role="search" method="get" id="searchform" action="<?php echo home_url('/') ?>">
                        <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s"
                               placeholder="Поиск по сайту"/>
                        <input type="submit" value="&nbsp;"/>
                    </form>
                </div>
                <div class="title">быстро, качественно, выгодно</div>
                <div class="sub-title">Изготовление декораций от «Bright Day»</div>
                <a href="#" class="order-btn">Сделать заказ</a>
            </div>
        </div>
        <div class="clear"></div>
        <div style="margin-bottom: 35px;"></div>
        <div id="content">
          <?php include(TEMPLATEPATH . "/left.php"); ?>
          <?php include(TEMPLATEPATH . "/right.php"); ?>
            <div class="clear"></div>
          <?php include(TEMPLATEPATH . "/portfolio.php"); ?>
            <div class="clear"></div>
          <?php include(TEMPLATEPATH . "/contact.php"); ?>
        </div>
    </div>

    <div class="main">
        <div class="clear"></div>
        <div style="margin-top: 40px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3994.450570389087!2d30.260169316079747!3d59.96158640321825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x469636ca2e5b4cc7%3A0xba25ff1a7e5a05f3!2z0J_QtdGC0YDQvtCy0YHQutC40Lkg0L_RgC4sIDksINCh0LDQvdC60YIt0J_QtdGC0LXRgNCx0YPRgNCzLCDQoNC-0YHRgdC40Y8sIDE5NzExMA!5e0!3m2!1sru!2sua!4v1473153956501"
                    width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
<?php get_footer(); ?>