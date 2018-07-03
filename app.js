

 let API_key = "69ada04a6ea560cac9738b2e25124938";
 let result;

 let recipe;

 $('#submitRecipe').click(function() {
   let food = $('#foodInput').val();
   food = food.replace(" ", "%20");
   //let city = $('#location').val();
   //$('#location').val("");
   $.ajax({url: "https://food2fork.com/api/search?key=" + API_key + "&q=" + food + "&page=2&sort=q", success: function(result){
    recipe = jQuery.parseJSON(result);
     console.log(recipe);
       //console.log("got the data,", result);


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
             let foodURL = "<a href='" + recipe.recipes[x].f2f_url + "' target='_blank'>Get Recipe</a>";

             let foodPic = "<img src='" + recipe.recipes[x].image_url + "' class='img-responsive' />";

             let title = recipe.recipes[x].title;
             //console.log(foodURL, foodPic, title);

             $('.response_msg').append('<div class="col-sm-3"><h3>' + title + '</h3>' + foodPic + '<br>' + foodURL + '</div>');

           }

       //clear fields
       $('#foodInput').val('');

   }});
 });