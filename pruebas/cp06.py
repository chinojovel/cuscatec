# ejemplo_selenium_fill_fields.py
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service as ChromeService
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager  # opcional, facilita el driver
from dotenv import load_dotenv
import os
import time
from mailjet_rest import Client
from selenium.webdriver.chrome.options import Options

# --- CONFIG: obtener credenciales (evitar hardcodear en producción) ---
load_dotenv()
EMAIL = os.getenv("MY_APP_EMAIL_ADMIN", "your_email@example.com")
PASSWORD = os.getenv("MY_APP_PASSWORD_ADMIN", "your_password")
URL = os.getenv("URL_ADMIN_LOGIN", "https://cuscatec.cuscatec.com/login")

api_key = os.environ['MJ_APIKEY_PUBLIC']
api_secret = os.environ['MJ_APIKEY_PRIVATE']
SENDER_EMAIL = os.environ.get('SENDER_EMAIL', 'hj15001@ues.edu.sv')
RECIPIENT_EMAIL = os.environ.get('RECIPIENT_EMAIL', 'mauricioricaldone14@gmail.com')
mailjet = Client(auth=(api_key, api_secret), version='v3.1')

# --- INICIALIZAR DRIVER (Chrome) ---
#options = webdriver.ChromeOptions()
options = Options()
options.add_argument("--headless=new")
options.add_argument("--no-sandbox")
options.add_argument("--disable-dev-shm-usage")
# options.add_argument("--headless=new")  # descomenta si quieres modo headless
driver = webdriver.Chrome(options=options)
#driver = webdriver.Chrome(service=ChromeService(ChromeDriverManager().install()), options=options)

try:
    driver.get(URL)  # cambia por la URL real

    wait = WebDriverWait(driver, 15)

    # --- Buscar input por name "email" y por id "username" ---
    # Espero que cualquiera de las dos coincidencias esté presente (primero por id, luego por name)
    try:
        username_input = wait.until(EC.presence_of_element_located((By.ID, "username")))
    except:
        username_input = wait.until(EC.presence_of_element_located((By.NAME, "email")))

    # Limpio y escribo
    username_input.clear()
    username_input.send_keys(EMAIL)

    # --- Buscar input por name "password" y por id "userpassword" ---
    try:
        password_input = wait.until(EC.presence_of_element_located((By.ID, "userpassword")))
    except:
        password_input = wait.until(EC.presence_of_element_located((By.NAME, "password")))

    password_input.clear()
    password_input.send_keys(PASSWORD)

    # (Opcional) hacer click en el botón de login
    try:
        login_btn = wait.until(EC.element_to_be_clickable((By.CSS_SELECTOR, "button[type='submit'], input[type='submit']")))
        login_btn.click()
    except:
        # Si no hay botón submit, enviar ENTER desde el campo password
        from selenium.webdriver.common.keys import Keys
        password_input.send_keys(Keys.RETURN)

    # espera corta para ver resultado (en pruebas)
    time.sleep(5)  
    driver.get(URL)


    # Esperar 10 segundos después del intento de login
        #Sign in to continue to Administration Ecommerce.
    time.sleep(20)

    # Esperar 20 segundos antes de validar el h4
    try:
    # 1) Buscar directamente el h5 con clase text-primary
        h5_element = wait.until(
        EC.presence_of_element_located(
            (By.CSS_SELECTOR, "h5.text-primary")
        )
        )

    # 2) Extraer su texto
        h5_text = h5_element.text.strip()
        print(f"Texto capturado del h5: '{h5_text}'")

    # 4) Validación opcional
        if h4_text == "Welcome !":
            print("✓✓✓ El h5 contiene exactamente 'Welcome !'")
            data = {
                'Messages': [
				{
						"From": {
								"Email": SENDER_EMAIL,
								"Name": "CUSCATEC TEST"
						},
						"To": [
								{
										"Email": RECIPIENT_EMAIL,
										"Name": "You"
								}
						],
						"Subject": "CP06 - Una vez logueado en el sistema no debe poder ver ningún login hasta cerrar sesión",
						"TextPart": "La prueba CP06 ha sido exitosa!",
						"HTMLPart": "CP06 - Una vez logueado en el sistema no debe poder ver ningún login hasta cerrar sesión!"
				}
		    ]
    }
        else:
            data = {
            'Messages': [
				{
						"From": {
								"Email": SENDER_EMAIL,
								"Name": "CUSCATEC TEST"
						},
						"To": [
								{
										"Email": RECIPIENT_EMAIL,
										"Name": "You"
								}
						],
						"Subject": "FALLO CP06 - Una vez logueado en el sistema no debe poder ver ningún login hasta cerrar sesión",
						"TextPart": "La prueba CP06 FALLO!",
						"HTMLPart": "CP06 - Una vez logueado en el sistema no debe poder ver ningún login hasta cerrar sesión!"
				}
		    ]
    }
            print("✘✘✘ El h5 NO contiene 'Welcome !'")

    except Exception as e:
        data = {
            'Messages': [
				{
						"From": {
								"Email": SENDER_EMAIL,
								"Name": "CUSCATEC TEST"
						},
						"To": [
								{
										"Email": RECIPIENT_EMAIL,
										"Name": "You"
								}
						],
						"Subject": "FALLO NIVEL EXCEPT CP06 - Una vez logueado en el sistema no debe poder ver ningún login hasta cerrar sesión",
						"TextPart": "La prueba CP06 FALLO!",
						"HTMLPart": "CP06 - Una vez logueado en el sistema no debe poder ver ningún login hasta cerrar sesión!"
				}
		    ]
    }
        print("✗ ERROR: No se pudo capturar el h4 dentro del div especificado")
        print("Detalles:", e)

    # ----------------------------------------------------------------------



    result = mailjet.send.create(data=data)
    print(result.status_code)
    print(result.json())


finally:
    driver.quit()
