# Botin
Application to create and manipulate a directory of professional people using only a xml document.
This application is written to works on *unix servers

This application works with php and used those element to work :

* [Twiter-Bootstrap](http://getbootstrap.com/)
* [bootstrap-datepicker](http://bootstrap-datepicker.readthedocs.io/en/latest/)
* [jQuery UI autocomplete](https://jqueryui.com/autocomplete/)
* [jQuery](https://jquery.com/)
* [clipboard](https://clipboardjs.com/)

How to use it :

Admin part :

1. In index.php set xmlFile by giving path, writen as an url , of xml file used in the application and put in app folder
2. xml file should be backup somewhere and then on copy should be added to the app folder
3. An admin page to awepeople.html can be used to writen in the selected XML file.

User part :

1. User should have only acces to wepeople.html that cotain two panels :
  1. First Panel is to find person card
    *A card is a personal panel with all informations on searched person
  2. Second panel give access people in function of group (multi group can be selected in once):
    * "Tableau" = return a table with Name, SIM, Courriel, Startinf time in this group End date and if the person is still present or not.
    * "Courriel" =  return all email of people __still working__ in this group
    * "Courriel fusioné" = return all email of people  __still working__ in groups selected
