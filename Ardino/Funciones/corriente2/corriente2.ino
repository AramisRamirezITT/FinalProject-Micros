float Sensibilidad=0.100; //sensibilidad en Voltios/Amperio para sensor de 5A
float a = 0.0 ; 
void setup() {
  
  Serial.begin(9600);
}

void loop() {
  a = analogRead(A0) * (5.0 / 1023.0);
  float I=get_corriente(200);//obtenemos la corriente promedio de 500 muestras 
  Serial.print("Corriente: ");
  Serial.println(I,3); 
  Serial.println(a);
  delay(100);     
}

float get_corriente(int n_muestras)
{
  float voltajeSensor;
  float corriente=0;
  for(int i=0;i<n_muestras;i++)
  {
    voltajeSensor = analogRead(A0) * (5.0 / 1023.0);////lectura del sensor
    corriente=corriente+(voltajeSensor-2.5)/Sensibilidad; //Ecuación  para obtener la corriente
  }
  corriente=corriente/n_muestras;
  return(corriente);
}
