#include <WiFi.h> 
#include <HTTPClient.h> 
#include "HX711.h"

const int ld_cell = 19;
const int ld_sck = 18;
const int tara = 23;
const int encendido=36;

// Crear el objeto balanza
HX711 balanza;

String URL = "http://192.168.91.234/gramera-inteligente/API/recibirLectura.php";

const char* ssid = "Redmi"; 
const char* password = "prueba2024"; 

int dato = 1; 

void setup() {
  Serial.begin(115200); 
  connectWiFi();

  // Configura la balanza
  balanza.begin(ld_cell, ld_sck);

  // Configura los botones
  pinMode(tara, INPUT);
  pinMode(encendido, INPUT);

  balanza.set_scale();
  delay(5000);
  balanza.tare(); // Hacer 10 lecturas, el promedio es la tara
}

void loop() {
  if(WiFi.status() != WL_CONNECTED) { 
    connectWiFi();
  }
  
  float peso=0, pesoFinal=0;

  if(digitalRead(encendido)==1 && digitalRead(tara)==1 ){
    balanza.tare(); // El peso actual es considerado Tara.
    anti_debounce(tara);
    
    
  } else {
    if (digitalRead(encendido)==1) {
      peso = balanza.get_units(10);
      pesoFinal = (peso/(21.34));
      Serial.print("Peso: ");
      Serial.println(pesoFinal);
      delay(1000);
    } else{
      Serial.println("Apagado");
    }
  }

  String postData = "dato=" + String(pesoFinal); 

  HTTPClient http; 
  http.begin(URL);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  
  int httpCode = http.POST(postData); 
  String payload = http.getString(); 
  
  Serial.print("URL : "); Serial.println(URL); 
  Serial.print("Data: "); Serial.println(postData); 
  Serial.print("httpCode: "); Serial.println(httpCode); 
  Serial.print("payload : "); Serial.println(payload); 
  Serial.println("--------------------------------------------------");
  http.end();
  delay(500);
}

void connectWiFi() {
  WiFi.mode(WIFI_OFF);
  delay(1000);
  //This line hides the viewing of ESP as wifi hotspot
  WiFi.mode(WIFI_STA);
  
  WiFi.begin(ssid, password);
  Serial.println("Connecting to WiFi");
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
    
  Serial.print("Connected to : "); Serial.println(ssid);
  Serial.print("IP address: "); Serial.println(WiFi.localIP());
}

// Función de Anti-debounce (Evitar el rebote del pulsador)
void anti_debounce(byte boton) {
  delay(100);
  while (digitalRead(boton) == HIGH); // Anti-Rebote
  delay(100);
}