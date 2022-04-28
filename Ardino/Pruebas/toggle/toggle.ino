#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
 
ESP8266WebServer server(81);
 
#include "config.h"  // Sustituir con datos de vuestra red
#include "ESP8266_Utils.hpp"
#include "Server.hpp"

void setup(void) 
{
   Serial.begin(115200);

   ConnectWiFi_STA();
   
   InitServer();
}
 
void loop()
{
   server.handleClient();
}

// Funcion al recibir petición GET
void getLED() 
{
   // devolver respuesta
   server.send(200, "text/plain", String("GET ") + server.arg(String("Id")));
}
 
// Funcion al recibir petición POST
void setLED() 
{
   // mostrar por puerto serie
   Serial.println(server.argName(0));
   
   // devolver respuesta
   server.send(200, "text/plain", String("POST ") + server.arg(String("Id")) + " " + server.arg(String("Status")));
}
// Funcion que se ejecutara en la URI '/'
void handleRoot() 
{
   server.send(200, "text/plain", "Hola mundo!");
}
void handleNotFound() 
{
   server.send(404, "text/plain", "Not found");
}
void InitServer()
{
   // Ruteo para '/'
   server.on("/", handleRoot);
 
   // Definimos dos routeos
   server.on("/led", HTTP_GET, getLED);
   server.on("/led", HTTP_POST, setLED);
 
   server.onNotFound(handleNotFound);
 
   server.begin();
   Serial.println("HTTP server started");
}
