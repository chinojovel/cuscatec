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

    # ============================================
    # VERIFICACIÓN DE ACCESO A MÚLTIPLES URLS
    # ============================================

    urls_palabras = {
        "https://cuscatec.cuscatec.com/customers": "Customers List",
        "https://cuscatec.cuscatec.com/sellers": "Sellers List",
        "https://cuscatec.cuscatec.com/states": "States List",
        "https://cuscatec.cuscatec.com/products": "Products",
        "https://cuscatec.cuscatec.com/administration/orders": "Orders",
        "https://cuscatec.cuscatec.com/administration/warehouse/index": "Warehouses",
        "https://cuscatec.cuscatec.com/administration/inventory": "Inventory by Warehouse",
        "https://cuscatec.cuscatec.com/categories": "Categories",
        "https://cuscatec.cuscatec.com/suppliers": "Suppliers",
        "https://cuscatec.cuscatec.com/purchase_orders": "Purchase Orders",
        "https://cuscatec.cuscatec.com/coupons": "Coupons List",
        "https://cuscatec.cuscatec.com/users": "Users List",
    }

    status_result = ""  # acumulador de mensajes

    try:
        for url, palabra in urls_palabras.items():
            try:
                driver.get(url)

                # Esperar el <h1> dentro del XPATH proporcionado
                h1_element = wait.until(
                    EC.presence_of_element_located(
                        (By.XPATH, "//div[@class='main-content']/div/div/div[@class='container']/h1")
                    )
                )

                contenido = h1_element.text.strip()

                if palabra.lower() in contenido.lower():
                    mensaje = f"✓ Se ingresó exitosamente a la página '{palabra}'"
                    print(mensaje)
                    status_result += mensaje + "\n"
                else:
                    mensaje = f"✗ Coincidencia NO encontrada en {url}. Se esperaba '{palabra}', se obtuvo '{contenido}'"
                    print(mensaje)
                    status_result += mensaje + "\n"

            except Exception as e:
                mensaje = f"❌ Error al procesar la URL {url}: {str(e)}"
                print(mensaje)
                status_result += mensaje + "\n"

        print("\n=========== RESUMEN DE ACCESOS ===========")
        print(status_result)
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
						"Subject": "CP64 - Verificar funcionamiento de CAPTCHA, enlaces, validaciones, y responsive.",
						"TextPart": "La prueba CP64!",
						"HTMLPart": f"CP64 - Verificar funcionamiento de CAPTCHA, enlaces, validaciones, y responsive. <br> {status_result}"
				}
		    ]
    }

    except Exception as e:
        print("❌ Error general al verificar URLs:", e)


        

    # ----------------------------------------------------------------------



    result = mailjet.send.create(data=data)
    print(result.status_code)
    print(result.json())


finally:
    driver.quit()
