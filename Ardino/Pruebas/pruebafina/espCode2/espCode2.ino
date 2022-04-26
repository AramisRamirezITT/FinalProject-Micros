 /******************************************************************************************************************************
 * TITULO: Sistema de monitoreo y alarma de gases y/o fuego 
 *         -código ESP (#2 completo) proyecto final serie intermedia
 * AUTOR: Jhimmy Astoraque Durán
 * DESCRIPCION: Este es el resultado final de toda la serie intermedia del canal en el que monitoreamos presencia de gases y temperatura                
 *              ambiente para reconocer y alarmar ante una presencia inusual de gases de tipo peligroso en la atmosfera que podrian                     causar un fuego o conato de incendio.
 * CANAL YOUTUBE: https://www.youtube.com/c/jadsatv
 * © 2019
 *******************************************************************************************************************************/
#include <ESP8266WiFi.h>
#include <SoftwareSerial.h>


#define SSID "AS-08387"
#define PASS  "ZTE1RTHH4Q03008"

const char* ssid     = SSID;
const char* password = PASS;

const char* host = "192.168.1.4"; // cmd -> ipconfig
const uint16_t port = 80;



const byte espRx = 5;
const byte espTx = 4;
SoftwareSerial SerialEsp(espRx, espTx); // RX, TX  Nodemcu => D1->5, D2->4

// RX msg
bool received = false;
String receivedMsg;

// variables to control
String s_alarm;
String s_co;
String s_smoke;
String s_lpg;
String s_temp;
const byte numVars = 5;
//                          0         1     2       3        4
String controlledVars[] = {s_alarm, s_co, s_lpg, s_smoke, s_temp};

// variables float
int alarm = 0;
int co = 0;
int lpg = 0;
int smoke = 0;
float temp = 0.0;


void setup() 
{
  Serial.begin(115000);
  SerialEsp.begin(9600);

  // We start by connecting to a WiFi network

  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  /* Explicitly set the ESP8266 to be a WiFi-client, otherwise, it by default,
     would try to act as both a client and an access-point and could cause
     network-issues with your other WiFi-devices on your WiFi-network. */
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
} // EOF setup

void loop()
{  
  checkSerialCom();
  if (received){
    ProcessMsg();
    receivedMsg = "";
    received = false;
    ConvertVariables();
    delay(50);
    // attempt to send data to host
    SendDataToHost(); 
  }

  //delay(300000); // execute once every 5 minutes
  delay(10000);
} // EOF loop


/************ Helper Functions **********************/
void checkSerialCom()
{
  char data;
  if (SerialEsp.available() > 0)
  { // Checks whether data is comming from the serial port
    while (SerialEsp.available() > 0)
    {
      data = (char)SerialEsp.read(); // Reads the data from the serial port
      receivedMsg += data;        // Para la segunda parte del vídeo
    }
    received = true;
  }
} // EOF checkSerialCom


void ProcessMsg(){
  receivedMsg.trim();
  Serial.println("Recibido: ");
  Serial.println(receivedMsg);
  int index;
  for (size_t i = 0; i < numVars; i++)
  {
    index = receivedMsg.indexOf('_');
    controlledVars[i] = receivedMsg.substring(0, index);
    receivedMsg = receivedMsg.substring(index + 1);
    // Serial.print("=> ");
    // Serial.println(controlledVars[i]);
  }
  s_alarm = controlledVars[0];
  s_co = controlledVars[1];
  s_lpg = controlledVars[2];
  s_smoke = controlledVars[3];
  s_temp = controlledVars[4];
} // EOF ProcessMsg


void ConvertVariables(){
  alarm = s_alarm.toInt();
  co = s_co.toInt();
  lpg = s_lpg.toInt();
  smoke = s_smoke.toInt();
  temp = s_temp.toFloat(); // if conversion not possible 0 is returned
}// EOF ConvertVariables


void SendDataToHost(){
  Serial.print(">>>>>>> connecting to ");
  Serial.print(host);
  Serial.print(':');
  Serial.println(port);

  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  if (!client.connect(host, port)) {
    Serial.println("connection failed");
    delay(5000);
    return;
  }

  String query = "esp8266/save.php?alarm=";
  query += alarm;
  query += "&co=";
  query += co;
  query += "&lpg=";
  query += lpg;
  query += "&smoke=";
  query += smoke;
  query += "&temp=";
  query += temp;
  
  Serial.println(query);

  Serial.println("[Sending a request]");
  client.print(String("GET /") + query + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n" +
               "\r\n"
              );

  // wait for data to be available
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      delay(3000);
      return;
    }
  }

  // Read all the lines of the reply from server
  Serial.println("receiving from remote server");
  String msg;
  while (client.available()) {
    char ch = static_cast<char>(client.read());
    Serial.print(ch); // print the reply
    msg += ch;
  }
  
  Serial.println();
  if (msg.indexOf("Guardado correcto!") != -1){
    Serial.println("Data Saved");
  }
  else{
    Serial.println("Could not save data");
  }

  // Close the connection
  Serial.println();
  Serial.println(">>>>>>>>>> closing connection");
  Serial.println();
  client.stop();
} // EOF SendDataToHOST
