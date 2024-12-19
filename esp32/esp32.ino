#include <WiFi.h>
#include <HTTPClient.h>
#include <Arduino_JSON.h>
#include <ESP32Servo.h>
Servo myservo;

#define TRIG_PIN 25  // Pin Trig sensor ultrasonik
#define ECHO_PIN 26  // Pin Echo sensor ultrasonik

#define TURBIDITY_PIN 34  // Pin yang digunakan untuk sensor turbidity (misal: GPIO 34)

// Definisi pin sensor PH 
const int sensorPin = 35;  // Pin GPIO35 pada ESP32

// Variabel global untuk menyimpan nilai dari sensor PH
float voltagePH = 0;         // Tegangan yang terbaca dari sensor PH
float pHValue = 0;         // Nilai pH
float turbidity = 0.0;     // Variabel global untuk turbidity

// Konfigurasi WiFi
const char* ssid = "nama_SSID";
const char* password = "PASSWORD_WIFI";
// URL server PHP
const char* serverURL = "http://namaweb/iot-ikan/jamMakan.php";
const char* serverURL1 = "http://namaweb/iot-ikan/insertSensor.php";

// Fungsi untuk menghubungkan ke WiFi
void connectToWiFi() {
    WiFi.begin(ssid, password); 
    Serial.println("Menghubungkan ke WiFi...");
    while (WiFi.status() != WL_CONNECTED) {
        Serial.print(".");
    }
    Serial.println("\nTerhubung ke WiFi");
    Serial.print("IP Address: ");
    Serial.println(WiFi.localIP());
}

// Fungsi untuk membaca data dari server
int getServoValueFromServer() {
    HTTPClient http;
    http.begin(serverURL);
    int httpResponseCode = http.GET();

    if (httpResponseCode > 0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);

        String response = http.getString();
        Serial.println("Respon: " + response);

        // Parsing JSON
        JSONVar json = JSON.parse(response);
        if (JSON.typeof(json) == "undefined") {
            Serial.println("Gagal mem-parsing JSON!");
            return 0; // Indikasi error
        }

        if (json.hasOwnProperty("nilai")) {
            int nilai = int(json["nilai"]);
            Serial.print("Nilai diterima: ");
            Serial.println(nilai);
            return nilai;
        } else {
            Serial.println("Tidak ada data 'nilai' dalam JSON!");
            return 0; // Indikasi error
        }
    } else {
        Serial.print("Error HTTP Response code: ");
        Serial.println(httpResponseCode);
        return 0; // Indikasi error
    }

    http.end();
}
// Fungsi untuk setup sensor ultrasonik
void setupUltrasonicSensor() {
  pinMode(TRIG_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);
}

// Fungsi untuk mendapatkan jarak dari sensor ultrasonik
long getDistance() {
  long duration, distance;

  // Memicu sensor ultrasonik
  digitalWrite(TRIG_PIN, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIG_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIG_PIN, LOW);

  // Mengukur lama waktu pantulan
  duration = pulseIn(ECHO_PIN, HIGH);

  // Menghitung jarak (kecepatan suara 0.034 cm/us)
  distance = duration * 0.034 / 2;

  return distance; // Mengembalikan nilai jarak
}


// Fungsi untuk setup sensor turbidity
void setupTurbiditySensor() {
  pinMode(TURBIDITY_PIN, INPUT);  // Set pin turbidity sebagai input
}

// Fungsi untuk membaca nilai sensor turbidity dan menampilkannya
void readAndDisplayTurbidity() {
  int sensorValue = analogRead(TURBIDITY_PIN);  // Membaca nilai dari sensor turbidity
  float voltage = convertToVoltage(sensorValue);  // Mengonversi nilai ADC ke tegangan
  
  // Konversi tegangan ke NTU (simulasi)
  turbidity = convertToTurbidity(voltage);  // Simpan nilai turbidity ke variabel global
  
  // Menampilkan nilai sensor
  displayTurbidity(sensorValue, voltage, turbidity);
}

// Fungsi untuk mengonversi nilai ADC ke tegangan  sensor turbidity
float convertToVoltage(int sensorValue) {
  return sensorValue * (3.3 / 4095.0);  // Mengonversi nilai ADC ke tegangan (3.3V untuk ESP32)
}

// Fungsi untuk mengonversi tegangan ke NTU
float convertToTurbidity(float voltage) {
  return (voltage > 0) ? (3000 / voltage) : 0;  // Mencegah pembagian dengan nol dan konversi ke NTU
}

// Fungsi untuk menampilkan nilai sensor turbidity pada Serial Monitor 
void displayTurbidity(int sensorValue, float voltage, float turbidity) {
  Serial.print("Nilai ADC: ");
  Serial.print(sensorValue);
  Serial.print(" | Tegangan: ");
  Serial.print(voltage, 2);
  Serial.print(" V | Turbidity: ");
  Serial.print(turbidity, 2);
  Serial.println(" NTU");
}

// Fungsi untuk membaca nilai ADC dari sensor PH dan menghitung tegangan pada sesor PH
float readvoltagePH() {
  int sensorValue = analogRead(sensorPin); // Membaca nilai ADC (0-4095)
  float voltagePH = sensorValue * (3.3 / 4095.0); // Menghitung tegangan
  return voltagePH;
}

// Fungsi untuk membaca nilai pH berdasarkan tegangan dari sensor PH
float readPH() {
  voltagePH = readvoltagePH();                // Membaca tegangan
  float pH = (voltagePH - 2.5) * 5.0;       // Menghitung pH (sesuaikan formula untuk kalibrasi)
  return pH;
}

void setup() {
  Serial.begin(115200);

  // Inisialisasi WiFi
  connectToWiFi();
  
  // servo 
  myservo.attach(23);
  	
	// Setup pin untuk sensor ultrasonik
	setupUltrasonicSensor();
	
	// Setup sensor turbidity
	setupTurbiditySensor();  
	
	// Setel pin sensor pH sebagai input analog
	pinMode(sensorPin, INPUT);

}

void loop() {

  // Baca jarak menggunakan sensor ultrasonik
	long distance = getDistance();

	// Menampilkan jarak di Serial Monitor
	Serial.print("Jarak: ");
	Serial.print(distance);
	Serial.println(" cm");
  
	// Membaca dan menampilkan nilai sensor turbidity
	readAndDisplayTurbidity();  
	
	// Membaca sensor dan mengupdate nilai pH
	pHValue = readPH();

	// Menampilkan hasil pembacaan sensor pH
	Serial.print("voltagePH: ");
	Serial.print(voltagePH, 3);  // Menampilkan tegangan dengan 3 angka desimal
	Serial.print(" V | pH Value: ");  
	Serial.println(pHValue, 2);  // Menampilkan pH dengan 2 angka desimal


  int nilaiServo = getServoValueFromServer();
  if (nilaiServo > 0) {
    myservo.write(35);     // Move the servo to 90 degrees
    delay(1000);          // Pause for 1 second
    myservo.write(0);    // Move the servo to 0 degrees
    delay(1000);          // Pause for 1 second

    myservo.write(35);     // Move the servo to 90 degrees
    delay(1000);          // Pause for 1 second
    myservo.write(0);    // Move the servo to 0 degrees
    delay(1000);          // Pause for 1 second

    myservo.write(35);     // Move the servo to 90 degrees
    delay(1000);          // Pause for 1 second
    myservo.write(0);    // Move the servo to 0 degrees
    delay(1000);          // Pause for 1 second
  }

  // Kirim data menggunakan GET
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;

    // Membuat URL dengan parameter data
    String url = String(serverURL1) + "?id_user=1&ph=" + String(pHValue) + "&turbinity=" + String(turbidity) + "&ultrasonik=" + String(distance);

    http.begin(url); // Inisialisasi HTTP GET
    int httpResponseCode = http.GET(); // Kirim GET request

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("Response dari server: " + response);
    } else {
      Serial.println("Error mengirim data: " + String(httpResponseCode));
    }

    http.end(); // Akhiri koneksi
  }

  delay(5000); // Kirim data setiap 5 detik
}