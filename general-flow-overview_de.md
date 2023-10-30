# PHP MD Blog

## index.php

- die aktuelle URL wird ausgelesen, der Query String , so wie "index.php" werden davon entfernt => übrig bleibt die Domain
- es wird auf die Blog Seite weitergeleitet



## blog.php

- in eine Variable wird der aktuelle Pfad ohne Query String gespeichert => wird später benötigt um den Link zu einem einzelnen Post zu bauen

### get_all_pages($path, $mad_converter)

- es werden alle Files des Pfades ausgelesen
- alle MD Files darunter werden in ein Array gespeichert
- von allen MD Files wird der Inhalt ausgelesen
- mit jedem MD wird ein neues Page Objekt erzeugt und in ein Array gespeichert

### get_all_snippets

- über das Page Objekt Array wird iteriert und die get_snippet() Methode aufgerufen
- das erhaltene Snippet wird in ein Array gespeichert

#### get_snippet()

- den MD Converter wird der Inhalt (String) des MD`s (des Page Objekts) übergeben  und in HTML Content umgewandelt
- über ein Assoziatives Array mit Regular Expressions wird iteriert, die Expression auf den HTML Content angewandt und der gefilterte Inhalt wird in ein Assoziatives Array gespeichert (pattern_name => "matched content")
- bei dem hashtags Pattern wird eine Verzweigung eingeleitet => es muss eine Schicht tiefer gegangen werden und die Listenpunkte + Inhalte werden geholt (dabei wird ein verschachteltes Array erzeugt)
- die Wörter des ersten Paragraphen werden in ein Array explodiert => nach dem 20ten Wort wird das Array abgeschnitten und daraus wieder ein String gemacht

### get_blog_metas()

- über die Snippets wird iteriert und die zweiten Einträge (ohne HTML Tags) der preg_match() Functions werden in Arrays gespeichert
- die Arrays werden aufsteigend sortiert
- es wird ein Array für alle Metadaten Arrays des Blogs erzeugt und zurückgegeben

### extract()

- das Array mit allen Blog Metadaten wird wieder in seine Einzelteile zerlegt

### condition - page or archive

- mit Hilfe der $_GET Variable wird überprüft ob eine spezielle Seite gesucht wird oder ob das Archiv geöffnet werden soll



## archive.view.php

### condition - special archive or all posts

- es wird überprüft ob ein Query String, mit einem Bereich und einem Begriff, vorhanden ist => aus dem Array von allen Seiten werden die passenden Einträge gefiltert
- wird nach einem Hashtag gesucht, wird über das Hashtag Array einer Seite iteriert und dabei zum einen überprüft ob der gesuchte Hashtag vorhanden ist und zum anderen wird gezählt wie oft der Hashtag vorkommt => nur bei Count = 1 wird die Seite returnt
- es wird eine HTML Line mit den Informationen zum aktuellen Filter erzeugt

### pagination

#### get the count of pagination pages

- die Anzahl der zuvor selektierten Pages wird durch die Anzahl an Posts die man per Seite anzeigen will dividiert

#### create the page links

- es wird ein Limit an Posts per Page ($limit) festgelegt
- es wird ein Limit an Seitenlinks ($pagination_limit), welche man generieren will,  festgelegt 
- in einem for Loop werden die Links generiert, solange das festgelegte Pagination Limit nicht überstiegen wird
- die Zählervariable($i) des Loops, wird immer um das Limit an Posts ($limit) erhöht
- innerhalb des Loops wird eine Variable "$pagination_number" verwendet um  den Content für die Pagination Link zu erzeugen

#### show the right extract of the pages array

- benötigt wird das Limit an Post per Page so wie ein Offset, von welchem aus die Posts/Seiten, aus dem Seiten Array genommen werden
- bei Seite 1 startet das Offset mit 0
- das benötigte Offset erhält man folgendermaßen => 
    - die aktuelle Archiv Seite wird aus der URL gelesen
    - diese wird mit dem Limit multipliziert
    - vom Ergebnis wird das Limit substrahiert
- die Posts die anzuzeigen sind werden mit array_slice() aus dem Seiten Array substrahiert
- noch bevor die Posts substrahiert werden, wird das Seiten Array mit usort() nach Datum sortiert


### single.view.php

- über die URL wird der Titel des gesuchten Posts ausgelesen
- im Seiten Array wird der gesuchte Post geholt (= Objekt)
- vom selektierten Post wird der Content aufgerufen
- falls der gesuchte Post nicht gefunden wird, wird auch die Archiv Seite weitergeleitet
