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

# --- CONFIG ---
load_dotenv()
EMAIL = os.getenv("MY_APP_EMAIL_ADMIN", "your_email@example.com")
PASSWORD = os.getenv("MY_APP_PASSWORD_ADMIN", "your_password")
URL = os.getenv("URL_ADMIN_LOGIN", "https://cuscatec.cuscatec.com/login")

options = webdriver.ChromeOptions()
driver = webdriver.Chrome(service=ChromeService(ChromeDriverManager().install()), options=options)

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
    time.sleep(500)
    

finally:
    
    driver.quit()
