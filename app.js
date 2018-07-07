

 let API_key = "69ada04a6ea560cac9738b2e25124938";
 let result;

 let recipe;

 $('#searchRecipe').click(function() {
   let food = $('#foodInput').val();
   //food = food.replace(" ", "%20");
   //let city = $('#location').val();
   //$('#location').val("");
   $.ajax({url: "https://food2fork.com/api/search?key=" + API_key + "&q=" + food + "&count=4&sort=r", success: function(result){
     // Clear div upon new search
     $('.recipe-results').empty();

    recipe = jQuery.parseJSON(result);
     console.log(recipe);
       //console.log("got the data,", result);
       $('.recipe-results').append('<h2>Recipe Results for ' + food);

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


          // Loop through data and format
          for (let x = 0; x < recipe.recipes.length; x++){
              // Create Link
             let foodURL = "<a class='btn btn-default' href='" + recipe.recipes[x].source_url + "' target='_blank'><i class='fas fa-utensils'></i> Get Recipe</a>";

             let foodPic = "<img src='" + recipe.recipes[x].image_url + "' class='img-responsive' />";

             let title = recipe.recipes[x].title;
             //console.log(foodURL, foodPic, title);

             $('.recipe-results').append('<div class="col-sm-3"><div class="recipe-container"><h4>' + title + '</h4>' + foodPic + '<br>' + foodURL + ' <a class="btn btn-info addRecipe"><i class="fas fa-heart"></i> Add to Favorites</a></div></div>');
           }

       //clear fields
       $('#foodInput').val('');

       // Function to add recipe to database
       $('.addRecipe').click(function(){
             let meal_name = $(this).siblings('h4').text();
             let meal_url = $(this).siblings('a').attr('href');
             let parent = $(this).parent();

             $.post("functions.php",
             {
                 meal_name: meal_name,
                 meal_url: meal_url
             },
             function(){
               $(parent).after('<p class="confirmation">' + meal_name + ' successfully added!</p>');
                 //$(this).append(data + "added!");
             });
           });


   }});
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

   $("input").keypress(function(e) {
  	if (e.which == 13) {
  		console.log('enter');
  		$(this).next().click();
    }
  });
