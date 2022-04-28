<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <title>Led</title>
  </head>
  <body>
    
    <?php 
      $obj = json_decode(file_get_contents("json/led.json"));
      $led = $obj->{'led'};
      $ledswitch = $led <= 0 ? "unchecked" : "checked";
    ?>

    <div class="head">
      <img width="52" height="52" src="img/logo.svg">
      <h1 class="sd" h="ass">Led con php y JSON</h1>
    </div>

    <div class="card">
      
      <input type="checkbox" id="led" <?php echo $ledswitch; ?>>
      <label for="led" class="switch"></label>
      
      <div class="header">
        <svg width="204" height="417" viewBox="0 0 360 735.048">
          <defs>
            <filter id="shine" x="0" y="0" width="360" height="415" filterUnits="userSpaceOnUse">
              <feOffset dy="4" input="SourceAlpha"/>
              <feGaussianBlur id="blur" stdDeviation="<?php echo ($led/255)*40; ?>" result="blur"/>
              <feFlood flood-color="#5ccca3" flood-opacity="0.7"/>
              <feComposite operator="in" in2="blur"/>
              <feComposite in="SourceGraphic"/>
            </filter>
            <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
              <stop offset="0" stop-color="#94df8e"/>
              <stop offset="1" stop-color="#31beb5"/>
            </linearGradient>
          </defs>
          <g transform="translate(-101.5 -229.952)">
            <g transform="matrix(1, 0, 0, 1, 101.5, 229.95)" filter="url(#shine)">
              <ellipse cx="60" cy="87.5" rx="60" ry="87.5" transform="translate(120 116)" fill="rgba(92,204,163,0.98)"/>
            </g>
            <rect width="10" height="360" rx="4" transform="translate(307 545)" fill="#ebebeb"/>
            <rect width="10" height="420" rx="4" transform="translate(244 545)" fill="#ebebeb"/>
            <path d="M65.5,0h0A65.5,65.5,0,0,1,131,65.5V220a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V65.5A65.5,65.5,0,0,1,65.5,0Z" transform="translate(215 332)" fill="url(#linear-gradient)"/>
            <path d="M566.338,293.986V280.6l-12.324-13.057V203.913h12.324V215.08l25.82,14.242v12.785h-25.82v18.935l12.712,12.785v20.16Z" transform="translate(-324 258)" fill="rgba(0,0,0,0.23)"/>
            <path d="M629.712,294V274.6l12.476-12.855V241.606H630.744l-44.519-24.869v-13.2h56.917v25.62h12.785v38.032l-13.739,13.245V294Z" transform="translate(-324 258)" fill="rgba(31,33,32,0.26)"/>
            <path d="M605.213,73.344s46.769,9.548,57.269,62.358c.067-.406,0,136.094,0,136.094h8.044s0-136,0-136.094C661.29,71.127,605.213,73.344,605.213,73.344Z" transform="translate(-323.608 258.616)" fill="rgba(255,255,255,0.26)"/>
            <rect width="155" height="22" rx="11" transform="translate(203 530)" fill="#31beb5"/>
          </g>
        </svg>
      </div>

      <div class="strength-led">
        <span>0</span>
        <input type="range" value="<?php echo $led; ?>" class="slider" max="255">
        <span class="info"><?php echo round(($led/255)*100); ?>%</span>
      </div>

    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/range.js"></script>
  </body>
</html>