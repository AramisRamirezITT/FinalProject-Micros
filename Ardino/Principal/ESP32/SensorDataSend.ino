#include <WiFi.h>
#include <HTTPClient.h>
//#include <Arduino_JSON.h>

 
const int sensorIn = 36; 
const int sensorIn1 = 39; 
const int sensorIn2 = 34; 


int mVperAmp = 66;           
float Watt = 0;
float Voltage = 0;
float VRMS = 0;
float AmpsRMS = 0;



const char* ssid = "Nirmrod";
const char* password = "Kkckdbb248.";

float user = 255.13;
float pass = 255.15;


void setup() {
  delay(10);
  Serial.begin(115200);
    Serial.println ("ACS712 current sensor"); 

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

void processSensor() {
  Serial.println (""); 
  Voltage = getVPP();
  VRMS = (Voltage/2.0) *0.707;   //root 2 is 0.707
  AmpsRMS = ((VRMS * 1000)/mVperAmp); //0.3 is the error I got for my sensor
 
  Serial.print(AmpsRMS);
  Serial.print(" Amps RMS  ---  ");
  Watt = (AmpsRMS*0.050); //5v 
 
  Serial.print(Watt);
  Serial.println(" Watts");

delay (100);
}








float getVPP(int sensor){
  float result;
  int readValue;                // value read from the sensor
  int maxValue = 0;             // store max value here
  int minValue = 4096;          // store min value here ESP32 ADC resolution
  
   uint32_t start_time = millis();
   while((millis()-start_time) < 1000) //sample for 1 Sec
   {
       readValue = analogRead(sensor);
       // see if you have a new maxValue
       if (readValue > maxValue) 
       {
           /*record the maximum sensor value*/
           maxValue = readValue;
       }
       if (readValue < minValue) 
       {
           /*record the minimum sensor value*/
           minValue = readValue;
       }
   }
   
   // Subtract min from max
   result = ((maxValue - minValue) * 5)/4096.0; //ESP32 ADC resolution 4096
      
   return result;
 }