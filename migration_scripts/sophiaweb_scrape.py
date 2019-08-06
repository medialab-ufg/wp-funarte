from collections import defaultdict
from selenium.webdriver.common.by import By
from selenium import webdriver
import csv


itens_dict = defaultdict(list)
values_dict = {'Inf. publicação ':'', 'Número de chamada ':'', 'Título ':'', 'Imprenta ':'', 'Desc. física ':'',
               'Notas ':'', 'Link do título ':'', 'Classificação ':'', 'Gerais ':'', 'Locais ':''}
#Set webdriver for browser sophia pages
browser = webdriver.Chrome("C:\Python36\chromedriver.exe")
browser.set_page_load_timeout(600)

with open('url_colecoes.csv', encoding="utf-8") as csvfile:
    
    #Read url csv
    leitorArquivo = csv.reader(csvfile)
    
    with open('sophia_values_teste.csv', 'w', encoding = "utf-8", newline='') as out_file:
       
        for row in leitorArquivo:
        
            # <class 'selenium.webdriver.firefox.webdriver.WebDriver'>
            browser.get(row[0]) #Get the url from csv
            frame = browser.find_element_by_id("mainFrame");
            #find_elements_by_xpath("//*[@class='div_conteudo visible']")
            browser.switch_to.frame(frame) #Set to metadata frame
            
            metadados = browser.find_element_by_xpath("//*[@class='max_width table-ficha-detalhes']").find_elements_by_tag_name("tr") #Get the values from metadata frame
            #metadados_recuo = browser.find_elements_by_xpath("//*[@class='td_detalhe_descricao_recuo']") #Get the values from metadata frame
            
            valores = []
            for linha in metadados:
                valores.append(linha.text)
            
            #Write list into a csv
            
            writer = csv.writer(out_file, quoting=csv.QUOTE_MINIMAL)
            writer.writerow(valores)
