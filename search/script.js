let currentSearch = '';

function fill(Value) {
   //Assigning value to "search" div in "search.php" file.
   $('#search').val(Value);
   //Hiding "display" div in "search.php" file.
   $('#display').hide();
}
 
$(document).ready(function() {
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
   $("#search").keyup(function() {
       //Assigning search box value to javascript variable named as "input".
       var input = $('#search').val();
       //Validating, if "input" is empty.
           currentSearch = input;
       if (input == "") {
           //Assigning empty value to "display" div in "search.php" file.
           $("#display").html("");
           $("#display").css('display', 'none');
       }
       //If input is not empty.
       else {
          $("#display").css('display', 'flex');
          $("#display").addClass("scroll");

           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "../search/ajax.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "input" into "search" variable.
                   search: input
               },
               //If result found, this funtion will be called.
               success: function(html) {
                  if(input != currentSearch) { return; }
                   //Assigning result to "display" div in "search.php" file.
                   $("#display").html(html).show();
               }
           });
       }

   });
$("#search-submit").click(function() {
  console.log("hoi");
});

});

