<?php include("header.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GDE</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

  /* Styles for header */
  header {
    background-color: rgba(0, 0, 0, 0.442);
    color: white;
    padding: 20px 0;
    text-align: center;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 2;
  }

  /* Styles for navigation */
  nav {
    background-color: rgba(0, 0, 0, 0.5);
    position: absolute;
    top: 120px; /* Adjust top position to place it below the header */
    width: 100%;
    padding: 10px 0;
    color: white;
    z-index: 2;
    text-align: center;
  }

  nav a {
    color: white;
    text-decoration: none;
    padding: 0 20px;
  }

  /* Styles for section content */
  section {
    padding-top: 140px; /* Add padding to the top to center content vertically */
  }
       h1 {
    text-align: center; /* Center the paragraph horizontally */
  }
 /* New styles for search container */
  #search-container {
    text-align: center; /* Center the content horizontally */
  }

  /* New styles for labels */
  label {
    display: block; /* This ensures each label appears on a new line */
    margin-bottom: 5px; /* Add some space between each label and its associated input */
    font-weight: bold; /* Make the labels bold for better visibility */
    margin-top: 10px;
  }

  /* New styles for input fields */
  input[type="text"] {
    width: 400px; /* Set the width of the input fields */
    padding: 10px; /* Add some padding to the input fields */
    border: 3px solid #ccc; /* Add a border to the input fields */
    border-radius: 10px; /* Add some border-radius for rounded corners */
    box-sizing: border-box; /* Ensure padding and border are included in the width */
  }


  button {
    padding: 10px 20px; /* Add padding to the button */
    background-color: #007bff; /* Set the background color of the button */
    color: #fff; /* Set the text color of the button */
    border: none; /* Remove the border */
    border-radius: 10px; /* Add some border-radius for rounded corners */
    cursor: pointer; /* Change cursor to pointer on hover */
    display: block; /* Display the button as a block element */
    margin: 0 auto; /* Center the button horizontally */
    margin-top: 20px;
    width: 400px;
  }

  button:hover {
    background-color: #0056b3; /* Darken the background color on hover */
  }
     /* Styles for footer */
  footer {
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    text-align: center;
    padding: 0px 0;
    position: absolute;
    bottom: 0;
    width: 100%;
    z-index: 2;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  footer p {
        margin: 10px;
      }
  footer p:first-child {
        padding-left: 580px; /* Add left padding */ 
      }
    </style>
  </head>
  <!--Content-->
  <body>
    <header>
      <h1>Welcome To Game Discovery Engine</h1>
    </header>
    <!--Navigation Bar Content-->
  <nav>
      <a href="index.php">Home</a>
      <a href="about.php">About Us</a>
      <a href="contact.php">Contact</a>
    <?php if (isLoggedIn()) : ?>
        <a href="profile.php">Profile</a>
        <a href="?logout=true">Logout</a>
    <?php else : ?>
        <a href="login.php">Login</a>
    <?php endif; ?>
    </nav>
    <section>
    
      <h1>Enter some games and age, see what you get!</h1>
  <div id="search-container">
    <label for="game1">Game Title 1:</label>
    <input type="text" id="game1" placeholder="Enter game 1">
  
    <label for="game2">Game Title 2:</label>
    <input type="text" id="game2" placeholder="Enter game 2">

    <label for="game3">Game Title 3:</label>
    <input type="text" id="game3" placeholder="Enter game 3">
  
    <label for="age">Age:</label>
    <input type="text" id="age" placeholder="Enter age">
     
    <button onclick="search()">Search</button>
    
  </div>
    </section>
    <footer>
      <p>
        &copy;
        <?php echo date("Y"); ?>
        Game Discovery Engine. All rights reserved.
      </p>
    </footer>
  </body>
</html>
