PHP_Projekt
===========

## Projekt dokumentation

Tanken med projektet var att jag skulle göra ett forum för alla utbytesstudenter som jag bodde med förra året.
Behovet dök mest upp från de utbytesstudenter som bor i kina då facebook, twitter och andra sociala medier är blockade där.

Därav fick webbplatsen sitt tillfälliga namn. Byggnad 31 var nämnligen vårt nummer.
Med tiden hade jag hoppats kunna styla sidan efter byggnaden och få den så tilltalande som möjlig så att elever faktiskt skulle använda den.

Men en snygg webbplats är inte tillräckligt utan den måste vara funktionsduglig också.
Tanken är att man skall kunna logga in och posta meddelanden och bilder.
Jag hade hoppats på att hinna göra webbplatsen mer personlig men det får i så fall vara utanför studiernas ramar.
Då hade jag tänkt att man skulle kunna lägga upp en profilbild som läggs upp brevid ens användarnamn.
Det hade också varit trevligt med något slags kommentarsystem så att man vet vem som svarar på vad... Tex som vissa forum har när de kopierar någon annans innehåll och har i sin post.

Jag fick inga riktigt stora programmeringsproblem förr än jag bestämde mig för att hämpa ut mina poster i en array som i sin tur innehöll tre andra arrayer. Var och en innehöll id, användarnamn och kommentar som jag sen loopade igenom för att få ut varje post.
Efter att jag var klar och lämnade datorn för en stund så började jag fundera på ifall det inte fanns något bättre sätt.
Efter mycket sökande och tittande på föreläsningar så förstod jag att lösningen fanns i att skjuta in det i ett objekt.
Det jag inte var helt säker på var ifall det var enligt mvc eller inte.
Om inte annat så har jag blivit mycket mer bekväm med att använda objekt och vilken fördel de har.

Jag förlorade dessvärre mycket tid när jag testade mot phpmyadmin. Det ursprungliga felet var att jag hade fel i
min sql satts men pga en bugg så fick jag felmeddelandet att det inte kunde få kontakt med databasen.

Mitt mål har alltid varit att få fart på funktionaliteten. Att kunna ha en relativt säker inloggning och att kunna lägga upp kommentarer och bilder på ett lätt och smidigt sätt.

Kodmässigt skulle jag inte vilja säga att jag är nöjd.
Det är aldrig kul att visa upp kod som man inte är stolt över men brist på tid tvingar fram sånt.

Det började med att jag hade svårt att separera min uppgifter ifrån min LoginView.
Jag tyckte att han började få hand om mycket men kom inte på något effektivt sätt att sära på hans uppgifter.
För stunden så beslutade jag mig för att separera LoginViews uppgifter under ett senare tillfälle då hans ansvar kanske växt och kanske då är lättare att fixa.

Överlag en lärorik period där jag fick användning för det mesta man lärt sig inom programmering och om jag får tid så ska jag nog fortsätta utveckla detta forum tills jag är tillräkligt nöjd för att visa mina utlandsvänner.

Jag hade t.e.x kunnat göra en postView som innehåller funktionerna inom det som postas på sidan och därav också en postController och en postModel.




