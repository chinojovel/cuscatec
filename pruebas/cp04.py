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
EMAIL = os.getenv("MY_APP_EMAIL_INCORRECT", "your_email@example.com")
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

    # espera corta para ver resultado (en pruebas)
    print("Se utilizo correctamente el botón de ingresar al sistema")
    time.sleep(10)  
    #driver.get(URL)
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
    time.sleep(10)  
    #driver.get(URL)
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
    time.sleep(10)  
    #driver.get(URL)
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

    time.sleep(10)  
    #driver.get(URL)
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
    # Esperar 10 segundos después del intento de login
        #Sign in to continue to Administration Ecommerce.
    time.sleep(10)

    # Esperar 20 segundos antes de validar el h4
    try:
    # Buscar la etiqueta <strong>
        strong_tag = wait.until(
        EC.presence_of_element_located((By.TAG_NAME, "strong"))
    )

        strong_text = strong_tag.text.strip()
        print(f"Texto encontrado dentro de <strong>: '{strong_text}'")

    # Verificar si coincide con el texto de error
        if "Blocked user" in strong_text:
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
						"Subject": "EXITO CP04 - Verifica que la cuenta sea bloqueada luego de varios intentos fallidos",
						"TextPart": "La prueba CP04 ha sido exitosa!",
						"HTMLPart": "EXITO CP04 - Verifica que la cuenta sea bloqueada luego de varios intentos fallidos <br>"
				}
		    ]
    }
            print("✗✘✘ Credenciales incorrectas detectadas.")
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
						"Subject": "FALLO CP04 - Verifica que la cuenta sea bloqueada luego de varios intentos fallidos",
						"TextPart": "La prueba CP04 ha fallado!",
						"HTMLPart": f"FALLO CP04 - Verifica que la cuenta sea bloqueada luego de varios intentos fallidos HA FALLADO! <br> Intentos realizados por ingresar: 5 <br> Se coloco el usuario no registrado en la base en la casilla user correctamente <br> Se coloco la contraseña en el campo respectivo <br> Se utilizo correctamente el botón de ingresar al sistema <br> Texto encontrado dentro de <strong>: '{strong_text}' <br>Nunca se bloqueo el usuario"
				}
		    ]
    }

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
						"Subject": "FALLO NIVEL EXCEPT CP04 - No se bloqueo el usuario",
						"TextPart": "La prueba CP04 FALLO!",
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
