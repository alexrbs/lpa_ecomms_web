<?PHP

  $authChk = true;
  require('app-lib.php');
  build_header();
?>

  <div id="content">
    <?PHP build_navBlock(); ?>
    <div id="mainIndex">
      <div id="miss" class="mashup">
          Logical Peripherals Australia’s mission is to supply high quality computer peripherals,
          reliable customer service and above all customer satisfaction. We strive to deliver the
          very best in the latest technologies and support our customers with the highest after
          sales support, allowing our customers to enjoy the best of technology that our ever-changing
          world demands.
      </div>
      <div id="gmaps" class="mashup">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d885.0263872504248!2d153.0362584853315!3d-27.46597319524018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b9159f562a6f935%3A0x94904327a1574815!2s50+Holman+St%2C+Kangaroo+Point+QLD+4169!5e0!3m2!1sen!2sau!4v1558917568375!5m2!1sen!2sau"
        width="315" height="160" frameborder="0" style="border:0" allowfullscreen>
        </iframe>
      </div>
      <div id="youtube" class="mashup">
        <iframe width="315" height="315" src="https://www.youtube.com/embed/gJtDDTUDSfk"
        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
      </div>
      <div id="facebook" class="mashup">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FLogical-Peripherals-Australia-2294850667204295%2F&tabs=timeline&width=315&height=315&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
        width="315" height="315" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
        allowTransparency="true" allow="encrypted-media">
        </iframe>
      </div>
    </div>
  </div>
  <script>
  </script>
<?PHP
build_footer();
?>
