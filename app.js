

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

             let regex = /\/[0-9]+/g;
             let tail = f2f_url.match(regex);
             //console.log(url, 'tail: ' + tail);

             // End at URL view/
             let stop = 'view/';
             let end = f2f_url.indexOf(stop);

             let full = end + stop.length;

             let res = f2f_url.substring(0, full);


             // Replace title spaces w/ _ to build URL
             let grocery_title = title.replace(/ /g, "_");
             grocery_title.replace('-', '');
             grocery_title.replace('&', '');

             let grocery_url = res + grocery_title + tail;






             //getIngredients(f2f_url, title);
             //console.log(foodURL, foodPic, title);

             $('.recipe-results').append('<div class="col-sm-3 group' + groupNumber + '"><div class="recipe-container"><div class="image-container">' + foodPic + '<div class="overlay"><div class="overlay-text">' + title + '</div></div></div></div>' + foodURL + ' <a class="btn btn-danger btn-block addRecipe"  data-grocery-url="' + grocery_url + '" data-title="' + title + '"><i class="fas fa-heart"></i></a></div></div></div>');
           }

           changePage();

       //clear fields
       $('#foodInput').val('');

       // Function to add recipe to database
       $('.addRecipe').click(function(){
          let $_this = $(this);

             let meal_name = $(this).siblings('.recipe-container').find('.overlay-text').text();
             //console.log(meal_name);
             let meal_url = $(this).siblings('a').attr('href');
             //console.log(meal_url);

             let meal_pic = $(this).siblings('.recipe-container').find('.image').css('background-image');
               meal_pic = meal_pic.substring(
                  meal_pic.lastIndexOf('(') + 1,
                  meal_pic.lastIndexOf(')')
              );

              let grocery_url = $_this.data('grocery-url');

             console.log(grocery_url);

             let parent = $(this).parent();






             $.post("functions.php",
             {
                 meal_name: meal_name,
                 meal_url: meal_url,
                 meal_pic: meal_pic,
                 grocery_url: grocery_url
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

 $('.favoritesDropdown>span').click(function(){
     let $mealName = $(this).text();
     let $calendarImage = $(this).data('url');
     let $mealID = $(this).data('id');
     console.log($mealID);
     $(this).closest('.dropdown-container').siblings('.meal-name').html($mealName);
     $(this).closest('.dropdown-container').siblings('.meal-id').html($mealID);
     $(this).closest('.dropdown-container').siblings('.dayMealPlan').css('background', 'url(' + $calendarImage + ')');
     $(this).closest('.dropdown-container').siblings('.dayMealPlan').html('');
     $(".favoritesDropdown").hide();
 });

 // Post current calendar selections to DB
 $('.submitCalendar').click(function(){


   // Need Date Range (week)

   let fullCalendar = true;
   // Check for unchanged
   $('.dayMealPlan').each(function(index, item) {
     console.log(item);
      if ($(item).text() === 'Click to add a favorite meal below!') {
        let $_this = $(this);

        $(this).addClass('missing');
        $('.errorOverlay').show();

        setTimeout(function () {
            $_this.removeClass('missing');
            $('.errorOverlay').fadeOut();
        }, 1500);
        fullCalendar = false;
      }

    });

    if (fullCalendar===false){return;}

     let weekNumber = $('.displaying').data('week-number');
     let monday = $('#monday .meal-id').text();
     let tuesday = $('#tuesday .meal-id').text();
     let wednesday = $('#wednesday .meal-id').text();
     let thursday = $('#thursday .meal-id').text();
     let friday = $('#friday .meal-id').text();
     let weekdays = {Monday: monday, Tuesday: tuesday, Wednesday: wednesday, Thursday: thursday, Friday: friday};

     // Gather meal IDs
     // each loop through .meal-id


   $.post("forms.php",
   {
     week: weekNumber,
     mon: monday,
     tue: tuesday,
     wed: wednesday,
     thu: thursday,
     fri: friday
   },
   function(data, status){
     console.log(data);
     $('.submitOverlay').show();

     setTimeout(function () {
         $('.submitOverlay').fadeOut();
     }, 1500);
     return false;
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
  function getIngredients() {

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


// Function to loop through calendar week date ranges
  $('.weeklyCalendar .btn').click(function(){
    let weekRanges = [];

    // Loop through all of .range
    $('.range').each(function(index, item) {
      weekRanges.push($(this).data('week-number'));

    });
    //console.log(weekRanges);

    let weekNumber = $('.displaying').data('week-number');
    console.log('week#: ' + weekNumber);
    let current = weekRanges.indexOf(weekNumber);


    if ($(this).hasClass('prev')) {

      if (current >= 1) {
        if (current === 1) {
          $('.prev').addClass('disabled');
          $('.next').removeClass('disabled');
        } else {
          $('.next').removeClass('disabled');
          $('.prev').removeClass('disabled');
        }
      } else return;

      $('.range:eq(' + current + ')').removeClass('displaying');
      current -= 1;

      let newCurrent = weekRanges[current];
      console.log('new current: ' + newCurrent);
      $('.range:eq(' + current + ')').addClass('displaying');
      $('.meal-row').removeClass('displaying');
      $('.meal-row-'+newCurrent).addClass('displaying');


    } else if ($(this).hasClass('next')) {

      if (current <= 1) {
        if (current === 1) {
          $('.next').addClass('disabled');
          $('.prev').removeClass('disabled');
        } else {
          $('.prev').removeClass('disabled');
          $('.next').removeClass('disabled');

        }
      } else return;


      $('.range:eq(' + current + ')').removeClass('displaying');
        current += 1;
        let newCurrent = weekRanges[current];
        console.log(newCurrent);
        $('.range:eq(' + current + ')').addClass('displaying');

        $('.meal-row').removeClass('displaying');
        $('.meal-row-'+newCurrent).addClass('displaying');

        //  weekRanges.indexOf(current).show();

        }
  });

  // Hide non-selected .week-row
  function properWeeks() {
    $('.meal-row:eq(1)').addClass('displaying');
  };
  properWeeks();




/*


  // Begin recipe getting
  // Build function to scrape ingredients
  let grocery_list = getGroceries();
  console.log(grocery_list);
  function getGroceries() {

    console.log($_this);

    let url = $_this.data('url');
    let title = $_this.data('title');

    console.log(url, ' + ', title);


  //   IS it better to do this server side?

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

    let full = end + stop.length;

    let res = url.substring(0, full);


    // Replace title spaces w/ _ to build URL
    title = title.replace(/ /g, "_");
    title.replace('-', '');
    title.replace('&', '');
    let getUrl = res + title + tail;
*/
    // Gets ingredients using built url

  /*  $.get(getUrl, function(data, status){
        var x = $.parseHTML(data);

        var y = $(x).find('.about-container ul').html();
        console.log('grocery-list: ' + y);
        return y;
      }); */
      /*
      ajaxCall1();
      function ajaxCall1(){
        var promises = [];
        $.ajax({
          type: "get",
          url: getUrl,
          success: function(data) {
              var x = $.parseHTML(data);

              var y = $(x).find('.about-container ul').html();
              console.log('grocery-list: ' + y);
              //ajaxCall2(y);
              promises.push(y);
            },
            error: function() {
                alert('Error occured');
            }
        });
        console.log('promises: ' + promises);
        return promises;
      }
*/
/*     function ajaxCall2(list) {
       console.log('final list: ' + list);

        $.post('groceries.php'
          {
            grocery_list: list
          },
            function(){
              $(parent).append('<p class="confirmation">Added!</p>');
                //$(this).append(data + "added!");
            });
        };

      }

*/
//  };




// End recipe getting




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
