PHP_Projekt
===========

## Registrering

Registrera med blanka fält.

**Resultat:** Systemet presenterar "Username must have 3 letters and password 6 letters".

Registrera med endast giltigt Username

**Resultat:** Systemet presenterar "Password is to short. At least 6 letters".

Registrera och lämna repeat password blankt

**Resultat** Systemet pressenterar "Password doesn't match".

Registrerar sig mer 2 bokstäver i username och 4 i båda password.

**Resultat** Systemet presenterar "Username must have 3 letters and password 6 letters".

Registrera sig med taggar i Username.

**Resultat** Systemet presenterar "No valid letters in username".

Registrerar sig med taggar i password.

**Resultat** Systemet presenterar "Password doesn't match"

Registrerar sig med olika lösenord.

**Resultat** Systemet presenterar "Password doesn't match".

Registrerar sig med username som redan finns i databasen.

**Resultat** Systemet presenterar "The username is in use. Please try somthing else.".

Registrerar sig med giltiga värden.

**Resultat** Systemet presenterar "Success. Your welcome to login now.".



## Inloggning

Loggar in med tomma fält.

**Result** Systemet presenterar "Username is missing".

Loggar in med endast giltigt Username.

**Resultat** Systemet presenterar "Password is missing".

Loggar in med endast giltigt Password.

**Resultat** Systemet presenterar "Username is missing".

4. Loggar in med ogiltigt Username och Password.

**Resultat** Systemet presenterar "Username or Password is wrong".

Loggar in med giltigt Username och ogiltigt Password.

**Reslutat** Systemet presenterar "Username or password is wrong".

Loggar in med taggar i Username.

**Resultat** Systemet presenterar "No valid letters in Username".

Loggar in med taggar i Password.

**Resultat** Systemet presenterar "Username or password is wrong".

Loggar in med giltiga värden.

**Resultat** Man är inloggad.

Loggar in med giltiga värden och bockar i Remember me

**Resultat** Man är inloggad och cookies är skapade.



## Cookie och sessions

Inloggad. Tar bort session och gör en ny post.

**Resultat** Man är uloggad.

Inloggad. Kopierar session till en annan webbläsare som inte är inloggad. 

**Resultat** Fortfarande inte inloggad och systemet presenterar "Don't steal session please"

Inloggad, Remember Me. Tar bort session och gör en ny post.

**Resultat** Man är fortfarande inloggad och en ny session är startad.

Inloggad, Remember Me. Ändrar värdet i cookie.

**Resultat** Man är utloggad och systemet presenterar "No Valid Cookie".

Inloggad, Remember Me. Klickar på logout knappen.

**Resultat** Man är utloggad och både session och cookie är borta.

## Inlägg

Postar kommentar.

**Resultat** kommentaren blir postad.

Posta en tom kommentar.

**Resultat** Systemet presenterar "Please write somthing".

Posta en tom kommentar med bild.

**Resultat** Systemet presenterar "Please write somthing".

Postar med taggar

**Resultat** Kommentaren blir postad utan taggar.

Postar med whitespace

**Resultat** Systemet presenterar "Please write somthing".

Postar kommentar med bild.

**Resultat** Kommentaren blir postad med bilden.

Klickar på delete

**Resultat** Både bild och kommentar tas bort.

Klickar på edit och ändrar kommentaren.

**Resultat** Kommentaren blir ändrad.

Försöker ta bort en annan användares post.

**Resultat** Ingenting händer.

Försöker uppdatera någon annans kommentar

**Resultat** Uppdaterings formuläret kommer fram men kommentaren går inte att uppdatera.

Admin tar bort någon annans kommentar.

**Resultat** Kommentaren tas bort

Admin uppdaterar någon annans post.

**Resultat** Kommentaren uppdateras.

Laddar upp en fil som inte är jpg, png eller jpeg

**Resultat** Kommentaren läggs upp utan bild. Inget blir sparat i databasen.



## Ändra lösenord

Postar med ett blankt fält.

**Resultat** Systemet presenterar "Password is missing".

Postar med whitespace.

**Resultat** Systemet presenterar "Password is missing".

Postar med taggar.

**Resultat** Systemet presenterar "Invalid letters in password"

Postar med 3 bokstäver

**Result** Systemet presenterar "At least 6 letters in your password".

Postar med giltiga värden.

**Resultat** Systemet presenterar "The new password have been saved".

