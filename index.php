<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Gra liczby</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<script>

    var playerName;
    var bP = 0;
    var eP = 0;
    let moves = 0;
    let numberToGuess = 0;
    let standard;

    $(function ()
    {
        LoadMainSite();
    });

    function LoadMainSite()
    {
        LoadPolegry("MainSite.php");
    }
    
    function BeginGame()
    {

        playerName = $("#playerName").val();
        LoadPolegry("GameBegin.php")
    }
    
    function intervalCheck()
    {
        bP = parseInt(document.getElementById("pPrzedzial").value);
        eP = parseInt(document.getElementById("kPrzedzial").value);

        if (bP >= eP)
        {
            alert("Źle podany przedział!!!");
            BeginGame();
        }

        numberToGuess = Math.floor(Math.random()*(eP + bP) - bP);

        LoadPolegry("Game.php");
        standard = Math.log2(eP - bP);
        updatePlayerStats();
    }

    function CheckNumber()
    {
        let value = document.getElementById("numberGameIn").value;
        if (value < bP || value > eP)
        {
            alert("Podano liczbę z poza przedziału!");
        }
    }

    function LoadPolegry(name)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("polegry").innerHTML = "";
                document.getElementById("polegry").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", name, false);
        xmlhttp.send();
    }
    
    function updatePlayerStats()
    {
        let zakres = "<" + bP + "; " + eP + ">";
        document.getElementById("ruchy").innerHTML = moves.toString();
        document.getElementById("zakres").innerHTML = zakres;
    }
    
    function GuessNumber()
    {
        let value = document.getElementById("numberGameIn").value;
        document.getElementById("numberGameIn").value = null;

        if (value < bP || value > eP)
        {
            moves++;
            let mm = "<h4>Liczba poza przedziałem :( </h4>";
            udpateLastMsg(mm);
            updatePlayerStats();
        }
        else if (value > numberToGuess)
        {
            eP = value;
            moves++;
            let mm = "<h4>Liczba większa od szukanej!</h4>";
            udpateLastMsg(mm);
            updatePlayerStats();
        }
        else if (value < numberToGuess)
        {
            bP = value;
            moves++;
            let mm = "<h4>Liczba mniejsza od szukanej!</h4>";
            udpateLastMsg(mm);
            updatePlayerStats();
        }
        else
        {
            moves++;
            let mm = "<h1>Odgadłeś liczbę!!!!</h1>";
            udpateLastMsg(mm);
            updatePlayerStats();
            setTimeout(afterWin(), 5000);
        }
    }
    
    function udpateLastMsg(msg)
    {
        document.getElementById("msgs").innerHTML = msg;
    }

    function afterWin()
    {
        let score = Math.floor((standard/moves)*100);
        $.ajax({
            url: "dodajWynik.php",
            type: "POST",
            dataType: "json",
            method: "POST",
            async: false,
            data: {
                'name': playerName,
                'score': score
            },
            success:function()
            {

            },
            error: function()
            {
                console.log('Fatal error');
            }
        });
        LoadPolegry("ScoreBoard.php");
        document.getElementById("scoreBoardPlayer").innerHTML = "<b>"+score+"</b>";
    }

</script>


<div class="container">

    <div id="polegry">

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
