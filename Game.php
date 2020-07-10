<?php

$site =
    '
    <h5>Liczba ruchów</h5> 
    <div id="ruchy">0</div>
    <h5>Twój zakres</h5>
    <div id="zakres">x</div>
    <br>
    <br>
    Zgadnij liczbę:
    <input type="number" onfocusout="CheckNumber()" id="numberGameIn">
    <br>
    <br>
    <button onclick="GuessNumber()" class="btn btn-success btn-lg">Potwierdź liczbę</button>     
    <br>
    <br>
    <div id="msgs"></div>
';

echo $site;