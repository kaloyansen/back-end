<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container">
        <a href="/back-end/index.php/tickets">All Tickets</a>
        <div class="inputContainer">
            <label for="inputTicket">ticket id :</label>
            <input type="number" name="inputTicket" id="id_ticket">
            <a id="linkTicket" href="/back-end/index.php/tickets">voir le ticket</a>
        </div>
    </div>
    <script>
        let link = document.getElementById('linkTicket');
        let input = document.getElementById('id_ticket');
        console.log(input);
        input.addEventListener('change', () => {
            console.log('change')
            link.setAttribute('href', `/back-end/index.php/tickets?id=${input.value}`)
        })
    </script>
</body>
</html>