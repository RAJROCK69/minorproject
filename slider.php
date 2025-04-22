<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Slider</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for better visibility */
        .carousel-item img {
            object-fit: cover;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }
        .carousel-caption {
            background: rgba(0, 0, 0, 0.6); /* Add background to text for readability */
            padding: 1rem;
            border-radius: 8px;
            
        }
       
        .button {
  background-color: #04AA6D; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
        }
        header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 10%;
      background-color: rgba(236, 236, 239, 0.8);
      padding: 5px 10px;
      z-index: 1000;
    }
    header h1 {
      margin: 0;
    }
    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    h1 {
      color: #555;
      font-size: 1.5rem;
    }

    #navbar {
      display: flex;
    }

    #navbar ul {
      display: flex;
      gap: 1rem;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    #navbar ul li a {
      text-decoration: none;
      color: #333;
      font-size: 1rem;
      font-weight: 500;
    }

    #navbar ul li a:hover {
      color: #007bff;
    }

    .navbar {
      margin-left: auto;
    }
    
  

.button2 {background-color:rgb(138, 213, 238);} /* Blue */
.button3 {background-color: #f44336;} /* Red */ 
.button4 {background-color:rgb(215, 233, 20); color: black;} 



    </style>

</head>
 <header class="py-4 px-3">
    <nav class="flex justify-between items-center">
      <h4 class="text-2xl font-bold text-grey-500">CIPHER</h4>
      <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
          <li><a class="nav-link scrollto " href="slider.php"><h1>Home</h1></a></li>
          <li><a class="nav-link scrollto" href="dataConcealed.php"><h1>Data Concealed</h1></a></li>
          
          <li><a class="nav-link scrollto" href="contact.php"><h1>Contact Us</h1></a></li>
        </ul>
        
      </nav>
    </nav>
  </header>
<body>
    <!-- Bootstrap Carousel Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>

        <!-- Slides -->
        <div class="carousel-inner"
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="pic.jpg" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption">
                    <h2>Welcome to CIPHER</h2>
                     <p> <h2>Home Page </h2></p>
                     <form action="login.php" method="POST" style="margin-top: 10px;" >
        <button type="submit" class=" button"> LET'S GO</button>
    </form>
                   
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="page2.jpg" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption">
                    <h2> Welcome to CIPHER</h2>
                    <p>Explore Data Concealed System</p>
                    <form action="login.php" method="POST" style="margin-top: 10px;" >
        <button type="submit" class="button button2"> LET'S GO</button>
    </form>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <img src="lock.jpg" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption">
                    <h2>Welcome to CIPHER</h2>
                    <p>Explore Image Encryption System</p>
                   
                    <form action="login.php" method="POST" style="margin-top: 10px;" >
        <button type="submit" class="button button3"> LET'S GO</button>
    </form>
                </div>
            </div>
            <!-- Slide 4 -->
            <div class="carousel-item">
                <img src="log.jpg" class="d-block w-100" alt="Slide 4">
                <div class="carousel-caption">
                    <h2>Welcome to CIPHER</h2>
                    <p>Explore Text Encryption System.</p>
                    <form action="login.php" method="POST" style="margin-top: 10px;" >
        <button type="submit" class="button button4"> LET'S GO</button>
    </form>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>