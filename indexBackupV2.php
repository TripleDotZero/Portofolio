<!DOCTYPE html>
<html>
<head>
	<title>Mohamed's Game API</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">

	<div class="header">
		<a href="http://79435.ict-lab.nl/prive/"><i style="color:white; padding:10px;" class="fa fa-home fa-2x"></i></a>
		<input class="searchBar" type="text" id="zoek" >
		<button type="button" class="searchButon" id="searchButon" onClick="search()">Search</button>
	</div>
</head>
<body>

</body>
</html>
<script type="text/javascript">

	$('a[href$="$page"]')

	function search() {
		//pak de variable waar hij op moet gaan zoeken
		var zoektekst = document.getElementById('zoek').value;
		 zoektekst = zoektekst.replace(/ /g,"-");

	if(window.location.href.indexOf("?") > -1) {

 		var href = window.location.href,
		newUrl = href.substring(0, href.indexOf('?'))
		window.history.replaceState({}, '', newUrl);

    	var currentUrl = window.location.href;
    	//voeg de &wp= toe aan de ulr met wat er voorgezocht moet worden
		var newUrl = "" + currentUrl + "?wp="+zoektekst;
//alert("url: "+newUrl);
		// ga naar de zo juist gemaakt url
		window.location.replace(newUrl);

    }else{
    	var currentUrl = window.location.href;
    	//voeg de &wp= toe aan de ulr met wat er voorgezocht moet worden
		var newUrl = "" + currentUrl + "?wp="+zoektekst;
//alert("url: "+newUrl);
		// ga naar de zo juist gemaakt url
		window.location.replace(newUrl);
    }
}
</script>
<?php

$curl = curl_init();

$page = $_GET['page'];
$wp = $_GET['wp'];

if(!$page)
	$page = 1;

$pageMin1 = $page - 1;
$pageMin2 = $page - 2;

$pagePlus1 = $page+1;
$pagePlus2= $page + 2;

$pageOffset = ($page - 1) * 50;

if(!$wp){
	$wp = "";
}


$url = "https://api-2445582011268.apicast.io/games/?search=$wp&fields=name,popularity,cover,rating&limit=50&offset=$pageOffset&order=popularity:desc";



curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache",
    "user-key: ed844db058b36c2b2b8a944b6c59c9ac"
  ),
));

$data = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

$obj = json_decode($data);

if ($error) {
  echo "cURL Error #:" . $error;
} else {
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

// 	cho "$url";
// De (start) pagination voor aan de top van de pagina
		if(strpos($url, '?wp=')){
			if(strpos($url,'&'))
				$url = strstr($url, '&', true);
	//pagination if your looing trough a search list
		// pagination if your in the first and second pages
			if($page < 3){

				echo" <div class='pagination'>
						<a href='$url&page=1'>&laquo;</a>
						<a href='$url&page=1'>1</a>
						<a href='$url&page=2'>2</a>
			 			<a href='$url&page=3'>3</a>
						<a href='$url&page=4'>4</a>
			 			<a href='$url&page=5'>5</a>
			 			<a href='$url&page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
			}
		// pagination when page is between the 3e and last
			else if($page == 197 || $page > 197 ){
				echo" <div class='pagination'>
						<a href='$url&page=1'>&laquo;</a>
						<a href='$url&page=195'>195</a>
						<a href='$url&page=196'>196</a>
			 			<a href='$url&page=197'>197</a>
						<a href='$url&page=198'>198</a>
			 			<a href='$url&page=199'>199</a>
			 			<a href='$url&page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
			}

		//pagination if page is in the last 3 page's
			else{
				echo" <div class='pagination'>
						<a href='$url&page=1'>&laquo;</a>
						<a href='$url&page=$pageMin2'>$pageMin2</a>
						<a href='$url&page=$pageMin1'>$pageMin1</a>
			 			<a href='$url&page=$page'>$page</a>
						<a href='$url&page=$pagePlus1'>$pagePlus1</a>
			 			<a href='$url&page=$pagePlus2'>$pagePlus2</a>
			 			<a href='$url&page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
				}
		}else{
	//the pagiantion that starts with ?
		// pagination if your in the first and second pages
			if($page < 3){
				echo" <div class='pagination'>
						<a href='?page=1'>&laquo;</a>
						<a href='?page=1'>1</a>
						<a href='?page=2'>2</a>
			 			<a href='?page=3'>3</a>
						<a href='?page=4'>4</a>
			 			<a href='?page=5'>5</a>
			 			<a href='?page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
				}
					// pagination when page is between the 3e and last
			else if($page == 197 || $page > 197 ){
				echo" <div class='pagination'>
						<a href='?page=1'>&laquo;</a>
						<a href='?page=195'>195</a>
						<a href='?page=196'>196</a>
			 			<a href='?page=197'>197</a>
						<a href='?page=198'>198</a>
			 			<a href='?page=199'>199</a>
			 			<a href='?page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
			}

		//pagination if page is in the last 3 page's
			else{
				echo" <div class='pagination'>
						<a href='?page=1'>&laquo;</a>
						<a href='?page=$pageMin2'>$pageMin2</a>
						<a href='?page=$pageMin1'>$pageMin1</a>
			 			<a href='?page=$page'>$page</a>
						<a href='?page=$pagePlus1'>$pagePlus1</a>
			 			<a href='?page=$pagePlus2'>$pagePlus2</a>
			 			<a href='?page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
				}
			}
	// De (end) pagination voor aan de top van de pagina
		if($wp != ""){
			echo "<h4>uw zoekopdracht is: $wp</h4>";
		}

	echo "<div id='container' class='container'>";

		foreach ($obj as $value) {
			$id = $value->{'id'};
			$name = $value->{'name'};
			$rating = $value->{'rating'};
			$popularity = $value->{'popularity'};
			$cover_url = $value->{'cover'}->{'url'};
			if(strpos($name, $Search)){
				echo "true";
			}
			if(!$rating){
				$rating = "-";
			}

			echo "<div class='item_row'>";
			echo "<img class='cover' stlye='float:right;' src='$cover_url' width='100px' height='auto'>";
			echo "<h2>$name</h2>";
			echo "<p>rating: $rating <br />";
			echo "popularity: $popularity </p>";
			echo "</div>";
		}
		echo"</div>";
// De (start) pagination voor aan de top van de pagina
		if(strpos($url, '?wp=')){
			if(strpos($url,'&'))
				$url = strstr($url, '&', true);
	//pagination if your looing trough a search list
		// pagination if your in the first and second pages
			if($page < 3){

				echo" <div class='pagination'>
						<a href='$url&page=1'>&laquo;</a>
						<a href='$url&page=1'>1</a>
						<a href='$url&page=2'>2</a>
			 			<a href='$url&page=3'>3</a>
						<a href='$url&page=4'>4</a>
			 			<a href='$url&page=5'>5</a>
			 			<a href='$url&page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
			}
		// pagination when page is between the 3e and last
			else if($page == 197 || $page > 197 ){
				echo" <div class='pagination'>
						<a href='$url&page=1'>&laquo;</a>
						<a href='$url&page=195'>195</a>
						<a href='$url&page=196'>196</a>
			 			<a href='$url&page=197'>197</a>
						<a href='$url&page=198'>198</a>
			 			<a href='$url&page=199'>199</a>
			 			<a href='$url&page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
			}

		//pagination if page is in the last 3 page's
			else{
				echo" <div class='pagination'>
						<a href='$url&page=1'>&laquo;</a>
						<a href='$url&page=$pageMin2'>$pageMin2</a>
						<a href='$url&page=$pageMin1'>$pageMin1</a>
			 			<a href='$url&page=$page'>$page</a>
						<a href='$url&page=$pagePlus1'>$pagePlus1</a>
			 			<a href='$url&page=$pagePlus2'>$pagePlus2</a>
			 			<a href='$url&page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
				}
		}else{
	//the pagiantion that starts with ?
		// pagination if your in the first and second pages
			if($page < 3){
				echo" <div class='pagination'>
						<a href='?page=1'>&laquo;</a>
						<a href='?page=1'>1</a>
						<a href='?page=2'>2</a>
			 			<a href='?page=3'>3</a>
						<a href='?page=4'>4</a>
			 			<a href='?page=5'>5</a>
			 			<a href='?page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
				}
					// pagination when page is between the 3e and last
			else if($page == 197 || $page > 197 ){
				echo" <div class='pagination'>
						<a href='?page=1'>&laquo;</a>
						<a href='?page=195'>195</a>
						<a href='?page=196'>196</a>
			 			<a href='?page=197'>197</a>
						<a href='?page=198'>198</a>
			 			<a href='?page=199'>199</a>
			 			<a href='?page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
			}

		//pagination if page is in the last 3 page's
			else{
				echo" <div class='pagination'>
						<a href='?page=1'>&laquo;</a>
						<a href='?page=$pageMin2'>$pageMin2</a>
						<a href='?page=$pageMin1'>$pageMin1</a>
			 			<a href='?page=$page'>$page</a>
						<a href='?page=$pagePlus1'>$pagePlus1</a>
			 			<a href='?page=$pagePlus2'>$pagePlus2</a>
			 			<a href='?page=199'>&raquo;</a>
					</div> ";
				echo "</div>";
				}
			}
	// De (end) pagination voor aan de top van de pagina
	}
 ?>

