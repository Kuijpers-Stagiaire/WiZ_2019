
function timer(){   

  random = Math.floor((Math.random()*15)+1);

  if(random == 16){random = 15;}else{}

  switch(random){
    case 1:
    city = "makkum";
    break;
    case 2:
    city = "groningen";
    break;
    case 3:
    city = "katwijk";
    break;
    case 4:
    city = "amsterdam";
    break;
    case 5:
    city = "zwolle";
    break;
    case 6:
    city = "den-haag";
    break;
    case 7:
    city = "utrecht";
    break;
    case 8:
    city = "roosendaal";
    break;
    case 9:
    city = "oosterhout";
    break;
    case 10:
    city = "tilburg";
    break;
    case 11:
    city = "den-bosch";
    break;
    case 12:
    city = "arnhem";
    break;
    case 13:
    city = "helmond";
    break;
    case 14:
    city = "zelhem";
    break;
    case 15:
    city = "echt";
    break;
  }

  str = city.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    return letter.toUpperCase();
  });

  str = str.replace('-', ' ');

  if (str == "") {
    $(".stadsnaam").text("Makkum");
  }else{
    $(".stadsnaam").text(str);
  }

  $.ajax({
        type: 'GET',
        url: "http://127.0.0.1:8000/retrieveChartData.php",
        dataType: 'json',
        data: {
            str : str
        },
          // Als de query succesvol is uitgevoerd, voer het volgende uit:
          success: function(result){

            cityName = $(".stadsnaam").text();

            new Chart(document.getElementById("line-chart"), {
              type: 'line',
              data: {
                labels: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt", "Nov", "Dec"],
                datasets: [{ 
                    data: [result[0],result[1],result[2],result[3],result[4],result[5],result[6],result[7],result[8],result[9],result[10],result[11]],
                    label: cityName,
                    backgroundColor: "#f4bc73",
                    fill: true,
                    borderColor: "#f28e0b",
                  }
                ]
              },
              options: {
                title: {
                  display: false,
                  text: 'Producten toegevoegd'
                }
              }
            });

        }            
      });
 }

 timer();


// Uncomment to activate timer.
 //setInterval(timer, 12500);

$(".grid-button").on("click", function(){

  filiaal = $(this).attr("id");

  str = filiaal.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    return letter.toUpperCase();
  });

  str = str.replace('-', ' ');

  $(".stadsnaam").text(str);

  $.ajax({
        type: 'GET',
        url: "http://127.0.0.1:8000/retrieveChartData.php",
        dataType: 'json',
        data: {
            str : str
        },
          // Als de query succesvol is uitgevoerd, voer het volgende uit:
          success: function(result){

            cityName = $(".stadsnaam").text();

            new Chart(document.getElementById("line-chart"), {
              type: 'line',
              data: {
                labels: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt", "Nov", "Dec"],
                datasets: [{ 
                    data: [result[0],result[1],result[2],result[3],result[4],result[5],result[6],result[7],result[8],result[9],result[10],result[11]],
                    label: cityName,
                    backgroundColor: "#f4bc73",
                    fill: true,
                    borderColor: "#f28e0b",
                  }
                ]
              },
              options: {
                title: {
                  display: false,
                  text: 'Producten toegevoegd'
                }
              }
            });

        }            
      });
});








