# Wordpress Klantenvertellen Plugin

Met deze plugin kunt u de Klantenvertellen widget aan uw eigen Wordpress website toevoegen. De plugin haalt data uit de XML feed aangeleverd door Klantenvertellen. Hij maakt gebruik van het Schema.org AggregateRating vocabulaire (**https://schema.org/AggregateRating**)

## Installatie
1. Ga naar **Plugins** > **Add new**  > **Upload plugin**
2. Upload de aangeleverde .zip file
3. Ga naar Plugins en activeer de plugin

### Handmatige installatie
1. Pak de .zip file uit
2. Upload met uw FTP programma de **klantenvertellen** folder naar de **wp-content/plugins** folder in uw online Wordpress directory
3. Ga naar Plugins en activeer de plugin

## Gebruik
U kunt de plugin plaatsen in uw eigen artikel of pagina door de volgende code te gebruiken:

```
[klantenvertellen slug="expertees" v="v1"]
```
**Parameters**
* ***SLUG*** - de naam van uw bedrijf zoals bij Klantenvertellen geregistreerd staat
* ***V*** - de versie van de plugin die u wilt gebruiken. Dit kan zijn v1, v6, v7, v8, v9, v10. Standaard - v1

Om de plugin in een thema te gebruiken heeft u de volgende php code nodig:

```
<?php echo do_shortcode('[klantenvertellen slug="expertees" v="v1"]'); ?>
```
