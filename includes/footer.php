<script src="asset/js/jquery-3.7.1.min.js"></script>
<script src="asset/js/bootstrap.bundle.min.js"></script> <!-- Corrected path -->

<script src="asset/js/custom.js"></script>
<script src="asset/js/owl.carousel.min.js"></script>
<script src="asset/js/compare.js"></script>
<script src="asset/js/buildapccustom.js"></script>



<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
  <script>
    alertify.set('notifier','position', 'top-right');
  <?php 
      if(isset($_SESSION['message'])) 
    {
      ?>
        alertify.success('<?=$_SESSION['message']?>');
      <?php
      unset($_SESSION['message']);
    } 
  ?>

var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
  </script>

</body>
</html>