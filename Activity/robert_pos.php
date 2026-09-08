<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robert's Book Store</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Calling or Accessing the CSS from robert_pos.css file inside the CSS folder -->
    <link rel="stylesheet" href="css/robert_pos.css">
</head>
<body>
<div class="container page_border">
    <h1 style="text-align:center; margin-top:10px; font-size:70px; font-family:Algerian; color:black">
        Robert's Book Store</h1>
    <div style="float:left">
        <div class="pic_group">
            <div class="pic_option">
                <div><img src="book_images/How_i_killed_pluto.jpg" data-toggle="tooltip" data-placement="bottom" title="How I Killed Pluto" alt="How I Killed Pluto"></div>
                <div><img src="book_images/all_things_cease_to_appear.png" data-toggle="tooltip" data-placement="bottom" title="All Things Cease to Appear" alt="All Things Cease to Appear"></div>
                <div><img src="book_images/art_of_war.jpg" data-toggle="tooltip" data-placement="bottom" title="The Art of War" alt="The Art of War"></div>
                <div><img src="book_images/brothes_karamazov.jpg" data-toggle="tooltip" data-placement="bottom" title="The Brothers Karamazov" alt="The Brothers Karamazov"></div>
                <div><img src="book_images/closing_time.jpg" data-toggle="tooltip" data-placement="bottom" title="Closing Time" alt="Closing Time"></div>
                <div><img src="book_images/dead_astronauts.jpg" data-toggle="tooltip" data-placement="bottom" title="Dead Astronauts" alt="Dead Astronauts"></div>
                <div><img src="book_images/no_longer_human.jpg" data-toggle="tooltip" data-placement="bottom" title="No Longer Human" alt="No Longer Human"></div>
                <div><img src="book_images/no_to_disturb.jpg" data-toggle="tooltip" data-placement="bottom" title="Not to Disturb" alt="Not to Disturb"></div>
                <div><img src="book_images/numbers.jpg" data-toggle="tooltip" data-placement="bottom" title="Numbers" alt="Numbers"></div>
                <div><img src="book_images/the_mother_the_daughter.png" data-toggle="tooltip" data-placement="bottom" title="The Mother, The Daughter" alt="The Mother, The Daughter"></div>
                <div><img src="book_images/tyll.jpg" data-toggle="tooltip" data-placement="bottom" title="Tyll" alt="Tyll"></div>
                <div><img src="book_images/ugly_man.jpg" data-toggle="tooltip" data-placement="bottom" title="Ugly Man" alt="Ugly Man"></div>
            </div>
        </div>
    </div>
</div>

<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>
</html>