
$( document ).ready(function() {

  var rangeElement = document.querySelector('input[type="range"]');
  var infoElement = $(".info");
  var switchElement = $("#led");
  var switchElement1 = $("#led1");

  updateRange(rangeElement);

  var rangeValue = function(){
    var newValue = rangeElement.value;

    calculePercent(newValue)

    if(Number(newValue)>=1){
      switchElement.prop("checked", true);
    }else {
      switchElement.prop("checked", false);
    }

    sendData(newValue);
    setBlur(newValue);
    updateRange(rangeElement);

  }



  rangeElement.addEventListener("input", rangeValue);

  switchElement.on('change', function() {
    if ($(this).is(':checked') ) {
 
      infoElement.text("100%");
      rangeElement.value = 255;
      updateRange(rangeElement);
      sendData(255);


      // setBlur(255)

    } else {

      infoElement.text("0%");
      rangeElement.value = 0;
      updateRange(rangeElement);
      sendData(0);
      // setBlur(0)

    }
  });


  switchElement1.on('change', function() {
    if ($(this).is(':checked') ) {

      infoElement.text("100%");
      // rangeElement.value = 255;
      // updateRange(rangeElement);
      sendData1(255);


      // setBlur(255)

    } else {

      infoElement.text("0%");
      // rangeElement.value = 0;
      // updateRange(rangeElement);
      sendData1(0);
      // setBlur(0)

    }
  });

});

function calculePercent(value){
  percent = (Number(value)/255*100).toFixed();
  $(".info").text(percent+"%");
}



function sendData(value){
  $.ajax({
    url: "led.php",
    type: "POST",
    data:{ led: value}
  });     
}

function sendData1(value){
  $.ajax({
    url: "led.php",
    type: "POST",
    data:{ led1: value}
  });
}

// function setBlur(value){
//   blur=(Number(value)/255*40).toFixed();
//   $("#blur").attr('stdDeviation', blur);
// }