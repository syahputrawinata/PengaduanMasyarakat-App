<html>
 <head>
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container-fluid {
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 0;
        }
        .left-section {
            background-color: #f97316;
            color: white;
            padding: 50px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right-section {
            position: relative;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        .right-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5;
        }
        .floating-icons {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .floating-icons a {
            background-color: #0f766e;
            color: white;
            padding: 15px;
            border-radius: 50%;
            text-align: center;
            font-size: 20px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-custom {
            background-color: #0f766e;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
            margin-top: 20px;
        }
        a {
            text-decoration: none;
            text-align: center;
        }
        @media (min-width: 768px) {
            .container-fluid {
                flex-direction: row;
            }
            
            .floating-icons {
                display: flex;
                flex-direction: column-reverse;
            }
        }
  </style>
 </head>
 <body>
  <div class="container-fluid">
   <div class="left-section">
    <h1>
     Pengaduan Masyarakat
    </h1>
    <p>
     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi perspiciatis aut pariatur doloremque laborum quis in praesentium at, recusandae obcaecati dicta accusantium delectus asperiores illum minima veritatis iure quidem amet rerum fugit quaerat illo!
    </p>
    <a href="login" class="btn-custom">
        Bergabung!
    </a>
   </div>
   <div class="right-section">
    <img alt="Aerial view of a city street with cars and trees" height="600" src="https://storage.googleapis.com/a1aa/image/vtMeEJwPOUySPy8UGnfZbEVzxyxrfFNfZKi6nO0FQwjWN2hPB.jpg" width="800"/>
    <div class="floating-icons">
     <a href="#">
      <i class="fas fa-user">
      </i>
     </a>
     <a href="#">
      <i class="fas fa-exclamation">
      </i>
     </a>
     <a href="#">
      <i class="fas fa-pen">
      </i>
     </a>
    </div>
   </div>
  </div>
 </body>
</html>
