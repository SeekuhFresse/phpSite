<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PJ-Writing</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>PeanutButter n' Jelly Writing</h1>
    <nav>
      <a href="index.html">Home</a>
      <a href="about.html">About</a>
      <a href="writing.html">Writing</a>
      <a href="random.html">Random</a>
    </nav>
    <img src="image.jpg" alt="Image">
  </header>
  <main>
    <h2>Our Writing</h2>
    <input type="text" id="search" placeholder="Search by title...">
    <select id="filter">
      <option value="all">All categories</option>
      <option value="essay">Essay</option>
      <option value="story">Story</option>
      <option value="article">Article</option>
    </select>
   <!-- <div class="grid" id="grid"> 
    </div> -->
 
    <?php 
    $server = "localhost";
    $user = "root";
    $pw = "";
    $db = "Test";
    $table = "Autos";
    
    // Aufbau der Datenbankverbindung
    $conn = mysqli_connect($server, $user, $pw, $db);
    if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
    }

    // Prüfung, ob das Script über Adresse oder über Form aufgerufen wurde, und Definition des Filters
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if (isset($_POST['suche'])) {
        $filter = mysqli_real_escape_string($conn, $_POST['suche']);
        $sql = "SELECT * FROM $table WHERE name LIKE '$filter%'";
      }
    } 
  else {
    $sql = "SELECT * FROM $table";
  }

  // Ausführen des SQL-Befehls in der Datenbank
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die("Auslesen nicht erfolgreich: " . mysqli_error($conn));
  }

 /* echo '<div class="grid" id="grid">';
  while ($car = mysqli_fetch_assoc($result)) {
    echo '<div class="texts">';
    echo $car["Model"] . "<br />";
    echo '</div>';
  } */
  echo '</div>';

  // Ermittlung Anzahl Datensätze
  $anzahl_datensaetze = mysqli_num_rows($result);
  echo "<tr class='headline' height='30'><td colspan='7'>Anzahl Datensätze: $anzahl_datensaetze</td></tr>";

  // Überschrift mit Suchmaske
echo "<tr height='25' class='headline'>
<td colspan='7' valign='center'>
<form action='". htmlspecialchars($_SERVER['PHP_SELF']) ."' method='post'>
Suche nach Namen:
<input type='text' name='suche' value=''>
<input type='submit' name='' value='Suchen'>
</form>
</td>
</tr>";
 echo '<table class="Autos">';
    echo '<tr>';
      echo '<th>Hersteller</th>';
      echo '<th>Modell</th>';
      echo '<th>Typ</th>';
      echo '<th>Farbe</th>';
      echo '<th>Zustand</th>';
      echo '<th>Status</th>';
      echo '<th>Kilometer</th>';
      echo '<th>Sprit</th>';
      echo '<th>Preis</th>';
      echo '<th>Verkäufer</th>';
    echo '</tr>';
// Zeilenweises Einlesen der Datensätze und Ausgabe mittels Schleife
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $format = ($i % 2) ? "text1" : "text2";
    $id = htmlspecialchars($row['AID']);
    echo "<tr class='$format'><td>". htmlspecialchars($row['Hersteller']) ."</td>";
    echo "<td>". htmlspecialchars($row['Model']) ."</td>";
    echo "<td>". htmlspecialchars($row['Typ']) ."</td>";
    echo "<td>". htmlspecialchars($row['Farbe']) ."</td>";
    echo "<td>". htmlspecialchars($row['Zustand']) ."</td>";
    echo "<td>". htmlspecialchars($row['Status']) ."</td>";
    echo "<td>". htmlspecialchars($row['Kilometer']) ."</td>";
    echo "<td>". htmlspecialchars($row['Sprit']) ."</td>";
    echo "<td>". htmlspecialchars($row['Preis']) ."</td>";
    echo "<td>". htmlspecialchars($row['Username']) ."</td>";
    $i++;
}

mysqli_close($conn);
    ?>
  </table>
  </main>
  <footer>
    <p>© 2023 PBnJ Limited & APS & Stiftung & e.V. & FLINTA & Co. KG. All rights reserved. | Contact me at <a href="mailto:paul@arbus.today">paul@arbus.today</a></p>
  </footer>
  <div class="modal" id="modal">
    <div class="modal-content" id="modal-content">
      <!--  full textdynamically added here -->
      <span class="close" id="close">×</span>
    </div>
  </div>
</body>
  <script> 
const filter = document.getElementById("filter");// get the filter select element by id 
const grid = document.getElementById("grid"); // get the grid element by id 



//-----------Filter and grid------------------
// define a function to filter the texts by category
function filterTexts(filterValue) {
  // if the filter value is "all", return the original texts array
  if (filterValue === "all") {
    return texts;
  }
  // otherwise, use the filter() method to create a new array of texts that have the same category as the filter value
  else {
    return texts.filter(function(text) {
      // convert both strings to lowercase and compare them
      return text.category.toLowerCase() === filterValue.toLowerCase();
    });
  }
}



function displayTexts(textArray) { //define a function to display the texts on the grid
  grid.innerHTML = ""; // clear the grid content
  let textElements = textArray.map(function(text, key) {//use the map() method to reate an array of HTML elements from the texts array
    let textDiv = document.createElement("div");//create a div element for each text
    textDiv.id = key;// assign an id to the text div
    textDiv.classList.add("text", text.category);//add the text and category classes to the text div
    textDiv.setAttribute("data-category", text.category);//set the data-category attribute to the text category
    let textTitle = document.createElement("h3"); //create an h3 element for the text title
    textTitle.textContent = text.title;//set the text content of the h3 element to the text title
    textTitle.addEventListener("click", function() {showText(key);});// add a click event listener to the text title
    textDiv.appendChild(textTitle);//append the h3 element to the text div
    let textSummary = document.createElement("p");//create a p element for the text summary
    textSummary.textContent = text.summary;//set the text content of the p element to the text summary
    textDiv.appendChild(textSummary);//append the p element to the text div
    let textCategory = document.createElement("span");//create a span element for the text category
    textCategory.textContent = text.category;//set the text content of the span element to the text category
    textDiv.appendChild(textCategory);//append the span element to the text div
    return textDiv;//return the text div as the result

  });
  // append the text elements to the grid
  textElements.forEach(function(element) {
    grid.appendChild(element);
  });
}

filter.addEventListener("change", function() {// add a change event listener to the filter select element
  let filterValue = filter.value;// get the filter value from the select element
  let filteredTexts = filterTexts(filterValue);// call the filter function with the filter value and store the result in a variable
  displayTexts(filteredTexts);// display the filtered texts on the grid
  localStorage.setItem("filterValue", filterValue);// store the filter value in the localStorage

});

window.onload = function() {// when the page is loaded, check if there is a filter value stored in the localStorage
  let filterValue = localStorage.getItem("filterValue");  // get the filter value from the localStorage
  // if there is a filter value, set the filter select element to that value
  if (filterValue) {
    filter.value = filterValue;
  }
  // else, set the filter select element to "all"
  else {
    filter.value = "all";
  }
  let filteredTexts = filterTexts(filterValue);// call the filter function with the filter value and store the result in a variable
  displayTexts(filteredTexts);// display the filtered texts on the grid
};


//----search---
function search() {//define a search function 
  let input = document.getElementById("search").value.toLowerCase();//get the value of the input element and convert it to lowercase
  let elements = document.getElementsByClassName("text");//get the elements that you want to search by a class name or a tag name
  // loop through the elements
  for (let i = 0; i < elements.length; i++) {
    let title = elements[i].getElementsByTagName("h3")[0].textContent;//get the title of the element
    title = title.toLowerCase();//convert the title to lowercase
    // check if the input value is a substring/part of the title
    if (title.indexOf(input) > -1) {
      elements[i].style.display = "";// display the element
    } else {
      elements[i].style.display = "none";// hide the element
    }
  }
}

const input = document.getElementById("search");// get the input element by id
input.addEventListener("keyup", function() {//keyup event listener to the input element
  search();// call the search function

});


//-------Modal display-------

//a  function to show the full text in the modal
function showText(key) {
  const modal = document.getElementById("modal");//get the modal element by id
  const modalContent = document.getElementById("modal-content");//get the modal content element by id
  const close = document.getElementById("close");//get the close button element by id
  modalContent.innerHTML = "";//clear the modal content element
  let textTitle = document.createElement("h3");//create an h3 element for the text title
  textTitle.textContent = texts[key].title;//set the text content of the h3 element to the text title
  modalContent.appendChild(textTitle);//append the h3 element to the modal content element
  let textContent = document.createElement("p");//create a p element for the text content
  textContent.textContent = texts[key].content;//set the text content of the p element to the text content
  modalContent.appendChild(textContent);//append the p element to the modal content element
  let textCategory = document.createElement("span");//create a span element for the text category
  textCategory.textContent = texts[key].category;//set the text content of the span element to the text category
  modalContent.appendChild(textCategory);//append the span element to the modal content element
  modalContent.appendChild(close);//append the close button element to the modal content element
  modal.style.display = "block";//display the modal element
  // add a click event listener to the close button element
  close.addEventListener("click", function() {
    modal.style.display = "none";//hide the modal element
  });
}
</script>
