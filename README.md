# P2-score-calculator
El programa recibe los marcadores y deberá indicar el ganador (no hay empates, se puede asumir siempre existe un ganador único)
<br>
<br>
Como ejecutarlo en entorno local
si por defecto queremos llamar el programa con el archivo ejemplo "file1.txt" se llamara la url de la siguiente manera:<br>
http://localhost/P2-score-calculator/P2-score-calculator.php
si queremos probar con un archivo diferente, sera necesario colocar dicho archivo en la carpeta "test-files/" y pasar el nombre del archivo en el request,
el nombre del archivo puede venir en POST o GET "score_file". Ejemplo en la isguiente url mandaremos verificar el archivo "file2.txt":<br>
http://localhost/P2-score-calculator/P2-score-calculator.php?score_file=file2.txt
