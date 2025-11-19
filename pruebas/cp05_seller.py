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
from selenium.webdriver.chrome.options import Options
from mailjet_rest import Client
# --- CONFIG: obtener credenciales (evitar hardcodear en producción) ---
load_dotenv()
EMAIL = os.getenv("MY_APP_EMAIL_SELLER", "your_email@example.com")
PASSWORD = os.getenv("MY_APP_PASSWORD_SELLER", "your_password")
URL = os.getenv("URL_SELLER_LOGIN", "https://cuscatec.cuscatec.com/ecommerce/seller/login")

api_key = os.environ['MJ_APIKEY_PUBLIC']
api_secret = os.environ['MJ_APIKEY_PRIVATE']
SENDER_EMAIL = os.environ.get('SENDER_EMAIL', 'hj15001@ues.edu.sv')
RECIPIENT_EMAIL = os.environ.get('RECIPIENT_EMAIL', 'mauricioricaldone14@gmail.com')
mailjet = Client(auth=(api_key, api_secret), version='v3.1')
# --- INICIALIZAR DRIVER (Chrome) ---
#options = webdriver.ChromeOptions()
# options.add_argument("--headless=new")  # descomenta si quieres modo headless
#driver = webdriver.Chrome(service=ChromeService(ChromeDriverManager().install()), options=options)
options = Options()
options.add_argument("--headless=new")
options.add_argument("--no-sandbox")
options.add_argument("--disable-dev-shm-usage")
# options.add_argument("--headless=new")  # descomenta si quieres modo headless
driver = webdriver.Chrome(options=options) 

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
    print("Se coloco el usuario no registrado en la base en la casilla user correctamente")
    # --- Buscar input por name "password" y por id "userpassword" ---
    try:
        password_input = wait.until(EC.presence_of_element_located((By.ID, "userpassword")))
    except:
        password_input = wait.until(EC.presence_of_element_located((By.NAME, "password")))

    password_input.clear()
    password_input.send_keys(PASSWORD)
    print("Se coloco la contraseña en el campo respectivo")

    # (Opcional) hacer click en el botón de login
    try:
        login_btn = wait.until(EC.element_to_be_clickable((By.CSS_SELECTOR, "button[type='submit'], input[type='submit']")))
        login_btn.click()
    except:
        # Si no hay botón submit, enviar ENTER desde el campo password
        from selenium.webdriver.common.keys import Keys
        password_input.send_keys(Keys.RETURN)
    
    print("Se utilizo correctamente el botón de ingresar al sistema")
    # espera corta para ver resultado (en pruebas)
    time.sleep(10)

    # Esperar 20 segundos antes de validar el h4

    try:
    # 1) Esperar a que aparezca el div contenedor
        container = wait.until(
        EC.presence_of_element_located(
            (
                By.CSS_SELECTOR,
                "div.page-title-box.d-sm-flex.align-items-center.justify-content-between"
            )
        )
    )

        # 2) Buscar el h4 dentro del contenedor
        h4_element = container.find_element(By.TAG_NAME, "h4")

        # 3) Extraer su texto
        h4_text = h4_element.text.strip()
        print(f"Texto capturado para el usuario tipo seller: '{h4_text}'")

    # 4) Validación opcional
        if h4_text == "Categories":
            print("✓✓✓ El h4 contiene exactamente 'Categories")
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
						"Subject": "CP05-SELLER - Validar enrutamiento según tipo de usuario",
						"TextPart": "La prueba CP05-seller ha sido exitosa!",
						"HTMLPart": f"CP05-seller - Validar enrutamiento según tipo de usuario  Ha concluido exitosamente! <br>Se coloco el usuario no registrado en la base en la casilla user correctamente <br> Se coloco la contraseña en el campo respectivo <br> Se utilizo correctamente el botón de ingresar al sistema <br> Texto encontrado para el tipo usuario seller: '{h4_text}'"
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
						"Subject": "FALLO CP05-SELLER - Validar enrutamiento según tipo de usuario",
						"TextPart": "La prueba CP05-Seller FALLO!",
						"HTMLPart": "CP05-SELLER - Validar enrutamiento según tipo de usuario Ha FALLADO!"
				}
		    ]
    }
            print("✘✘✘ El h4 NO contiene 'Welcome !'")

    except Exception as e:
        print("✗ ERROR: No se pudo capturar el h4 dentro del div especificado")
        print("Detalles:", e)

    # ----------------------------------------------------------------------



    result = mailjet.send.create(data=data)
    print(result.status_code)
    print(result.json())


finally:
    driver.quit()
