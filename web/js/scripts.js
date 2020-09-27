$(function () {
   let routeTree = $('#routeTree');

   $("#roleForm").on('change', function () {
      let currentRoleId = $(this).find('select[name="roleId"]').val();
      $.post('/ajax/routes', {roleId: currentRoleId})
          .done(function (answer) {
             let response = JSON.parse(answer);
             if (response.status)
               routeTree.html(response.html);
          });
   });

});