<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>API query</title>
    <style>
      form {
        width: 50vw;
        margin: auto;
        background: rgb(201, 198, 198);
        padding: 5vh;
      }
      input[type="text"] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }

      input[type="submit"],
      input[type="button"] {
        width: 100%;
        background-color: #4caf50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      input[type="submit"]:hover,
      input[type="button"]:hover {
        background-color: #45a049;
      }

      .output,.output2 {
        padding: 20px;
        margin: 20px;
      }
    </style>
  </head>
  <body>
    <form action="./externalapi.php" method="POST">
      <label for="query">Type a query to search on wikipedia</label>
      <input type="text" name="query" id="query" placeholder="query...." required/>
      <input type="submit" value="Make traditional call" />
      <input type="button" value="Make ajax call" onclick="sendQuery()" />
    </form>
    <div class="output"></div>
    
<?php 
if(isset($_POST['query'])){
  $curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://en.wikipedia.org/w/rest.php/v1/search/page?q=$_POST[query]&limit=1");

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($curl);

curl_close($curl);
$output=json_decode($output);
echo "<div class='output2'>
<h1>Traditional call output</h1>
<h2>".$output->pages[0]->title."</h2>
      <h4>".$output->pages[0]->description."</h4>";
if($output->pages[0]->thumbnail){
  echo "<img src='".$output->pages[0]->thumbnail->url."' alt='".$output->pages[0]->title."' height='".$output->pages[0]->thumbnail->height."' width='".$output->pages[0]->thumbnail->width."' />";
}
echo "<div>".$output->pages[0]->excerpt."</div></div>";
}
?>
    <script>
      async function sendQuery() {
        const query = document.querySelector("#query").value;
        if(query.trim()===""){alert('enter something first to search');
        return;}
        const output = document.querySelector(".output");
        let res = await fetch(
          `https://en.wikipedia.org/w/rest.php/v1/search/page?q=${query}&limit=1`
        );
        let data = await res.json();
        let page = data.pages[0];
        let title = page.title;
        let description = page.description;
        let excerpt = page.excerpt;

        output.innerHTML = `
        <h1>AJAX call output</h1>
        <h2>${title}</h2>
      <h4>${description}</h4>
      <div class="image"></div>
      <div>${excerpt}</div>`;
        if (page.thumbnail) {
          let url = page.thumbnail.url,
            height = page.thumbnail.height,
            width = page.thumbnail.width;
          document.querySelector(
            ".image"
          ).innerHTML = `<img src="${url}" alt="${title}" height="${height}" width="${width}" />`;
        }
      }
    </script>
  </body>
</html>

