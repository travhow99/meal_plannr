

 let API_key = "69ada04a6ea560cac9738b2e25124938";
 let result, recipe;


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

             let foodPic = "<div style='background-image:url(" + recipe.recipes[x].image_url + ")' class='image ' ></div>";

             let title = recipe.recipes[x].title;

             let f2f_url = recipe.recipes[x].f2f_url;

             getIngredients(f2f_url, title);
             //console.log(foodURL, foodPic, title);

             $('.recipe-results').append('<div class="col-sm-3 group' + groupNumber + '"><div class="recipe-container"><div class="image-container">' + foodPic + '<div class="overlay"><div class="overlay-text">' + title + '</div></div></div></div>' + foodURL + ' <a class="btn btn-info btn-block addRecipe"><i class="fas fa-heart"></i></a><a class="btn btn-info btn-block getList"><i class="fas fa-heart"></i></a></div></div></div>');
           }

           changePage();

       //clear fields
       $('#foodInput').val('');

       // Function to add recipe to database
       $('.addRecipe').click(function(){
             let meal_name = $(this).siblings('.recipe-container').find('.overlay-text').text();
             //console.log(meal_name);
             let meal_url = $(this).siblings('a').attr('href');
             //console.log(meal_url);

             let meal_pic = $(this).siblings('.recipe-container').find('.image').css('background-image');
             meal_pic = meal_pic.substring(
                meal_pic.lastIndexOf('(') + 1,
                meal_pic.lastIndexOf(')')
            );

             console.log(meal_pic);

             let parent = $(this).parent();

             $.post("functions.php",
             {
                 meal_name: meal_name,
                 meal_url: meal_url,
                 meal_pic: meal_pic
             },
             function(){
               $(parent).append('<p class="confirmation">Added!</p>');
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

     // Add .active to current page
     $('.pagination>li').removeClass('active');
     $('.pagination>li:nth-of-type(' + (page + 2) + ')').addClass('active');

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

 // .addMeal buttons for home (weekly calendar)
 $('.addMeal').click(function(e){
   $('.hide-button').click();
   $(this).siblings('.dropdown-container').find('.favoritesDropdown').show();
  // $(this).siblings('.hide-button').show();

   e.stopPropagation();
   //$(this).before('tacos');
 });

 $(".favoritesDropdown").click(function(e){
    e.stopPropagation();
  });

  $(document).click(function(){
      $(".favoritesDropdown").hide();
  });

 $('.hide-button').click(function(){
   $('.favoritesDropdown').hide();
   $(this).hide();
 });

 $('.favoritesDropdown>span').click(function(){
     let $mealName = $(this).text();
     let $calendarImage = $(this).data('url');
     console.log($calendarImage);
     $(this).closest('.dropdown-container').siblings('.dayMealPlan').after($mealName);
     $(this).closest('.dropdown-container').siblings('.dayMealPlan').css('background', 'url(' + $calendarImage + ')');
     $(".favoritesDropdown").hide();
 });

 // Post current calendar selections to DB
 $('.submitCalendar').click(function(){
   let monday = $('#monday .dayMealPlan').text();
   let tuesday = $('#tuesday .dayMealPlan').text();
   let wednesday = $('#wednesday .dayMealPlan').text();
   let thursday = $('#thursday .dayMealPlan').text();
   let friday = $('#friday .dayMealPlan').text();
   let weekdays = {Monday: monday, Tuesday: tuesday, Wednesday: wednesday, Thursday: thursday, Friday: friday};

   for (let newMeal in weekdays) {
     if (weekdays[newMeal] === 'Click to add a favorite meal below!'){
       alert('Please select a meal for ' + newMeal);
       break;
     }
   }

   //weekdays.push(monday, tuesday, wednesday, thursday, friday);
/*
   for (let x = 0; x < weekdays.length; x++) {
     if (weekdays[x] === 'Click to add a favorite meal below!'){
       alert('Please select ');
       break;
     }
   }
*/
   //console.log(monday, tuesday);
   $.post("forms.php",
   {
     mon: monday,
     tue: tuesday,
     wed: wednesday,
     thu: thursday,
     fri: friday
   },
   function(data, status){
     console.log(data);
   });
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

  // Add meals to calendar

  $(".pop").popover({ trigger: "manual" , html: true, animation:false})
      .on("mouseenter", function () {
          var _this = this;
          $(this).popover("show");
          $(".popover").on("mouseleave", function () {
              $(_this).popover('hide');
          }),
          $('.dayz').click(function() {
            console.log($(this).text() + ' ' + $(this).data('meal'));
          });
      }).on("mouseleave", function () {
          var _this = this;
          setTimeout(function () {
              if (!$(".popover:hover").length) {
                  $(_this).popover("hide");
              }
          }, 300);
  });

  /* Build function to scrape ingredients */
  function getIngredients(url, title) {

    // Search Recipe
    // get f2f_url
    // Append meal name between `view/` + `/numbers`
        // REGEX for finding trailing numbers: (\/[0-9]+)
    let regex = /\/[0-9]+/g;
    let tail = url.match(regex);
    //console.log(url, 'tail: ' + tail);

    // End at URL view/
    let stop = 'view/';
    let end = url.indexOf(stop);
    console.log(end);
    let full = end + stop.length;
    console.log(full);
    let res = url.substring(0, full);


    // Replace title spaces w/ _ to build URL
    title = title.replace(/ /g, "_");
    let getUrl = res + title + tail;


    $( "#grocery-list" ).load( getUrl + " [itemprop=ingredients]" );
  }

/* Possible Get function to get grocery list

    $(document).ready(function(){
      $("button").click(function(){
          $.get("https://food2fork.com/view/Dark_and_Stormy/36227", function(data, status){
              $('#result').html(data);
              $('#result').hide();

              $('#list').html($('body').find('[itemprop=ingredients]'));

          });
      });
  });
*/
