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

# --- CONFIG: obtener credenciales (evitar hardcodear en producción) ---
load_dotenv()
EMAIL = os.getenv("MY_APP_EMAIL_CUSTOMER", "your_email@example.com")
PASSWORD = os.getenv("MY_APP_PASSWORD_CUSTOMER", "your_password")
URL = os.getenv("URL_CUSTOMER_LOGIN", "https://cuscatec.cuscatec.com/ecommerce/seller/login")

# --- INICIALIZAR DRIVER (Chrome) ---
options = webdriver.ChromeOptions()
# options.add_argument("--headless=new")  # descomenta si quieres modo headless
driver = webdriver.Chrome(service=ChromeService(ChromeDriverManager().install()), options=options)

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
    # --- Hacer click en el segundo div con class 'product-box' ---

    try:
        product_boxes = wait.until(EC.presence_of_all_elements_located((By.CLASS_NAME, "product-box")))
        if len(product_boxes) >= 2:
            product_boxes[1].click()  # índice 1 = segundo elemento
            print(" Click en el segundo product-box")
        else:
            print(" No se encontró un segundo product-box en la página")
    except Exception as e:
        print(" Error al intentar hacer click en el segundo product-box:", e)

    
    try:
    # Esperar el primer div con class 'quantity-container'
        quantity_container = wait.until(
        EC.presence_of_element_located((By.CLASS_NAME, "quantity-container"))
    )

    # Buscar los botones dentro de ese div
        buttons = quantity_container.find_elements(By.CLASS_NAME, "quantity-btn")

        if len(buttons) >= 2:
        # Click en el primer botón
            buttons[1].click()
            print("✅ Click en el segundo botón de quantity-btn")
            buttons[1].click()
            print("✅ Click en el segundo botón de quantity-btn")
            # Esperar 10 segundos
            time.sleep(10)

            # Click en el segundo botón
            buttons[0].click()
            print("✅ Click en el primer botón de quantity-btn")
            
        else:
            print("⚠️ No se encontraron al menos 2 botones con class 'quantity-btn'")

    except Exception as e:
        print("Error al interactuar con quantity-container:", e)
    
    
    time.sleep(10)

    driver.get("https://cuscatec.cuscatec.com/customer-ecommerce/cart")

    time.sleep(10)

        # ==============================
    # CALCULO DE TOTALES DEL CARRITO
    # ==============================
    try:
        # 1) Buscar todos los DIV que contengan un <p> con texto "Total"
        divs_total = wait.until(
            EC.presence_of_all_elements_located((By.XPATH, "//div[p[contains(text(), 'Total')]]"))
        )

        resultado = 0.0  # acumulador

        for div in divs_total:
            try:
                h5 = div.find_element(By.TAG_NAME, "h5")
                valor = h5.text.replace("$", "").strip()

                # Convertir a float
                valor_float = float(valor)
                resultado += valor_float
            except:
                print("⚠️ No se pudo procesar un h5 dentro de un div con Total")

        print(f"🔍 Suma de todos los Totales encontrados (resultado): {resultado}")

        # 2) Comparar con SUBTOTAL
        subtotal_text = driver.find_element(By.ID, "subtotal").text.replace("$", "").strip()
        subtotal_val = float(subtotal_text)

        if resultado == subtotal_val:
            print("✅ SUBTOTAL CORRECTO (coincide con la suma de Totales)")
        else:
            print(f"❌ Subtotal incorrecto. Esperado {resultado} pero la página muestra {subtotal_val}")

        # 3) Tomar descuento y restarlo
        discount_text = driver.find_element(By.ID, "discount").text.replace("$", "").strip()
        discount_val = float(discount_text)

        resultado -= discount_val
        print(f"📉 Resultado luego de restar descuento ({discount_val}): {resultado}")

        # 4) Tomar shipping y sumarlo
        shipping_text = driver.find_element(By.ID, "shipping").text.replace("$", "").strip()
        shipping_val = float(shipping_text)

        resultado += shipping_val
        print(f"🚚 Resultado luego de sumar envío ({shipping_val}): {resultado}")

        # 5) Comparar con TOTAL
        total_text = driver.find_element(By.ID, "total").text.replace("$", "").strip()
        total_val = float(total_text)

        if resultado == total_val:
            print("🎉 TOTAL CORRECTO: El cálculo coincide con el total mostrado")
        else:
            print(f"❌ TOTAL INCORRECTO. Resultado calculado: {resultado} | Total página: {total_val}")

    except Exception as e:
        print("❌ Error en el proceso de cálculo del carrito:", e)
finally:
    driver.quit()
