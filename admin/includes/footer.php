<footer class="footer pt-2">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-7">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">about us</a>
                </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">services</a>
                </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">contact</a>
                </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">about</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </main>

  <script src="../assets/js/material-dashboard.min.js"></script>
  <script src="../assets/js/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/smooth-scrollbar.min.js"></script>

  

  <!-- alert -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
  <script>
  <?php 
      if(isset($_SESSION['message'])) 
    {
      ?>
      alertify.set('notifier','position', 'top-right');
      alertify.success('<?=$_SESSION['message']?>');
      <?php
      unset($_SESSION['message']);
    } 
  ?>
  </script>

</body>
</html>