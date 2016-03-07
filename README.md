Wordpress Klantenvertellen Plugin
=================================

Met deze plugin kunt u de Klantenvertellen widget aan uw eigen Wordpress website toevoegen. De plugin haalt data uit de XML feed aangeleverd door Klantenvertellen en maakt gebruik van het Schema.org AggregateRating vocabulaire (**https://schema.org/AggregateRating**) waardoor zoekmachines de waarderingen aan de zoekresultaten toevoegen.

Voor een optimaal resultaat moeten de bedrijfsgegevens gekoppeld worden aan de waarderingen. Door deze gegevens aan de plugin mee te geven worden deze naast de widget getoond. Eventueel zijn deze gegevens ook te verbergen. Dit is echter niet aan te raden.

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

**Parameters**<br/>
***slug*** - de afkorting van uw bedrijf zoals bij Klantenvertellen geregistreerd staat<br/>
***v*** - de versie van de plugin die u wilt gebruiken. Dit kan zijn v1, v6, v7, v8, v9, v10. Standaard - v1<br/>

**Optionele parameters**<br/>
***name*** - De naam van uw bedrijf <br/>
***street*** - Adres van uw bedrijf<br/>
***postalcode*** - Postcode van uw bedrijf<br/>
***city*** - De vestigingsplaats van uw bedrijf<br/>
***telephone*** - Het telefoonnummer van uw bedrijf<br/>
***hide*** - Wanneer u 'true' invult worden de bedrijfsgegevens wel in de html toegevoegd maar niet getoond.<br/>

Om de plugin in een thema te gebruiken heeft u de volgende php code nodig:

```
<?php echo do_shortcode('[klantenvertellen slug="expertees" v="v1"]'); ?>
```


