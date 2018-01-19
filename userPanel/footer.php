 <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="index.php">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="storeDetail.php">
                                Store
                            </a>
                        </li>
                        <li>
                            <a href="addTerms.php">
                                Terms & Conditions
                            </a>
                        </li>
                        <li>
                            <a href="addPolicy.php">
                               Privacy policy
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                   2017 &copy; All Rights Reserved <a href="index.php">MAI.com</a>
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(window).load(function(){
      // For Driver Page
      if ( $('.createVoucherPage').length ) {
        $('.sidebar-wrapper ul li').removeClass("active");
        $('.createVoucherNav').addClass("active");
      }
      if ( $('.storeDetailPage').length ) {
        $('.sidebar-wrapper ul li').removeClass("active");
        $('.storeDetailNav').addClass("active");
      }
      if ( $('.voucherListPage').length ) {
        $('.sidebar-wrapper ul li').removeClass("active");
        $('.voucherListNav').addClass("active");
      }
      if ( $('.createVoucherPage').length ) {
        $('.sidebar-wrapper ul li').removeClass("active");
        $('.createVoucherNav').addClass("active");
      }
      if ( $('.createVoucherPage').length ) {
        $('.sidebar-wrapper ul li').removeClass("active");
        $('.createVoucherNav').addClass("active");
      }
      if ( $('.addTermsPage').length ) {
        $('.sidebar-wrapper ul li').removeClass("active");
        $('.addTermsNav').addClass("active");
      }
      if ( $('.addPolicyPage').length ) {
        $('.sidebar-wrapper ul li').removeClass("active");
        $('.addPolicyNav').addClass("active");
      }
    });
  </script>
  <script src="js/bootstrap.min.js" type="text/javascript"></script>

  <!--  Charts Plugin -->
  <script src="js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
  <script src="js/light-bootstrap-dashboard.js?v=1.4.0"></script>

  <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
  <script src="js/demo.js"></script>
  

</html>
