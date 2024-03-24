<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Flix Favorites</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div id="app">
        <header>
            <h1>Filme Favorites</h1>
            <form class="search" method="get">
                <label class="sr-only">Pesquisar filme</label>
                <input type="text" placeholder="Pesquisar filme" name="name">
                <button><i class="ph ph-magnifying-glass"></i></button>
            </form>
        </header>
        <table>
            <thead>
                <tr>
                    <th>Filme</th>
                    <th>Sinopce</th>
                    <th>Nota</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nameMovie = $_GET['name'];
                    $url = "https://api.themoviedb.org/3/search/movie?api_key=8734d18b1c59ba1e8242ff5d1d3704a5&query=$nameMovie&include_adult=false&language=pt-br&page=1";
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false); 
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"GET");

                    $result = json_decode(curl_exec($ch));

                    if ($result == null) {
                        echo "Filme não encotrado";
                    } else {
                        $title = $result -> results[0] -> title;

                        $description = $result -> results[0] -> overview;

                        $vote_average = $result -> results[0] -> vote_average;

                        $poster_path = $result -> results[0] -> poster_path;

                        $release_date = $result -> results[0] -> release_date;

                    }

                ?>

                <td class="film">
                    <img src="https://image.tmdb.org/t/p/w200/<?php echo $poster_path; ?>" alt="">
                    <div>
                        <p>
                            <?php
                                echo $title;
                             ?>
                        </p>
                        <span>
                            <?php
                                echo $release_date;
                             ?>
                        </span>
                    </div>
                </td>
                <td class="sinopce">
                    <?php
                        echo $description;
                    ?>
                </td>
                <td class="nota">
                    <?php
                        echo $vote_average ;
                    ?>
                </td>
                <td>
                    <button class="remove">&times</button>
                </td>
            </tbody>
        </table>
    </div>
</body>
</html>