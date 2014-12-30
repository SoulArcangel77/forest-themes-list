Forest Themes List
==================

* **Plugin Name:** Forest Themes List
* **Plugin URI:** http://www.mediaclaim.it/forest-themes-list-wp-plugin/
* **Description:** Forest Themes List è un plugin NON UFFICIALE della EnvantoMarket che, tramite uno shortcode, visualizza una galleria di temi di ThemeForest al fine di poter realizzare un preventivo per i propri clienti. ( Forest Themes List is an EnvantoMarket's UNOFFICIAL plugin that show a gallery themes from ThemeForest to be able to create a pricing for its customers. ) - SHORTCODE: [ftl_gallery]
* **Version:** 0.1
* **Author:** MediaClaim (Fabrizio Zippo)
* **Author URI:** http://www.mediaclaim.it
* **Requires at least:** 4.0
* **Tested up to:** 4.1
* **Tags:** gallery, themeforest, evanto, template, theme
* **License:** GPLv2 or later
* **License URI:** http://www.gnu.org/licenses/gpl-2.0.html

#Requisiti di sistema

* PHP5
* Wordpress 4.0 o sup.
* Un plugin per la visualizzazione dei moduli, es. [Contact Form 7](https://wordpress.org/plugins/contact-form-7/)  (opzionale)

# Installazione

Dopo aver scaricato il file zip, entra nell'area di amministrazione di Wordpress e segui i seguenti passi:

1. Clicca su **Plugin**
2. Clicca su **Aggiungi nuovo**
3. Clicca su **Carica plugin**
4. **Seleziona** il file zip dal percorso in cui l'hai salvato e clicca su **Installa adesso**
5. **Attiva plugin**

![image](http://www.mediaclaim.it/wp-content/uploads/2014/12/installazione_ftl_1.jpg)

# Configurazione

Per configurare il plugin nell'area di amministrazione di Wordpress devi:

6. Cliccare su **Impostazioni**
7. Cliccare su **Forest Themes List**

Nella prima sezione della configurazione, potete inserire la vostra username del vostro account Evanto, così da poter guadagnare dall'affiliazione dell'EvantoMarket, nel caso in cui il vostro cliente acquisti da solo il tema scelto partendo dal vostro sito.

Nella sezione del cambio valuta potete inserire i dati per convertire il prezzo del tema visualizzato.

Nella sezione delle opzioni avanzate potete far comparire il pulsante "Seleziona" sotto ogni tema. Questo da la possibilità al vostro cliente, dopo la selezione del tema, di inviarvi una richiesta di preventivo.

![image](http://www.mediaclaim.it/wp-content/uploads/2014/12/installazione_ftl_2.jpg)

# Modalità d'uso

Per visualizzare la gallery di ThemeForest è necessario prima di tutto creare una nuova pagina. All'interno della pagina potete inserire uno dei seguenti shortcode:

- Senza modulo di richiesta preventivo

* **[ftl_gallery]** (visualizza la galleria dei temi di Wordpress di ThemeForest, rif. http://themeforest.net/category/wordpress)
* **[ftl_gallery category="ecommerce/opencart"]** (visualizza la galleria dei temi di OpenCart, rif. http://themeforest.net/category/ecommerce/opencart)


- Con il modulo di richiesta preventivo

* **[ftl_gallery category="ecommerce/prestashop" input="selectedTheme"]** (visualizza la galleria dei temi di Prestashop ed aggiunge sotto ogni tema un pulsante di selezione)

Se avete abilitato le opzioni avanzate con la visualizzazione del bottone "select" è necessario inserire lo shortcode del vostro modulo. Il plugin è stato testato sia con [Contact Form 7](https://wordpress.org/plugins/contact-form-7/), sia con [Form Maker](https://wordpress.org/plugins/form-maker/). In questo caso il modulo sarà visibile solo dopo aver selezionato il tema.

![image](http://www.mediaclaim.it/wp-content/uploads/2014/12/uso_ftl.jpg)

## Opzioni dello shortcode

Le opzioni disponibili sono:

* **category** : visualizza i temi di ThemeForest di una determinata categoria (default: Wordpress)
* **input** : indica il nome del campo di testo (o nascosto) del modulo situato all'interno della pagina dove il plugin salva il link del tema selezionato (es. <input type="text" name="selectedTheme" value="" readonly="readonly" /> )
 
# Consigli

Per evitare errori di indicizzazione, consiglio l'installazione del modulo [WordPress Meta Robots](https://wordpress.org/plugins/wordpress-meta-robots/) ed impostare il meta robots della pagina contenente questo plugin in "index,nofollow". Questo perché i link dei template vengono corretti in javascript, mentre i robots seguirebbero un link errato. (N.b. Questo plugin funziona anche su WP 4.1)
