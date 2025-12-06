# ejemplo_selenium_fill_fields.py
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service as ChromeService
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
#from webdriver_manager.chrome import ChromeDriverManager  # opcional, facilita el driver
from dotenv import load_dotenv
import os
import time
from mailjet_rest import Client

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
def convertir_fecha(fecha_str):
    try:
        return datetime.strptime(fecha_str, "%d/%m/%Y").strftime("%Y-%m-%d")
    except Exception as e:
        print(f"[ERROR] Falló la conversión de fecha '{fecha_str}': {e}")
        return None


# Fechas solicitadas
fecha_date = convertir_fecha("10/11/2024")
fecha_date_to = convertir_fecha("12/11/2025")

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

    print("Se coloco usuario en su casilla correspondiente correctamente")

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
    # ------------------------ BUSQUEDA DE WELCOME! ------------------------
    # Esperar 20 segundos
    # Esperar 20 segundos
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
        print(f"Texto capturado de bienvenida al sistema: '{h4_text}'")

    # 4) Validación opcional
        if h4_text == "Welcome !":
            print("✓✓✓ El texto capturado contiene exactamente 'Welcome !'")
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
						"Subject": "CP17 - Verificar que el sistema permita acceso con credenciales válidas",
						"TextPart": "La prueba CP01 ha sido exitosa!",
						"HTMLPart": "CP17 - Verificar que el sistema permita acceso con credenciales válidas Ha concluido exitosamente! <br> Se coloco usuario en su casilla correspondiente correctamente <br> Se coloco la contraseña en el campo respectivo <br> ✓✓✓ El texto capturado contiene exactamente 'Welcome ! '"
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
						"Subject": "FALLO CP01 - Verificar que el sistema permita acceso con credenciales válidas",
						"TextPart": "La prueba CP01 FALLO!",
						"HTMLPart": "CP01 - Verificar que el sistema permita acceso con credenciales válidas Ha FALLADO!"
				}
		    ]
    }
            print("✘✘✘ El h4 NO contiene 'Welcome !'")

    except Exception as e:
        print("✗ ERROR: No se pudo capturar el h4 dentro del div especificado")
        print("Detalles:", e)



    # ----------------------------------------------------------------------
    try:
        date_input = wait.until(
            EC.presence_of_element_located((By.ID, "date"))
        )
        date_input.clear()
        date_input.send_keys(fecha_date)
        print("✓ Fecha colocada en 'date'")
    except Exception as e:
        print(f"[ERROR] No se pudo colocar la fecha en el input 'date': {e}")


# ---------------------------------------------------------
# 2) Input con id/name "date_to"
# ---------------------------------------------------------
    try:
        date_to_input = wait.until(
            EC.presence_of_element_located((By.ID, "date_to"))
        )
        date_to_input.clear()
        date_to_input.send_keys(fecha_date_to)
        print("✓ Fecha colocada en 'date_to'")
    except Exception as e:
        print(f"[ERROR] No se pudo colocar la fecha en el input 'date_to': {e}")

    try:
        boton = wait.until(
            EC.element_to_be_clickable((By.CSS_SELECTOR, ".btn.btn-primary"))
        )
        boton.click()
        print("✓ Botón 'btn btn-primary' presionado")
    except Exception as e:
        print(f"[ERROR] No se pudo presionar el botón 'btn btn-primary': {e}")

    result = mailjet.send.create(data=data)
    print(result.status_code)
    print(result.json())


finally:
    driver.quit()
