# ejemplo_selenium_fill_fields_tabs.py
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service as ChromeService
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.keys import Keys
from dotenv import load_dotenv
import os
import time
from mailjet_rest import Client
from selenium.webdriver.chrome.options import Options

# --- CONFIG ---
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
    driver.get(URL)
    wait = WebDriverWait(driver, 15)

    # --- Login ---
    try:
        username_input = wait.until(EC.presence_of_element_located((By.ID, "username")))
    except:
        username_input = wait.until(EC.presence_of_element_located((By.NAME, "email")))

    username_input.clear()
    username_input.send_keys(EMAIL)

    try:
        password_input = wait.until(EC.presence_of_element_located((By.ID, "userpassword")))
    except:
        password_input = wait.until(EC.presence_of_element_located((By.NAME, "password")))

    password_input.clear()
    password_input.send_keys(PASSWORD)

    # --- Click en checkbox remember ---
    
    try:
        remember_checkbox = wait.until(EC.element_to_be_clickable((By.ID, "remember")))
        if not remember_checkbox.is_selected():  # evitar desmarcarlo
            remember_checkbox.click()
    except:
        print("⚠️ No se encontró el checkbox con id 'remember'")

    # --- Botón login ---
    try:
        login_btn = wait.until(EC.element_to_be_clickable((By.CSS_SELECTOR, "button[type='submit'], input[type='submit']")))
        login_btn.click()
    except:
        password_input.send_keys(Keys.RETURN)

    time.sleep(5)

    # --- Abrir nueva pestaña ---
    driver.switch_to.new_window('tab')
    driver.get("https://www.google.com")
    time.sleep(3)

    # --- Cerrar pestaña actual (Google) ---
    driver.switch_to.window(driver.window_handles[0])
    driver.close()
    time.sleep(5)
    # Cambiar el foco a la primera pestaña (login)

    
    driver.switch_to.window(driver.window_handles[0])
    # --- Abrir otra pestaña nueva ---
    driver.switch_to.new_window('tab')
    driver.get(URL)
    time.sleep(20)

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
        print(f"Texto capturado del h4: '{h4_text}'")

    # 4) Validación opcional
        if h4_text == "Welcome !":
            print("✓✓✓ El h4 contiene exactamente 'Welcome !'")
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
						"Subject": "CP60 - Evaluar si la opción “recordarme” conserva sesiones de forma segura",
						"TextPart": "La prueba CP60 ha sido exitosa!",
						"HTMLPart": "CP60 - Evaluar si la opción “recordarme” conserva sesiones de forma segura"
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
						"Subject": "FALLO CP60 - Evaluar si la opción “recordarme” conserva sesiones de forma segura",
						"TextPart": "La prueba CP60 FALLO!",
						"HTMLPart": "CP60 - Evaluar si la opción “recordarme” conserva sesiones de forma segura"
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