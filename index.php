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
  .bg{
  
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
    <b>Pokemon</b>: ${film.Pokemon}<br /> 
            <b>Name</b>: ${film.Name}<br /> 
             <b>Type</b>: ${film.Type}<br />
            <b>Abilities</b>: ${film.Abilities}<br /> 
            <b>Height</b>: ${film.Height}<br /> 
            <b>Breeding</b>: ${film.Breeding}<br /> 
            <b>Gender</b>: ${film.Gender}<br /> 
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
    <div class="bg">
	<h1>Welcome to the Pokemon world!</h1>
		<a href="year" class="category">First level of Evolution</a><br />
		<a href="box" class="category">Last level of Evolution </a>
		<h3 id="filmtitle">Pokmon</h3>
		<div id="films">
		</div>
		<div id="output"></div>
    </div>
	</body>
</html>