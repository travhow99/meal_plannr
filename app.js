

 let API_key = "69ada04a6ea560cac9738b2e25124938";
 let result;

 let recipe;

 $('#searchRecipe').click(function() {
   let food = $('#foodInput').val();
   $('nav').remove();

   let page = 0;

   let pagination = '<nav aria-label="Page navigation example"><ul class="pagination"><li class="page-item"><a id="pageBack" class="btn page-link">Previous</a></li><li class="page-item"><a class="btn page-number">1</a></li><li class="page-item"><a class="btn page-number" >2</a></li><li class="page-item"><a class="btn page-number">3</a></li><li class="page-item"><a class="btn page-number">4</a></li><li class="page-item"><a class="btn page-number">5</a></li><li class="page-item"><a class="btn page-number">6</a></li><li class="page-item"><a id="pageForward" class="btn page-link">Next</a></li></ul></nav>';


   // This proved to be unecessary
   //food = food.replace(" ", "%20");

   $.ajax({url: "https://food2fork.com/api/search?key=" + API_key + "&q=" + food + "&count=24&sort=r", success: function(result){
     // Clear div upon new search
     $('.recipe-results').empty();

    recipe = jQuery.parseJSON(result);
     console.log(recipe);
       //console.log("got the data,", result);
       $('.recipe-results').show().append('<h2>Recipe Results for ' + food);

       // Sample JSON Response

       /*

       f2f_url: "http://food2fork.com/view/0beb06"
       image_url: "http://static.food2fork.com/466_1_1349094314_lrg2129.jpg"
       publisher: "Jamie Oliver"
       publisher_url:"http://www.jamieoliver.com"
       recipe_id:"0beb06"
       social_rank:94.88568903341375
       source_url:"http://www.jamieoliver.com/recipes/chicken-recipes/roasted-chicken-breast-with-pancetta-leeks-and-thyme"
       title:"Roasted chicken breast with pancetta, leeks &amp; thyme"

              */

              //page -1 * 4

          // Loop through data and format
          for (let x = 0; x < recipe.recipes.length; x++){
            let groupNumber = Math.floor(x / 4);

              // Create Link
             let foodURL = "<a class='btn btn-default btn-block' href='" + recipe.recipes[x].source_url + "' target='_blank'><i class='fas fa-utensils'></i></a>";

             let foodPic = "<img src='" + recipe.recipes[x].image_url + "' class='image img-responsive' />";

             let title = recipe.recipes[x].title;
             //console.log(foodURL, foodPic, title);

             $('.recipe-results').append('<div class="col-sm-3 group' + groupNumber + '"><div class="recipe-container"><div class="image-container">' + foodPic + '<div class="overlay"><div class="overlay-text">' + title + '</div></div></div></div>' + foodURL + ' <a class="btn btn-info btn-block addRecipe"><i class="fas fa-heart"></i></a></div></div></div>');
           }

           changePage();

       //clear fields
       $('#foodInput').val('');

       // Function to add recipe to database
       $('.addRecipe').click(function(){
             let meal_name = $(this).siblings('.recipe-container').find('.overlay-text').text();
             console.log(meal_name);
             let meal_url = $(this).siblings('a').attr('href');
             console.log(meal_url);
             let parent = $(this).parent();

             $.post("functions.php",
             {
                 meal_name: meal_name,
                 meal_url: meal_url
             },
             function(){
               $(parent).append('<p class="confirmation">' + meal_name + ' successfully added!</p>');
                 //$(this).append(data + "added!");
             });
           });


   }});
   $('.recipe-results').parent().append(pagination);

   // Change page to pagination #
   $('.page-number').click(function(){
     page = parseInt($(this).text()) - 1;
     console.log(page);
     changePage();
   });


   $('#pageBack').click(function() {
     console.log('back');
     if (page !== 0) {
       page -= 1;
     }
     changePage();
   });

   $('#pageForward').click(function() {
     console.log('forward');
     if (page !== 5){
       page += 1;
     }
     changePage();
   });

   // Function to show proper row
   function changePage() {
     console.log(page);
     if (page !== 0 && page !== 5){
       $('#pageBack').removeClass('disabled');
       $('#pageForward').removeClass('disabled');
       console.log('disabled classes removed');
     } else if (page === 5){
       $('#pageBack').removeClass('disabled');
       $('#pageForward').addClass('disabled');
       console.log('disable forward button');
     } else if (page === 0){
       $('#pageForward').removeClass('disabled');
       $('#pageBack').addClass('disabled');
       console.log('disable back button');
     }

     for (let x = 0; x <= 5; x++) {
       if (page !== x){
         let group = '.group' + x;
         $(group).hide();
       } else {
         let group = '.group' + x;
         $(group).show();
       }
     }
   }
 });

 // Function to add recipe to database
 /*
 $('.addRecipe').click(function(){
       console.log('test');
       /*$.post("functions.php",
       {
           meal_name: "",
           meal_url: ""
       },
       function(data, status){
           alert("Data: " + data + "\nStatus: " + status);
       });
     });
     */


   $("#addNeeded").click(function() {


     let itemName = $("#neededInput").val();
     let timeLine = $("#timeLine").val();

     if (timeLine === null) {
       $("#pantryError").show();
       return;
     }

     $.post("pantry.php",
     {
         itemName: itemName,
         timeLine: timeLine
     },
     function(){
         $('#needed').prepend(itemName + " added!");
     });

   });

   $("#timeLine").keypress(function(e) {
     if (e.which == 13) {
       $("#addNeeded").click();
     }
   });

   $("input").keypress(function(e) {
  	if (e.which == 13) {
  		console.log('enter');

      // Adjust if adding to #pantry
      if (this.id === 'neededInput') {
        $("#addNeeded").click();
      } else {
  		  $(this).next().click();
      }
    }
  });
