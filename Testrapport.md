PHP_Projekt
===========

## Registrering

1. Registrera med blanka fält.

**Resultat:** Systemet presenterar "Username must have 3 letters and password 6 letters".

2. Registrera med endast giltigt Username

**Resultat:** Systemet presenterar "Password is to short. At least 6 letters".

3. Registrera och lämna repeat password blankt

**Resultat** Systemet pressenterar "Password doesn't match".

4. Registrerar sig mer 2 bokstäver i username och 4 i båda password.

**Resultat** Systemet presenterar "Username must have 3 letters and password 6 letters".

5. Registrera sig med taggar i Username.

**Resultat** Systemet presenterar "No valid letters in username".

6. Registrerar sig med taggar i password.

**Resultat** Systemet presenterar "Password doesn't match"

7. Registrerar sig med olika lösenord.

**Resultat** Systemet presenterar "Password doesn't match".

8. Registrerar sig med username som redan finns i databasen.

**Resultat** Systemet presenterar "The username is in use. Please try somthing else.".

9. Registrerar sig med giltiga värden.

**Resultat** Systemet presenterar "Success. Your welcome to login now.".



## Inloggning

1. Loggar in med tomma fält.

**Result** Systemet presenterar "Username is missing".

2. Loggar in med endast giltigt Username.

**Resultat** Systemet presenterar "Password is missing".

3. Loggar in med endast giltigt Password.

**Resultat** Systemet presenterar "Username is missing".

4. Loggar in med ogiltigt Username och Password.

**Resultat** Systemet presenterar "Username or Password is wrong".

5. Loggar in med giltigt Username och ogiltigt Password.

**Reslutat** Systemet presenterar "Username or password is wrong".

6. Loggar in med taggar i Username.

**Resultat** Systemet presenterar "No valid letters in Username".

7. Loggar in med taggar i Password.

**Resultat** Systemet presenterar "Username or password is wrong".

8. Loggar in med giltiga värden.

**Resultat** Man är inloggad.

9. Loggar in med giltiga värden och bockar i Remember me

**Resultat** Man är inloggad och cookies är skapade.



## Cookie och sessions

1. Inloggad. Tar bort session och gör en ny post.

**Resultat** Man är uloggad.

2. Inloggad. Kopierar session till en annan webbläsare som inte är inloggad. 

**Resultat** Fortfarande inte inloggad och systemet presenterar "Don't steal session please"

3. Inloggad, Remember Me. Tar bort session och gör en ny post.

**Resultat** Man är fortfarande inloggad och en ny session är startad.

4. Inloggad, Remember Me. Ändrar värdet i cookie.

**Resultat** Man är utloggad och systemet presenterar "No Valid Cookie".

5. Inloggad, Remember Me. Klickar på logout knappen.

**Resultat** Man är utloggad och både session och cookie är borta.

## Inlägg

1. Postar kommentar.

**Resultat** kommentaren blir postad.

2. Posta en tom kommentar.

**Resultat** Systemet presenterar "Please write somthing".

3. Posta en tom kommentar med bild.

**Resultat** Systemet presenterar "Please write somthing".

4. Postar med taggar

**Resultat** Kommentaren blir postad utan taggar.

5. Postar med whitespace

**Resultat** Systemet presenterar "Please write somthing".

6. Postar kommentar med bild.

**Resultat** Kommentaren blir postad med bilden.

7. Klickar på delete

**Resultat** Både bild och kommentar tas bort.

8 Klickar på edit och ändrar kommentaren.

**Resultat** Kommentaren blir ändrad.

9. Försöker ta bort en annan användares post.

**Resultat** Ingenting händer.

10. Försöker uppdatera någon annans kommentar

**Resultat** Uppdaterings formuläret kommer fram men kommentaren går inte att uppdatera.

11. Admin tar bort någon annans kommentar.

**Resultat** Kommentaren tas bort

12. Admin uppdaterar någon annans post.

**Resultat** Kommentaren uppdateras.

13. Laddar upp en fil som inte är jpg, png eller jpeg

**Resultat** Kommentaren läggs upp utan bild. Inget blir sparat i databasen.



## Ändra lösenord

1. Postar med ett blankt fält.

**Resultat** Systemet presenterar "Password is missing".

2. Postar med whitespace.

**Resultat** Systemet presenterar "Password is missing".

3. Postar med taggar.

**Resultat** Systemet presenterar "Invalid letters in password"

4. Postar med 3 bokstäver

**Result** Systemet presenterar "At least 6 letters in your password".

5. Postar med giltiga värden.

**Resultat** Systemet presenterar "The new password have been saved".

