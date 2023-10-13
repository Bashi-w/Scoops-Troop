<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #419d67;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      lord-icon {
        color: #9ABC66;
        width: 10em;
        height: 10em;
        margin-left:-15px;
        margin: 10%;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: auto;
        width: 25em;
      }
    </style>
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #f5faf8; margin:0 auto;">
        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
        <lord-icon
            src="https://cdn.lordicon.com/zqxjldws.json"
            trigger="loop">
        </lord-icon>
      </div>
        <h1>Success</h1> 
        <p><b>Your payment has been processed successfully!</b></p>
        <br>
        <p>We'll start preparing your ice cream right away and have it delivered to you as soon as possible. Get ready for a delightful treat!</p>
        <br>
        <p>Redirecting in <span id="countdown"><b>5</b></span> seconds...</p>
      </div>

      <script>
      // Countdown function to redirect after a specified duration
      function countdown() {
        var seconds = 5; // Change this to the desired countdown duration
        var countdownElement = document.getElementById('countdown');
        
        var interval = setInterval(function() {
          countdownElement.textContent = seconds;
          seconds--;

          if (seconds < 0) {
            clearInterval(interval);
            window.location.href = '/';
          }
        }, 1000); // 1000 milliseconds = 1 second
      }

      // Start the countdown when the page loads
      window.onload = countdown;
    </script>
    </body>
</html>