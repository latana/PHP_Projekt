PHP_Projekt
===========

## Registrering

1. Registrera med blanka fält.

**Resultat:** Systemet presenterar "Username must have 3 letters and password 6 letters".

2. Registrera med endast Username

**Resultat:** Systemet presenterar "Password is to short. At least 6 letters".

3. Registrera och lämna repeat password blankt

**Resultat** Systemet pressenterar "Password doesn't match".

4. Registrerar sig mer 2 bokstäver i username och 4 i båda password.

**Resultat** Systemet presenterar "Username must have 3 letters and password 6 letters".

5. Registrera sig med taggar i Username. Tex "<a>hastags</a>".

**Resultat** Systemet presenterar "No valid letters in username".

6. Registrerar sig med olika lösenord.

**Result** Systemet presenterar "Password doesn't match".
