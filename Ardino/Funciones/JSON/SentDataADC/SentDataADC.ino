#include <WiFi.h>
#include <HTTPClient.h>
//#include <Arduino_JSON.h>


const char* ssid = "Nirmrod";
const char* password = "Kkckdbb248.";

float user = 255.13;
float pass = 255.15;


void setup() {
  delay(10);
  Serial.begin(115200);


  WiFi.begin(ssid, password);

  Serial.print("Conectando...");
  while (WiFi.status() != WL_CONNECTED) { //Check for the connection
    delay(500);
    Serial.print(".");
  }

  Serial.print("Conectado con éxito, mi IP es: ");
  Serial.println(WiFi.localIP());

}

void loop() {
  String user_string = String(user, 3);
  String pass_string = String(pass, 3);

  
  if(WiFi.status()== WL_CONNECTED){   //Check WiFi connection status

    HTTPClient http;
    
    String datos_a_enviar = "user_arduino=" + user_string + "&pass_arduino=" + pass_string;

    http.begin("http://192.168.0.15:8080/uag/AppWeb/get-sensor.php");        //Indicamos el destino
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Preparamos el header text/plain si solo vamos a enviar texto plano sin un paradigma llave:valor.

    int codigo_respuesta = http.POST(datos_a_enviar);   //Enviamos el post pasándole, los datos que queremos enviar. (esta función nos devuelve un código que guardamos en un int)
    delay(10000);
    if(codigo_respuesta>0){
      Serial.println("Código HTTP ► " + String(codigo_respuesta));   //Print return code

      if(codigo_respuesta == 200){
        String cuerpo_respuesta = http.getString();
        Serial.println("El servidor respondió ▼ ");
        Serial.println(cuerpo_respuesta);

      }

    }else{

     Serial.print("Error enviando POST, código: ");
     Serial.println(codigo_respuesta);

    }

    http.end();  //libero recursos

  }else{

     Serial.println("Error en la conexión WIFI");

  }

   delay(5000);
}
