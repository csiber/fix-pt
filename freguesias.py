import requests
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
        for elem in children:
            print elem
            print elem.name

        districts[counter]['freguesias'] = [elem.a.text.encode('utf-8').strip() 
            for elem in district.parent.find_next_sibling('ul').children if elem.name == 'li']

        counter += 1

    return districts

def main():
    print "Starting..."

    soup = get_soup(URL)
    districts = get_districts_dict(soup)

    # for key,value in districts.items():
    #     print key, value

if __name__ == '__main__':
    main()
