import scrapy
import os
import random

IS_LOCAL = False
PRODUCTS_MAX = 1100

LOCAL_ENTRY_POINTS = [
    'file://e:/workspace/Scrapy/ASUS Radeon RX 580 Dual OC 4GB GDDR5 - Karty graficzne AMD - Sklep komputerowy - x-kom.pl.html',
]

REMOTE_ENTRY_POINTS = [
    'https://www.x-kom.pl/g-5/c/345-karty-graficzne.html',
    'https://www.x-kom.pl/g-2/c/159-laptopy-notebooki-ultrabooki.html',
    'https://www.x-kom.pl/g-4/c/1590-smartfony-i-telefony.html',
    'https://www.x-kom.pl/g-5/c/28-pamieci-ram.html'
]

SETTINGS = {
    'COOKIES_ENABLED': False,
    'CONCURRENT_REQUESTS': 100,
    'DEPTH_PRIORITY' : 1,
    'SCHEDULER_DISK_QUEUE' : 'scrapy.squeues.PickleFifoDiskQueue',
    'SCHEDULER_MEMORY_QUEUE' : 'scrapy.squeues.FifoMemoryQueue'
}

Hashes = {
    'product_name': 'data-product-name',
    'product_brand': 'data-product-brand',
    'product_price': 'data-product-price',
    'product_category': 'data-product-category',

    'description': 'fresh-content',
    
    'categories': 'dwaJTI',
    #'price': 'cFNHuG',
    'main_photo': 'bGxSBM',
    #'params': 'ZosGi',
    #'params_key': 'kAzEEb',
    #'params_value': 'kSXTpu',
    #'details': 'jmiIrE',
    #'details_key': 'kAqCCK',
    #'details_value': 'fzdKtr',
    
    
    
    'product_page_link': 'foJNzj',
    'next_page_link': 'next',
    'prev_page_link': 'prev'
}



class x_komSpider(scrapy.Spider):
    name = 'x-komSpider'
    start_urls = []
    _products_cnt = 0
    _categories = []
    _categoriesOffset = 20
    _exited = False

    def __init__(self):
        self.custom_settings = SETTINGS
        self.start_urls = list( dict.fromkeys( REMOTE_ENTRY_POINTS if not IS_LOCAL else LOCAL_ENTRY_POINTS) )
    
    def parse(self, response):
        #print(f"Visiting {response.url}...")
        
        if self._products_cnt % 50 == 0:
            print(f"Progress: {self._products_cnt*100.0/PRODUCTS_MAX}%")

        if self._products_cnt >= PRODUCTS_MAX:
            if not self._exited:
                self._exited = True
                print(f"Progress: 100%")
                self._SaveCategories()

            raise scrapy.exceptions.CloseSpider("PRODUCTS_MAX achieved, exiting...")
        
        if self._IsProductSite(response.url) or IS_LOCAL:
            #Product page
            self._products_cnt += 1
            yield self._GetProduct(response)
        
        else:
            # Category page
            if not IS_LOCAL:
                for product in response.xpath(self._GetXPathOfProductWithinCategoryPage()):
                    yield response.follow(product, self.parse)
                for page in response.xpath("//head/link[@rel='next']"):
                    yield response.follow(page, self.parse)
                for page in response.xpath("//head/link[@rel='prev']"):
                    yield response.follow(page, self.parse)
    
    def _IsProductSite(self, url):
        return url.startswith("https://www.x-kom.pl/p/")
    
    def _GetProduct(self, response):
        return {
            'id': self._products_cnt,
            'name': response.css(f"div::attr({Hashes['product_name']})").extract_first(),
            'brand': response.css(f"div::attr({Hashes['product_brand']})").extract_first(),
            'price': response.css(f"div::attr({Hashes['product_price']})").extract_first(),
            'category': self._GetCategoryId(response.css(f"div::attr({Hashes['product_category']})").extract_first()),
            
            'description': self._ProcessHtml(response.xpath(f"//div[has-class('{Hashes['description']}')]").extract()),
            'photo': response.xpath(f"//img[has-class('{Hashes['main_photo']}')]//@src").extract_first(),
            'url': response.url,
        }

    def _GetCategoryId(self, categoryStr):
        if not categoryStr in self._categories:
            self._categories.append(categoryStr)
            print(categoryStr)
        return self._categories.index(categoryStr) + self._categoriesOffset

    def _GetXPathOfProductWithinCategoryPage(self):
        return f"//div[has-class('{Hashes['product_page_link']}')]//@href"
        

    def _ProcessHtml(self, htmlElements):
        strArray = list(map(str.strip, htmlElements))
        strArray = filter(None, strArray)
        string = "".join(strArray)
        string = string.replace("\n", "")
        string = string.replace("\t", "")
        string = string.replace("\r", "")
        string = string.replace("\"", "'")
        return string
    
    def _SaveCategories(self):
        with open("categories.txt", "w") as file:
            file.write("id, name\n")
            for (catId, catStr) in enumerate(self._categories):
                file.write(f"{catId + self._categoriesOffset}, {catStr}\n")
     