# -*- coding: utf-8 -*-
"""

Created on Fri Apr  5 16:58:28 2019

@author: Luis

"""

import requests
import re
from bs4 import BeautifulSoup
import csv


url = 'http://www.funarte.gov.br/brasilmemoriadasartes/acervo/atores-do-brasil/audios/audios-entrevistas'

r = requests.get(url)

string = r.text

soup = BeautifulSoup(r.text, "html.parser")

regex = r"((?<=<li>Título: <span>)|(?<=<li>Ano: <span>)|(?<=<li>Intérprete\(s\): <span>)|(?<=<li>Faixa: <span>)|(?<=\)\.data\('url', '))(.*?)((?=</span></li>)|(?='\);</script>))"

matches = re.findall(regex, string)

i=0

lista_aux =[]
with open('autores_brasil.csv', 'w', encoding = "utf-8", newline='') as out_file:
    
    writer = csv.writer(out_file, quoting=csv.QUOTE_MINIMAL)
        
    for i in range(len(matches)):
        lista_aux.append(matches[i][1])
        
        if ".mp3" in matches[i][1]:
            writer.writerow(["|".join(lista_aux)])
            lista_aux.clear()
