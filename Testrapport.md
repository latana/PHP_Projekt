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





















