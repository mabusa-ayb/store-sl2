<!-- /.content-wrapper -->
  <footer class="main-footer">
      <?php
      $copyYear = 2020;
      $curYear = date('Y');
      ?>
    <strong>Copyright &copy; <?php  echo $copyYear.(($copyYear != $curYear) ? '-'.$curYear: '');?> <a href="#">Modjalefa.code</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
