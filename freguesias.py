import requests
import json
from bs4 import BeautifulSoup

URL = 'http://pt.wikipedia.org/wiki/Anexo:Lista_de_freguesias_de_Portugal'


def get_soup(url):
    return BeautifulSoup(requests.get(url).text)


def get_districts_dict(soup):
    districts = {}
    counter = 1
    for district in soup.select('h3 > span.mw-headline'):
        districts[counter] = {}
        districts[counter]['name'] = district.a.text.encode('utf-8').strip()

        children = district.parent.find_next_sibling('ul').children

        districts[counter]['freguesias'] = []
        for elem in district.parent.find_next_sibling('ul').children:
            try:
                if elem.name == 'li':
                    districts[counter]['freguesias'].append(elem.a.text.encode('utf-8').strip())
            except Exception, e:
                pass

        counter += 1

    return districts

def main():
    print "Starting..."

    soup = get_soup(URL)
    districts = get_districts_dict(soup)

    with open("districts.json", "w") as f:
        f.write(json.dumps(districts, sort_keys=True, indent=4, separators=(',', ": ")))

if __name__ == '__main__':
    main()
