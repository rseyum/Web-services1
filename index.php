<html>
<head>
<title>Bond Web Service Demo</title>
<style>
	body {font-family:georgia;}
  
   .film{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }
  
  .pic img{
	max-width:115px;
  }
</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">
  function bondTemplate(film){
    return `
    <div class="film">
            <b>Film</b>:${film.Film}<br/>
       <b>Title</b>:${film.Title}<br/>
       <b>Year</b>:${film.Year}<br/>
       <b>Director</b>:${film.Director}<br/>
       <b>Producer</b>:${film.Producer}<br/>
       <b>Writers</b>${film.Writers}<br/>
       <b>Composer</b>:${film.Composer}<br/>
       <b>Bond</b>:${film.Bond}<br/>
       <b>Budget</b>:${film.Budget}<br/>
       <b>BoxOffice</b>:${film.BoxOffice}<br/>
            <div class="pic"><img src="images/${film.Image}" /></div>
      </div>
    `;
    
  }
  
$(document).ready(function() { 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
    console.log(data);
     // place data.title on page 
     $("#filmtitle").html(data.title);
     // clear previous data
     $("#films").html("");
     // loop thru data.films and place on page
     $.each(data.films,function(i,item){
      let myData = bondTemplate(item);
       $("<div></div>").html(myData).appendTo("#films");
       
     });
     // let myData = JSON.stringify(data,null,4);
     // myData = "<pre>" + myData + "</pre>";
     // $("#output").html(myData);
   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
  });
}); 
</script>
</head>
	<body>
<h1>Bond Web Service</h1>
		<a href="year" class="category">Bond Films By Year</a><br />
		<a href="box" class="category">Bond Films By International Box Office Totals</a>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films">

		</div>
		<div id="output"></div>
	</body>
</html>