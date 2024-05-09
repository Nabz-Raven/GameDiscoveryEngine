   <?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About GDE</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
      }

      nav {
        background-color: #444;
        padding: 10px;
        text-align: center;
      }

      nav a {
        color: #fff;
        text-decoration: none;
        padding: 10px;
        margin: 0 10px;
      }

      section {
        padding: 20px;
      }

      footer {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>About Us</h1>
    </header>

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

        <!-- Main about us content section -->
        <section id="about-us">
          <div class="container">
            <h1>About the Game Discovery Engine</h1>

            <h2>Our Vision</h2>
            <p>
              At the core of the Game Discovery Engine is a vision to
              revolutionize the gaming landscape. We aim to bridge the gap
              between gamers and tailored game recommendations, ensuring that
              users, regardless of their gaming background, can seamlessly
              discover titles that match their preferences and age group.
            </p>

            <h2>What Sets Us Apart</h2>
            <p>
              Unlike traditional recommendation systems, the Game Discovery
              Engine prioritizes user privacy and accessibility. We understand
              that not everyone wants to create an account to receive
              personalized suggestions, so we've designed our engine to provide
              recommendations without the need for user accounts. Our unique age
              filtering feature adds an extra layer of personalization, catering
              to users of different age groups and ensuring a safer gaming
              environment.
            </p>

            <h2>How It Works</h2>
            <p>
              Powered by advanced algorithms, machine learning, and natural
              language processing, our engine analyzes user preferences,
              behaviors, and inputs to deliver tailored recommendations. Whether
              you're a seasoned gamer or someone exploring video games for the
              first time, the Game Discovery Engine is here to make your gaming
              journey more exciting and enjoyable.
            </p>

            <h2>Join Us on the Gaming Adventure</h2>
            <p>
              Embark on a gaming adventure with the Game Discovery Engine.
              Discover titles beyond the mainstream, explore underrated gems,
              and enjoy a personalized gaming experience like never before.
              Thank you for being part of our gaming community!
            </p>
          </div>
        </section>

      </body>
    </html>

    <footer>
      <p>
        &copy;
        <?php echo date("Y"); ?>
        Game Discovery Engine. All rights reserved.
      </p>
    </footer>
  </body>
</html>
