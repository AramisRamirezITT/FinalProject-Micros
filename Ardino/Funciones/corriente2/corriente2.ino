

 
const int sensorIn = 36;      // pin where the OUT pin from sensor is connected on Arduino
int mVperAmp = 66;           // this the 5A version of the ACS712 -use 100 for 20A Module and 66 for 30A Module
float Watt = 0;
float Voltage = 0;
float VRMS = 0;
float AmpsRMS = 0;
 
// initialize the LCD library with I2C address and LCD size

 
void setup() {
  Serial.begin (9600); 
  Serial.println ("ACS712 current sensor"); 
  // Initialize the LCD connected 

}
 
void loop() {
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
 
// ***** function calls ******
float getVPP()
{
  float result;
  int readValue;                // value read from the sensor
  int maxValue = 0;             // store max value here
  int minValue = 4096;          // store min value here ESP32 ADC resolution
  
   uint32_t start_time = millis();
   while((millis()-start_time) < 1000) //sample for 1 Sec
   {
       readValue = analogRead(sensorIn);
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
