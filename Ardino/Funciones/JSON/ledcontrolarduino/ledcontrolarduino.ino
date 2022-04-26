#include <ArduinoJson.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
// Se Definine la conexion a punto de acceso wifi
#define WIFI_SSID "Nirmrod"
#define WIFI_PASSWORD "Kkckdbb248."


WiFiClient client;

#define LED 2

void setup() {
  Serial.begin(9600);

  WiFi.begin (WIFI_SSID, WIFI_PASSWORD);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println ("");
  Serial.println ("Se conectó al wifi!");
  Serial.println(WiFi.localIP());
  pinMode(LED, OUTPUT);
}

void loop() {

  if (client.connect("192.168.0.15",8080)) { // Preguntamos se si conectó a la IP del servidor 

    // Send HTTP request
    client.println(F("GET /uag/AppWeb/json/led.json HTTP/1.0"));
    client.println(F("Host: arduinojson.org"));
    client.println(F("Connection: close"));
    
    if (client.println() == 0) {
      Serial.println(F("Failed to send request"));
      return;
    }
    
    // Check HTTP status
    char status[32] = {0}; 
    client.readBytesUntil('\r', status, sizeof(status));
    if (strcmp(status, "HTTP/1.1 200 OK") != 0) {
      Serial.print(F("Unexpected response: "));
      Serial.println(status);
      return;
    }

    // Skip HTTP headers
    char endOfHeaders[] = "\r\n\r\n";
    if (!client.find(endOfHeaders)) {
      Serial.println(F("Invalid response"));
      return;
    }
    
    const size_t capacity = JSON_OBJECT_SIZE(3) + JSON_ARRAY_SIZE(2) + 60;
    DynamicJsonDocument doc(capacity);
    

    // Parse JSON object
    DeserializationError error = deserializeJson(doc, client);
    if (error) {
      Serial.print(F("deserializeJson() failed: "));
      Serial.println(error.c_str());
      return;
    }

    // Extract values
    Serial.println(F("Response:"));
    Serial.println( String(doc["led1"]));
    Serial.println(doc["led"].as<int>());
  
    int dato=doc["led"].as<int>();
    analogWrite(LED, dato);
  
  } else{
      Serial.println("naranjas");
    }

  client.stop();
  delay(1000); 

}
