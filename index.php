<?php
session_start();
$player1 = $_SESSION["name"][0];
$player2 = $_SESSION["name"][1];
print_r(array_search('w', $_SESSION["name"]));
if (!empty($player1) && !empty($player2)) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <style>
      #table td {
        width: 25px;
        height: 25px;
        border: 1px solid black;
      }

      table {
        position: absolute;
        top: 50%;
        left: 50%;
      }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  </head>

  <body>
    <div>Игрок 1 ( Name: <?= $player1 ?>) играет за <b>X</b></div>
    <div>Игрок 2 ( Name: <?= $player2 ?>) играет за <b>0</b></div>
    <button value="<?= $player1 ?>">Кнопка для выходы первого игрок</button>
    <button value="<?= $player2 ?>">Кнопка для выходы второго игрок</button>
    <table id="table">
      <?php
      for ($i = 1; $i <= 9; $i++) {
        if ($i == 1) {
          echo "\t<tr>";
        }
        echo '<td></td>';
        if ($i % 3 == 0) {
          echo "</tr>";
        }
      }
      ?>
      <script>
        let elements = document.querySelectorAll('#table td');
        let players = new Map([
          ["X", "<?= $player1 ?>"],
          ["0", "<?= $player2 ?>"]
        ]);
        play(elements);
     

        function play(elements) {

          let i = 0;
          for (let element of elements) {

            element.addEventListener('click', function step() {
              this.textContent = ["X", "0"][i % 2];
              this.removeEventListener('click', step);
              if (win(elements)) {
                let winPlayer = players.get(this.textContent);
                let losePlayer = players.get(secondPlayer(this.textContent))
                alert('выйграли игрок ' + winPlayer);

                $.ajax({
                  method: "POST",
                  url: "add.php",
                  data: {
                    winPlayer: winPlayer,
                    losePlayer: losePlayer,
                  }
                })
                location.reload();
              } else if (i == 8) {
                alert('ничья');
                location.reload();
              }
              i++;

            });
          }
        }

        function secondPlayer(key) {
          return (key == "0") ? "X" : "0";
        }

        function clear(elements) {
          for (let element of elements) {
            element.textContent = '';

          }
        }

        function win(elements) {
          let combs = [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],
            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8],
            [0, 4, 8],
            [2, 4, 6],
          ];
          for (let part of combs) {
            if (elements[part[0]].textContent == elements[part[1]].textContent &&
              elements[part[1]].textContent == elements[part[2]].textContent &&
              elements[part[0]].textContent != '') {
              return true;
            }
          }
          return false;
        }

        let buttons = document.querySelectorAll('button')
        for (let but of buttons) {
          let user = but.value
          but.addEventListener('click', function() {

            $.ajax({
              method: "POST",
              url: "session.php",
              data: {
                user: user,
              }
            })
            location.reload();

          })
        }
      </script>
    </table>
  </body>

  </html>
<?php
} else {
  header("Location:classes.php");
}
?>