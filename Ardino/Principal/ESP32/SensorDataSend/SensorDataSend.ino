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


float sensorf, sensorw, sensor1f, sensor1w, sensor2f, sensorw2;


const char* ssid = "Nirmrod";
const char* password = "Kkckdbb248.";




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


    sensorf, sensorw =  processSensor( sensorIn);
    sensor1f, sensor1w = processSensor( sensorIn1);
    sensor1f, sensorw2 = processSensor( sensorIn2);

    String sensor = String(sensorf, 3);
    String sensor1 = String(sensor1f, 3);
    String sensor2 = String(sensor2f, 3);
  
    // Primer Sensor
    Serial.print("Primer Sensor");
    Serial.print(sensorf);
    Serial.print(" Amps RMS  ---  ");
    Serial.print(sensorw);
    Serial.println(" Watts");
    Serial.print("----------------------------------");
    // Segundo Sensor
    Serial.print("Segundo Sensor");
    Serial.print(sensor1f);
    Serial.print(" Amps RMS  ---  ");
    Serial.print(sensor1w);
    Serial.println(" Watts");
    Serial.print("----------------------------------");
    // Tercer Sensor
    Serial.print("Tercer Sensor");
    Serial.print(sensor2f);
    Serial.print(" Amps RMS  ---  ");
    Serial.print(sensorw2);
    Serial.println(" Watts");
    Serial.print("----------------------------------");
    
  
  if(WiFi.status()== WL_CONNECTED){   //Check WiFi connection status

    HTTPClient http;
    String datos_a_enviar = "val=" + sensor + "&val1=" + sensor1 + "&val2=" + sensor2 ;

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



// Serial.print(AmpsRMS);
// Serial.print(" Amps RMS  ---  ");
// Serial.print(Watt);
//   Serial.println(" Watts");

float processSensor(int sensor) {
  Voltage = getVPP( sensor);
  VRMS = (Voltage/2.0) *0.707;   //root 2 is 0.707
  AmpsRMS = ((VRMS * 1000)/mVperAmp); //0.3 is the error I got for my sensor
  Watt = (AmpsRMS*0.050); //5v  
delay (100);
    return AmpsRMS, Watt;
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
