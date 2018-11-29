# WorldWideImp
School webshop Library's
Using bootstrap 3.0
Using SweetAlert

Hoe voeg je een gebruiker toe aan mysql db ( Tutorial by EurekaGaming, EUG, SS, TEG ) ( <3 )

1. Ga naar control panel van xampp
2. Open shell (rechts in beeld, 3de van boven)
3. In de command line voer uit: mysql -u root -p
4. Voer wachtwoord in ( indien je die hebt gegeven aan xampp )
5. In de command line voer uit: use mysql;
6. In de command line voer uit: CREATE USER 'wwi'@'localhost' IDENTIFIED BY 'test';
7. In de command line voer uit: GRANT SELECT ON * . * TO wwi@'localhost’;
8. In de command line voer uit: GRANT INSERT ON * . * TO wwi@'localhost’;