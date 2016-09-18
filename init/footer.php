<script src="/js/materialize.min.js"></script>
<script src="/js/parsley.min.js"></script>

<script>
$(document).ready(function(){
      $('select').material_select();
    $('.tooltipped').tooltip({delay: 50});
      $('#form').parsley();
          $('.modal-trigger').leanModal();
  });
  </script>
</body>
</html>
